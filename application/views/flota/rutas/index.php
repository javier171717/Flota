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
.modal-dialog {
    max-width: 700px;
}

/* Campos en filas */
.row .col-md-6 {
    padding: 0 10px;
}

/* Responsive */
@media (max-width: 768px) {
    .modal-dialog {
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
</style>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-white">Lista de Rutas</h6>
        <?php if ($permissions->can_create('rutas')): ?>
        <button type="button" class="btn btn-light" onclick="showAddRutaModal()">
            <i class="fas fa-plus me-2"></i>Nueva Ruta
        </button>
        <?php else: ?>
        <button type="button" class="btn btn-light" disabled title="No tienes permisos para crear rutas">
            <i class="fas fa-plus me-2"></i>Nueva Ruta
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
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <div class="table-responsive">
            <table class="table table-bordered" id="rutasTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Distancia (km)</th>
                        <th>Tiempo Estimado</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($rutas)): ?>
                        <?php foreach ($rutas as $ruta): ?>
                            <tr>
                                <td><?php echo $ruta->id; ?></td>
                                <td><?php echo $ruta->nombre; ?></td>
                                <td><?php echo $ruta->origen; ?></td>
                                <td><?php echo $ruta->destino; ?></td>
                                <td><?php echo $ruta->distancia; ?></td>
                                <td><?php echo $ruta->tiempo_estimado; ?></td>
                                <td>
                                    <span class="badge bg-<?php echo ($ruta->estado == 'activo') ? 'success' : 'danger'; ?>">
                                        <?php echo ucfirst($ruta->estado); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($permissions->can_update('rutas')): ?>
                                        <button class="btn btn-sm btn-info" onclick="editRuta(<?php echo $ruta->id; ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <?php if ($ruta->estado == 'inactivo'): ?>
                                            <button class="btn btn-sm btn-success" onclick="reactivarRuta(<?php echo $ruta->id; ?>)" title="Reactivar Ruta">
                                                <i class="fas fa-play"></i>
                                            </button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Solo Vista</span>
                                    <?php endif; ?>
                                    
                                    <?php if ($permissions->can_delete('rutas')): ?>
                                    <button class="btn btn-sm btn-danger" onclick="deleteRuta(<?php echo $ruta->id; ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">No hay rutas registradas</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para agregar/editar ruta -->
<div class="modal fade" id="addRutaModal" tabindex="-1" aria-labelledby="addRutaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRutaModalLabel">Nueva Ruta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="rutaForm" novalidate>
                <div class="modal-body">
                    <input type="hidden" id="ruta_id" name="ruta_id">
                    
                    <!-- Primera fila -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">
                                    Nombre de la Ruta <span class="text-danger">*</span>
                                                                         <i class="fas fa-info-circle text-info" title="Solo letras, números y espacios, entre 3 y 50 caracteres"></i>
                                </label>
                                                                 <input type="text" class="form-control" id="nombre" name="nombre" 
                                        pattern="^[A-Za-zÁáÉéÍíÓóÚúÑñ0-9\s]{3,50}$" 
                                        placeholder="Ruta Principal" required>
                                <div class="invalid-feedback" id="nombre-error"></div>
                                <div class="valid-feedback">Nombre válido</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="origen" class="form-label">
                                    Origen <span class="text-danger">*</span>
                                                                         <i class="fas fa-info-circle text-info" title="Solo letras y espacios, entre 3 y 50 caracteres"></i>
                                 </label>
                                 <input type="text" class="form-control" id="origen" name="origen" 
                                        pattern="^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]{3,50}$" 
                                        placeholder="Ciudad Origen" required>
                                <div class="invalid-feedback" id="origen-error"></div>
                                <div class="valid-feedback">Origen válido</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Segunda fila -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="destino" class="form-label">
                                    Destino <span class="text-danger">*</span>
                                                                         <i class="fas fa-info-circle text-info" title="Solo letras y espacios, entre 3 y 50 caracteres"></i>
                                 </label>
                                 <input type="text" class="form-control" id="destino" name="destino" 
                                        pattern="^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]{3,50}$" 
                                        placeholder="Ciudad Destino" required>
                                <div class="invalid-feedback" id="destino-error"></div>
                                <div class="valid-feedback">Destino válido</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="distancia" class="form-label">
                                    Distancia (km) <span class="text-danger">*</span>
                                    <i class="fas fa-info-circle text-info" title="Número mayor a 0, máximo 2 decimales"></i>
                                </label>
                                <input type="number" class="form-control" id="distancia" name="distancia" 
                                       min="0.1" max="9999.99" step="0.01" 
                                       placeholder="150.5" required>
                                <div class="invalid-feedback" id="distancia-error"></div>
                                <div class="valid-feedback">Distancia válida</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tercera fila -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tiempo_estimado" class="form-label">
                                    Tiempo Estimado <span class="text-danger">*</span>
                                    <i class="fas fa-info-circle text-info" title="Formato: 2h 30m o 2.5 horas"></i>
                                </label>
                                <input type="text" class="form-control" id="tiempo_estimado" name="tiempo_estimado" 
                                       pattern="^(\d+h\s*\d*m|\d+\.?\d*\s*horas?|\d+\s*horas?)$" 
                                       placeholder="2h 30m" required>
                                <div class="invalid-feedback" id="tiempo_estimado-error"></div>
                                <div class="valid-feedback">Tiempo válido</div>
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
                                </select>
                                <div class="invalid-feedback" id="estado-error"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Indicador de progreso -->
                    <div class="progress mb-3" style="height: 5px;">
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
let currentRutaId = null;
let isEditing = false;

// Validaciones en tiempo real
function setupRealTimeValidation() {
    const inputs = document.querySelectorAll('#rutaForm input, #rutaForm select');
    
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
        case 'nombre':
            isValid = validateNombre(value);
                         errorMessage = isValid ? '' : 'Solo letras, números y espacios permitidos, entre 3 y 50 caracteres';
            break;
            
                 case 'origen':
             isValid = validateOrigen(value);
             errorMessage = isValid ? '' : 'Solo letras y espacios permitidos, entre 3 y 50 caracteres';
             break;
            
                 case 'destino':
             isValid = validateDestino(value);
             errorMessage = isValid ? '' : 'Solo letras y espacios permitidos, entre 3 y 50 caracteres';
             break;
            
        case 'distancia':
            isValid = validateDistancia(value);
            errorMessage = isValid ? '' : 'Debe ser un número mayor a 0, máximo 9999.99 km';
            break;
            
        case 'tiempo_estimado':
            isValid = validateTiempoEstimado(value);
            errorMessage = isValid ? '' : 'Formato inválido. Use: 2h 30m, 2.5 horas, o 2 horas';
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

// Funciones de validación específicas
 function validateNombre(nombre) {
     const pattern = /^[A-Za-zÁáÉéÍíÓóÚúÑñ0-9\s]{3,50}$/;
     return pattern.test(nombre);
 }
 
 function validateOrigen(origen) {
     const pattern = /^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]{3,50}$/;
     return pattern.test(origen);
 }
 
 function validateDestino(destino) {
     const pattern = /^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]{3,50}$/;
     return pattern.test(destino);
 }

