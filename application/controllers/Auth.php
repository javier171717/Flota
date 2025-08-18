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

        // Procesar registro directamente
        if ($this->input->post()) {

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
                $this->session->set_flashdata('success', 'Usuario registrado exitosamente. Ya puedes hacer login.');
                redirect('auth');
            } else {
                // Error en el registro
                $this->session->set_flashdata('error', 'Error al registrar usuario');
                redirect('auth/register');
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
