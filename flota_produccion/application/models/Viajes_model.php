<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viajes_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'viajes';
    }

    public function get_all() {
        $this->db->select('v.*, b.placa as bus_placa, c.nombre as conductor_nombre, r.nombre as ruta_nombre');
        $this->db->from($this->table . ' v');
        $this->db->join('buses b', 'b.id = v.bus_id', 'left');
        $this->db->join('conductores c', 'c.id = v.conductor_id', 'left');
        $this->db->join('rutas r', 'r.id = v.ruta_id', 'left');
        $this->db->order_by('v.fecha_salida', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_with_details() {
        $viajes = $this->get_all();
        
        foreach ($viajes as $viaje) {
            $viaje->detalles = $this->get_detalles_by_viaje($viaje->id);
        }
        
        return $viajes;
    }

    public function get_by_id($id) {
        $this->db->select('v.*, b.placa as bus_placa, c.nombre as conductor_nombre, r.nombre as ruta_nombre');
        $this->db->from($this->table . ' v');
        $this->db->join('buses b', 'b.id = v.bus_id', 'left');
        $this->db->join('conductores c', 'c.id = v.conductor_id', 'left');
        $this->db->join('rutas r', 'r.id = v.ruta_id', 'left');
        $this->db->where('v.id', $id);
        $query = $this->db->get();
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
        // Primero eliminar detalles
        $this->db->delete('viajes_detalles', array('viaje_id' => $id));
        // Luego eliminar el viaje
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function count_all() {
        return $this->db->count_all($this->table);
    }

    public function get_detalles_by_viaje($viaje_id) {
        $this->db->select('*');
        $this->db->from('viajes_detalles');
        $this->db->where('viaje_id', $viaje_id);
        $this->db->order_by('orden', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function add_detalle($data) {
        return $this->db->insert('viajes_detalles', $data);
    }

    public function update_detalle($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('viajes_detalles', $data);
    }

    public function delete_detalle($id) {
        $this->db->where('id', $id);
        return $this->db->delete('viajes_detalles');
    }

    public function get_by_bus($bus_id) {
        $this->db->where('bus_id', $bus_id);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_by_conductor($conductor_id) {
        $this->db->select('v.*, b.placa as bus_placa, c.nombre as conductor_nombre, r.nombre as ruta_nombre');
        $this->db->from($this->table . ' v');
        $this->db->join('buses b', 'b.id = v.bus_id', 'left');
        $this->db->join('conductores c', 'c.id = v.conductor_id', 'left');
        $this->db->join('rutas r', 'r.id = v.ruta_id', 'left');
        $this->db->where('v.conductor_id', $conductor_id);
        $this->db->order_by('v.fecha_salida', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_ruta($ruta_id) {
        $this->db->where('ruta_id', $ruta_id);
        $query = $this->db->get($this->table);
        return $query->result();
    }
}