function validateDistancia(distancia) {
    const num = parseFloat(distancia);
    return !isNaN(num) && num > 0 && num <= 9999.99;
}

function validateTiempoEstimado(tiempo) {
    const pattern = /^(\d+h\s*\d*m|\d+\.?\d*\s*horas?|\d+\s*horas?)$/;
    return pattern.test(tiempo);
}

// Actualizar progreso del formulario
function updateFormProgress() {
    const requiredFields = document.querySelectorAll('#rutaForm input[required], #rutaForm select[required]');
    let validFields = 0;
    let totalFields = requiredFields.length;
    
    requiredFields.forEach(field => {
        if (field.classList.contains('is-valid')) {
            validFields++;
        }
    });
    
    const progress = (validFields / totalFields) * 100;
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
        progressText.textContent = `Progreso: ${validFields}/${totalFields} campos obligatorios completados`;
        btnGuardar.disabled = true;
        if (btnActualizar) btnActualizar.disabled = true;
    } else {
        progressBar.classList.remove('bg-warning', 'bg-success');
        progressBar.classList.add('bg-danger');
        progressText.textContent = `Progreso: ${validFields}/${totalFields} campos obligatorios completados`;
        btnGuardar.disabled = true;
        if (btnActualizar) btnActualizar.disabled = true;
    }
}

