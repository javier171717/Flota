<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'usuarios';
    }

    public function get_all() {
        $this->db->select('id, nombre, email, rol, estado, fecha_registro, fecha_ultimo_login');
        $this->db->from($this->table);
        $this->db->order_by('nombre', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id) {
        $query = $this->db->get_where($this->table, array('id' => $id));
        return $query->row();
    }

    public function get_by_email($email) {
        $query = $this->db->get_where($this->table, array('email' => $email));
        return $query->row();
    }

    public function create($data) {
        // Hashear la contraseña antes de guardar
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        // Si se está actualizando la contraseña, hashearla
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            // Si no hay contraseña nueva, remover del array
            unset($data['password']);
        }
        
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function authenticate($email, $password) {
        $user = $this->get_by_email($email);
        
        if ($user && password_verify($password, $user->password)) {
            // Actualizar último login
            $this->db->where('id', $user->id);
            $this->db->update($this->table, array('fecha_ultimo_login' => date('Y-m-d H:i:s')));
            
            return $user;
        }
        
        return false;
    }

    public function update_last_login($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, array('fecha_ultimo_login' => date('Y-m-d H:i:s')));
    }

    public function count_all() {
        return $this->db->count_all($this->table);
    }

    public function get_active() {
        $this->db->select('id, nombre, email, rol');
        $this->db->from($this->table);
        $this->db->where('estado', 'activo');
        $this->db->order_by('nombre', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
}
