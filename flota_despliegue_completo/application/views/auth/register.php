<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlotaPro</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }
        
        .register-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
        }
        
        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 30px 20px;
        }
        
        .register-header h3 {
            margin: 0;
            font-size: 24px;
        }
        
        .register-header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
        }
        
        .register-body {
            padding: 40px 30px;
        }
        
        .form-floating {
            margin-bottom: 20px;
        }
        
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .btn-register:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        .login-link {
            text-align: center;
            color: #666;
        }
        
        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #fee 0%, #fcc 100%);
            color: #c33;
            border-left: 4px solid #dc3545;
            padding: 15px 20px;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #efe 0%, #cfc 100%);
            color: #363;
            border-left: 4px solid #28a745;
            padding: 15px 20px;
        }
        
        .alert-danger a {
            color: #dc3545;
            text-decoration: underline;
            font-weight: 600;
        }
        
        .alert-danger a:hover {
            color: #c82333;
        }
        
        .alert strong {
            font-weight: 700;
        }
        
        .form-select {
            padding-top: 1.625rem;
            padding-bottom: 0.625rem;
        }
        
        /* Estilos para validaciones */
        .password-strength .progress {
            background-color: #e9ecef;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .password-strength .progress-bar {
            transition: width 0.3s ease, background-color 0.3s ease;
        }
        
        .password-strength .form-text {
            margin-top: 5px;
            font-size: 0.875em;
        }
        
        .form-control.is-valid,
        .form-select.is-valid {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }
        
        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
        
        .invalid-feedback {
            display: block;
            margin-top: 5px;
            font-size: 0.875em;
            color: #dc3545;
        }
        
        .valid-feedback {
            display: block;
            margin-top: 5px;
            font-size: 0.875em;
            color: #28a745;
        }
        
        .btn-register:disabled {
            opacity: 0.6;
            transform: none;
            box-shadow: none;
        }
        
        /* Estado de validación del email */
        .form-control.is-validating {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
        }
        
        .form-control.is-validating ~ label {
            color: #ffc107;
        }
        
        /* Estilo para mensajes de verificación */
        .validating-message {
            color: #ffc107;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h3><i class="fas fa-user-plus me-2"></i>Registro de Usuario</h3>
            <p>Crea tu cuenta para acceder al sistema</p>
        </div>
        
        <div class="register-body">
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?php echo $this->session->flashdata('error'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo $this->session->flashdata('success'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <?php echo form_open('auth/register', ['id' => 'registerForm', 'novalidate' => '']); ?>
                <div class="form-floating">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" 
                           pattern="^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]{2,50}$" required>
                    <label for="nombre"><i class="fas fa-user me-2"></i>Nombre completo</label>
                    <div class="invalid-feedback" id="nombre-error"></div>
                    <div class="valid-feedback">Nombre válido</div>
                    <?php echo form_error('nombre', '<small class="text-danger">', '</small>'); ?>
                </div>
                
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com" required>
                    <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                    <div class="invalid-feedback" id="email-error"></div>
                    <div class="valid-feedback">Email válido</div>
                    <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                </div>
                
                <div class="form-floating">
                    <select class="form-select" id="rol" name="rol" required>
                        <option value="">Seleccionar rol</option>
                        <option value="operador">Operador</option>
                        <option value="conductor">Conductor</option>
                        <option value="admin">Administrador</option>
                    </select>
                    <label for="rol"><i class="fas fa-user-tag me-2"></i>Rol</label>
                    <div class="invalid-feedback" id="rol-error"></div>
                    <div class="valid-feedback">Rol seleccionado</div>
                    <?php echo form_error('rol', '<small class="text-danger">', '</small>'); ?>
                </div>
                
                <!-- Campo de licencia (solo visible para conductores) -->
                <div class="form-floating" id="licencia-field" style="display: none;">
                    <input type="text" class="form-control" id="licencia" name="licencia" placeholder="Número de licencia" 
                           pattern="^[0-9]{5,20}$" minlength="5" maxlength="20">
                    <label for="licencia"><i class="fas fa-id-card me-2"></i>Número de Licencia</label>
                    <small class="form-text text-muted">Campo obligatorio para conductores</small>
                    <div class="invalid-feedback" id="licencia-error"></div>
                    <div class="valid-feedback">Licencia válida</div>
                    <?php echo form_error('licencia', '<small class="text-danger">', '</small>'); ?>
                </div>
                
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" 
                           minlength="6" maxlength="20" required>
                    <label for="password"><i class="fas fa-lock me-2"></i>Contraseña</label>
                    <small class="form-text text-muted">Entre 6 y 20 caracteres</small>
                    <div class="password-strength mt-2">
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar" id="passwordStrengthBar" role="progressbar" style="width: 0%"></div>
                        </div>
                        <small class="form-text" id="passwordStrengthText">Ingresa tu contraseña</small>
                    </div>
                    <div class="invalid-feedback" id="password-error"></div>
                    <div class="valid-feedback">Contraseña válida</div>
                    <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>
                
                <div class="form-floating">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirmar contraseña" required>
                    <label for="confirm_password"><i class="fas fa-lock me-2"></i>Confirmar contraseña</label>
                    <div id="passwordMatch" class="form-text"></div>
                    <div class="invalid-feedback" id="confirm_password-error"></div>
                    <div class="valid-feedback">Contraseñas coinciden</div>
                    <?php echo form_error('confirm_password', '<small class="text-danger">', '</small>'); ?>
                </div>
                
                <!-- Barra de progreso del formulario -->
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="text-muted">Progreso del formulario</small>
                        <small class="text-muted" id="progressText">0%</small>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-danger" id="formProgress" role="progressbar" style="width: 0%"></div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-register" id="submitBtn" disabled>
                    <i class="fas fa-user-plus me-2"></i>Crear Cuenta
                </button>
            <?php echo form_close(); ?>
            
            <div class="login-link">
                ¿Ya tienes cuenta? 
                <a href="<?php echo base_url('auth'); ?>">Inicia sesión aquí</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('registerForm');
        const nombre = document.getElementById('nombre');
        const email = document.getElementById('email');
        const rol = document.getElementById('rol');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');
        const submitBtn = document.getElementById('submitBtn');
        const passwordStrengthBar = document.getElementById('passwordStrengthBar');
        const passwordStrengthText = document.getElementById('passwordStrengthText');
        const passwordMatch = document.getElementById('passwordMatch');
        const formProgress = document.getElementById('formProgress');
        const progressText = document.getElementById('progressText');
        
        // Agregar event listeners para validación en tiempo real
        [nombre, email, rol, password, confirmPassword].forEach(field => {
            field.addEventListener('input', validateField);
            field.addEventListener('blur', validateField);
        });
        
        // Agregar event listener para el campo de licencia (se agrega dinámicamente)
        const licencia = document.getElementById('licencia');
        if (licencia) {
            licencia.addEventListener('input', validateField);
            licencia.addEventListener('blur', validateField);
        }
        
        // Validar campo específico
        function validateField(event) {
            const field = event.target;
            const fieldName = field.name;
            const value = field.value.trim();
            
            // Limpiar estados previos
            field.classList.remove('is-valid', 'is-invalid');
            
            // Validar según el campo
            let isValid = false;
            let errorMessage = '';
            
            switch(fieldName) {
                case 'nombre':
                    isValid = validateNombre(value);
                    errorMessage = isValid ? '' : 'Solo letras y espacios permitidos, entre 2 y 50 caracteres';
                    break;
                    
                case 'email':
                    isValid = validateEmail(value);
                    if (value === '') {
                        errorMessage = 'El email es obligatorio';
                    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                        errorMessage = 'Formato de email inválido. Ejemplo: usuario@ejemplo.com';
                    } else {
                        errorMessage = '';
                    }
                    break;
                    
                case 'rol':
                    isValid = value !== '';
                    errorMessage = isValid ? '' : 'Debe seleccionar un rol';
                    // Mostrar/ocultar campo de licencia según el rol
                    toggleLicenciaField(value);
                    break;
                    
                case 'licencia':
                    if (rol.value === 'conductor') {
                        isValid = /^[0-9]{5,20}$/.test(value);
                        errorMessage = isValid ? '' : 'La licencia debe tener entre 5 y 20 dígitos numéricos';
                    } else {
                        isValid = true; // No es obligatorio para otros roles
                        errorMessage = '';
                    }
                    break;
                    
                case 'password':
                    isValid = value.length >= 6 && value.length <= 20;
                    errorMessage = isValid ? '' : 'La contraseña debe tener entre 6 y 20 caracteres';
                    checkPasswordStrength(value);
                    break;
                    
                case 'confirm_password':
                    if (password.value && value) {
                        isValid = password.value === value;
                        errorMessage = isValid ? '' : 'Las contraseñas no coinciden';
                    } else {
                        isValid = false;
                        errorMessage = 'Debe confirmar la contraseña';
                    }
                    checkPasswordMatch();
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
        function validateNombre(nombre) {
            const pattern = /^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]{2,50}$/;
            return pattern.test(nombre);
        }
        
        function validateEmail(email) {
            const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!pattern.test(email)) {
                return false;
            }
            
            // Verificar si el email ya está en uso (solo si el email es válido)
            checkEmailAvailability(email);
            return true;
        }
        
        // Verificar disponibilidad del email
        function checkEmailAvailability(email) {
            if (email.length > 0) {
                // Simular verificación (en un caso real, aquí harías una petición AJAX)
                // Por ahora, solo mostramos un mensaje informativo
                const emailField = document.getElementById('email');
                const emailError = document.getElementById('email-error');
                
                // Mostrar mensaje de verificación
                emailError.textContent = 'Verificando disponibilidad del email...';
                emailField.classList.add('is-validating');
                
                // Simular delay de verificación
                setTimeout(() => {
                    // En un caso real, aquí verificarías con el servidor
                    // Por ahora, solo removemos el estado de validación
                    emailField.classList.remove('is-validating');
                }, 1000);
            }
        }
        
        function checkPasswordStrength(password) {
            let strength = 0;
            let feedback = '';
            
            if (password.length >= 6) strength += 20;
            if (password.length >= 8) strength += 20;
            if (password.length >= 10) strength += 20;
            
            if (/[a-z]/.test(password)) strength += 20;
            if (/[A-Z]/.test(password)) strength += 20;
            if (/[0-9]/.test(password)) strength += 20;
            if (/[^A-Za-z0-9]/.test(password)) strength += 20;
            
            if (strength <= 20) {
                feedback = 'Muy débil';
                passwordStrengthBar.className = 'progress-bar bg-danger';
            } else if (strength <= 40) {
                feedback = 'Débil';
                passwordStrengthBar.className = 'progress-bar bg-warning';
            } else if (strength <= 60) {
                feedback = 'Media';
                passwordStrengthBar.className = 'progress-bar bg-info';
            } else if (strength <= 80) {
                feedback = 'Fuerte';
                passwordStrengthBar.className = 'progress-bar bg-primary';
            } else {
                feedback = 'Muy fuerte';
                passwordStrengthBar.className = 'progress-bar bg-success';
            }
            
            passwordStrengthBar.style.width = strength + '%';
            passwordStrengthText.textContent = feedback;
        }
        
        function checkPasswordMatch() {
            if (password.value && confirmPassword.value) {
                if (password.value === confirmPassword.value) {
                    passwordMatch.innerHTML = '<span class="text-success"><i class="fas fa-check-circle"></i> Las contraseñas coinciden</span>';
                } else {
                    passwordMatch.innerHTML = '<span class="text-danger"><i class="fas fa-times-circle"></i> Las contraseñas no coinciden</span>';
                }
            } else {
                passwordMatch.innerHTML = '';
            }
        }
        
        // Función para mostrar/ocultar campo de licencia según el rol
        function toggleLicenciaField(selectedRole) {
            const licenciaField = document.getElementById('licencia-field');
            const licenciaInput = document.getElementById('licencia');
            
            if (selectedRole === 'conductor') {
                licenciaField.style.display = 'block';
                licenciaInput.required = true;
                licenciaInput.pattern = '^[0-9]{5,20}$';
            } else {
                licenciaField.style.display = 'none';
                licenciaInput.required = false;
                licenciaInput.value = ''; // Limpiar valor
                licenciaInput.classList.remove('is-valid', 'is-invalid');
            }
            
            // Actualizar progreso del formulario
            updateFormProgress();
        }
        
        // Actualizar progreso del formulario
        function updateFormProgress() {
            const requiredFields = document.querySelectorAll('#registerForm input[required], #registerForm select[required]');
            let validFields = 0;
            let totalFields = requiredFields.length;
            
            requiredFields.forEach(field => {
                if (field.classList.contains('is-valid')) {
                    validFields++;
                }
            });
            
            const progress = (validFields / totalFields) * 100;
            
            formProgress.style.width = progress + '%';
            progressText.textContent = Math.round(progress) + '%';
            
            if (progress === 100) {
                formProgress.classList.remove('bg-warning', 'bg-danger');
                formProgress.classList.add('bg-success');
                submitBtn.disabled = false;
            } else if (progress >= 50) {
                formProgress.classList.remove('bg-danger');
                formProgress.classList.add('bg-warning');
                submitBtn.disabled = true;
            } else {
                formProgress.classList.remove('bg-warning', 'bg-success');
                formProgress.classList.add('bg-danger');
                submitBtn.disabled = true;
            }
        }
        
        // Validar formulario antes de enviar
        form.addEventListener('submit', function(e) {
            const requiredFields = document.querySelectorAll('#registerForm input[required], #registerForm select[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.classList.contains('is-valid')) {
                    isValid = false;
                    field.classList.add('is-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Por favor, completa todos los campos correctamente antes de enviar el formulario.');
                return false;
            }
            
            if (password.value !== confirmPassword.value) {
                e.preventDefault();
                alert('Las contraseñas no coinciden. Por favor, verifica.');
                return false;
            }
            
            if (password.value.length < 6 || password.value.length > 20) {
                e.preventDefault();
                alert('La contraseña debe tener entre 6 y 20 caracteres.');
                return false;
            }
            
            // Deshabilitar el botón para evitar envíos múltiples
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Procesando...';
        });
        
        // Inicializar progreso
        updateFormProgress();
    });
    </script>
</body>
</html>
