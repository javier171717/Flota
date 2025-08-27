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
    max-width: 800px;
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
    
    .row .col-md-6 {
        padding: 0 5px;
    }
}

/* Estilos para campos deshabilitados */
.form-control:disabled, .form-select:disabled {
    background-color: #f8f9fa;
    color: #6c757d;
    cursor: not-allowed;
    opacity: 0.7;
    border-color: #dee2e6;
}

.form-control:disabled::placeholder {
    color: #adb5bd;
}

/* Estilos especiales para modal de solo estado */
.modal-solo-estado .form-control:disabled {
    background-color: #e9ecef;
    color: #495057;
    font-weight: 500;
    border: 1px solid #ced4da;
}

/* Badge de viajes */
.badge.bg-info {
    background-color: #17a2b8 !important;
    font-size: 0.7rem;
    padding: 0.25rem 0.5rem;
}

/* Mensaje de advertencia */
.text-warning .fa-exclamation-triangle {
    color: #ffc107;
}

/* Botón de solo estado */
.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
    color: #212529;
}

.btn-warning:hover {
    background-color: #e0a800;
    border-color: #d39e00;
    color: #212529;
}

/* Estilos para el modal cuando solo se edita estado */
.modal-solo-estado .modal-body {
    background-color: #f8f9fa;
}

.modal-solo-estado .form-label {
    color: #6c757d;
    font-weight: 500;
}

.modal-solo-estado .form-control:disabled {
    background-color: #ffffff;
    border: 1px solid #dee2e6;
    color: #495057;
}
</style>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-white">Lista de Buses</h6>
        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addBusModal">
            <i class="fas fa-plus me-2"></i>Nuevo Bus
        </button>
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
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <div class="table-responsive">
            <table class="table table-bordered" id="busesTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>Capacidad</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($buses)): ?>
                        <?php foreach ($buses as $bus): ?>
                            <tr>
                                <td><?php echo $bus->id; ?></td>
                                <td><?php echo $bus->placa; ?></td>
                                <td><?php echo $bus->marca; ?></td>
                                <td><?php echo $bus->modelo; ?></td>
                                <td><?php echo $bus->anio; ?></td>
                                <td><?php echo $bus->capacidad; ?></td>
                                <td>
                                    <span class="badge bg-<?php echo ($bus->estado == 'activo') ? 'success' : 'danger'; ?>">
                                        <?php echo ucfirst($bus->estado); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php 
                                    // Verificar si el bus tiene viajes asociados
                                    $tiene_viajes = false;
                                    if (isset($viajes_por_bus) && isset($viajes_por_bus[$bus->id])) {
                                        $tiene_viajes = true;
                                    }
                                    ?>
                                    
                                    <?php if ($tiene_viajes): ?>
                                        <!-- Bus con viajes - solo permitir cambio de estado -->
                                        <button class="btn btn-sm btn-warning" onclick="editBusEstado(<?php echo $bus->id; ?>)" title="Solo cambiar estado (tiene viajes asociados)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <span class="badge bg-info ms-1" title="Este bus tiene viajes asociados">Viajes</span>
                                    <?php else: ?>
                                        <!-- Bus sin viajes - permitir edición completa -->
                                        <button class="btn btn-sm btn-info" onclick="editBus(<?php echo $bus->id; ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    <?php endif; ?>
                                    
                                    <?php if ($bus->estado == 'inactivo'): ?>
                                        <button class="btn btn-sm btn-success" onclick="reactivarBus(<?php echo $bus->id; ?>)" title="Reactivar Bus">
                                            <i class="fas fa-play"></i>
                                        </button>
                                    <?php endif; ?>
                                    <button class="btn btn-sm btn-danger" onclick="deleteBus(<?php echo $bus->id; ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">No hay buses registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para agregar/editar bus -->
