<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'tickets';
    }

    /**
     * Obtener todos los tickets (para admin/operadores)
     */
    public function get_all() {
        $this->db->select('t.*, u.nombre as pasajero_nombre, u.email as pasajero_email, v.fecha_salida, v.fecha_llegada, r.origen, r.destino, r.distancia, b.placa, b.marca, b.modelo, b.capacidad');
        $this->db->from($this->table . ' t');
        $this->db->join('usuarios u', 'u.id = t.pasajero_id');
        $this->db->join('viajes v', 'v.id = t.viaje_id');
        $this->db->join('rutas r', 'r.id = v.ruta_id');
        $this->db->join('buses b', 'b.id = v.bus_id');
        $this->db->order_by('t.fecha_compra', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Obtener tickets por ID
     */
    public function get_by_id($id) {
        $this->db->select('t.*, u.nombre as pasajero_nombre, u.email as pasajero_email, v.fecha_salida, v.fecha_llegada, r.origen, r.destino, r.distancia, b.placa, b.marca, b.modelo');
        $this->db->from($this->table . ' t');
        $this->db->join('usuarios u', 'u.id = t.pasajero_id');
        $this->db->join('viajes v', 'v.id = t.viaje_id');
        $this->db->join('rutas r', 'r.id = v.ruta_id');
        $this->db->join('buses b', 'b.id = v.bus_id');
        $this->db->where('t.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Obtener tickets de un pasajero específico
     */
    public function get_by_pasajero($pasajero_id) {
        $this->db->select('t.*, u.nombre as pasajero_nombre, u.email as pasajero_email, v.fecha_salida, v.fecha_llegada, r.origen, r.destino, r.distancia, b.placa, b.marca, b.modelo, b.capacidad');
        $this->db->from($this->table . ' t');
        $this->db->join('usuarios u', 'u.id = t.pasajero_id');
        $this->db->join('viajes v', 'v.id = t.viaje_id');
        $this->db->join('rutas r', 'r.id = v.ruta_id');
        $this->db->join('buses b', 'b.id = v.bus_id');
        $this->db->where('t.pasajero_id', $pasajero_id);
        $this->db->order_by('t.fecha_viaje', 'DESC');
        $query = $this->db->get();
        
        // DEBUG: Verificar qué se está obteniendo
        log_message('debug', 'Query SQL: ' . $this->db->last_query());
        log_message('debug', 'Resultados: ' . print_r($query->result(), true));
        
        return $query->result();
    }

    /**
     * Obtener tickets por viaje
     */
    public function get_by_viaje($viaje_id) {
        $this->db->select('t.*, u.nombre as pasajero_nombre, u.email as pasajero_email');
        $this->db->from($this->table . ' t');
        $this->db->join('usuarios u', 'u.id = t.pasajero_id');
        $this->db->where('t.viaje_id', $viaje_id);
        $this->db->order_by('t.fecha_compra', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Crear nuevo ticket
     */
    public function create($data) {
        // Generar código único del ticket
        $data['codigo_ticket'] = $this->generate_ticket_code();
        
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Actualizar ticket
     */
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Eliminar ticket
     */
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    /**
     * Cancelar ticket
     */
    public function cancel_ticket($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, array('estado' => 'cancelado'));
    }



    /**
     * Verificar si un asiento está disponible en un viaje
     */
    public function is_seat_available($viaje_id, $asiento) {
        $this->db->where('viaje_id', $viaje_id);
        $this->db->where('asiento', $asiento);
        $this->db->where('estado !=', 'cancelado');
        $query = $this->db->get($this->table);
        return $query->num_rows() == 0;
    }

    /**
     * Obtener asientos ocupados en un viaje
     */
    public function get_occupied_seats($viaje_id) {
        $this->db->select('asiento');
        $this->db->where('viaje_id', $viaje_id);
        $this->db->where('estado !=', 'cancelado');
        $query = $this->db->get($this->table);
        return array_column($query->result_array(), 'asiento');
    }

    /**
     * Contar tickets por viaje
     */
    public function count_by_viaje($viaje_id) {
        $this->db->where('viaje_id', $viaje_id);
        $this->db->where('estado !=', 'cancelado');
        return $this->db->count_all_results($this->table);
    }

    /**
     * Generar código único del ticket
     */
    private function generate_ticket_code() {
        $prefix = 'TK';
        $timestamp = time();
        $random = rand(1000, 9999);
        return $prefix . $timestamp . $random;
    }

    /**
     * Calcular precio del ticket basado en distancia
     */
    public function calculate_price($distancia) {
        // Precio base por km (puedes ajustar según tu tarifa)
        $precio_por_km = 0.50;
        $precio_base = 2.00; // Precio mínimo
        
        $precio = $distancia * $precio_por_km;
        return max($precio, $precio_base);
    }
}
