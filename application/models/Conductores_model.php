<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conductores_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'conductores';
    }

    public function get_all() {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('nombre', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id) {
        $query = $this->db->get_where($this->table, array('id' => $id));
        return $query->row();
    }

    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function count_all() {
        return $this->db->count_all($this->table);
    }

    public function get_available() {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('estado', 'activo');
        $this->db->order_by('nombre', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
}