<div class="modal fade" id="addBusModal" tabindex="-1" aria-labelledby="addBusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBusModalLabel">Nuevo Bus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="busForm" novalidate>
                <div class="modal-body">
                    <input type="hidden" id="bus_id" name="bus_id">
                    
                    <!-- Mensaje informativo para buses con viajes -->
                    <div id="mensajeViajes" class="alert alert-info" style="display: none;">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Información:</strong> Este bus tiene viajes asociados. Solo se puede cambiar el estado para mantener la integridad de los datos históricos. Los demás campos están bloqueados.
                    </div>
                    
                    <!-- Primera fila -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="placa" class="form-label">
                                    Placa <span class="text-danger">*</span>
                                    <i class="fas fa-info-circle text-info" title="Formato: ABC-123 o ABC123"></i>
                                </label>
                                <input type="text" class="form-control" id="placa" name="placa" 
                                       pattern="^[A-Z]{2,3}-?\d{3,4}$" 
                                       placeholder="ABC-123" maxlength="8" required>
                                <div class="invalid-feedback" id="placa-error"></div>
                                <div class="valid-feedback">Placa válida</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="marca" class="form-label">
                                    Marca <span class="text-danger">*</span>
                                    <i class="fas fa-info-circle text-info" title="Letras, números, espacios y guiones, entre 2 y 25 caracteres"></i>
                                </label>
                                <input type="text" class="form-control" id="marca" name="marca" 
                                       pattern="^[A-Za-zÁáÉéÍíÓóÚúÑñ0-9\s\-]{2,25}$" 
                                       placeholder="Mercedes-Benz" required>
                                <div class="invalid-feedback" id="marca-error"></div>
                                <div class="valid-feedback">Marca válida</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Segunda fila -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="modelo" class="form-label">
                                    Modelo <span class="text-danger">*</span>
                                    <i class="fas fa-info-circle text-info" title="Letras, números, espacios y guiones, entre 2 y 25 caracteres"></i>
                                </label>
                                <input type="text" class="form-control" id="modelo" name="modelo" 
                                       pattern="^[A-Za-z0-9ÁáÉéÍíÓóÚúÑñ\s\-]{2,25}$" 
                                       placeholder="Sprinter" required>
                                <div class="invalid-feedback" id="modelo-error"></div>
                                <div class="valid-feedback">Modelo válido</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="anio" class="form-label">
                                    Año <span class="text-danger">*</span>
                                    <i class="fas fa-info-circle text-info" title="Entre 1900 y 2035"></i>
                                </label>
                                <input type="number" class="form-control" id="anio" name="anio" 
                                       min="1900" max="2035" placeholder="2023" required>
                                <div class="invalid-feedback" id="anio-error"></div>
                                <div class="valid-feedback">Año válido</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tercera fila -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="capacidad" class="form-label">
                                    Capacidad <span class="text-danger">*</span>
                                    <i class="fas fa-info-circle text-info" title="Entre 1 y 200 pasajeros"></i>
                                </label>
                                <input type="number" class="form-control" id="capacidad" name="capacidad" 
                                       min="1" max="200" placeholder="20" required>
                                <div class="invalid-feedback" id="capacidad-error"></div>
                                <div class="valid-feedback">Capacidad válida</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="estado" class="form-label">
                                    Estado <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="">Seleccionar estado</option>
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                    <option value="mantenimiento">Mantenimiento</option>
                                </select>
                                <div class="invalid-feedback" id="estado-error"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Indicador de progreso -->
                    <div class="progress mb-3" style="height: 5px;">
                        <div class="progress-bar" id="formProgress" role="progressbar" style="width: 0%"></div>
                    </div>
                    <small class="text-muted" id="progressText">Completa todos los campos para continuar</small>
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
let currentBusId = null;
let isEditing = false;

// Validaciones en tiempo real
function setupRealTimeValidation() {
    const inputs = document.querySelectorAll('#busForm input, #busForm select');
    
    inputs.forEach(input => {
        input.addEventListener('input', validateField);
        input.addEventListener('blur', validateField);
        input.addEventListener('change', validateField);
    });
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
        case 'placa':
            isValid = validatePlaca(value);
            errorMessage = isValid ? '' : 'Formato inválido. Use: ABC-123 o ABC123';
            break;
            
        case 'marca':
            isValid = validateMarca(value);
            errorMessage = isValid ? '' : 'Letras, números, espacios y guiones permitidos, entre 2 y 25 caracteres';
            break;
            
        case 'modelo':
            isValid = validateModelo(value);
            errorMessage = isValid ? '' : 'Letras, números, espacios y guiones permitidos, entre 2 y 25 caracteres';
            break;
            
        case 'anio':
            isValid = validateAnio(value);
            errorMessage = isValid ? '' : 'Año debe estar entre 1900 y 2035';
            break;
            
        case 'capacidad':
            isValid = validateCapacidad(value);
            errorMessage = isValid ? '' : 'Capacidad debe estar entre 1 y 200';
            break;
            
        case 'estado':
            isValid = value !== '';
            errorMessage = isValid ? '' : 'Debe seleccionar un estado';
            break;
    }
    
    // Aplicar validación visual
    if (isValid) {
        field.classList.add('is-valid');
        field.classList.remove('is-invalid');
        document.getElementById(fieldName + '-error').textContent = '';
    } else {
        field.classList.add('is-invalid');
        field.classList.remove('is-valid');
        document.getElementById(fieldName + '-error').textContent = errorMessage;
    }
    
    // Actualizar progreso del formulario
    updateFormProgress();
}

