<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

    public function index() {
        echo "<h1>Test de Sesiones y Base de Datos</h1>";
        
        // Test de sesiones
        echo "<h2>Test de Sesiones</h2>";
        echo "<p>Estado de la sesión: " . ($this->session->userdata('logged_in') ? 'Logueado' : 'No logueado') . "</p>";
        echo "<p>Datos de sesión:</p>";
        echo "<pre>";
        print_r($this->session->userdata());
        echo "</pre>";
        
        echo "<p>ID de sesión: " . session_id() . "</p>";
        echo "<p>Ruta de guardado: " . ini_get('session.save_path') . "</p>";
        
        // Probar crear una variable de sesión
        $this->session->set_userdata('test_var', 'Valor de prueba');
        echo "<p>Variable de prueba creada</p>";
        
        // Test de base de datos
        echo "<h2>Test de Base de Datos</h2>";
        try {
            $query = $this->db->query("SELECT COUNT(*) as total FROM usuarios");
            $result = $query->row();
            echo "<p>Conexión a BD exitosa. Total de usuarios: " . $result->total . "</p>";
            
            $query = $this->db->query("SELECT COUNT(*) as total FROM buses");
            $result = $query->row();
            echo "<p>Total de buses: " . $result->total . "</p>";
            
        } catch (Exception $e) {
            echo "<p>Error en BD: " . $e->getMessage() . "</p>";
        }
        
        // Test de logout
        echo "<h2>Test de Logout</h2>";
        echo "<p><a href='" . base_url('test/logout_test') . "'>Probar Logout</a></p>";
        
        echo "<p><a href='" . base_url('test') . "'>Recargar</a></p>";
        echo "<p><a href='" . base_url('auth/logout') . "'>Cerrar Sesión</a></p>";
    }
    
    public function logout_test() {
        echo "<h1>Test de Logout</h1>";
        
        // Simular logout
        $this->session->unset_userdata('test_var');
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }
        
        echo "<p>Logout simulado completado</p>";
        echo "<p>Estado de la sesión: " . ($this->session->userdata('logged_in') ? 'Logueado' : 'No logueado') . "</p>";
        echo "<p><a href='" . base_url('test') . "'>Volver al Test</a></p>";
    }
}
