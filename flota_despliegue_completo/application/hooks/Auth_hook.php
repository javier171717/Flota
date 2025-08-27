<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_hook {
    
    private $CI;
    
    public function __construct() {
        $this->CI =& get_instance();
    }
    
    public function check_auth() {
        // Rutas que no requieren autenticación
        $public_routes = array(
            'auth',
            'auth/login',
            'auth/register',
            'auth/logout'
        );
        
        // Obtener la ruta actual
        $current_route = $this->CI->uri->uri_string();
        
        // Verificar si la ruta actual es pública
        $is_public = false;
        foreach ($public_routes as $route) {
            if (strpos($current_route, $route) === 0) {
                $is_public = true;
                break;
            }
        }
        
        // Si no es ruta pública y no está logueado, redirigir al login
        if (!$is_public && !$this->CI->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        // Si está logueado y está en login/register, redirigir al dashboard
        if ($this->CI->session->userdata('logged_in') && 
            (strpos($current_route, 'auth') === 0 && 
             $current_route !== 'auth/profile' && 
             $current_route !== 'auth/logout' && 
             $current_route !== 'auth/change_password' &&
             $current_route !== 'auth/test_db' &&
             $current_route !== 'auth/test_password_change')) {
            redirect('flota');
        }
        
        // Permitir operaciones CRUD (POST requests y operaciones de eliminación)
        if ($this->CI->input->method() === 'post') {
            return;
        }
        
        // Permitir operaciones de eliminación
        if (strpos($current_route, '_delete') !== false) {
            return;
        }
    }
}