// Funciones de validación específicas
function validatePlaca(placa) {
    const pattern = /^[A-Z]{2,3}-?\d{3,4}$/;
    return pattern.test(placa);
}

function validateMarca(marca) {
    const pattern = /^[A-Za-zÁáÉéÍíÓóÚúÑñ0-9\s\-]{2,25}$/;
    return pattern.test(marca);
}

function validateModelo(modelo) {
    const pattern = /^[A-Za-z0-9ÁáÉéÍíÓóÚúÑñ\s\-]{2,25}$/;
    return pattern.test(modelo);
}

function validateAnio(anio) {
    const year = parseInt(anio);
    return year >= 1900 && year <= 2035;
}

function validateCapacidad(capacidad) {
    const cap = parseInt(capacidad);
    return cap >= 1 && cap <= 200;
}

// Actualizar progreso del formulario
function updateFormProgress() {
    const fields = document.querySelectorAll('#busForm input[required], #busForm select[required]');
    let validFields = 0;
    let totalFields = fields.length;
    
    fields.forEach(field => {
        if (field.classList.contains('is-valid')) {
            validFields++;
        }
    });
    
    const progress = (validFields / totalFields) * 100;
    const progressBar = document.getElementById('formProgress');
    const progressText = document.getElementById('progressText');
    const btnGuardar = document.getElementById('btnGuardar');
    
    progressBar.style.width = progress + '%';
    
    if (progress === 100) {
        progressBar.classList.remove('bg-warning', 'bg-danger');
        progressBar.classList.add('bg-success');
        progressText.textContent = '¡Formulario completo! Puedes guardar';
        btnGuardar.disabled = false;
    } else if (progress >= 50) {
        progressBar.classList.remove('bg-danger');
        progressBar.classList.add('bg-warning');
        progressText.textContent = `Progreso: ${validFields}/${totalFields} campos completados`;
        btnGuardar.disabled = true;
    } else {
        progressBar.classList.remove('bg-warning', 'bg-success');
        progressBar.classList.add('bg-danger');
        progressText.textContent = `Progreso: ${validFields}/${totalFields} campos completados`;
        btnGuardar.disabled = true;
    }
}

// Función para editar solo el estado de buses con viajes asociados
function editBusEstado(id) {
    // Cargar datos del bus para editar solo estado
    const row = event.target.closest('tr');
    const cells = row.cells;
    
    currentBusId = id;
    isEditing = true;
    
    document.getElementById('bus_id').value = id;
    
    // Cargar valores actuales (solo para mostrar)
    document.getElementById('placa').value = cells[1].textContent; // Placa
    document.getElementById('marca').value = cells[2].textContent; // Marca
    document.getElementById('modelo').value = cells[3].textContent; // Modelo
    document.getElementById('anio').value = cells[4].textContent; // Año
    document.getElementById('capacidad').value = cells[5].textContent; // Capacidad
    document.getElementById('estado').value = cells[6].querySelector('.badge').textContent.toLowerCase(); // Estado
    
    // Deshabilitar completamente campos que no se pueden editar
    document.getElementById('placa').disabled = true;
    document.getElementById('marca').disabled = true;
    document.getElementById('modelo').disabled = true;
    document.getElementById('anio').disabled = true;
    document.getElementById('capacidad').disabled = true;
    
    // Solo el estado se puede editar
    document.getElementById('estado').disabled = false;
    
    // Cambiar el título del modal
    document.getElementById('addBusModalLabel').textContent = 'Cambiar Estado del Bus';
    
    // Configurar botones
    document.getElementById('btnGuardar').style.display = 'none';
    document.getElementById('btnActualizar').style.display = 'inline-block';
    
    // Mostrar mensaje informativo
    document.getElementById('mensajeViajes').style.display = 'block';
    
    // Cambiar el texto del botón de actualizar
    document.getElementById('btnActualizar').innerHTML = '<i class="fas fa-save me-2"></i>Actualizar Estado';
    
    // Ocultar la barra de progreso ya que solo se edita un campo
    document.getElementById('formProgress').style.display = 'none';
    document.getElementById('progressText').style.display = 'none';
    
    // Agregar clase CSS para estilos especiales
    document.getElementById('addBusModal').classList.add('modal-solo-estado');
    
    // Usar Bootstrap 5 para mostrar el modal
    const modal = new bootstrap.Modal(document.getElementById('addBusModal'));
    modal.show();
}

