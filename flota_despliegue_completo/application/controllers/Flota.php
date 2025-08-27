<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flota extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Cargar librerías primero
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('permissions');
        
        // Verificar si el usuario está logueado
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        $this->load->model('Buses_model');
        $this->load->model('Conductores_model');
        $this->load->model('Rutas_model');
        $this->load->model('Viajes_model');
        
        // Agregar reglas de validación personalizadas
        $this->form_validation->set_message('valid_email_if_not_empty', 'El campo %s debe contener un email válido si se proporciona.');
        $this->form_validation->set_message('is_unique_if_not_empty', 'El %s ya está registrado en otro conductor.');
    }

    public function index() {
        $data['title'] = 'FlotaPro - Sistema de Gestión';
        $data['permissions'] = $this->permissions;
        
        // Solo mostrar estadísticas si el usuario tiene permisos para verlas
        if ($this->permissions->can_access('buses')) {
            $data['total_buses'] = $this->Buses_model->count_all();
        }
        
        if ($this->permissions->can_access('conductores')) {
            $data['total_conductores'] = $this->Conductores_model->count_all();
        }
        
        if ($this->permissions->can_access('rutas')) {
            $data['total_rutas'] = $this->Rutas_model->count_all();
        }
        
        if ($this->permissions->can_access('viajes')) {
            $data['total_viajes'] = $this->Viajes_model->count_all();
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('flota/dashboard', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Método para probar el sistema de permisos
     */
    public function test_permissions() {
        $data['title'] = 'Prueba de Permisos';
        $data['permissions'] = $this->permissions;
        
        $this->load->view('templates/header', $data);
        $this->load->view('flota/test_permissions', $data);
        $this->load->view('templates/footer');
    }

    public function buses() {
        // Verificar permisos: solo admin puede gestionar buses
        if (!$this->permissions->can_access('buses')) {
            $this->session->set_flashdata('error', 'No tienes permisos para acceder a esta sección');
            redirect('flota');
        }
        
        $data['title'] = 'Gestión de Buses';
        $data['buses'] = $this->Buses_model->get_all();
        $data['permissions'] = $this->permissions;
        
        // Obtener información de viajes por bus para determinar cuáles se pueden editar
        $viajes_por_bus = array();
        foreach ($data['buses'] as $bus) {
            $viajes = $this->Viajes_model->get_by_bus($bus->id);
            if (!empty($viajes)) {
                $viajes_por_bus[$bus->id] = count($viajes);
            }
        }
        $data['viajes_por_bus'] = $viajes_por_bus;
        
        $this->load->view('templates/header', $data);
        $this->load->view('flota/buses/index', $data);
        $this->load->view('templates/footer');
    }

    public function conductores() {
        // Verificar permisos: solo admin puede gestionar conductores
        if (!$this->permissions->can_access('conductores')) {
            $this->session->set_flashdata('error', 'No tienes permisos para acceder a esta sección');
            redirect('flota');
        }
        
        $data['title'] = 'Gestión de Conductores';
        $data['conductores'] = $this->Conductores_model->get_all();
        $data['permissions'] = $this->permissions;
        
        $this->load->view('templates/header', $data);
        $this->load->view('flota/conductores/index', $data);
        $this->load->view('templates/footer');
    }

    public function rutas() {
        // Verificar permisos: admin y operador pueden ver rutas, solo admin puede gestionar
        if (!$this->permissions->can_access('rutas')) {
            $this->session->set_flashdata('error', 'No tienes permisos para acceder a esta sección');
            redirect('flota');
        }
        
        $data['title'] = 'Gestión de Rutas';
        $data['rutas'] = $this->Rutas_model->get_all();
        $data['permissions'] = $this->permissions;
        
        $this->load->view('templates/header', $data);
        $this->load->view('flota/rutas/index', $data);
        $this->load->view('templates/footer');
    }

    public function viajes() {
        // Verificar permisos: admin, operador y conductor pueden acceder a viajes
        if (!$this->permissions->can_access('viajes')) {
            $this->session->set_flashdata('error', 'No tienes permisos para acceder a esta sección');
            redirect('flota');
        }
        
        $data['title'] = 'Gestión de Viajes';
        $data['permissions'] = $this->permissions;
        
        // Si es conductor, mostrar solo sus viajes
        if ($this->permissions->is_driver()) {
            $conductor_id = $this->session->userdata('user_id');
            $data['viajes'] = $this->Viajes_model->get_by_conductor($conductor_id);
        } else {
            $data['viajes'] = $this->Viajes_model->get_all_with_details();
        }
        
        $data['buses'] = $this->Buses_model->get_all();
        $data['conductores'] = $this->Conductores_model->get_all();
        $data['rutas'] = $this->Rutas_model->get_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('flota/viajes/index', $data);
        $this->load->view('templates/footer');
    }

    // ===== FUNCIONES CRUD PARA BUSES =====
    public function bus_create() {
        // Verificar si es una petición POST
        if ($this->input->method() !== 'post') {
            show_404();
            return;
        }
        
        // Validar datos
        $this->form_validation->set_rules('placa', 'Placa', 'required|is_unique[buses.placa]');
        $this->form_validation->set_message('is_unique', 'La placa %s ya está registrada en otro vehículo. No puedes repetir la misma placa.');
        $this->form_validation->set_message('required', 'El campo %s es obligatorio.');
        $this->form_validation->set_message('min_length', 'El campo %s debe tener al menos %s caracteres.');
        $this->form_validation->set_message('numeric', 'El campo %s debe ser un número.');
        $this->form_validation->set_message('greater_than', 'El campo %s debe ser mayor a %s.');
        $this->form_validation->set_message('less_than', 'El campo %s debe ser menor a %s.');
        $this->form_validation->set_message('regex_match', 'El campo %s solo debe contener letras, números, espacios y guiones.');
        $this->form_validation->set_rules('marca', 'Marca', 'required|min_length[2]|max_length[25]|regex_match[/^[A-Za-zÁáÉéÍíÓóÚúÑñ0-9\s\-]+$/]');
        $this->form_validation->set_rules('modelo', 'Modelo', 'required|min_length[2]|max_length[25]|regex_match[/^[A-Za-zÁáÉéÍíÓóÚúÑñ0-9\s\-]+$/]');
        $this->form_validation->set_rules('anio', 'Año', 'required|numeric|greater_than[1900]|less_than[2031]');
        $this->form_validation->set_rules('capacidad', 'Capacidad', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('estado', 'Estado', 'required|in_list[activo,inactivo,mantenimiento]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
        } else {
            $data = array(
                'placa' => $this->input->post('placa'),
                'marca' => $this->input->post('marca'),
                'modelo' => $this->input->post('modelo'),
                'anio' => $this->input->post('anio'),
                'capacidad' => $this->input->post('capacidad'),
                'estado' => $this->input->post('estado'),
                'fecha_registro' => date('Y-m-d H:i:s')
            );
            
            $result = $this->Buses_model->create($data);
            if ($result) {
                $this->session->set_flashdata('success', 'Bus creado exitosamente');
            } else {
                $this->session->set_flashdata('error', 'Error al crear bus. Verifique los datos.');
            }
        }
        
        redirect('flota/buses');
    }

    public function bus_update() {
        // Verificar si es una petición POST
        if ($this->input->method() !== 'post') {
            show_404();
            return;
        }
        
        $id = $this->input->post('id');
        
        // Log de debug
        log_message('debug', 'bus_update - ID recibido: ' . $id);
        log_message('debug', 'bus_update - POST data: ' . print_r($_POST, true));
        
        // VERIFICAR PRIMERO SI EL BUS TIENE VIAJES ASOCIADOS
        $viajes_asociados = $this->Viajes_model->get_by_bus($id);
        
        log_message('debug', 'bus_update - Viajes asociados: ' . print_r($viajes_asociados, true));
        
        if (!empty($viajes_asociados)) {
            log_message('debug', 'bus_update - Bus tiene viajes, validando solo estado');
            
            // Si tiene viajes, solo validar el estado
            $this->form_validation->set_rules('id', 'ID', 'required|numeric');
            $this->form_validation->set_rules('estado', 'Estado', 'required|in_list[activo,inactivo,mantenimiento]');
            
            if ($this->form_validation->run() == FALSE) {
                log_message('debug', 'bus_update - Validación falló: ' . validation_errors());
                $this->session->set_flashdata('error', validation_errors());
            } else {
                log_message('debug', 'bus_update - Validación exitosa, actualizando solo estado');
                
                // Solo permitir cambio de estado
                $estado_actual = $this->Buses_model->get_by_id($id)->estado;
                $nuevo_estado = $this->input->post('estado');
                
                log_message('debug', 'bus_update - Estado actual: ' . $estado_actual . ', Nuevo estado: ' . $nuevo_estado);
                
                if ($estado_actual !== $nuevo_estado) {
                    $data = array(
                        'estado' => $nuevo_estado,
                        'fecha_actualizacion' => date('Y-m-d H:i:s')
                    );
                    
                    $result = $this->Buses_model->update($id, $data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Estado del bus actualizado exitosamente. Los demás campos no se pueden modificar porque tiene viajes asociados.');
                    } else {
                        $this->session->set_flashdata('error', 'Error al actualizar estado del bus');
                    }
                } else {
                    $this->session->set_flashdata('warning', 'El estado del bus ya está en el valor seleccionado.');
                }
            }
        } else {
            log_message('debug', 'bus_update - Bus no tiene viajes, validando todos los campos');
            
            // Si no tiene viajes, validar todos los campos
            $this->form_validation->set_rules('id', 'ID', 'required|numeric');
            $this->form_validation->set_rules('placa', 'Placa', 'required');
            $this->form_validation->set_message('is_unique', 'La placa %s ya está registrada en otro vehículo. No puedes repetir la misma placa.');
            $this->form_validation->set_message('required', 'El campo %s es obligatorio.');
            $this->form_validation->set_message('min_length', 'El campo %s debe tener al menos %s caracteres.');
            $this->form_validation->set_message('numeric', 'El campo %s debe ser un número.');
                         $this->form_validation->set_message('greater_than', 'El campo %s debe ser mayor a %s.');
             $this->form_validation->set_message('less_than', 'El campo %s debe ser menor a %s.');
             $this->form_validation->set_message('regex_match', 'El campo %s solo debe contener letras, números, espacios y guiones.');
             $this->form_validation->set_rules('marca', 'Marca', 'required|min_length[2]|max_length[25]|regex_match[/^[A-Za-zÁáÉéÍíÓóÚúÑñ0-9\s\-]+$/]');
             $this->form_validation->set_rules('modelo', 'Modelo', 'required|min_length[2]|max_length[25]|regex_match[/^[A-Za-zÁáÉéÍíÓóÚúÑñ0-9\s\-]+$/]');
            $this->form_validation->set_rules('anio', 'Año', 'required|numeric|greater_than[1900]|less_than[2031]');
            $this->form_validation->set_rules('capacidad', 'Capacidad', 'required|numeric|greater_than[0]');
            $this->form_validation->set_rules('estado', 'Estado', 'required|in_list[activo,inactivo,mantenimiento]');
            
            if ($this->form_validation->run() == FALSE) {
                log_message('debug', 'bus_update - Validación falló: ' . validation_errors());
                $this->session->set_flashdata('error', validation_errors());
            } else {
                log_message('debug', 'bus_update - Validación exitosa, actualizando todos los campos');
                
                // Permitir modificar todos los campos
                $data = array(
                    'placa' => $this->input->post('placa'),
                    'marca' => $this->input->post('marca'),
                    'modelo' => $this->input->post('modelo'),
                    'anio' => $this->input->post('anio'),
                    'capacidad' => $this->input->post('capacidad'),
                    'estado' => $this->input->post('estado'),
                    'fecha_actualizacion' => date('Y-m-d H:i:s')
                );
                
                $result = $this->Buses_model->update($id, $data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Bus actualizado exitosamente');
                } else {
                    $this->session->set_flashdata('error', 'Error al actualizar bus. Verifique los datos.');
                }
            }
        }
        
        redirect('flota/buses');
    }

    public function bus_delete($id = NULL) {
        // Verificar si se proporcionó un ID válido
        if ($id === NULL || !is_numeric($id)) {
            $this->session->set_flashdata('error', 'ID de bus inválido');
            redirect('flota/buses');
            return;
        }
        
        // Verificar si el bus existe
        $bus = $this->Buses_model->get_by_id($id);
        if (!$bus) {
            $this->session->set_flashdata('error', 'El bus no existe');
            redirect('flota/buses');
            return;
        }
        
        // Verificar si el bus tiene viajes asociados
        $viajes_asociados = $this->Viajes_model->get_by_bus($id);
        
        if (!empty($viajes_asociados)) {
            // Si tiene viajes, cambiar estado a 'inactivo' en lugar de eliminar
            $result = $this->Buses_model->update($id, array('estado' => 'inactivo'));
            if ($result) {
                $this->session->set_flashdata('warning', 'El bus no se puede eliminar porque tiene viajes asociados. Se ha marcado como inactivo. Puedes reactivarlo más tarde.');
            } else {
                $this->session->set_flashdata('error', 'Error al marcar bus como inactivo');
            }
        } else {
            // Si no tiene viajes, permitir eliminar incluso si está inactivo
            $result = $this->Buses_model->delete($id);
            if ($result) {
                $this->session->set_flashdata('success', 'Bus eliminado exitosamente');
            } else {
                $this->session->set_flashdata('error', 'Error al eliminar bus');
            }
        }
        
        redirect('flota/buses');
    }

    public function bus_reactivar($id = NULL) {
        // Verificar si se proporcionó un ID válido
        if ($id === NULL || !is_numeric($id)) {
            $this->session->set_flashdata('error', 'ID de bus inválido');
            redirect('flota/buses');
            return;
        }
        
        // Verificar si el bus existe
        $bus = $this->Buses_model->get_by_id($id);
        if (!$bus) {
            $this->session->set_flashdata('error', 'El bus no existe');
            redirect('flota/buses');
            return;
        }
        
        // Verificar que el bus esté inactivo
        if ($bus->estado !== 'inactivo') {
            $this->session->set_flashdata('error', 'Solo se pueden reactivar buses inactivos');
            redirect('flota/buses');
            return;
        }
        
        // Reactivar el bus
        $result = $this->Buses_model->update($id, array(
            'estado' => 'activo',
            'fecha_actualizacion' => date('Y-m-d H:i:s')
        ));
        
        if ($result) {
            $this->session->set_flashdata('success', 'Bus reactivado exitosamente');
        } else {
            $this->session->set_flashdata('error', 'Error al reactivar bus');
        }
        
        redirect('flota/buses');
    }

    // ===== FUNCIONES CRUD PARA CONDUCTORES =====
    public function conductor_create() {
        // Verificar si es una petición POST
        if ($this->input->method() !== 'post') {
            show_404();
            return;
        }
        
        try {
            // Validar datos con reglas simplificadas
            $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[2]|max_length[50]');
            $this->form_validation->set_rules('licencia', 'Licencia', 'required|min_length[5]|max_length[20]|is_unique[conductores.licencia]');
            $this->form_validation->set_rules('telefono', 'Teléfono', 'required|min_length[7]|max_length[15]');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email_if_not_empty|is_unique_if_not_empty[conductores.email]');
            $this->form_validation->set_rules('estado', 'Estado', 'required|in_list[activo,inactivo,suspendido]');
            
            // Mensajes personalizados simplificados
            $this->form_validation->set_message('is_unique', 'El %s ya está registrado en otro conductor.');
            $this->form_validation->set_message('valid_email', 'El campo %s debe contener un email válido.');
            $this->form_validation->set_message('in_list', 'El campo %s debe ser uno de los valores permitidos.');
            
            if ($this->form_validation->run() == FALSE) {
                // Log del error para debugging
                log_message('error', 'Error de validación en conductor_create: ' . validation_errors());
                $this->session->set_flashdata('error', 'Error de validación: ' . validation_errors());
            } else {
                // Preparar datos
                $email = $this->input->post('email');
                if (empty($email)) {
                    $email = NULL;
                }
                
                $data = array(
                    'nombre' => $this->input->post('nombre'),
                    'licencia' => $this->input->post('licencia'),
                    'telefono' => $this->input->post('telefono'),
                    'email' => $email,
                    'estado' => $this->input->post('estado'),
                    'fecha_registro' => date('Y-m-d H:i:s')
                );
                
                // Log de datos para debugging
                log_message('info', 'Intentando crear conductor con datos: ' . json_encode($data));
                
                $result = $this->Conductores_model->create($data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Conductor creado exitosamente');
                    log_message('info', 'Conductor creado exitosamente con ID: ' . $result);
                } else {
                    $this->session->set_flashdata('error', 'Error al crear conductor. Verifique los datos.');
                    log_message('error', 'Error al crear conductor en la base de datos');
                }
            }
        } catch (Exception $e) {
            // Log del error para debugging
            log_message('error', 'Excepción en conductor_create: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Error inesperado al crear conductor. Contacte al administrador.');
        }
        
        redirect('flota/conductores');
    }

    public function conductor_update() {
        // Verificar si es una petición POST
        if ($this->input->method() !== 'post') {
            show_404();
            return;
        }
        
        $id = $this->input->post('id');
        
        // Validar datos
        $this->form_validation->set_rules('id', 'ID', 'required|numeric');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[2]|max_length[30]|regex_match[/^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]+$/]');
        $this->form_validation->set_rules('licencia', 'Licencia', 'required|regex_match[/^[0-9]{11}$/]');
        $this->form_validation->set_rules('telefono', 'Teléfono', 'required|min_length[10]|max_length[15]');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('estado', 'Estado', 'required|in_list[activo,inactivo,suspendido]');
        
        // Mensajes personalizados para conductores
        $this->form_validation->set_message('valid_email', 'El campo %s debe contener un email válido.');
        $this->form_validation->set_message('in_list', 'El campo %s debe ser uno de los valores permitidos.');
        $this->form_validation->set_message('regex_match', 'El campo %s debe tener el formato correcto: 11 dígitos numéricos (ej: 10002079656).');
        $this->form_validation->set_message('regex_match', 'El campo %s solo debe contener letras y espacios.');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
        } else {
            $email = $this->input->post('email');
            // Si el email está vacío, establecerlo como NULL en lugar de string vacío
            if (empty($email)) {
                $email = NULL;
            }
            
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'licencia' => $this->input->post('licencia'),
                'telefono' => $this->input->post('telefono'),
                'email' => $email,
                'estado' => $this->input->post('estado'),
                'fecha_actualizacion' => date('Y-m-d H:i:s')
            );
            
            $result = $this->Conductores_model->update($id, $data);
            if ($result) {
                $this->session->set_flashdata('success', 'Conductor actualizado exitosamente');
            } else {
                $this->session->set_flashdata('error', 'Error al actualizar conductor. Verifique los datos.');
            }
        }
        
        redirect('flota/conductores');
    }

    public function conductor_delete($id = NULL) {
        // Verificar si se proporcionó un ID válido
        if ($id === NULL || !is_numeric($id)) {
            $this->session->set_flashdata('error', 'ID de conductor inválido');
            redirect('flota/conductores');
            return;
        }
        
        // Verificar si el conductor existe
        $conductor = $this->Conductores_model->get_by_id($id);
        if (!$conductor) {
            $this->session->set_flashdata('error', 'El conductor no existe');
            redirect('flota/conductores');
            return;
        }
        
        // Verificar si el conductor tiene viajes asociados
        $viajes_asociados = $this->Viajes_model->get_by_conductor($id);
        
        if (!empty($viajes_asociados)) {
            // Si tiene viajes, cambiar estado a 'suspendido' en lugar de eliminar
            $result = $this->Conductores_model->update($id, array('estado' => 'suspendido'));
            if ($result) {
                $this->session->set_flashdata('warning', 'El conductor no se puede eliminar porque tiene viajes asociados. Se ha marcado como suspendido. Puedes reactivarlo más tarde.');
            } else {
                $this->session->set_flashdata('error', 'Error al marcar conductor como suspendido');
            }
        } else {
            // Si no tiene viajes, eliminar físicamente
            $result = $this->Conductores_model->delete($id);
            if ($result) {
                $this->session->set_flashdata('success', 'Conductor eliminado exitosamente');
            } else {
                $this->session->set_flashdata('error', 'Error al eliminar conductor');
            }
        }
        
        redirect('flota/conductores');
    }

    public function conductor_reactivar($id = NULL) {
        // Verificar si se proporcionó un ID válido
        if ($id === NULL || !is_numeric($id)) {
            $this->session->set_flashdata('error', 'ID de conductor inválido');
            redirect('flota/conductores');
            return;
        }
        
        // Verificar si el conductor existe
        $conductor = $this->Conductores_model->get_by_id($id);
        if (!$conductor) {
            $this->session->set_flashdata('error', 'El conductor no existe');
            redirect('flota/conductores');
            return;
        }
        
        // Verificar que el conductor esté suspendido
        if ($conductor->estado !== 'suspendido') {
            $this->session->set_flashdata('error', 'Solo se pueden reactivar conductores suspendidos');
            redirect('flota/conductores');
            return;
        }
        
        // Reactivar el conductor
        $result = $this->Conductores_model->update($id, array(
            'estado' => 'activo',
            'fecha_actualizacion' => date('Y-m-d H:i:s')
        ));
        
        if ($result) {
            $this->session->set_flashdata('success', 'Conductor reactivado exitosamente');
        } else {
            $this->session->set_flashdata('error', 'Error al reactivar conductor');
        }
        
        redirect('flota/conductores');
    }

    // ===== FUNCIONES CRUD PARA RUTAS =====
    public function ruta_create() {
        // Verificar si es una petición POST
        if ($this->input->method() !== 'post') {
            show_404();
            return;
        }
        
        // Validar datos
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('origen', 'Origen', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('destino', 'Destino', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('distancia', 'Distancia', 'required|numeric|greater_than[0]|less_than_equal_to[9999.99]');
        $this->form_validation->set_rules('tiempo_estimado', 'Tiempo Estimado', 'required|max_length[20]');
        $this->form_validation->set_rules('estado', 'Estado', 'required|in_list[activo,inactivo]');
        
        // Mensajes personalizados para rutas
        $this->form_validation->set_message('greater_than', 'La %s debe ser mayor a %s km.');
        $this->form_validation->set_message('less_than_equal_to', 'La %s debe ser menor o igual a %s km.');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
        } else {
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'origen' => $this->input->post('origen'),
                'destino' => $this->input->post('destino'),
                'distancia' => $this->input->post('distancia'),
                'tiempo_estimado' => $this->input->post('tiempo_estimado'),
                'estado' => $this->input->post('estado'),
                'fecha_registro' => date('Y-m-d H:i:s')
            );
            
            $result = $this->Rutas_model->create($data);
            if ($result) {
                $this->session->set_flashdata('success', 'Ruta creada exitosamente');
            } else {
                $this->session->set_flashdata('error', 'Error al crear ruta. Verifique los datos.');
            }
        }
        
        redirect('flota/rutas');
    }

    public function ruta_update() {
        // Verificar si es una petición POST
        if ($this->input->method() !== 'post') {
            show_404();
            return;
        }
        
        $id = $this->input->post('id');
        
        // Validar datos
        $this->form_validation->set_rules('id', 'ID', 'required|numeric');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('origen', 'Origen', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('destino', 'Destino', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('distancia', 'Distancia', 'required|numeric|greater_than[0]|less_than_equal_to[9999.99]');
        $this->form_validation->set_rules('tiempo_estimado', 'Tiempo Estimado', 'required|max_length[20]');
        $this->form_validation->set_rules('estado', 'Estado', 'required|in_list[activo,inactivo]');
        
        // Mensajes personalizados para rutas
        $this->form_validation->set_message('greater_than', 'La %s debe ser mayor a %s km.');
        $this->form_validation->set_message('less_than_equal_to', 'La %s debe ser menor o igual a %s km.');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
        } else {
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'origen' => $this->input->post('origen'),
                'destino' => $this->input->post('destino'),
                'distancia' => $this->input->post('distancia'),
                'tiempo_estimado' => $this->input->post('tiempo_estimado'),
                'estado' => $this->input->post('estado'),
                'fecha_actualizacion' => date('Y-m-d H:i:s')
            );
            
            $result = $this->Rutas_model->update($id, $data);
            if ($result) {
                $this->session->set_flashdata('success', 'Ruta actualizada exitosamente');
            } else {
                $this->session->set_flashdata('error', 'Error al actualizar ruta. Verifique los datos.');
            }
        }
        
        redirect('flota/rutas');
    }

    public function ruta_delete($id = NULL) {
        // Verificar si se proporcionó un ID válido
        if ($id === NULL || !is_numeric($id)) {
            $this->session->set_flashdata('error', 'ID de ruta inválido');
            redirect('flota/rutas');
            return;
        }
        
        // Verificar si la ruta existe
        $ruta = $this->Rutas_model->get_by_id($id);
        if (!$ruta) {
            $this->session->set_flashdata('error', 'La ruta no existe');
            redirect('flota/rutas');
            return;
        }
        
        // Verificar si la ruta tiene viajes asociados
        $viajes_asociados = $this->Viajes_model->get_by_ruta($id);
        
        if (!empty($viajes_asociados)) {
            // Si tiene viajes, cambiar estado a 'inactivo' en lugar de eliminar
            $result = $this->Rutas_model->update($id, array('estado' => 'inactivo'));
            if ($result) {
                $this->session->set_flashdata('warning', 'La ruta no se puede eliminar porque tiene viajes asociados. Se ha marcado como inactiva.');
            } else {
                $this->session->set_flashdata('error', 'Error al marcar ruta como inactiva');
            }
        } else {
            // Si no tiene viajes, eliminar físicamente
            $result = $this->Rutas_model->delete($id);
            if ($result) {
                $this->session->set_flashdata('success', 'Ruta eliminada exitosamente');
            } else {
                $this->session->set_flashdata('error', 'Error al eliminar ruta');
            }
        }
        
        redirect('flota/rutas');
    }

    public function ruta_reactivar($id = NULL) {
        // Verificar si se proporcionó un ID válido
        if ($id === NULL || !is_numeric($id)) {
            $this->session->set_flashdata('error', 'ID de ruta inválido');
            redirect('flota/rutas');
            return;
        }
        
        // Verificar si la ruta existe
        $ruta = $this->Rutas_model->get_by_id($id);
        if (!$ruta) {
            $this->session->set_flashdata('error', 'La ruta no existe');
            redirect('flota/rutas');
            return;
        }
        
        // Verificar que la ruta esté inactiva
        if ($ruta->estado !== 'inactivo') {
            $this->session->set_flashdata('error', 'Solo se pueden reactivar rutas inactivas');
            redirect('flota/rutas');
            return;
        }
        
        // Reactivar la ruta
        $result = $this->Rutas_model->update($id, array(
            'estado' => 'activo',
            'fecha_actualizacion' => date('Y-m-d H:i:s')
        ));
        
        if ($result) {
            $this->session->set_flashdata('success', 'Ruta reactivada exitosamente');
        } else {
            $this->session->set_flashdata('error', 'Error al reactivar ruta');
        }
        
        redirect('flota/rutas');
    }

    // ===== FUNCIONES CRUD PARA VIAJES =====
    public function viaje_create() {
        // Verificar si es una petición POST
        if ($this->input->method() !== 'post') {
            show_404();
            return;
        }
        
        // Validar datos
        $this->form_validation->set_rules('bus_id', 'Bus', 'required|numeric');
        $this->form_validation->set_rules('conductor_id', 'Conductor', 'required|numeric');
        $this->form_validation->set_rules('ruta_id', 'Ruta', 'required|numeric');
        $this->form_validation->set_rules('fecha_salida', 'Fecha de Salida', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required|in_list[programado,en_curso,completado,cancelado]');
        
        // Mensajes personalizados para viajes
        $this->form_validation->set_message('in_list', 'El campo %s debe ser uno de los valores permitidos.');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
        } else {
            $data = array(
                'bus_id' => $this->input->post('bus_id'),
                'conductor_id' => $this->input->post('conductor_id'),
                'ruta_id' => $this->input->post('ruta_id'),
                'fecha_salida' => $this->input->post('fecha_salida'),
                'fecha_llegada' => $this->input->post('fecha_llegada'),
                'estado' => $this->input->post('estado'),
                'observaciones' => $this->input->post('observaciones'),
                'fecha_registro' => date('Y-m-d H:i:s')
            );
            
            $result = $this->Viajes_model->create($data);
            if ($result) {
                $this->session->set_flashdata('success', 'Viaje creado exitosamente');
            } else {
                $this->session->set_flashdata('error', 'Error al crear viaje. Verifique los datos.');
            }
        }
        
        redirect('flota/viajes');
    }

    public function viaje_update() {
        // Verificar si es una petición POST
        if ($this->input->method() !== 'post') {
            show_404();
            return;
        }
        
        $id = $this->input->post('id');
        $solo_estado = $this->input->post('solo_estado');
        
        // Si solo se está actualizando el estado (viaje en curso)
        if ($solo_estado == '1') {
            // Validar solo el estado
            $this->form_validation->set_rules('id', 'ID', 'required|numeric');
            $this->form_validation->set_rules('estado', 'Estado', 'required|in_list[programado,en_curso,completado,cancelado]');
            
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
            } else {
                $data = array(
                    'estado' => $this->input->post('estado'),
                    'fecha_actualizacion' => date('Y-m-d H:i:s')
                );
                
                $result = $this->Viajes_model->update($id, $data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Estado del viaje actualizado exitosamente');
                } else {
                    $this->session->set_flashdata('error', 'Error al actualizar el estado del viaje');
                }
            }
        } else {
            // Validar todos los campos para viajes programados
            $this->form_validation->set_rules('id', 'ID', 'required|numeric');
            $this->form_validation->set_rules('bus_id', 'Bus', 'required|numeric');
            $this->form_validation->set_rules('conductor_id', 'Conductor', 'required|numeric');
            $this->form_validation->set_rules('ruta_id', 'Ruta', 'required|numeric');
            $this->form_validation->set_rules('fecha_salida', 'Fecha de Salida', 'required');
            $this->form_validation->set_rules('estado', 'Estado', 'required|in_list[programado,en_curso,completado,cancelado]');
            
            // Mensajes personalizados para viajes
            $this->form_validation->set_message('in_list', 'El campo %s debe ser uno de los valores permitidos.');
            
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
            } else {
                $data = array(
                    'bus_id' => $this->input->post('bus_id'),
                    'conductor_id' => $this->input->post('conductor_id'),
                    'ruta_id' => $this->input->post('ruta_id'),
                    'fecha_salida' => $this->input->post('fecha_salida'),
                    'fecha_llegada' => $this->input->post('fecha_llegada'),
                    'estado' => $this->input->post('estado'),
                    'observaciones' => $this->input->post('observaciones'),
                    'fecha_actualizacion' => date('Y-m-d H:i:s')
                );
                
                $result = $this->Viajes_model->update($id, $data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Viaje actualizado exitosamente');
                } else {
                    $this->session->set_flashdata('error', 'Error al actualizar viaje. Verifique los datos.');
                }
            }
        }
        
        redirect('flota/viajes');
    }

    public function test_db() {
        log_message('debug', 'test_db llamado');
        
        try {
            // Probar conexión básica
            $this->db->simple_query('SELECT 1');
            log_message('debug', 'Conexión a BD exitosa');
            
            // Verificar si existe la tabla viajes
            $tables = $this->db->list_tables();
            log_message('debug', 'Tablas disponibles: ' . json_encode($tables));
            
            if (in_array('viajes', $tables)) {
                log_message('debug', 'Tabla viajes existe');
                
                // Contar viajes
                $count = $this->db->count_all('viajes');
                log_message('debug', 'Total de viajes: ' . $count);
                
                // Mostrar algunos viajes
                $this->db->select('id, estado, fecha_salida');
                $this->db->from('viajes');
                $this->db->limit(3);
                $query = $this->db->get();
                $viajes = $query->result();
                
                log_message('debug', 'Viajes de ejemplo: ' . json_encode($viajes));
                
                echo "✅ Conexión exitosa<br>";
                echo "📊 Total de viajes: " . $count . "<br>";
                echo "🔍 Viajes de ejemplo: <pre>" . json_encode($viajes, JSON_PRETTY_PRINT) . "</pre>";
                
            } else {
                log_message('error', 'Tabla viajes NO existe');
                echo "❌ Tabla viajes NO existe<br>";
            }
            
        } catch (Exception $e) {
            log_message('error', 'Error en test_db: ' . $e->getMessage());
            echo "❌ Error: " . $e->getMessage() . "<br>";
        }
    }

    public function get_viaje_ajax($id = NULL) {
        log_message('debug', 'get_viaje_ajax llamado con ID: ' . $id);
        
        // Verificar que el ID sea válido
        if ($id === NULL || !is_numeric($id)) {
            log_message('error', 'ID de viaje inválido: ' . $id);
            $this->output->set_status_header(400);
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(['error' => 'ID de viaje inválido']));
            return;
        }
        
        try {
            // Primero probar con una consulta simple
            $this->db->select('id, bus_id, conductor_id, ruta_id, estado, fecha_salida, fecha_llegada');
            $this->db->from('viajes');
            $this->db->where('id', $id);
            $query = $this->db->get();
            
            log_message('debug', 'Query ejecutada: ' . $this->db->last_query());
            
            if ($query->num_rows() == 0) {
                log_message('error', 'El viaje con ID ' . $id . ' no existe');
                $this->output->set_status_header(404);
                $this->output->set_content_type('application/json');
                $this->output->set_output(json_encode(['error' => 'El viaje no existe']));
                return;
            }
            
            $viaje = $query->row();
            log_message('debug', 'Viaje encontrado: ' . json_encode($viaje));
            
            // Obtener detalles del viaje
            $this->db->select('*');
            $this->db->from('viajes_detalles');
            $this->db->where('viaje_id', $id);
            $this->db->order_by('orden', 'ASC');
            $detalles_query = $this->db->get();
            
            log_message('debug', 'Query detalles ejecutada: ' . $this->db->last_query());
            
            $detalles = $detalles_query->result();
            log_message('debug', 'Detalles encontrados: ' . count($detalles));
            
            // Agregar detalles al objeto viaje
            $viaje->detalles = $detalles;
            
            // Log de los datos que se van a enviar
            log_message('debug', 'Datos del viaje a enviar: ' . json_encode($viaje));
            
            // Enviar respuesta JSON
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($viaje));
            log_message('debug', 'Respuesta JSON enviada exitosamente');
            
        } catch (Exception $e) {
            log_message('error', 'Excepción en get_viaje_ajax: ' . $e->getMessage());
            $this->output->set_status_header(500);
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]));
        }
    }

    public function viaje_delete($id = NULL) {
        // Verificar si se proporcionó un ID válido
        if ($id === NULL || !is_numeric($id)) {
            $this->session->set_flashdata('error', 'ID de viaje inválido');
            redirect('flota/viajes');
            return;
        }
        
        // Verificar si el viaje existe
        $viaje = $this->Viajes_model->get_by_id($id);
        if (!$viaje) {
            $this->session->set_flashdata('error', 'El viaje no existe');
            redirect('flota/viajes');
            return;
        }
        
        // Solo permitir eliminar viajes programados o cancelados
        if ($viaje->estado === 'en_curso' || $viaje->estado === 'completado') {
            $this->session->set_flashdata('error', 'No se puede eliminar un viaje en curso o completado');
            redirect('flota/viajes');
            return;
        }
        
        $result = $this->Viajes_model->delete($id);
        if ($result) {
            $this->session->set_flashdata('success', 'Viaje eliminado exitosamente');
        } else {
            $this->session->set_flashdata('error', 'Error al eliminar viaje');
        }
        
        redirect('flota/viajes');
    }
    
    // ===== FUNCIONES DE VALIDACIÓN PERSONALIZADAS =====
    
    /**
     * Valida email solo si no está vacío
     */
    public function valid_email_if_not_empty($str) {
        if (empty($str)) {
            return TRUE; // Email vacío es válido
        }
        return (bool) filter_var($str, FILTER_VALIDATE_EMAIL);
    }
    
    /**
     * Verifica unicidad del email solo si no está vacío
     */
    public function is_unique_if_not_empty($str, $field) {
        if (empty($str)) {
            return TRUE; // Email vacío no necesita verificación de unicidad
        }
        
        // Extraer el nombre de la tabla y campo del parámetro field
        $parts = explode('.', $field);
        if (count($parts) !== 2) {
            return FALSE;
        }
        
        $table = $parts[0];
        $column = $parts[1];
        
        // Verificar si existe otro registro con el mismo email
        $this->db->where($column, $str);
        $this->db->where('id !=', $this->input->post('id')); // Excluir el registro actual en caso de edición
        $query = $this->db->get($table);
        
        return $query->num_rows() === 0;
    }
}
