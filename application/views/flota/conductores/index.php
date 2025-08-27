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
    max-width: 600px;
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

/* Estilos especiales para campos opcionales */
.form-control:not([required]) {
    border-color: #6c757d;
}

.form-control:not([required]):focus {
    border-color: #17a2b8;
    box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
}

.form-control:not([required]).is-valid {
    border-color: #28a745;
}

.form-control:not([required]).is-invalid {
    border-color: #dc3545;
}

/* Indicador visual de campo opcional */
.form-label small.text-muted {
    font-size: 0.75em;
    font-style: italic;
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
        <h6 class="m-0 font-weight-bold text-white">Lista de Conductores</h6>
        <?php if ($permissions->can_create('conductores')): ?>
        <button type="button" class="btn btn-light" onclick="showAddConductorModal()">
            <i class="fas fa-plus me-2"></i>Nuevo Conductor
        </button>
        <?php else: ?>
        <button type="button" class="btn btn-light" disabled title="No tienes permisos para crear conductores">
            <i class="fas fa-plus me-2"></i>Nuevo Conductor
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
            <table class="table table-bordered" id="conductoresTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Licencia</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($conductores)): ?>
                        <?php foreach ($conductores as $conductor): ?>
                            <tr>
                                <td><?php echo $conductor->id; ?></td>
                                <td><?php echo $conductor->nombre; ?></td>
                                <td><?php echo $conductor->licencia; ?></td>
                                <td><?php echo $conductor->telefono; ?></td>
                                <td><?php echo $conductor->email ? $conductor->email : '<span class="text-muted">Sin email</span>'; ?></td>
                                <td>
                                    <span class="badge bg-<?php echo ($conductor->estado == 'activo') ? 'success' : 'danger'; ?>">
                                        <?php echo ucfirst($conductor->estado); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($permissions->can_update('conductores')): ?>
                                        <button class="btn btn-sm btn-info" onclick="editConductor(<?php echo $conductor->id; ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <?php if ($conductor->estado == 'suspendido'): ?>
                                            <button class="btn btn-sm btn-success" onclick="reactivarConductor(<?php echo $conductor->id; ?>)" title="Reactivar Conductor">
                                                <i class="fas fa-play"></i>
                                            </button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Solo Vista</span>
                                    <?php endif; ?>
                                    
                                    <?php if ($permissions->can_delete('conductores')): ?>
                                    <button class="btn btn-sm btn-danger" onclick="deleteConductor(<?php echo $conductor->id; ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No hay conductores registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para agregar/editar conductor -->
<div class="modal fade" id="addConductorModal" tabindex="-1" aria-labelledby="addConductorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addConductorModalLabel">Nuevo Conductor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="conductorForm" novalidate>
                <div class="modal-body">
                    <input type="hidden" id="conductor_id" name="conductor_id">
                    
                    <!-- Primera fila -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">
                                    Nombre Completo <span class="text-danger">*</span>
                                                                         <i class="fas fa-info-circle text-info" title="Solo letras y espacios, entre 2 y 30 caracteres"></i>
                                </label>
                                                                 <input type="text" class="form-control" id="nombre" name="nombre" 
                                        pattern="^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]{2,30}$" 
                                        placeholder="Juan Pérez" required>
                                <div class="invalid-feedback" id="nombre-error"></div>
                                <div class="valid-feedback">Nombre válido</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="licencia" class="form-label">
                                    Número de Licencia <span class="text-danger">*</span>
                                                                         <i class="fas fa-info-circle text-info" title="Solo números, exactamente 11 dígitos"></i>
                                </label>
                                                                 <input type="text" class="form-control" id="licencia" name="licencia" 
                                        pattern="^[0-9]{11}$" 
                                        placeholder="10002079656" required>
                                <div class="invalid-feedback" id="licencia-error"></div>
                                <div class="valid-feedback">Licencia válida</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Segunda fila -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telefono" class="form-label">
                                    Teléfono <span class="text-danger">*</span>
                                                                         <i class="fas fa-info-circle text-info" title="Solo números, mínimo 10 dígitos"></i>
                                </label>
                                                                 <input type="tel" class="form-control" id="telefono" name="telefono" 
                                        pattern="^[0-9]{10,15}$" 
                                        placeholder="3435467890" required>
                                <div class="invalid-feedback" id="telefono-error"></div>
                                <div class="valid-feedback">Teléfono válido</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    Email <small class="text-muted">(Opcional)</small>
                                    <i class="fas fa-info-circle text-info" title="Formato de email válido"></i>
                                </label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       placeholder="ejemplo@correo.com">
                                <div class="invalid-feedback" id="email-error"></div>
                                <div class="valid-feedback">Email válido</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tercera fila -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="estado" class="form-label">
                                    Estado <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="">Seleccionar estado</option>
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                    <option value="suspendido">Suspendido</option>
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
let currentConductorId = null;
let isEditing = false;

// Validaciones en tiempo real
function setupRealTimeValidation() {
    const inputs = document.querySelectorAll('#conductorForm input, #conductorForm select');
    
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
                         errorMessage = isValid ? '' : 'Solo letras y espacios permitidos, entre 2 y 30 caracteres';
            break;
            
        case 'licencia':
                         isValid = validateLicencia(value);
             errorMessage = isValid ? '' : 'Solo números permitidos, exactamente 11 dígitos';
            break;
            
        case 'telefono':
                         isValid = validateTelefono(value);
             errorMessage = isValid ? '' : 'Solo números permitidos, mínimo 10 dígitos';
            break;
            
        case 'email':
            if (value === '' || value === 'Sin email') {
                isValid = true; // Email es opcional
                errorMessage = '';
            } else {
                isValid = validateEmail(value);
                errorMessage = isValid ? '' : 'Formato de email inválido';
            }
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
     const pattern = /^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]{2,30}$/;
     return pattern.test(nombre);
 }

 function validateLicencia(licencia) {
     const pattern = /^[0-9]{11}$/;
     return pattern.test(licencia);
 }

 function validateTelefono(telefono) {
     const pattern = /^[0-9]{10,15}$/;
     return pattern.test(telefono);
 }