function editBus(id) {
    // Cargar datos del bus para editar
    const row = event.target.closest('tr');
    const cells = row.cells;
    
    currentBusId = id;
    isEditing = true;
    
    document.getElementById('bus_id').value = id;
    document.getElementById('placa').value = cells[1].textContent; // Placa
    document.getElementById('marca').value = cells[2].textContent; // Marca
    document.getElementById('modelo').value = cells[3].textContent; // Modelo
    document.getElementById('anio').value = cells[4].textContent; // Año
    document.getElementById('capacidad').value = cells[5].textContent; // Capacidad
    document.getElementById('estado').value = cells[6].querySelector('.badge').textContent.toLowerCase(); // Estado
    
    document.getElementById('addBusModalLabel').textContent = 'Editar Bus';
    document.getElementById('btnGuardar').style.display = 'none';
    document.getElementById('btnActualizar').style.display = 'inline-block';
    
    // Habilitar todos los campos para edición completa
    document.getElementById('placa').disabled = false;
    document.getElementById('marca').disabled = false;
    document.getElementById('modelo').disabled = false;
    document.getElementById('anio').disabled = false;
    document.getElementById('capacidad').disabled = false;
    document.getElementById('estado').disabled = false;
    
    // Ocultar mensaje informativo
    document.getElementById('mensajeViajes').style.display = 'none';
    
    // Restaurar la barra de progreso para edición completa
    document.getElementById('formProgress').style.display = 'block';
    document.getElementById('progressText').style.display = 'block';
    
    // Restaurar el texto del botón de actualizar
    document.getElementById('btnActualizar').innerHTML = '<i class="fas fa-edit me-2"></i>Actualizar';
    
    // Remover clase CSS de solo estado
    document.getElementById('addBusModal').classList.remove('modal-solo-estado');
    
    // Resetear mensaje de progreso
    document.getElementById('progressText').textContent = 'Completa todos los campos para continuar';
    
    // Validar todos los campos al editar
    setTimeout(() => {
        document.querySelectorAll('#busForm input, #busForm select').forEach(input => {
            validateField({ target: input });
        });
    }, 100);
    
    // Usar Bootstrap 5 para mostrar el modal
    const modal = new bootstrap.Modal(document.getElementById('addBusModal'));
    modal.show();
}

function deleteBus(id) {
    if (confirm('¿Estás seguro de que quieres eliminar este bus?')) {
        window.location.href = '<?php echo base_url("flota/bus_delete/"); ?>' + id;
    }
}

function reactivarBus(id) {
    if (confirm('¿Estás seguro de que quieres reactivar este bus?')) {
        window.location.href = '<?php echo base_url("flota/bus_reactivar/"); ?>' + id;
    }
}