function editRuta(id) {
    // Cargar datos de la ruta para editar
    const row = event.target.closest('tr');
    const cells = row.cells;
    
    currentRutaId = id;
    isEditing = true;
    
    document.getElementById('ruta_id').value = id;
    document.getElementById('nombre').value = cells[1].textContent; // Nombre
    document.getElementById('origen').value = cells[2].textContent; // Origen
    document.getElementById('destino').value = cells[3].textContent; // Destino
    document.getElementById('distancia').value = cells[4].textContent; // Distancia
    document.getElementById('tiempo_estimado').value = cells[5].textContent; // Tiempo estimado
    document.getElementById('estado').value = cells[6].querySelector('.badge').textContent.toLowerCase(); // Estado
    
    document.getElementById('addRutaModalLabel').textContent = 'Editar Ruta';
    document.getElementById('btnGuardar').style.display = 'none';
    document.getElementById('btnActualizar').style.display = 'inline-block';
    
    // Validar todos los campos al editar
    setTimeout(() => {
        document.querySelectorAll('#rutaForm input[required], #rutaForm select[required]').forEach(input => {
            validateField({ target: input });
        });
    }, 100);
    
    // Usar Bootstrap 5 para mostrar el modal
    const modal = new bootstrap.Modal(document.getElementById('addRutaModal'));
    modal.show();
}

function deleteRuta(id) {
    if (confirm('¿Estás seguro de que quieres eliminar esta ruta?')) {
        // Redirigir al controlador para eliminar la ruta
        window.location.href = '<?php echo base_url("flota/ruta_delete/"); ?>' + id;
    }
}

function reactivarRuta(id) {
    if (confirm('¿Estás seguro de que quieres reactivar esta ruta?')) {
        window.location.href = '<?php echo base_url("flota/ruta_reactivar/"); ?>' + id;
    }
}

// Función para actualizar ruta
function actualizarRuta() {
    if (!currentRutaId) return;
    
    // Validar formulario antes de enviar
    const form = document.getElementById('rutaForm');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    // Crear formulario temporal y enviar
    const tempForm = document.createElement('form');
    tempForm.method = 'POST';
    tempForm.action = '<?php echo base_url("flota/ruta_update"); ?>';
    
    const formData = new FormData(form);
    for (let [key, value] of formData.entries()) {
        if (key === 'ruta_id') {
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

// Limpiar formulario al abrir modal para nueva ruta
function showAddRutaModal() {
    currentRutaId = null;
    isEditing = false;
    
    document.getElementById('rutaForm').reset();
    document.getElementById('ruta_id').value = '';
    document.getElementById('addRutaModalLabel').textContent = 'Nueva Ruta';
    document.getElementById('btnGuardar').style.display = 'inline-block';
    document.getElementById('btnActualizar').style.display = 'none';
    
    // Limpiar validaciones
    document.querySelectorAll('#rutaForm input, #rutaForm select').forEach(field => {
        field.classList.remove('is-valid', 'is-invalid');
    });
    
    // Resetear progreso
    document.getElementById('formProgress').style.width = '0%';
    document.getElementById('progressText').textContent = 'Completa todos los campos obligatorios para continuar';
    document.getElementById('btnGuardar').disabled = true;
    
    // Usar Bootstrap 5 para mostrar el modal
    const modal = new bootstrap.Modal(document.getElementById('addRutaModal'));
    modal.show();
}

// Evento para limpiar formulario cuando se abre el modal
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('addRutaModal');
    modal.addEventListener('show.bs.modal', function() {
        if (!isEditing) {
            document.getElementById('rutaForm').reset();
            document.getElementById('ruta_id').value = '';
            document.getElementById('addRutaModalLabel').textContent = 'Nueva Ruta';
            document.getElementById('btnGuardar').style.display = 'inline-block';
            document.getElementById('btnActualizar').style.display = 'none';
            
            // Limpiar validaciones
            document.querySelectorAll('#rutaForm input, #rutaForm select').forEach(field => {
                field.classList.remove('is-valid', 'is-invalid');
            });
            
            // Resetear progreso
            document.getElementById('formProgress').style.width = '0%';
            document.getElementById('progressText').textContent = 'Completa todos los campos obligatorios para continuar';
            document.getElementById('btnGuardar').disabled = true;
        }
    });
    
    // Configurar validaciones en tiempo real
    setupRealTimeValidation();
});

document.getElementById('rutaForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (isEditing) {
        actualizarRuta();
    } else {
        // Crear nueva ruta
        const formData = new FormData(this);
        const tempForm = document.createElement('form');
        tempForm.method = 'POST';
        tempForm.action = '<?php echo base_url("flota/ruta_create"); ?>';
        
        for (let [key, value] of formData.entries()) {
            if (key === 'ruta_id') {
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
document.getElementById('btnActualizar').addEventListener('click', actualizarRuta);
</script>