function validateEmail(email) {
    const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return pattern.test(email);
}

// Actualizar progreso del formulario
function updateFormProgress() {
    // Solo considerar campos obligatorios para el progreso
    const requiredFields = document.querySelectorAll('#conductorForm input[required], #conductorForm select[required]');
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

function editConductor(id) {
    // Cargar datos del conductor para editar
    const row = event.target.closest('tr');
    const cells = row.cells;
    
    currentConductorId = id;
    isEditing = true;
    
    document.getElementById('conductor_id').value = id;
    document.getElementById('nombre').value = cells[1].textContent; // Nombre
    document.getElementById('licencia').value = cells[2].textContent; // Licencia
    document.getElementById('telefono').value = cells[3].textContent; // Teléfono
    
    // Manejar el email de manera especial
    const emailCell = cells[4];
    let emailValue = emailCell.textContent.trim();
    
    // Si el email es "Sin email", dejarlo vacío
    if (emailValue === 'Sin email' || emailValue === '') {
        document.getElementById('email').value = '';
    } else {
        document.getElementById('email').value = emailValue;
    }
    
    document.getElementById('estado').value = cells[5].querySelector('.badge').textContent.toLowerCase(); // Estado
    
    document.getElementById('addConductorModalLabel').textContent = 'Editar Conductor';
    document.getElementById('btnGuardar').style.display = 'none';
    document.getElementById('btnActualizar').style.display = 'inline-block';
    
    // Validar todos los campos al editar (excluyendo email)
    setTimeout(() => {
        document.querySelectorAll('#conductorForm input[required], #conductorForm select[required]').forEach(input => {
            validateField({ target: input });
        });
        
        // Validar email por separado (opcional) y limpiar si es "Sin email"
        const emailField = document.getElementById('email');
        if (emailField.value === 'Sin email') {
            emailField.value = '';
            emailField.classList.remove('is-valid', 'is-invalid');
        } else {
            validateField({ target: emailField });
        }
    }, 100);
    
    // Usar Bootstrap 5 para mostrar el modal
    const modal = new bootstrap.Modal(document.getElementById('addConductorModal'));
    modal.show();
}

function deleteConductor(id) {
    if (confirm('¿Estás seguro de que quieres eliminar este conductor?')) {
        // Redirigir al controlador para eliminar el conductor
        window.location.href = '<?php echo base_url("flota/conductor_delete/"); ?>' + id;
    }
}

function reactivarConductor(id) {
    if (confirm('¿Estás seguro de que quieres reactivar este conductor?')) {
        window.location.href = '<?php echo base_url("flota/conductor_reactivar/"); ?>' + id;
    }
}

// Función para actualizar conductor
function actualizarConductor() {
    if (!currentConductorId) return;
    
    // Validar formulario antes de enviar
    const form = document.getElementById('conductorForm');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    // Crear formulario temporal y enviar
    const tempForm = document.createElement('form');
    tempForm.method = 'POST';
    tempForm.action = '<?php echo base_url("flota/conductor_update"); ?>';
    
    const formData = new FormData(form);
    for (let [key, value] of formData.entries()) {
        if (key === 'conductor_id') {
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

// Limpiar formulario al abrir modal para nuevo conductor
function showAddConductorModal() {
    currentConductorId = null;
    isEditing = false;
    
    document.getElementById('conductorForm').reset();
    document.getElementById('conductor_id').value = '';
    document.getElementById('addConductorModalLabel').textContent = 'Nuevo Conductor';
    document.getElementById('btnGuardar').style.display = 'inline-block';
    document.getElementById('btnActualizar').style.display = 'none';
    
    // Limpiar validaciones
    document.querySelectorAll('#conductorForm input, #conductorForm select').forEach(field => {
        field.classList.remove('is-valid', 'is-invalid');
    });
    
    // Resetear progreso
    document.getElementById('formProgress').style.width = '0%';
    document.getElementById('progressText').textContent = 'Completa todos los campos obligatorios para continuar';
    document.getElementById('btnGuardar').disabled = true;
    
    // Asegurar que el email esté vacío y sin validaciones
    const emailField = document.getElementById('email');
    emailField.value = '';
    emailField.classList.remove('is-valid', 'is-invalid');
    
    // Usar Bootstrap 5 para mostrar el modal
    const modal = new bootstrap.Modal(document.getElementById('addConductorModal'));
    modal.show();
}

// Evento para limpiar formulario cuando se abre el modal
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('addConductorModal');
    modal.addEventListener('show.bs.modal', function() {
        if (!isEditing) {
            document.getElementById('conductorForm').reset();
            document.getElementById('conductor_id').value = '';
            document.getElementById('addConductorModalLabel').textContent = 'Nuevo Conductor';
            document.getElementById('btnGuardar').style.display = 'inline-block';
            document.getElementById('btnActualizar').style.display = 'none';
            
            // Limpiar validaciones
            document.querySelectorAll('#conductorForm input, #conductorForm select').forEach(field => {
                field.classList.remove('is-valid', 'is-invalid');
            });
            
            // Resetear progreso
            document.getElementById('formProgress').style.width = '0%';
            document.getElementById('progressText').textContent = 'Completa todos los campos obligatorios para continuar';
            document.getElementById('btnGuardar').disabled = true;
            
            // Asegurar que el email esté limpio
            const emailField = document.getElementById('email');
            emailField.value = '';
            emailField.classList.remove('is-valid', 'is-invalid');
        }
    });
    
    // Configurar validaciones en tiempo real
    setupRealTimeValidation();
});

document.getElementById('conductorForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (isEditing) {
        actualizarConductor();
    } else {
        // Crear nuevo conductor
        const formData = new FormData(this);
        const tempForm = document.createElement('form');
        tempForm.method = 'POST';
        tempForm.action = '<?php echo base_url("flota/conductor_create"); ?>';
        
        for (let [key, value] of formData.entries()) {
            if (key === 'conductor_id') {
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
document.getElementById('btnActualizar').addEventListener('click', actualizarConductor);
</script>