// Función para actualizar bus
function actualizarBus() {
    if (!currentBusId) return;
    
    // Verificar si estamos editando solo el estado (campos deshabilitados)
    const placaDisabled = document.getElementById('placa').disabled;
    const marcaDisabled = document.getElementById('marca').disabled;
    const modeloDisabled = document.getElementById('modelo').disabled;
    const anioDisabled = document.getElementById('anio').disabled;
    const capacidadDisabled = document.getElementById('capacidad').disabled;
    
    const soloEstado = placaDisabled && marcaDisabled && modeloDisabled && anioDisabled && capacidadDisabled;
    
    console.log('Debug actualizarBus:', {
        currentBusId,
        soloEstado,
        camposDeshabilitados: { placaDisabled, marcaDisabled, modeloDisabled, anioDisabled, capacidadDisabled }
    });
    
    // Validar formulario antes de enviar
    const form = document.getElementById('busForm');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    // Crear formulario temporal y enviar
    const tempForm = document.createElement('form');
    tempForm.method = 'POST';
    tempForm.action = '<?php echo base_url("flota/bus_update"); ?>';
    
    if (soloEstado) {
        // Solo enviar ID y estado cuando se edita solo el estado
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'id';
        idInput.value = currentBusId;
        tempForm.appendChild(idInput);
        
        const estadoInput = document.createElement('input');
        estadoInput.type = 'hidden';
        estadoInput.name = 'estado';
        estadoInput.value = document.getElementById('estado').value;
        tempForm.appendChild(estadoInput);
        
        console.log('Enviando solo estado:', {
            id: currentBusId,
            estado: document.getElementById('estado').value
        });
    } else {
        // Enviar todos los campos cuando se edita completamente
        const formData = new FormData(form);
        for (let [key, value] of formData.entries()) {
            if (key === 'bus_id') {
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
        
        console.log('Enviando todos los campos');
    }
    
    document.body.appendChild(tempForm);
    tempForm.submit();
}

// Event listeners
document.getElementById('busForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (isEditing) {
        actualizarBus();
    } else {
        // Crear nuevo bus
        const formData = new FormData(this);
        const tempForm = document.createElement('form');
        tempForm.method = 'POST';
        tempForm.action = '<?php echo base_url("flota/bus_create"); ?>';
        
        for (let [key, value] of formData.entries()) {
            if (key === 'bus_id') {
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

// Botón de actualizar
document.getElementById('btnActualizar').addEventListener('click', actualizarBus);

// Limpiar formulario al abrir modal para nuevo bus
function showAddBusModal() {
    currentBusId = null;
    isEditing = false;
    
    document.getElementById('busForm').reset();
    document.getElementById('bus_id').value = '';
    document.getElementById('addBusModalLabel').textContent = 'Nuevo Bus';
    document.getElementById('btnGuardar').style.display = 'inline-block';
    document.getElementById('btnActualizar').style.display = 'none';
    
    // Habilitar todos los campos para nuevo bus
    document.getElementById('placa').disabled = false;
    document.getElementById('marca').disabled = false;
    document.getElementById('modelo').disabled = false;
    document.getElementById('anio').disabled = false;
    document.getElementById('capacidad').disabled = false;
    document.getElementById('estado').disabled = false;
    
    // Ocultar mensaje informativo
    document.getElementById('mensajeViajes').style.display = 'none';
    
    // Restaurar la barra de progreso para nuevo bus
    document.getElementById('formProgress').style.display = 'block';
    document.getElementById('progressText').style.display = 'block';
    
    // Remover clase CSS de solo estado
    document.getElementById('addBusModal').classList.remove('modal-solo-estado');
    
    // Limpiar validaciones
    document.querySelectorAll('#busForm input, #busForm select').forEach(field => {
        field.classList.remove('is-valid', 'is-invalid');
    });
    
    // Resetear progreso
    document.getElementById('formProgress').style.width = '0%';
    document.getElementById('progressText').textContent = 'Completa todos los campos para continuar';
    document.getElementById('btnGuardar').disabled = true;
    
    // Usar Bootstrap 5 para mostrar el modal
    const modal = new bootstrap.Modal(document.getElementById('addBusModal'));
    modal.show();
}

// Evento para limpiar formulario cuando se abre el modal
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('addBusModal');
    modal.addEventListener('show.bs.modal', function() {
        if (!isEditing) {
            document.getElementById('busForm').reset();
            document.getElementById('bus_id').value = '';
            document.getElementById('addBusModalLabel').textContent = 'Nuevo Bus';
            document.getElementById('btnGuardar').style.display = 'inline-block';
            document.getElementById('btnActualizar').style.display = 'none';
            
            // Limpiar validaciones
            document.querySelectorAll('#busForm input, #busForm select').forEach(field => {
                field.classList.remove('is-valid', 'is-invalid');
            });
            
            // Resetear progreso
            document.getElementById('formProgress').style.width = '0%';
            document.getElementById('progressText').textContent = 'Completa todos los campos para continuar';
            document.getElementById('btnGuardar').disabled = true;
        }
    });
    
    // Configurar validaciones en tiempo real
    setupRealTimeValidation();
});
</script>
