<style>
/* Estilos para el formulario mejorado */
.form-label {
    font-weight: 600;
    color: #2c3e50;
}

.form-control:focus, .form-select:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
}

.form-control.is-valid, .form-select.is-valid {
    border-color: #28a745;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='m2.3 6.73.94-.94 3.03-3.03-1.88-1.88-3.03 3.03-.94.94 1.88 1.88z'/%3e%3c/svg%3e");
}

.form-control.is-invalid, .form-select.is-invalid {
    border-color: #dc3545;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 4.6 1.4 1.4m0-1.4-1.4 1.4'/%3e%3c/svg%3e");
}

.invalid-feedback {
    font-size: 0.875em;
    color: #dc3545;
    font-weight: 500;
}

.valid-feedback {
    font-size: 0.875em;
    color: #28a745;
    font-weight: 500;
}

.progress {
    background-color: #e9ecef;
    border-radius: 10px;
}

.progress-bar {
    transition: width 0.3s ease;
    border-radius: 10px;
}

.progress-bar.bg-danger {
    background-color: #dc3545 !important;
}

.progress-bar.bg-warning {
    background-color: #ffc107 !important;
}

.progress-bar.bg-success {
    background-color: #28a745 !important;
}

/* Botones mejorados */
.btn {
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.btn:disabled {
    transform: none;
    box-shadow: none;
    opacity: 0.6;
}

/* Iconos informativos */
.fa-info-circle {
    cursor: help;
    transition: color 0.3s ease;
}

.fa-info-circle:hover {
    color: #17a2b8 !important;
}

/* Modal más grande */
.modal-lg {
    max-width: 900px;
}

/* Campos en filas */
.row .col-md-6 {
    padding: 0 10px;
}

/* Responsive */
@media (max-width: 768px) {
    .modal-lg {
        max-width: 95%;
        margin: 10px;
    }
    
    .row .col-md-6 {
        padding: 0 5px;
    }
}

/* Estilos para mensajes de alerta */
.alert {
    border-radius: 10px;
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border-left: 4px solid #28a745;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border-left: 4px solid #dc3545;
}

.alert-warning {
    background-color: #fff3cd;
    color: #856404;
    border-left: 4px solid #ffc107;
}

.alert .btn-close {
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

.alert .btn-close:hover {
    opacity: 1;
}

.alert i {
    font-size: 1.1em;
}

/* Estilos para detalles del viaje */
.detalle-item {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #dee2e6;
    margin-bottom: 15px;
}

.detalle-item:hover {
    background-color: #e9ecef;
    border-color: #adb5bd;
}

/* Estilos para campos de detalles */
.detalle-item .form-control {
    border-radius: 6px;
}

.detalle-item .btn-danger {
    border-radius: 6px;
    padding: 0.375rem 0.75rem;
}

/* Estilos para botones deshabilitados según estado */
.btn-disabled-by-state {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
}

.btn-disabled-by-state:hover {
    transform: none !important;
    box-shadow: none !important;
}

/* Estilos para campos deshabilitados en modo en curso */
.form-control-disabled {
    background-color: #e9ecef !important;
    border-color: #ced4da !important;
    color: #6c757d !important;
    opacity: 0.8;
    cursor: not-allowed;
    pointer-events: none;
}

.form-control-disabled:focus {
    border-color: #ced4da !important;
    box-shadow: none !important;
    outline: none !important;
}

.form-control-disabled option {
    color: #6c757d;
}

/* Estilos para el mensaje informativo */
.alert-warning {
    background-color: #fff3cd;
    color: #856404;
    border-left: 4px solid #ffc107;
    border: 1px solid #ffeaa7;
}

.alert-warning .btn-close {
    color: #856404;
}

/* Estilos para botones deshabilitados según estado */
.btn-disabled-by-state {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
}

.btn-disabled-by-state:hover {
    transform: none !important;
    box-shadow: none !important;
}

/* Estilos para el mensaje informativo */
.alert-info {
    background-color: #d1ecf1;
    color: #0c5460;
    border-left: 4px solid #17a2b8;
    border: 1px solid #bee5eb;
}

.alert-info .btn-close {
    color: #0c5460;
}

/* Separador visual */
hr {
    border-color: #dee2e6;
    border-width: 2px;
    margin: 2rem 0;
}

/* Título de sección */
h6 {
    color: #495057;
    font-weight: 600;
    margin-bottom: 1rem;
}

/* Estilos para el modal cuando solo se edita el estado */
.modal-solo-estado .modal-body {
    background-color: #f8f9fa;
}

.modal-solo-estado .form-control-disabled {
    background-color: #e9ecef !important;
    border-color: #ced4da !important;
    color: #6c757d !important;
}

.modal-solo-estado .form-select.form-control-disabled {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%236c757d' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 6 7 7 7-7'/%3e%3c/svg%3e");
}

/* Estilos para el mensaje informativo */
.alert-info {
    background-color: #d1ecf1;
    color: #0c5460;
    border-left: 4px solid #17a2b8;
    border: 1px solid #bee5eb;
}

.alert-info .btn-close {
    color: #0c5460;
}
</style>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-white">Lista de Viajes</h6>
        <?php if ($permissions->can_create('viajes')): ?>
        <button type="button" class="btn btn-light" onclick="showAddViajeModal()">
            <i class="fas fa-plus me-2"></i>Nuevo Viaje
        </button>
        <?php else: ?>
        <button type="button" class="btn btn-light" disabled title="No tienes permisos para crear viajes">
            <i class="fas fa-plus me-2"></i>Nuevo Viaje
        </button>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo $this->session->flashdata('success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?php echo $this->session->flashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <?php if($this->session->flashdata('warning')): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?php echo $this->session->flashdata('warning'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
        <?php endif; ?>
        
        <div class="table-responsive">
            <table class="table table-bordered" id="viajesTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bus</th>
                        <th>Conductor</th>
                        <th>Ruta</th>
                        <th>Fecha Salida</th>
                        <th>Fecha Llegada</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($viajes)): ?>
                        <?php foreach ($viajes as $viaje): ?>
                            <tr>
                                <td><?php echo $viaje->id; ?></td>
                                <td><?php echo $viaje->bus_placa; ?></td>
                                <td><?php echo $viaje->conductor_nombre; ?></td>
                                <td><?php echo $viaje->ruta_nombre; ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($viaje->fecha_salida)); ?></td>
                                <td><?php echo ($viaje->fecha_llegada) ? date('d/m/Y H:i', strtotime($viaje->fecha_llegada)) : 'En curso'; ?></td>
                                <td>
                                    <span class="badge bg-<?php 
                                        echo ($viaje->estado == 'completado') ? 'success' : 
                                             (($viaje->estado == 'en_curso') ? 'warning' : 'info'); 
                                    ?>">
                                        <?php echo ucfirst(str_replace('_', ' ', $viaje->estado)); ?>
                                    </span>
                                </td>
                                                                 <td>
                                     <button class="btn btn-sm btn-info" onclick="viewViaje(<?php echo $viaje->id; ?>)">
                                         <i class="fas fa-eye"></i>
                                     </button>
                                     
                                     <?php if ($permissions->can_update('viajes')): ?>
                                     <button class="btn btn-sm btn-warning <?php echo ($viaje->estado == 'completado') ? 'btn-disabled-by-state' : ''; ?>" 
                                             onclick="editViaje(<?php echo $viaje->id; ?>)" 
                                             <?php echo ($viaje->estado == 'completado') ? 'disabled' : ''; ?>
                                             title="<?php echo ($viaje->estado == 'completado') ? 'Los viajes completados no se pueden editar' : 'Editar viaje'; ?>">
                                         <i class="fas fa-edit"></i>
                                     </button>
                                     <?php endif; ?>
                                     
                                     <?php if ($permissions->can_delete('viajes')): ?>
                                     <button class="btn btn-sm btn-danger <?php echo ($viaje->estado != 'programado') ? 'btn-disabled-by-state' : ''; ?>" 
                                             onclick="deleteViaje(<?php echo $viaje->id; ?>)" 
                                             <?php echo ($viaje->estado != 'programado') ? 'disabled' : ''; ?>
                                             title="<?php echo ($viaje->estado != 'programado') ? 'Solo se pueden eliminar viajes programados' : 'Eliminar viaje'; ?>">
                                         <i class="fas fa-trash"></i>
                                     </button>
                                     <?php endif; ?>
                                 </td>
                            </tr>
                            <!-- Fila de detalles expandible -->
                            <tr class="viaje-detalles" id="detalles-<?php echo $viaje->id; ?>" style="display: none;">
                                <td colspan="8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0">Detalles del Viaje #<?php echo $viaje->id; ?></h6>
                                        </div>
                                        <div class="card-body">
                                            <?php if (!empty($viaje->detalles)): ?>
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Orden</th>
                                                            <th>Parada</th>
                                                            <th>Hora Programada</th>
                                                            <th>Hora Real</th>
                                                            <th>Pasajeros Suben</th>
                                                            <th>Pasajeros Bajan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($viaje->detalles as $detalle): ?>
                                                            <tr>
                                                                <td><?php echo $detalle->orden; ?></td>
                                                                <td><?php echo $detalle->parada; ?></td>
                                                                <td><?php echo $detalle->hora_programada; ?></td>
                                                                <td><?php echo $detalle->hora_real ?: 'Pendiente'; ?></td>
                                                                <td><?php echo $detalle->pasajeros_suben; ?></td>
                                                                <td><?php echo $detalle->pasajeros_bajan; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php else: ?>
                                                <p class="text-muted">No hay detalles registrados para este viaje.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">No hay viajes registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para agregar/editar viaje -->
<div class="modal fade" id="addViajeModal" tabindex="-1" aria-labelledby="addViajeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addViajeModalLabel">Nuevo Viaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="viajeForm" novalidate>
                <div class="modal-body">
                    <input type="hidden" id="viaje_id" name="viaje_id">
                    
                    <!-- Información principal del viaje -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="bus_id" class="form-label">
                                    Bus <span class="text-danger">*</span>
                                    <i class="fas fa-info-circle text-info" title="Selecciona un bus activo para el viaje"></i>
                                </label>
                                <select class="form-select" id="bus_id" name="bus_id" required>
                                    <option value="">Seleccionar bus</option>
                                    <?php if (!empty($buses)): ?>
                                        <?php foreach ($buses as $bus): ?>
                                            <?php if ($bus->estado == 'activo'): ?>
                                                <option value="<?php echo $bus->id; ?>"><?php echo $bus->placa . ' - ' . $bus->marca . ' ' . $bus->modelo; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <div class="invalid-feedback" id="bus_id-error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="conductor_id" class="form-label">
                                    Conductor <span class="text-danger">*</span>
                                    <i class="fas fa-info-circle text-info" title="Selecciona un conductor activo para el viaje"></i>
                                </label>
                                <select class="form-select" id="conductor_id" name="conductor_id" required>
                                    <option value="">Seleccionar conductor</option>
                                    <?php if (!empty($conductores)): ?>
                                        <?php foreach ($conductores as $conductor): ?>
                                            <?php if ($conductor->estado == 'activo'): ?>
                                                <option value="<?php echo $conductor->id; ?>"><?php echo $conductor->nombre . ' - ' . $conductor->licencia; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <div class="invalid-feedback" id="conductor_id-error"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="ruta_id" class="form-label">
                                    Ruta <span class="text-danger">*</span>
                                    <i class="fas fa-info-circle text-info" title="Selecciona una ruta activa para el viaje"></i>
                                </label>
                                <select class="form-select" id="ruta_id" name="ruta_id" required>
                                    <option value="">Seleccionar ruta</option>
                                    <?php if (!empty($rutas)): ?>
                                        <?php foreach ($rutas as $ruta): ?>
                                            <?php if ($ruta->estado == 'activo'): ?>
                                                <option value="<?php echo $ruta->id; ?>"><?php echo $ruta->nombre . ' (' . $ruta->origen . ' - ' . $ruta->destino . ')'; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <div class="invalid-feedback" id="ruta_id-error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="estado" class="form-label">
                                    Estado <span class="text-danger">*</span>
                                    <i class="fas fa-info-circle text-info" title="Estado inicial del viaje"></i>
                                </label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="">Seleccionar estado</option>
                                    <option value="programado">Programado</option>
                                    <option value="en_curso">En Curso</option>
                                    <option value="completado">Completado</option>
                                    <option value="cancelado">Cancelado</option>
                                </select>
                                <div class="invalid-feedback" id="estado-error"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fecha_salida" class="form-label">
                                    Fecha y Hora de Salida <span class="text-danger">*</span>
                                    <i class="fas fa-info-circle text-info" title="Fecha y hora programada de salida"></i>
                                </label>
                                <input type="datetime-local" class="form-control" id="fecha_salida" name="fecha_salida" required>
                                <div class="invalid-feedback" id="fecha_salida-error"></div>
                                <div class="valid-feedback">Fecha de salida válida</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fecha_llegada" class="form-label">
                                    Fecha y Hora de Llegada <small class="text-muted">(Opcional)</small>
                                    <i class="fas fa-info-circle text-info" title="Fecha y hora estimada de llegada (opcional)"></i>
                                </label>
                                <input type="datetime-local" class="form-control" id="fecha_llegada" name="fecha_llegada">
                                <div class="invalid-feedback" id="fecha_llegada-error"></div>
                                <div class="valid-feedback">Fecha de llegada válida</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sección de detalles del viaje -->
                    <hr>
                    <h6>Detalles del Viaje (Paradas)</h6>
                    <div id="detalles-container">
                        <div class="detalle-item row mb-2">
                                                         <div class="col-md-3">
                                 <label class="form-label small">Parada</label>
                                 <input type="text" class="form-control" name="detalles[0][parada]" 
                                        id="detalle-0-parada" placeholder="Nombre de la parada" 
                                        pattern="^[A-Za-zÁáÉéÍíÓóÚúÑñ0-9\s\-]{2,50}$">
                                 <div class="invalid-feedback" id="detalle-0-parada-error"></div>
                             </div>
                                                         <div class="col-md-2">
                                 <label class="form-label small">Hora</label>
                                 <input type="time" class="form-control" name="detalles[0][hora_programada]" 
                                        id="detalle-0-hora">
                                 <div class="invalid-feedback" id="detalle-0-hora-error"></div>
                             </div>
                            <div class="col-md-2">
                                <label class="form-label small">Suben</label>
                                <input type="number" class="form-control" name="detalles[0][pasajeros_suben]" 
                                       id="detalle-0-suben" placeholder="0" min="0" max="200">
                                <div class="invalid-feedback" id="detalle-0-suben-error"></div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small">Bajan</label>
                                <input type="number" class="form-control" name="detalles[0][pasajeros_bajan]" 
                                       id="detalle-0-bajan" placeholder="0" min="0" max="200">
                                <div class="invalid-feedback" id="detalle-0-bajan-error"></div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small">Orden <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="detalles[0][orden]" 
                                       id="detalle-0-orden" value="1" min="1" max="50" required>
                                <div class="invalid-feedback" id="detalle-0-orden-error"></div>
                            </div>
                            <div class="col-md-1">
                                <label class="form-label small">&nbsp;</label>
                                <button type="button" class="btn btn-danger btn-sm" onclick="removeDetalle(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-secondary btn-sm" onclick="addDetalle()">
                        <i class="fas fa-plus me-2"></i>Agregar Parada
                    </button>
                    
                    <!-- Indicador de progreso -->
                    <div class="progress mb-3 mt-3" style="height: 5px;">
                        <div class="progress-bar" id="formProgress" role="progressbar" style="width: 0%"></div>
                    </div>
                    <small class="text-muted" id="progressText">Completa todos los campos obligatorios para continuar</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning" id="btnActualizar" style="display: none;">
                        <i class="fas fa-edit me-2"></i>Actualizar
                    </button>
                    <button type="submit" class="btn btn-primary" id="btnGuardar" disabled>
                        <i class="fas fa-save me-2"></i>Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Variables globales
let currentViajeId = null;
let isEditing = false;
let detalleCounter = 1;

// Validaciones en tiempo real
function setupRealTimeValidation() {
    const inputs = document.querySelectorAll('#viajeForm input, #viajeForm select');
    
    inputs.forEach(input => {
        input.addEventListener('input', validateField);
        input.addEventListener('blur', validateField);
        input.addEventListener('change', validateField);
    });
    
    // Validar campos de detalles dinámicamente
    setupDetallesValidation();
}

function setupDetallesValidation() {
    const detallesContainer = document.getElementById('detalles-container');
    
    // Validar campos existentes al cargar
    const existingInputs = detallesContainer.querySelectorAll('input');
    existingInputs.forEach(input => {
        input.addEventListener('input', function() {
            validateDetalleField(this);
        });
        input.addEventListener('blur', function() {
            validateDetalleField(this);
        });
    });
    
    // Validar campos nuevos que se agreguen dinámicamente
    detallesContainer.addEventListener('input', function(e) {
        if (e.target.matches('input')) {
            validateDetalleField(e.target);
        }
    });
    
    // Validar el primer detalle al cargar la página
    setTimeout(() => {
        const firstDetalleInputs = detallesContainer.querySelectorAll('.detalle-item:first-child input');
        firstDetalleInputs.forEach(input => {
            validateDetalleField(input);
        });
    }, 100);
}

function validateField(event) {
    const field = event.target;
    const value = field.value.trim();
    const fieldName = field.name;
    
    // Limpiar estados previos
    field.classList.remove('is-valid', 'is-invalid');
    
    // Validar según el campo
    let isValid = false;
    let errorMessage = '';
    
    switch(fieldName) {
        case 'bus_id':
            isValid = value !== '';
            errorMessage = isValid ? '' : 'Debe seleccionar un bus';
            break;
            
        case 'conductor_id':
            isValid = value !== '';
            errorMessage = isValid ? '' : 'Debe seleccionar un conductor';
            break;
            
        case 'ruta_id':
            isValid = value !== '';
            errorMessage = isValid ? '' : 'Debe seleccionar una ruta';
            break;
            
        case 'estado':
            isValid = value !== '';
            errorMessage = isValid ? '' : 'Debe seleccionar un estado';
            break;
            
        case 'fecha_salida':
            isValid = validateFechaSalida(value);
            errorMessage = isValid ? '' : 'La fecha de salida debe ser futura';
            break;
            
        case 'fecha_llegada':
            if (value === '') {
                isValid = true; // Es opcional
                errorMessage = '';
            } else {
                isValid = validateFechaLlegada(value);
                errorMessage = isValid ? '' : 'La fecha de llegada debe ser posterior a la salida';
            }
            break;
    }
    
    // Aplicar validación visual
    if (isValid) {
        field.classList.add('is-valid');
        field.classList.remove('is-invalid');
        if (document.getElementById(fieldName + '-error')) {
            document.getElementById(fieldName + '-error').textContent = '';
        }
    } else {
        field.classList.add('is-invalid');
        field.classList.remove('is-valid');
        if (document.getElementById(fieldName + '-error')) {
            document.getElementById(fieldName + '-error').textContent = errorMessage;
        }
    }
    
    // Actualizar progreso del formulario
    updateFormProgress();
}

function validateDetalleField(field) {
    const value = field.value.trim();
    const fieldName = field.name;
    
    // Limpiar estados previos
    field.classList.remove('is-valid', 'is-invalid');
    
    let isValid = false;
    let errorMessage = '';
    
    if (fieldName.includes('[parada]')) {
        if (value === '') {
            isValid = true; // Campo opcional
        } else {
            isValid = validateParada(value);
            errorMessage = isValid ? '' : 'Solo letras, números, espacios y guiones, entre 2 y 50 caracteres';
        }
    } else if (fieldName.includes('[hora_programada]')) {
        if (value === '') {
            isValid = true; // Es opcional
        } else {
            isValid = true; // Cualquier hora seleccionada es válida
        }
    } else if (fieldName.includes('[pasajeros_suben]') || fieldName.includes('[pasajeros_bajan]')) {
        if (value === '') {
            isValid = true; // Es opcional
        } else {
            isValid = validatePasajeros(value);
            errorMessage = isValid ? '' : 'Debe ser un número entre 0 y 200';
        }
    } else if (fieldName.includes('[orden]')) {
        isValid = validateOrden(value);
        errorMessage = isValid ? '' : 'Debe ser un número entre 1 y 50';
    }
    
    // Aplicar validación visual
    if (isValid) {
        field.classList.add('is-valid');
        field.classList.remove('is-invalid');
    } else {
        field.classList.add('is-invalid');
        field.classList.remove('is-valid');
    }
    
    // Actualizar progreso del formulario
    updateFormProgress();
}

// Funciones de validación específicas
function validateFechaSalida(fecha) {
    // Si es un viaje en curso, no validar que la fecha sea futura
    const esViajeEnCurso = document.querySelector('.form-control-disabled') !== null;
    if (esViajeEnCurso) {
        return true; // Para viajes en curso, cualquier fecha es válida
    }
    
    // Para viajes nuevos o programados, validar que la fecha sea futura
    const fechaSalida = new Date(fecha);
    const ahora = new Date();
    return fechaSalida > ahora;
}

function validateFechaLlegada(fechaLlegada) {
    // Si es un viaje en curso, ser más permisivo con la validación
    const esViajeEnCurso = document.querySelector('.form-control-disabled') !== null;
    
    if (fechaLlegada === '') {
        return true; // Es opcional
    }
    
    const fechaLlegadaDate = new Date(fechaLlegada);
    const fechaSalida = new Date(document.getElementById('fecha_salida').value);
    
    if (esViajeEnCurso) {
        // Para viajes en curso, solo validar que la fecha de llegada no sea anterior a la de salida
        return fechaLlegadaDate >= fechaSalida;
    } else {
        // Para viajes nuevos o programados, validar que sea posterior a la salida
        return fechaLlegadaDate > fechaSalida;
    }
}

function validateParada(parada) {
    const pattern = /^[A-Za-zÁáÉéÍíÓóÚúÑñ0-9\s\-]{2,50}$/;
    return pattern.test(parada);
}

function validatePasajeros(pasajeros) {
    const num = parseInt(pasajeros);
    return !isNaN(num) && num >= 0 && num <= 200;
}

function validateOrden(orden) {
    const num = parseInt(orden);
    return !isNaN(num) && num >= 1 && num <= 50;
}

// Actualizar progreso del formulario
function updateFormProgress() {
    // Contar campos principales obligatorios
    const mainRequiredFields = document.querySelectorAll('#viajeForm select[required], #viajeForm input[required]:not([name*="detalles"])');
    let validMainFields = 0;
    let totalMainFields = mainRequiredFields.length;
    
    mainRequiredFields.forEach(field => {
        if (field.classList.contains('is-valid')) {
            validMainFields++;
        }
    });
    
    // Contar campos de detalles obligatorios (al menos el primer detalle debe estar completo)
    const detallesContainer = document.getElementById('detalles-container');
    const detalleItems = detallesContainer.querySelectorAll('.detalle-item');
    let validDetalles = 0;
    let totalDetalles = 0;
    
         if (detalleItems.length > 0) {
         // Solo contar el campo obligatorio del primer detalle (orden)
         const firstDetalle = detalleItems[0];
         const requiredDetalleFields = firstDetalle.querySelectorAll('input[required]');
         totalDetalles = requiredDetalleFields.length;
         
         requiredDetalleFields.forEach(field => {
             if (field.classList.contains('is-valid')) {
                 validDetalles++;
             }
         });
     }
    
    // Calcular progreso total
    const totalValidFields = validMainFields + validDetalles;
    const totalRequiredFields = totalMainFields + totalDetalles;
    const progress = totalRequiredFields > 0 ? (totalValidFields / totalRequiredFields) * 100 : 0;
    
    const progressBar = document.getElementById('formProgress');
    const progressText = document.getElementById('progressText');
    const btnGuardar = document.getElementById('btnGuardar');
    const btnActualizar = document.getElementById('btnActualizar');
    
    progressBar.style.width = progress + '%';
    
    if (progress === 100) {
        progressBar.classList.remove('bg-warning', 'bg-danger');
        progressBar.classList.add('bg-success');
        progressText.textContent = '¡Formulario completo! Puedes guardar';
        btnGuardar.disabled = false;
        if (btnActualizar) btnActualizar.disabled = false;
    } else if (progress >= 50) {
        progressBar.classList.remove('bg-danger');
        progressBar.classList.add('bg-warning');
        progressText.textContent = `Progreso: ${totalValidFields}/${totalRequiredFields} campos obligatorios completados`;
        btnGuardar.disabled = true;
        if (btnActualizar) btnActualizar.disabled = true;
    } else {
        progressBar.classList.remove('bg-warning', 'bg-success');
        progressBar.classList.add('bg-danger');
        progressText.textContent = `Progreso: ${totalValidFields}/${totalRequiredFields} campos obligatorios completados`;
        btnGuardar.disabled = true;
        if (btnActualizar) btnActualizar.disabled = true;
    }
    
    // Debug: mostrar información en consola
    console.log('Debug updateFormProgress:', {
        validMainFields,
        totalMainFields,
        validDetalles,
        totalDetalles,
        totalValidFields,
        totalRequiredFields,
        progress
    });
}

function viewViaje(id) {
    const detallesRow = document.getElementById('detalles-' + id);
    if (detallesRow.style.display === 'none') {
        detallesRow.style.display = 'table-row';
    } else {
        detallesRow.style.display = 'none';
    }
}

function editViaje(id) {
    console.log('=== INICIO editViaje ===');
    console.log('ID del viaje:', id);
    console.log('Tipo de ID:', typeof id);
    
    // Obtener el estado del viaje desde la fila de la tabla
    const row = event.target.closest('tr');
    if (!row) {
        console.error('No se pudo encontrar la fila de la tabla');
        alert('Error: No se pudo identificar la fila del viaje');
        return;
    }
    
    const estadoCell = row.cells[6]; // La columna del estado es la 7 (índice 6)
    if (!estadoCell) {
        console.error('No se pudo encontrar la celda del estado');
        alert('Error: No se pudo identificar el estado del viaje');
        return;
    }
    
    const estadoViaje = estadoCell.textContent.trim().toLowerCase();
    console.log('Estado del viaje:', estadoViaje);
    
    // Solo permitir editar viajes programados o en curso
    if (estadoViaje === 'completado') {
        alert('Los viajes "Completado" no se pueden modificar.');
        return;
    }
    
    currentViajeId = id;
    isEditing = true;
    
    console.log('Configurando formulario para edición...');
    
    // Configurar elementos del formulario
    const viajeIdInput = document.getElementById('viaje_id');
    const modalLabel = document.getElementById('addViajeModalLabel');
    const btnGuardar = document.getElementById('btnGuardar');
    const btnActualizar = document.getElementById('btnActualizar');
    
    if (!viajeIdInput || !modalLabel || !btnGuardar || !btnActualizar) {
        console.error('No se pudieron encontrar elementos del formulario');
        alert('Error: No se pudo configurar el formulario');
        return;
    }
    
    viajeIdInput.value = id;
    modalLabel.textContent = 'Editar Viaje';
    btnGuardar.style.display = 'none';
    btnActualizar.style.display = 'inline-block';
    
    // Construir URL para la petición AJAX
    const baseUrl = '<?php echo base_url(); ?>';
    const url = baseUrl + 'flota/get_viaje_ajax/' + id;
    console.log('Base URL:', baseUrl);
    console.log('URL completa:', url);
    
    // Mostrar indicador de carga
    console.log('Mostrando modal...');
    const modal = new bootstrap.Modal(document.getElementById('addViajeModal'));
    modal.show();
    
    // Mostrar mensaje de carga
    const modalBody = document.querySelector('#addViajeModal .modal-body');
    if (!modalBody) {
        console.error('No se pudo encontrar el cuerpo del modal');
        return;
    }
    
    const loadingMessage = document.createElement('div');
    loadingMessage.className = 'alert alert-info text-center';
    loadingMessage.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Cargando datos del viaje...';
    modalBody.insertBefore(loadingMessage, modalBody.firstChild);
    
    console.log('Iniciando petición AJAX...');
    
    // Cargar datos del viaje por AJAX
    fetch(url, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
        .then(response => {
            console.log('=== RESPUESTA DEL SERVIDOR ===');
            console.log('Response object:', response);
            console.log('Status:', response.status);
            console.log('Status text:', response.statusText);
            console.log('OK:', response.ok);
            console.log('Headers:', response.headers);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status} - ${response.statusText}`);
            }
            
            console.log('Parseando respuesta JSON...');
            return response.json();
        })
        .then(data => {
            console.log('=== DATOS RECIBIDOS ===');
            console.log('Datos completos:', data);
            console.log('Tipo de datos:', typeof data);
            
            // Remover mensaje de carga
            if (loadingMessage && loadingMessage.parentNode) {
                loadingMessage.remove();
            }
            
            if (data.error) {
                console.error('Error en los datos:', data.error);
                alert('Error al cargar los datos del viaje: ' + data.error);
                return;
            }
            
            console.log('Cargando datos en el formulario...');
            
            // Precargar datos en el formulario
            cargarDatosViaje(data);
            
            // Si es un viaje en curso, solo permitir editar el estado
            if (estadoViaje === 'en_curso' || data.estado === 'en_curso') {
                console.log('Configurando modo en curso...');
                setupEnCursoMode();
            } else {
                console.log('Configurando modo programado...');
                setupProgramadoMode();
            }
            
            console.log('=== EDICIÓN CONFIGURADA EXITOSAMENTE ===');
            
        })
        .catch(error => {
            console.error('=== ERROR EN LA PETICIÓN AJAX ===');
            console.error('Error completo:', error);
            console.error('Nombre del error:', error.name);
            console.error('Mensaje del error:', error.message);
            console.error('Stack trace:', error.stack);
            
            // Remover mensaje de carga
            if (loadingMessage && loadingMessage.parentNode) {
                loadingMessage.remove();
            }
            
            // Mostrar mensaje de error más específico
            let errorMessage = 'Error al cargar los datos del viaje';
            if (error.message.includes('HTTP error')) {
                errorMessage += '. Error del servidor: ' + error.message;
            } else if (error.name === 'SyntaxError') {
                errorMessage += '. Error en el formato de respuesta del servidor';
            } else {
                errorMessage += '. ' + error.message;
            }
            
            console.error('Mensaje de error para el usuario:', errorMessage);
            alert(errorMessage);
            
            // Cerrar el modal si hay error
            const modal = bootstrap.Modal.getInstance(document.getElementById('addViajeModal'));
            if (modal) {
                modal.hide();
            }
        });
        
    console.log('=== FIN editViaje ===');
}

// Función para cargar los datos del viaje en el formulario
function cargarDatosViaje(viaje) {
    console.log('=== INICIO cargarDatosViaje ===');
    console.log('Datos del viaje recibidos:', viaje);
    
    // Cargar datos principales
    const busIdField = document.getElementById('bus_id');
    const rutaIdField = document.getElementById('ruta_id');
    const conductorIdField = document.getElementById('conductor_id');
    const estadoField = document.getElementById('estado');
    
    if (busIdField) busIdField.value = viaje.bus_id;
    if (rutaIdField) rutaIdField.value = viaje.ruta_id;
    if (conductorIdField) conductorIdField.value = viaje.conductor_id;
    if (estadoField) estadoField.value = viaje.estado;
    
    // Convertir fechas al formato datetime-local de manera segura
    if (viaje.fecha_salida) {
        try {
            const fechaSalida = new Date(viaje.fecha_salida);
            // Verificar que la fecha sea válida
            if (!isNaN(fechaSalida.getTime())) {
                const fechaSalidaLocal = fechaSalida.toISOString().slice(0, 16);
                const fechaSalidaField = document.getElementById('fecha_salida');
                if (fechaSalidaField) {
                    fechaSalidaField.value = fechaSalidaLocal;
                    console.log('Fecha de salida cargada:', fechaSalidaLocal);
                }
            } else {
                console.warn('Fecha de salida inválida:', viaje.fecha_salida);
                const fechaSalidaField = document.getElementById('fecha_salida');
                if (fechaSalidaField) fechaSalidaField.value = '';
            }
        } catch (error) {
            console.error('Error al procesar fecha de salida:', error);
            const fechaSalidaField = document.getElementById('fecha_salida');
            if (fechaSalidaField) fechaSalidaField.value = '';
        }
    }
    
    if (viaje.fecha_llegada) {
        try {
            const fechaLlegada = new Date(viaje.fecha_llegada);
            // Verificar que la fecha sea válida
            if (!isNaN(fechaLlegada.getTime())) {
                const fechaLlegadaLocal = fechaLlegada.toISOString().slice(0, 16);
                const fechaLlegadaField = document.getElementById('fecha_llegada');
                if (fechaLlegadaField) {
                    fechaLlegadaField.value = fechaLlegadaLocal;
                    console.log('Fecha de llegada cargada:', fechaLlegadaLocal);
                }
            } else {
                console.warn('Fecha de llegada inválida:', viaje.fecha_llegada);
                const fechaLlegadaField = document.getElementById('fecha_llegada');
                if (fechaLlegadaField) fechaLlegadaField.value = '';
            }
        } catch (error) {
            console.error('Error al procesar fecha de llegada:', error);
            const fechaLlegadaField = document.getElementById('fecha_llegada');
            if (fechaLlegadaField) fechaLlegadaField.value = '';
        }
    } else {
        // Si no hay fecha de llegada, limpiar el campo
        const fechaLlegadaField = document.getElementById('fecha_llegada');
        if (fechaLlegadaField) fechaLlegadaField.value = '';
        console.log('No hay fecha de llegada, campo limpiado');
    }
    
    // Cargar detalles del viaje
    if (viaje.detalles && viaje.detalles.length > 0) {
        console.log('Cargando detalles del viaje...');
        cargarDetallesViaje(viaje.detalles);
    } else {
        // Limpiar contenedor de detalles si no hay
        console.log('No hay detalles, limpiando contenedor');
        const detallesContainer = document.getElementById('detalles-container');
        if (detallesContainer) detallesContainer.innerHTML = '';
    }
    
    // Marcar campos como válidos después de cargar los datos
    console.log('Marcando campos como válidos...');
    setTimeout(() => {
        // Marcar campos principales como válidos
        const camposPrincipales = ['bus_id', 'ruta_id', 'conductor_id', 'estado', 'fecha_salida'];
        camposPrincipales.forEach(campo => {
            const elemento = document.getElementById(campo);
            if (elemento && elemento.value !== '') {
                elemento.classList.remove('is-invalid');
                elemento.classList.add('is-valid');
                console.log(`Campo ${campo} marcado como válido`);
            }
        });
        
        // Marcar fecha de llegada como válida si tiene valor
        const fechaLlegadaField = document.getElementById('fecha_llegada');
        if (fechaLlegadaField && fechaLlegadaField.value !== '') {
            fechaLlegadaField.classList.remove('is-invalid');
            fechaLlegadaField.classList.add('is-valid');
            console.log('Campo fecha_llegada marcado como válido');
        }
        
        // Actualizar progreso del formulario
        console.log('Actualizando progreso del formulario...');
        updateFormProgress();
        
    }, 200);
    
    console.log('=== FIN cargarDatosViaje ===');
}

// Función para cargar los detalles del viaje
function cargarDetallesViaje(detalles) {
    console.log('=== INICIO cargarDetallesViaje ===');
    console.log('Detalles recibidos:', detalles);
    
    const container = document.getElementById('detalles-container');
    if (!container) {
        console.error('No se pudo encontrar el contenedor de detalles');
        return;
    }
    
    container.innerHTML = ''; // Limpiar contenedor
    
    if (!Array.isArray(detalles) || detalles.length === 0) {
        console.log('No hay detalles para cargar');
        return;
    }
    
    detalles.forEach((detalle, index) => {
        console.log(`Procesando detalle ${index}:`, detalle);
        
        const newDetalle = document.createElement('div');
        newDetalle.className = 'detalle-item row mb-2';
        
        // Sanitizar valores para evitar problemas de seguridad
        const parada = (detalle.parada || '').replace(/[<>]/g, '');
        const horaProgramada = detalle.hora_programada || '';
        const pasajerosSuben = detalle.pasajeros_suben || '';
        const pasajerosBajan = detalle.pasajeros_bajan || '';
        const orden = detalle.orden || (index + 1);
        
        newDetalle.innerHTML = `
            <div class="col-md-3">
                <label class="form-label small">Parada</label>
                <input type="text" class="form-control" name="detalles[${index}][parada]" 
                       id="detalle-${index}-parada" placeholder="Nombre de la parada" 
                       pattern="^[A-Za-zÁáÉéÍíÓóÚúÑñ0-9\s\-]{2,50}$" value="${parada}">
                <div class="invalid-feedback" id="detalle-${index}-parada-error"></div>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Hora</label>
                <input type="time" class="form-control" name="detalles[${index}][hora_programada]" 
                       id="detalle-${index}-hora" value="${horaProgramada}">
                <div class="invalid-feedback" id="detalle-${index}-hora-error"></div>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Suben</label>
                <input type="number" class="form-control" name="detalles[${index}][pasajeros_suben]" 
                       id="detalle-${index}-suben" placeholder="0" min="0" max="200" value="${pasajerosSuben}">
                <div class="invalid-feedback" id="detalle-${index}-suben-error"></div>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Bajan</label>
                <input type="number" class="form-control" name="detalles[${index}][pasajeros_bajan]" 
                       id="detalle-${index}-bajan" placeholder="0" min="0" max="200" value="${pasajerosBajan}">
                <div class="invalid-feedback" id="detalle-${index}-bajan-error"></div>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Orden <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="detalles[${index}][orden]" 
                       id="detalle-${index}-orden" value="${orden}" min="1" max="50" required>
                <div class="invalid-feedback" id="detalle-${index}-orden-error"></div>
            </div>
            <div class="col-md-1">
                <label class="form-label small">&nbsp;</label>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeDetalle(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        
        container.appendChild(newDetalle);
        console.log(`Detalle ${index} agregado al DOM`);
    });
    
    // Actualizar contador de detalles
    detalleCounter = detalles.length;
    console.log('Contador de detalles actualizado:', detalleCounter);
    
    // Marcar campos de detalles como válidos después de agregarlos al DOM
    setTimeout(() => {
        console.log('Marcando campos de detalles como válidos...');
        detalles.forEach((detalle, index) => {
            // Marcar campo orden como válido (es obligatorio)
            const ordenField = document.getElementById(`detalle-${index}-orden`);
            if (ordenField && ordenField.value !== '') {
                ordenField.classList.remove('is-invalid');
                ordenField.classList.add('is-valid');
                console.log(`Campo orden del detalle ${index} marcado como válido`);
            }
            
            // Marcar otros campos como válidos si tienen valor
            const camposOpcionales = ['parada', 'hora_programada', 'pasajeros_suben', 'pasajeros_bajan'];
            camposOpcionales.forEach(campo => {
                const campoField = document.getElementById(`detalle-${index}-${campo}`);
                if (campoField && campoField.value !== '') {
                    campoField.classList.remove('is-invalid');
                    campoField.classList.add('is-valid');
                    console.log(`Campo ${campo} del detalle ${index} marcado como válido`);
                }
            });
        });
        
        // Actualizar progreso del formulario
        console.log('Actualizando progreso del formulario después de cargar detalles...');
        updateFormProgress();
        
    }, 100);
    
    console.log('=== FIN cargarDetallesViaje ===');
}

function deleteViaje(id) {
    // Obtener el estado del viaje desde la fila de la tabla
    const row = event.target.closest('tr');
    const estadoCell = row.cells[6]; // La columna del estado es la 7 (índice 6)
    const estadoViaje = estadoCell.textContent.trim().toLowerCase();
    
    // Solo permitir eliminar viajes programados
    if (estadoViaje !== 'programado') {
        alert('Solo se pueden eliminar viajes en estado "Programado". Los viajes "En Curso" y "Completado" no se pueden eliminar.');
        return;
    }
    
    if (confirm('¿Estás seguro de que quieres eliminar este viaje?')) {
        // Redirigir al controlador para eliminar el viaje
        window.location.href = '<?php echo base_url("flota/viaje_delete/"); ?>' + id;
    }
}

function addDetalle() {
    const container = document.getElementById('detalles-container');
    const newDetalle = document.createElement('div');
    newDetalle.className = 'detalle-item row mb-2';
    newDetalle.innerHTML = `
                 <div class="col-md-3">
             <label class="form-label small">Parada</label>
             <input type="text" class="form-control" name="detalles[${detalleCounter}][parada]" 
                    id="detalle-${detalleCounter}-parada" placeholder="Nombre de la parada" 
                    pattern="^[A-Za-zÁáÉéÍíÓúÑñ0-9\s\-]{2,50}$">
             <div class="invalid-feedback" id="detalle-${detalleCounter}-parada-error"></div>
         </div>
                 <div class="col-md-2">
             <label class="form-label small">Hora</label>
             <input type="time" class="form-control" name="detalles[${detalleCounter}][hora_programada]" 
                    id="detalle-${detalleCounter}-hora">
             <div class="invalid-feedback" id="detalle-${detalleCounter}-hora-error"></div>
         </div>
        <div class="col-md-2">
            <label class="form-label small">Suben</label>
            <input type="number" class="form-control" name="detalles[${detalleCounter}][pasajeros_suben]" 
                   id="detalle-${detalleCounter}-suben" placeholder="0" min="0" max="200">
            <div class="invalid-feedback" id="detalle-${detalleCounter}-suben-error"></div>
        </div>
        <div class="col-md-2">
            <label class="form-label small">Bajan</label>
            <input type="number" class="form-control" name="detalles[${detalleCounter}][pasajeros_bajan]" 
                   id="detalle-${detalleCounter}-bajan" placeholder="0" min="0" max="200">
            <div class="invalid-feedback" id="detalle-${detalleCounter}-bajan-error"></div>
        </div>
        <div class="col-md-2">
            <label class="form-label small">Orden <span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="detalles[${detalleCounter}][orden]" 
                   id="detalle-${detalleCounter}-orden" value="${detalleCounter + 1}" min="1" max="50" required>
            <div class="invalid-feedback" id="detalle-${detalleCounter}-orden-error"></div>
        </div>
        <div class="col-md-1">
            <label class="form-label small">&nbsp;</label>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeDetalle(this)">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
    container.appendChild(newDetalle);
    
    // Configurar validación para los nuevos campos
    const newInputs = newDetalle.querySelectorAll('input');
    newInputs.forEach(input => {
        input.addEventListener('input', function() {
            validateDetalleField(this);
        });
        input.addEventListener('blur', function() {
            validateDetalleField(this);
        });
    });
    
    detalleCounter++;
    updateFormProgress();
}

function removeDetalle(button) {
    button.closest('.detalle-item').remove();
}

// Limpiar formulario al abrir modal para nuevo viaje
function showAddViajeModal() {
    currentViajeId = null;
    isEditing = false;
    
    document.getElementById('viajeForm').reset();
    document.getElementById('viaje_id').value = '';
    document.getElementById('addViajeModalLabel').textContent = 'Nuevo Viaje';
    document.getElementById('btnGuardar').style.display = 'inline-block';
    document.getElementById('btnActualizar').style.display = 'none';
    
    // Limpiar validaciones
    document.querySelectorAll('#viajeForm input, #viajeForm select').forEach(field => {
        field.classList.remove('is-valid', 'is-invalid');
    });
    
    // Resetear progreso
    document.getElementById('formProgress').style.width = '0%';
    document.getElementById('progressText').textContent = 'Completa todos los campos obligatorios para continuar';
    document.getElementById('btnGuardar').disabled = true;
    
    // Habilitar todos los campos para nuevo viaje
    setupProgramadoMode();
    
    // Usar Bootstrap 5 para mostrar el modal
    const modal = new bootstrap.Modal(document.getElementById('addViajeModal'));
    modal.show();
}

// Evento para limpiar formulario cuando se abre el modal
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('addViajeModal');
    modal.addEventListener('show.bs.modal', function() {
        if (!isEditing) {
            document.getElementById('viajeForm').reset();
            document.getElementById('viaje_id').value = '';
            document.getElementById('addViajeModalLabel').textContent = 'Nuevo Viaje';
            document.getElementById('btnGuardar').style.display = 'inline-block';
            document.getElementById('btnActualizar').style.display = 'none';
            
            // Limpiar validaciones
            document.querySelectorAll('#viajeForm input, #viajeForm select').forEach(field => {
                field.classList.remove('is-valid', 'is-invalid');
            });
            
            // Resetear progreso
            document.getElementById('formProgress').style.width = '0%';
            document.getElementById('progressText').textContent = 'Completa todos los campos obligatorios para continuar';
            document.getElementById('btnGuardar').disabled = true;
            
            // Habilitar todos los campos para nuevo viaje
            setupProgramadoMode();
        }
    });
    
    // Configurar validaciones en tiempo real
    setupRealTimeValidation();
    
    // Validar todos los campos al cargar la página
    setTimeout(() => {
        const allFields = document.querySelectorAll('#viajeForm input, #viajeForm select');
        allFields.forEach(field => {
            if (field.hasAttribute('required')) {
                validateField({ target: field });
            }
        });
        
        // Validar campos de detalles
        const detallesInputs = document.querySelectorAll('#detalles-container input');
        detallesInputs.forEach(input => {
            validateDetalleField(input);
        });
    }, 200);
});

document.getElementById('viajeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (isEditing) {
        actualizarViaje();
    } else {
        // Crear nuevo viaje
        const formData = new FormData(this);
        const tempForm = document.createElement('form');
        tempForm.method = 'POST';
        tempForm.action = '<?php echo base_url("flota/viaje_create"); ?>';
        
        for (let [key, value] of formData.entries()) {
            if (key === 'viaje_id') {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = value;
                tempForm.appendChild(input);
            } else {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = value;
                tempForm.appendChild(input);
            }
        }
        
        document.body.appendChild(tempForm);
        tempForm.submit();
    }
});

// Función para actualizar viaje
function actualizarViaje() {
    if (!currentViajeId) return;
    
    // Obtener el estado actual del viaje
    const estadoActual = document.getElementById('estado').value;
    
    // Verificar si es un viaje en curso
    const esViajeEnCurso = document.querySelector('.form-control-disabled') !== null;
    
    if (esViajeEnCurso) {
        // Para viajes en curso, solo permitir cambiar el estado
        console.log('Viaje en curso - solo permitiendo cambio de estado');
        
        // Validar que el estado sea válido
        if (!estadoActual || estadoActual === '') {
            alert('Debe seleccionar un estado válido para el viaje');
            return;
        }
        
        // Mostrar confirmación
        if (!confirm(`¿Está seguro de que desea cambiar el estado del viaje a "${estadoActual}"?`)) {
            return;
        }
        
        // Para viajes en curso, solo enviar el ID y el estado
        const tempForm = document.createElement('form');
        tempForm.method = 'POST';
        tempForm.action = '<?php echo base_url("flota/viaje_update"); ?>';
        
        // Agregar solo los campos necesarios
        const inputId = document.createElement('input');
        inputId.type = 'hidden';
        inputId.name = 'id';
        inputId.value = currentViajeId;
        tempForm.appendChild(inputId);
        
        const inputEstado = document.createElement('input');
        inputEstado.type = 'hidden';
        inputEstado.name = 'estado';
        inputEstado.value = estadoActual;
        tempForm.appendChild(inputEstado);
        
        // Agregar un campo para indicar que es solo cambio de estado
        const inputSoloEstado = document.createElement('input');
        inputSoloEstado.type = 'hidden';
        inputSoloEstado.name = 'solo_estado';
        inputSoloEstado.value = '1';
        tempForm.appendChild(inputSoloEstado);
        
        document.body.appendChild(tempForm);
        tempForm.submit();
        
    } else {
        // Para viajes programados, validar todo el formulario
        const form = document.getElementById('viajeForm');
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        
        // Crear formulario temporal y enviar todos los datos
        const tempForm = document.createElement('form');
        tempForm.method = 'POST';
        tempForm.action = '<?php echo base_url("flota/viaje_update"); ?>';
        
        const formData = new FormData(document.getElementById('viajeForm'));
        for (let [key, value] of formData.entries()) {
            if (key === 'viaje_id') {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'id';
                input.value = value;
                tempForm.appendChild(input);
            } else {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = value;
                tempForm.appendChild(input);
            }
        }
        
        document.body.appendChild(tempForm);
        tempForm.submit();
    }
}

// Botón de actualizar
document.getElementById('btnActualizar').addEventListener('click', actualizarViaje);

// Función para configurar modo de edición para viajes en curso
function setupEnCursoMode() {
    console.log('Configurando modo en curso - solo permitir editar estado');
    
    // Deshabilitar todos los campos excepto el estado
    const camposBloqueados = [
        'bus_id', 'conductor_id', 'ruta_id', 'fecha_salida', 'fecha_llegada'
    ];
    
    camposBloqueados.forEach(campo => {
        const elemento = document.getElementById(campo);
        if (elemento) {
            elemento.disabled = true;
            elemento.classList.add('form-control-disabled');
            // Limpiar errores de validación para campos bloqueados
            elemento.classList.remove('is-invalid');
            elemento.classList.add('is-valid');
            console.log('Campo deshabilitado:', campo);
        }
    });
    
    // Deshabilitar la sección de detalles
    const detallesContainer = document.getElementById('detalles-container');
    if (detallesContainer) {
        const inputsDetalles = detallesContainer.querySelectorAll('input');
        inputsDetalles.forEach(input => {
            input.disabled = true;
            input.classList.add('form-control-disabled');
            // Limpiar errores de validación para campos bloqueados
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
        });
        
        // Deshabilitar botón de agregar parada
        const btnAgregarParada = document.querySelector('button[onclick="addDetalle()"]');
        if (btnAgregarParada) {
            btnAgregarParada.disabled = true;
            btnAgregarParada.classList.add('btn-disabled-by-state');
        }
    }
    
    // Asegurar que el campo estado esté habilitado
    const campoEstado = document.getElementById('estado');
    if (campoEstado) {
        campoEstado.disabled = false;
        campoEstado.classList.remove('form-control-disabled');
        console.log('Campo estado habilitado para edición');
    }
    
    // Cambiar el título del modal
    document.getElementById('addViajeModalLabel').textContent = 'Cambiar Estado del Viaje';
    
    // Cambiar el texto del botón de actualizar
    const btnActualizar = document.getElementById('btnActualizar');
    if (btnActualizar) {
        btnActualizar.innerHTML = '<i class="fas fa-lock me-2"></i>Actualizar Estado';
    }
    
    // Ocultar la barra de progreso ya que solo se edita un campo
    const formProgress = document.getElementById('formProgress');
    const progressText = document.getElementById('progressText');
    if (formProgress) formProgress.style.display = 'none';
    if (progressText) progressText.style.display = 'none';
    
    // Agregar clase CSS para estilos especiales
    document.getElementById('addViajeModal').classList.add('modal-solo-estado');
    
    // Limpiar mensajes de error
    limpiarErroresValidacion();
    
    // Mostrar mensaje informativo
    mostrarMensajeEnCurso();
}

// Función para configurar modo de edición para viajes programados
function setupProgramadoMode() {
    console.log('Configurando modo programado - permitir editar todos los campos');
    
    // Habilitar todos los campos
    const todosLosCampos = [
        'bus_id', 'conductor_id', 'ruta_id', 'estado', 'fecha_salida', 'fecha_llegada'
    ];
    
    todosLosCampos.forEach(campo => {
        const elemento = document.getElementById(campo);
        if (elemento) {
            elemento.disabled = false;
            elemento.classList.remove('form-control-disabled');
        }
    });
    
    // Habilitar la sección de detalles
    const detallesContainer = document.getElementById('detalles-container');
    if (detallesContainer) {
        const inputsDetalles = detallesContainer.querySelectorAll('input');
        inputsDetalles.forEach(input => {
            input.disabled = false;
            input.classList.remove('form-control-disabled');
        });
        
        // Habilitar botón de agregar parada
        const btnAgregarParada = document.querySelector('button[onclick="addDetalle()"]');
        if (btnAgregarParada) {
            btnAgregarParada.disabled = false;
            btnAgregarParada.classList.remove('btn-disabled-by-state');
        }
    }
    
    // Restaurar el texto del botón de actualizar
    const btnActualizar = document.getElementById('btnActualizar');
    if (btnActualizar) {
        btnActualizar.innerHTML = '<i class="fas fa-edit me-2"></i>Actualizar';
    }
    
    // Mostrar la barra de progreso
    const formProgress = document.getElementById('formProgress');
    const progressText = document.getElementById('progressText');
    if (formProgress) formProgress.style.display = 'block';
    if (progressText) progressText.style.display = 'block';
    
    // Remover clase CSS para estilos especiales
    document.getElementById('addViajeModal').classList.remove('modal-solo-estado');
    
    // Cambiar el título del modal
    document.getElementById('addViajeModalLabel').textContent = 'Editar Viaje';
    
    // Ocultar mensaje informativo si existe
    ocultarMensajeEnCurso();
}

// Función para mostrar mensaje informativo para viajes en curso
function mostrarMensajeEnCurso() {
    // Remover mensaje anterior si existe
    ocultarMensajeEnCurso();
    
    const modalBody = document.querySelector('#addViajeModal .modal-body');
    const mensaje = document.createElement('div');
    mensaje.className = 'alert alert-info alert-dismissible fade show mb-3';
    mensaje.id = 'mensajeEnCurso';
    mensaje.innerHTML = `
        <i class="fas fa-info-circle me-2"></i>
        <strong>Información:</strong> Este viaje ya está en ejecución. 
        Solo se puede cambiar el estado para mantener la integridad de los datos históricos del recorrido. 
        Los demás campos están bloqueados.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    // Insertar al inicio del modal body
    modalBody.insertBefore(mensaje, modalBody.firstChild);
}

// Función para ocultar mensaje informativo
function ocultarMensajeEnCurso() {
    const mensajeExistente = document.getElementById('mensajeEnCurso');
    if (mensajeExistente) {
        mensajeExistente.remove();
    }
}

// Función para limpiar todos los errores de validación
function limpiarErroresValidacion() {
    // Limpiar errores de campos principales
    const camposPrincipales = ['bus_id', 'conductor_id', 'ruta_id', 'estado', 'fecha_salida', 'fecha_llegada'];
    camposPrincipales.forEach(campo => {
        const elemento = document.getElementById(campo);
        if (elemento) {
            elemento.classList.remove('is-invalid');
            // Solo agregar is-valid si no está deshabilitado
            if (!elemento.disabled) {
                elemento.classList.add('is-valid');
            }
        }
        
        // Limpiar mensajes de error
        const errorElement = document.getElementById(campo + '-error');
        if (errorElement) {
            errorElement.textContent = '';
        }
    });
    
    // Limpiar errores de campos de detalles
    const detallesContainer = document.getElementById('detalles-container');
    if (detallesContainer) {
        const inputsDetalles = detallesContainer.querySelectorAll('input');
        inputsDetalles.forEach(input => {
            input.classList.remove('is-invalid');
            // Solo agregar is-valid si no está deshabilitado
            if (!input.disabled) {
                input.classList.add('is-valid');
            }
        });
    }
    
    // Actualizar progreso del formulario
    updateFormProgress();
}
</script>