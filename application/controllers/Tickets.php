<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Cargar librerías
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('permissions');
        
        // Verificar si el usuario está logueado
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        // Cargar modelos
        $this->load->model('Tickets_model');
        $this->load->model('Viajes_model');
        $this->load->model('Rutas_model');
        $this->load->model('Buses_model');
        $this->load->model('Usuarios_model');
    }

    /**
     * Listar tickets (diferente vista según el rol)
     */
    public function index() {
        $data['title'] = 'Gestión de Tickets';
        $data['permissions'] = $this->permissions;
        
        if ($this->permissions->is_passenger()) {
            // Pasajeros ven solo sus tickets
            $user_id = $this->session->userdata('user_id');
            $data['tickets'] = $this->Tickets_model->get_by_pasajero($user_id);
            
            // DEBUG: Verificar qué datos se están obteniendo
            log_message('debug', 'Tickets del pasajero: ' . print_r($data['tickets'], true));
            
            $this->load->view('templates/header', $data);
            $this->load->view('tickets/mis_tickets', $data);
            $this->load->view('templates/footer');
        } else {
            // Admin/operadores ven todos los tickets
            if (!$this->permissions->can_access('tickets')) {
                $this->session->set_flashdata('error', 'No tienes permisos para acceder a esta sección');
                redirect('flota');
            }
            
            $data['tickets'] = $this->Tickets_model->get_all();
            $this->load->view('templates/header', $data);
            $this->load->view('tickets/index', $data);
            $this->load->view('templates/footer');
        }
    }

    /**
     * Comprar ticket (para pasajeros, administradores y operadores)
     */
    public function comprar() {
        // Permitir que administradores y operadores puedan vender tickets
        if (!$this->permissions->can_buy_tickets()) {
            $this->session->set_flashdata('error', 'No tienes permisos para comprar tickets');
            redirect('flota');
        }
        
        $data['title'] = 'Comprar Ticket';
        $data['permissions'] = $this->permissions;
        
        // Obtener viajes disponibles
        $data['viajes'] = $this->Viajes_model->get_available_trips();
        
        // DEBUG: Verificar qué se está obteniendo
        log_message('debug', 'Viajes disponibles: ' . print_r($data['viajes'], true));
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('viaje_id', 'Viaje', 'required|numeric');
            $this->form_validation->set_rules('asiento', 'Asiento', 'required');
            $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|min_length[2]|max_length[50]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('telefono', 'Teléfono', 'required|trim|min_length[7]|max_length[15]');
            
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('tickets/comprar', $data);
                $this->load->view('templates/footer');
            } else {
                $viaje_id = $this->input->post('viaje_id');
                $asiento = $this->input->post('asiento');
                
                // Verificar si el asiento está disponible
                if (!$this->Tickets_model->is_seat_available($viaje_id, $asiento)) {
                    $this->session->set_flashdata('error', 'El asiento seleccionado no está disponible');
                    redirect('tickets/comprar');
                }
                
                // Obtener información del viaje para calcular precio
                $viaje = $this->Viajes_model->get_by_id($viaje_id);
                $ruta = $this->Rutas_model->get_by_id($viaje->ruta_id);
                
                // DEBUG: Verificar datos del viaje y ruta
                log_message('debug', 'Viaje: ' . print_r($viaje, true));
                log_message('debug', 'Ruta: ' . print_r($ruta, true));
                
                // Calcular precio basado en distancia
                $distancia = $ruta->distancia ?? 0;
                $precio = $this->Tickets_model->calculate_price($distancia);
                
                log_message('debug', 'Distancia: ' . $distancia . ', Precio calculado: ' . $precio);
                
                // Crear o obtener usuario para el pasajero (NO el usuario logueado)
                $user_data = array(
                    'nombre' => $this->input->post('nombre'),
                    'email' => $this->input->post('email'),
                    'telefono' => $this->input->post('telefono'),
                    'rol' => 'pasajero',
                    'estado' => 'activo'
                );
                
                // Buscar si ya existe un usuario con ese email
                $existing_user = $this->Usuarios_model->get_by_email($this->input->post('email'));
                
                if ($existing_user) {
                    // Si existe, actualizar sus datos
                    $this->Usuarios_model->update($existing_user->id, $user_data);
                    $pasajero_id = $existing_user->id;
                } else {
                    // Si no existe, crear uno nuevo
                    $pasajero_id = $this->Usuarios_model->create($user_data);
                }
                
                // Crear el ticket
                $ticket_data = array(
                    'pasajero_id' => $pasajero_id,
                    'viaje_id' => $viaje_id,
                    'asiento' => $asiento,
                    'precio' => $precio,
                    'estado' => 'confirmado',
                    'fecha_viaje' => $viaje->fecha_salida
                );
                
                $ticket_id = $this->Tickets_model->create($ticket_data);
                
                if ($ticket_id) {
                    $this->session->set_flashdata('success', '¡Ticket comprado exitosamente! Código: ' . $this->Tickets_model->get_by_id($ticket_id)->codigo_ticket);
                    redirect('tickets/ver/' . $ticket_id);
                } else {
                    $this->session->set_flashdata('error', 'Error al comprar el ticket');
                    redirect('tickets/comprar');
                }
            }
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('tickets/comprar', $data);
            $this->load->view('templates/footer');
        }
    }

    /**
     * Ver ticket específico
     */
    public function ver($id = NULL) {
        if (!$id) {
            show_404();
            return;
        }
        
        $data['ticket'] = $this->Tickets_model->get_by_id($id);
        if (!$data['ticket']) {
            show_404();
            return;
        }
        
        // Verificar permisos: solo el pasajero o admin/operador puede ver
        if ($this->permissions->is_passenger()) {
            $user_id = $this->session->userdata('user_id');
            if ($data['ticket']->pasajero_id != $user_id) {
                $this->session->set_flashdata('error', 'No tienes permisos para ver este ticket');
                redirect('tickets');
            }
        } elseif (!$this->permissions->can_access('tickets')) {
            $this->session->set_flashdata('error', 'No tienes permisos para acceder a esta sección');
            redirect('flota');
        }
        
        $data['title'] = 'Ticket #' . $data['ticket']->codigo_ticket;
        $data['permissions'] = $this->permissions;
        
        $this->load->view('templates/header', $data);
        $this->load->view('tickets/ver', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Cancelar ticket (solo para pasajeros)
     */
    public function cancelar($id = NULL) {
        if (!$id) {
            show_404();
            return;
        }
        
        if (!$this->permissions->can_manage_tickets()) {
            $this->session->set_flashdata('error', 'No tienes permisos para cancelar tickets');
            redirect('tickets');
        }
        
        $ticket = $this->Tickets_model->get_by_id($id);
        if (!$ticket) {
            show_404();
            return;
        }
        
        // Verificar que el pasajero solo pueda cancelar sus propios tickets
        if ($this->permissions->is_passenger()) {
            $user_id = $this->session->userdata('user_id');
            if ($ticket->pasajero_id != $user_id) {
                $this->session->set_flashdata('error', 'No puedes cancelar tickets de otros pasajeros');
                redirect('tickets');
            }
        }
        
        // Verificar que el ticket no esté ya cancelado
        if ($ticket->estado == 'cancelado') {
            $this->session->set_flashdata('error', 'No se puede cancelar este ticket');
            redirect('tickets/ver/' . $id);
        }
        
        if ($this->Tickets_model->cancel_ticket($id)) {
            $this->session->set_flashdata('success', 'Ticket cancelado exitosamente');
        } else {
            $this->session->set_flashdata('error', 'Error al cancelar el ticket');
        }
        
        redirect('tickets');
    }

    /**
     * Imprimir ticket
     */
    public function imprimir($id = NULL) {
        if (!$id) {
            show_404();
            return;
        }
        
        $data['ticket'] = $this->Tickets_model->get_by_id($id);
        if (!$data['ticket']) {
            show_404();
            return;
        }
        
        // Verificar permisos: solo el pasajero o admin/operador puede imprimir
        if ($this->permissions->is_passenger()) {
            $user_id = $this->session->userdata('user_id');
            if ($data['ticket']->pasajero_id != $user_id) {
                $this->session->set_flashdata('error', 'No tienes permisos para imprimir este ticket');
                redirect('tickets');
            }
        } elseif (!$this->permissions->can_access('tickets')) {
            $this->session->set_flashdata('error', 'No tienes permisos para acceder a esta sección');
            redirect('flota');
        }
        
        $data['title'] = 'Ticket #' . $data['ticket']->codigo_ticket;
        
        // Cargar vista de impresión sin header/footer
        $this->load->view('tickets/imprimir', $data);
    }

    /**
     * Obtener asientos disponibles para un viaje (AJAX)
     */
    public function get_asientos_disponibles($viaje_id) {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $viaje = $this->Viajes_model->get_by_id($viaje_id);
        if (!$viaje) {
            echo json_encode(array('error' => 'Viaje no encontrado'));
            return;
        }
        
        $bus = $this->Buses_model->get_by_id($viaje->bus_id);
        $asientos_ocupados = $this->Tickets_model->get_occupied_seats($viaje_id);
        
        // Generar lista de asientos disponibles
        $asientos_disponibles = array();
        for ($i = 1; $i <= $bus->capacidad; $i++) {
            if (!in_array($i, $asientos_ocupados)) {
                $asientos_disponibles[] = $i;
            }
        }
        
        echo json_encode(array(
            'asientos_disponibles' => $asientos_disponibles,
            'capacidad_total' => $bus->capacidad,
            'asientos_ocupados' => count($asientos_ocupados)
        ));
    }
}
