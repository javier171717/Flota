<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuarios_model');
        $this->load->model('Conductores_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        // Si ya está logueado, redirigir al dashboard
        if ($this->session->userdata('logged_in')) {
            redirect('flota');
        }
        
        // Mostrar formulario de login
        $this->load->view('auth/login');
    }

    public function login() {
        // Procesar login directamente
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->Usuarios_model->authenticate($email, $password);

            if ($user) {
                // Login exitoso
                $user_data = array(
                    'user_id' => $user->id,
                    'nombre' => $user->nombre,
                    'email' => $user->email,
                    'rol' => $user->rol,
                    'logged_in' => TRUE
                );

                $this->session->set_userdata($user_data);
                
                // Redirigir al dashboard
                redirect('flota');
            } else {
                // Login fallido
                $this->session->set_flashdata('error', 'Email o contraseña incorrectos');
                redirect('auth');
            }
        } else {
            // Mostrar formulario de login
            $this->load->view('auth/login');
        }
    }

    public function register() {
        // Si ya está logueado, redirigir al dashboard
        if ($this->session->userdata('logged_in')) {
            redirect('flota');
        }

        // Procesar registro
        if ($this->input->post()) {
            // Validar el formulario
            $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|min_length[2]|max_length[50]|regex_match[/^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]+$/]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[usuarios.email]');
            $this->form_validation->set_rules('rol', 'Rol', 'required|in_list[operador,conductor,admin]');
            
            // Validar licencia solo si el rol es conductor
            if ($this->input->post('rol') === 'conductor') {
                $this->form_validation->set_rules('licencia', 'Número de Licencia', 'required|trim|min_length[5]|max_length[20]');
            }
            
            $this->form_validation->set_rules('password', 'Contraseña', 'required|trim|min_length[6]|max_length[20]');
            $this->form_validation->set_rules('confirm_password', 'Confirmar Contraseña', 'required|trim|matches[password]');

            // Mensajes personalizados
            $this->form_validation->set_message('is_unique', 'El %s ya está registrado en el sistema.');
            $this->form_validation->set_message('valid_email', 'El campo %s debe contener un email válido.');
            $this->form_validation->set_message('in_list', 'El campo %s debe ser uno de los valores permitidos.');
            $this->form_validation->set_message('regex_match', 'El campo %s solo debe contener letras y espacios.');
            $this->form_validation->set_message('matches', 'El campo %s debe coincidir con la contraseña.');

            if ($this->form_validation->run() == FALSE) {
                // Si hay errores de validación, mostrar el formulario con errores
                $this->load->view('auth/register');
            } else {
                // Verificar si el email ya existe antes de intentar crear
                $existing_user = $this->Usuarios_model->get_by_email($this->input->post('email'));
                if ($existing_user) {
                    $this->session->set_flashdata('error', 'El email <strong>' . $this->input->post('email') . '</strong> ya está registrado en el sistema. Si ya tienes una cuenta, puedes <a href="' . base_url('auth') . '">iniciar sesión aquí</a>. Si olvidaste tu contraseña, contacta al administrador.');
                    redirect('auth/register');
                }
                
                // VALIDACIÓN DE SEGURIDAD: Si el rol es conductor, verificar que esté en la lista de conductores
                if ($this->input->post('rol') === 'conductor') {
                    try {
                        // Verificar que se proporcione el número de licencia
                        if (empty($this->input->post('licencia'))) {
                            $this->session->set_flashdata('error', '<strong>Acceso Restringido</strong><br><br>Para registrarte como conductor, debes contactar al administrador del sistema.<br><br>El administrador te explicará el proceso y te incluirá en la lista de conductores autorizados.');
                            redirect('auth/register');
                        }
                        
                        // Verificar que la licencia esté en la lista de conductores autorizados
                        $conductor = $this->Conductores_model->get_by_licencia($this->input->post('licencia'));
                        if (!$conductor) {
                            $this->session->set_flashdata('error', '<strong>Acceso Denegado</strong><br><br>Tu número de licencia no está autorizado para registrarte como conductor.<br><br>Por favor, contacta al administrador del sistema para solicitar acceso.<br><br><strong>Información para el administrador:</strong> Usuario ' . $this->input->post('nombre') . ' con licencia ' . $this->input->post('licencia') . ' solicitó registro como conductor.');
                            redirect('auth/register');
                        }
                        
                        // Log de éxito para debugging
                        log_message('info', 'Conductor autorizado encontrado: ' . $conductor->nombre . ' con licencia: ' . $this->input->post('licencia'));
                        
                    } catch (Exception $e) {
                        // Log del error para debugging
                        log_message('error', 'Error en validación de conductor: ' . $e->getMessage());
                        
                        $this->session->set_flashdata('error', '<strong>Error del Sistema</strong><br><br>Ocurrió un error al validar tu licencia de conductor.<br><br>Por favor, contacta al administrador del sistema.<br><br><strong>Error técnico:</strong> ' . $e->getMessage());
                        redirect('auth/register');
                    }
                }
                
                // Procesar registro
                $data = array(
                    'nombre' => $this->input->post('nombre'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    'rol' => $this->input->post('rol'),
                    'estado' => 'activo'
                );

                $user_id = $this->Usuarios_model->create($data);

                if ($user_id) {
                    // Registro exitoso - SOLUCIÓN SIMPLIFICADA
                    $this->session->set_flashdata('success', '¡Usuario registrado exitosamente! Ya puedes hacer login con tu nueva cuenta.');
                    
                    // Cargar vista de éxito directamente (sin redirección)
                    $data['title'] = 'Registro Exitoso';
                    $data['redirect_url'] = base_url('auth');
                    $this->load->view('auth/register_success', $data);
                    return;
                } else {
                    // Error en el registro
                    $this->session->set_flashdata('error', 'Ocurrió un error inesperado al registrar el usuario. Por favor, inténtalo nuevamente o contacta al administrador si el problema persiste.');
                    
                    // Cargar vista con error (sin redirección)
                    $this->load->view('auth/register');
                }
            }
        } else {
            // Mostrar formulario de registro
            $this->load->view('auth/register');
        }
    }

    public function logout() {
        // Limpiar todos los datos de sesión
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('nombre');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('rol');
        $this->session->unset_userdata('logged_in');
        
        // Destruir la sesión completamente
        $this->session->sess_destroy();
        
        // Limpiar cookies de sesión
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }
        
        // Redirigir al login
        redirect('auth');
    }

    public function profile() {
        // Verificar si está logueado
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('auth');
        }

        $data['user'] = $this->Usuarios_model->get_by_id($user_id);
        if (!$data['user']) {
            $this->session->set_flashdata('error', 'Usuario no encontrado');
            redirect('auth');
        }

        $data['title'] = 'Mi Perfil';

        $this->load->view('templates/header', $data);
        $this->load->view('auth/profile', $data);
        $this->load->view('templates/footer');
    }


    public function change_password() {
        // Habilitar reporte de errores para debug en producción
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        // Verificar si está logueado
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        // Log para debug
        log_message('debug', 'Iniciando cambio de contraseña para usuario: ' . $this->session->userdata('user_id'));
        
        // Verificar que sea una petición POST
        if ($this->input->method() !== 'post') {
            redirect('auth/profile');
        }

        // Validar el formulario
        $this->form_validation->set_rules('current_password', 'Contraseña Actual', 'required|trim');
        $this->form_validation->set_rules('new_password', 'Nueva Contraseña', 'required|trim|min_length[6]|max_length[255]');
        $this->form_validation->set_rules('confirm_password', 'Confirmar Nueva Contraseña', 'required|trim|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            // Si hay errores de validación, mostrar el perfil
            $this->profile();
        } else {
            // Debug: Mostrar datos recibidos
            echo "<!-- DEBUG: Datos recibidos -->\n";
            echo "<!-- Usuario ID: " . $this->session->userdata('user_id') . " -->\n";
            echo "<!-- Contraseña actual recibida: " . (strlen($this->input->post('current_password')) > 0 ? 'SÍ' : 'NO') . " -->\n";
            echo "<!-- Nueva contraseña recibida: " . (strlen($this->input->post('new_password')) > 0 ? 'SÍ' : 'NO') . " -->\n";
            $user_id = $this->session->userdata('user_id');
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');

            // Verificar que la nueva contraseña no sea igual a la actual
            $user = $this->Usuarios_model->get_by_id($user_id);
            
            if (!$user) {
                echo "error: Usuario no encontrado";
                return;
            }
            
            // Verificar contraseña actual
            if (!password_verify($current_password, $user->password)) {
                echo "error: La contraseña actual es incorrecta";
                return;
            }
            
            // Verificar que la nueva contraseña no sea igual a la actual
            if (password_verify($new_password, $user->password)) {
                echo "error: La nueva contraseña no puede ser igual a la actual";
                return;
            }
            
            // Log para debug
            log_message('debug', 'Intentando actualizar contraseña para usuario: ' . $user_id);
            
            // Actualizar contraseña (el modelo se encarga del hash)
            $result = $this->Usuarios_model->update($user_id, array('password' => $new_password));
            
            // Log del resultado
            log_message('debug', 'Resultado de actualización: ' . ($result ? 'exitoso' : 'fallido'));
            
            if ($result) {
                // Log de éxito
                log_message('debug', 'Contraseña actualizada exitosamente para usuario: ' . $user_id);
                
                // Cerrar sesión para forzar nuevo login con la nueva contraseña
                $this->session->unset_userdata('user_id');
                $this->session->unset_userdata('nombre');
                $this->session->unset_userdata('email');
                $this->session->unset_userdata('rol');
                $this->session->unset_userdata('logged_in');
                $this->session->sess_destroy();
                
                // Limpiar cookies de sesión
                if (isset($_COOKIE[session_name()])) {
                    setcookie(session_name(), '', time() - 3600, '/');
                }
                
                // Devolver respuesta de éxito para AJAX
                echo "success: Contraseña actualizada exitosamente";
                return;
            } else {
                echo "error: Error al actualizar la contraseña. Por favor, intente nuevamente.";
                return;
            }
        }
    }

    // Método de prueba para verificar redirección
    public function test_redirect() {
        echo "Probando redirección...";
        $this->session->set_flashdata('success', 'Redirección de prueba exitosa');
        redirect('auth');
    }

    // Método para mostrar la vista de redirección
    public function redirect_to_login() {
        // Verificar si hay una sesión activa
        if ($this->session->userdata('logged_in')) {
            redirect('auth/profile');
        }
        
        $this->load->view('auth/redirect_to_login');
    }

    // Método de prueba para verificar la base de datos
    public function test_db() {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        $user_id = $this->session->userdata('user_id');
        $user = $this->Usuarios_model->get_by_id($user_id);
        
        echo "<h2>Prueba de Base de Datos</h2>";
        echo "<p>Usuario ID: " . $user_id . "</p>";
        echo "<p>Usuario encontrado: " . ($user ? 'Sí' : 'No') . "</p>";
        if ($user) {
            echo "<p>Nombre: " . $user->nombre . "</p>";
            echo "<p>Email: " . $user->email . "</p>";
            echo "<p>Hash de contraseña: " . substr($user->password, 0, 50) . "...</p>";
        }
        
        echo "<h3>Prueba de actualización</h3>";
        $test_data = array('fecha_ultimo_login' => date('Y-m-d H:i:s'));
        $update_result = $this->Usuarios_model->update($user_id, $test_data);
        echo "<p>Resultado de actualización: " . ($update_result ? 'Exitoso' : 'Fallido') . "</p>";
        
        echo "<br><a href='" . base_url('auth/profile') . "'>Volver al Perfil</a>";
    }

    // Método de prueba simple para cambio de contraseña
    public function test_password_change() {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        echo "<h2>Prueba de Cambio de Contraseña</h2>";
        echo "<p>Usuario logueado: " . $this->session->userdata('nombre') . "</p>";
        echo "<p>Método de petición: " . $this->input->method() . "</p>";
        
        if ($this->input->method() === 'post') {
            echo "<h3>Datos POST recibidos:</h3>";
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
            
            echo "<h3>Verificando contraseña actual:</h3>";
            $user_id = $this->session->userdata('user_id');
            $user = $this->Usuarios_model->get_by_id($user_id);
            $current_password = $this->input->post('current_password');
            
            if ($user && $current_password) {
                $password_valid = password_verify($current_password, $user->password);
                echo "<p>Contraseña actual válida: " . ($password_valid ? 'SÍ' : 'NO') . "</p>";
                
                if ($password_valid) {
                    echo "<p>Intentando actualizar contraseña...</p>";
                    $new_password = $this->input->post('new_password');
                    $result = $this->Usuarios_model->update($user_id, array('password' => $new_password));
                    echo "<p>Resultado: " . ($result ? 'Exitoso' : 'Fallido') . "</p>";
                }
            }
        } else {
            echo "<form method='post'>";
            echo "<p><label>Contraseña Actual: <input type='password' name='current_password' required></label></p>";
            echo "<p><label>Nueva Contraseña: <input type='password' name='new_password' required></label></p>";
            echo "<p><label>Confirmar Contraseña: <input type='password' name='confirm_password' required></label></p>";
            echo "<p><button type='submit'>Probar Cambio</button></button></p>";
            echo "</form>";
        }
        
        echo "<br><a href='" . base_url('auth/profile') . "'>Volver al Perfil</a>";
    }

}