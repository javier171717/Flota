<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions {
    
    private $CI;
    private $user_rol;
    
    // Definir permisos por rol
    private $permissions = array(
        'admin' => array(
            'dashboard' => 'read',
            'buses' => 'full',      // full = create, read, update, delete
            'conductores' => 'full',
            'rutas' => 'full',
            'viajes' => 'full',
            'usuarios' => 'full',
            'tickets' => 'full',    // Admin puede ver y crear tickets
            'reportes' => 'full',
            'configuracion' => 'full'
        ),
        'operador' => array(
            'dashboard' => 'read',
            'buses' => 'read',
            'conductores' => 'read',
            'rutas' => 'read',
            'viajes' => 'full',     // Los operadores gestionan viajes
            'usuarios' => 'none',
            'tickets' => 'full',    // Operadores pueden ver y crear tickets
            'reportes' => 'read',
            'configuracion' => 'none'
        ),
        'conductor' => array(
            'dashboard' => 'read',
            'buses' => 'none',
            'conductores' => 'none',
            'rutas' => 'read',      // Solo ver rutas
            'viajes' => 'limited',  // Solo ver y actualizar sus viajes
            'usuarios' => 'none',
            'tickets' => 'read',    // Conductores pueden ver tickets de sus viajes
            'reportes' => 'limited',
            'configuracion' => 'none'
        ),
        'pasajero' => array(
            'dashboard' => 'limited',    // Solo ver sus tickets y viajes
            'buses' => 'none',          // Sin acceso
            'conductores' => 'none',    // Sin acceso
            'rutas' => 'read',          // Ver rutas disponibles
            'viajes' => 'limited',      // Ver viajes disponibles y comprar
            'usuarios' => 'none',       // Sin acceso
            'tickets' => 'full',        // Gestionar sus propios tickets
            'reportes' => 'none',       // Sin acceso
            'configuracion' => 'none'   // Sin acceso
        )
    );
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->user_rol = $this->CI->session->userdata('rol');
    }
    
    /**
     * Verificar si el usuario tiene acceso a una funcionalidad
     */
    public function can_access($module, $action = 'read') {
        if (!$this->user_rol || !isset($this->permissions[$this->user_rol])) {
            return false;
        }
        
        $user_permissions = $this->permissions[$this->user_rol];
        
        if (!isset($user_permissions[$module])) {
            return false;
        }
        
        $permission = $user_permissions[$module];
        
        switch ($action) {
            case 'read':
                return in_array($permission, ['read', 'limited', 'full']);
            case 'create':
            case 'update':
            case 'delete':
                return $permission === 'full';
            case 'limited':
                return $permission === 'limited';
            default:
                return false;
        }
    }
    
    /**
     * Verificar si el usuario puede crear
     */
    public function can_create($module) {
        return $this->can_access($module, 'create');
    }
    
    /**
     * Verificar si el usuario puede leer
     */
    public function can_read($module) {
        return $this->can_access($module, 'read');
    }
    
    /**
     * Verificar si el usuario puede actualizar
     */
    public function can_update($module) {
        return $this->can_access($module, 'update');
    }
    
    /**
     * Verificar si el usuario puede eliminar
     */
    public function can_delete($module) {
        return $this->can_access($module, 'delete');
    }
    
    /**
     * Verificar si el usuario tiene acceso limitado
     */
    public function has_limited_access($module) {
        return $this->can_access($module, 'limited');
    }
    
    /**
     * Obtener el rol del usuario actual
     */
    public function get_user_role() {
        return $this->user_rol;
    }
    
    /**
     * Verificar si el usuario es administrador
     */
    public function is_admin() {
        return $this->user_rol === 'admin';
    }
    
    /**
     * Verificar si el usuario es operador
     */
    public function is_operator() {
        return $this->user_rol === 'operador';
    }
    
    /**
     * Verificar si el usuario es conductor
     */
    public function is_driver() {
        return $this->user_rol === 'conductor';
    }
    
    /**
     * Verificar si el usuario es pasajero
     */
    public function is_passenger() {
        return $this->user_rol === 'pasajero';
    }
    
    /**
     * Verificar si el usuario puede gestionar tickets (especial para pasajeros)
     */
    public function can_manage_tickets() {
        if ($this->is_passenger()) {
            return true; // Los pasajeros pueden gestionar sus tickets
        }
        return $this->can_access('tickets', 'create');
    }
    
    /**
     * Verificar si el usuario puede ver todos los tickets o solo los suyos
     */
    public function can_see_all_tickets() {
        return !$this->is_passenger(); // Solo pasajeros ven limitado
    }
    
    /**
     * Verificar si el usuario puede comprar tickets
     */
    public function can_buy_tickets() {
        return $this->is_passenger() || $this->is_admin() || $this->is_operator();
    }
    
    /**
     * Obtener permisos del usuario para un módulo específico
     */
    public function get_module_permissions($module) {
        if (!$this->user_rol || !isset($this->permissions[$this->user_rol])) {
            return 'none';
        }
        
        return $this->permissions[$this->user_rol][$module] ?? 'none';
    }
    
    /**
     * Verificar si el usuario puede gestionar viajes (especial para conductores)
     */
    public function can_manage_trips() {
        if ($this->is_driver()) {
            return true; // Los conductores pueden gestionar sus viajes
        }
        return $this->can_access('viajes', 'create');
    }
    
    /**
     * Verificar si el usuario puede ver todos los viajes o solo los suyos
     */
    public function can_see_all_trips() {
        return !$this->is_driver(); // Solo conductores ven limitado
    }
}
