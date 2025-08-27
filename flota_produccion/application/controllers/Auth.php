<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuarios_model');
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
                    // Registro exitoso
                    $this->session->set_flashdata('success', '¡Usuario registrado exitosamente! Ya puedes hacer login con tu nueva cuenta.');
                    redirect('auth');
                } else {
                    // Error en el registro
                    $this->session->set_flashdata('error', 'Ocurrió un error inesperado al registrar el usuario. Por favor, inténtalo nuevamente o contacta al administrador si el problema persiste.');
                    redirect('auth/register');
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
        $data['user'] = $this->Usuarios_model->get_by_id($user_id);
        $data['title'] = 'Mi Perfil';

        $this->load->view('templates/header', $data);
        $this->load->view('auth/profile', $data);
        $this->load->view('templates/footer');
    }

    public function change_password() {
        // Verificar si está logueado
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('current_password', 'Contraseña Actual', 'required');
        $this->form_validation->set_rules('new_password', 'Nueva Contraseña', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirmar Nueva Contraseña', 'required|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            $this->profile();
        } else {
            $user_id = $this->session->userdata('user_id');
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');

            // Verificar contraseña actual
            $user = $this->Usuarios_model->get_by_id($user_id);
            if ($user && password_verify($current_password, $user->password)) {
                // Actualizar contraseña
                $this->Usuarios_model->update($user_id, array('password' => $new_password));
                $this->session->set_flashdata('success', 'Contraseña actualizada exitosamente');
            } else {
                $this->session->set_flashdata('error', 'Contraseña actual incorrecta');
            }

            redirect('auth/profile');
        }
    }
}
