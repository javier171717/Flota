<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-white">Información del Perfil</h6>
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
                
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nombre:</strong> <?php echo $user->nombre; ?></p>
                        <p><strong>Email:</strong> <?php echo $user->email; ?></p>
                        <p><strong>Rol:</strong> <?php echo ucfirst($user->rol); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Estado:</strong> 
                            <span class="badge bg-<?php echo ($user->estado == 'activo') ? 'success' : 'danger'; ?>">
                                <?php echo ucfirst($user->estado); ?>
                            </span>
                        </p>
                        <p><strong>Fecha de Registro:</strong> <?php echo date('d/m/Y H:i', strtotime($user->fecha_registro)); ?></p>
                        <?php if($user->fecha_ultimo_login): ?>
                            <p><strong>Último Login:</strong> <?php echo date('d/m/Y H:i', strtotime($user->fecha_ultimo_login)); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-white">Cambiar Contraseña</h6>
            </div>
            <div class="card-body">
                <?php echo form_open('auth/change_password', ['id' => 'changePasswordForm', 'target' => '_self']); ?>
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Contraseña Actual</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                        <?php echo form_error('current_password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required minlength="6">
                        <small class="form-text text-muted">Mínimo 6 caracteres</small>
                        <div class="password-strength mt-2">
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar" id="passwordStrengthBar" role="progressbar" style="width: 0%"></div>
                            </div>
                            <small class="form-text" id="passwordStrengthText">Ingresa tu nueva contraseña</small>
                        </div>
                        <?php echo form_error('new_password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirmar Nueva Contraseña</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        <div id="passwordMatch" class="form-text"></div>
                        <?php echo form_error('confirm_password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100" id="submitBtn">
                        <i class="fas fa-key me-2"></i>Cambiar Contraseña
                    </button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<style>
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

.form-control:focus {
    border-color: #6f42c1;
    box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
}

.btn-primary {
    background: linear-gradient(135deg, #6f42c1 0%, #007bff 100%);
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.btn-primary:disabled {
    transform: none;
    box-shadow: none;
    opacity: 0.6;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const newPassword = document.getElementById('new_password');
    const confirmPassword = document.getElementById('confirm_password');
    const passwordMatch = document.getElementById('passwordMatch');
    const submitBtn = document.getElementById('submitBtn');
    const passwordStrengthBar = document.getElementById('passwordStrengthBar');
    const passwordStrengthText = document.getElementById('passwordStrengthText');
    
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
        if (newPassword.value && confirmPassword.value) {
            if (newPassword.value === confirmPassword.value) {
                passwordMatch.innerHTML = '<span class="text-success"><i class="fas fa-check-circle"></i> Las contraseñas coinciden</span>';
                submitBtn.disabled = false;
            } else {
                passwordMatch.innerHTML = '<span class="text-danger"><i class="fas fa-times-circle"></i> Las contraseñas no coinciden</span>';
                submitBtn.disabled = true;
            }
        } else {
            passwordMatch.innerHTML = '';
            submitBtn.disabled = false;
        }
    }
    
    newPassword.addEventListener('input', function() {
        checkPasswordStrength(this.value);
        checkPasswordMatch();
    });
    confirmPassword.addEventListener('input', checkPasswordMatch);
    
    // Validar formulario antes de enviar
    document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevenir envío normal del formulario
        
        if (newPassword.value !== confirmPassword.value) {
            alert('Las contraseñas no coinciden. Por favor, verifica.');
            return false;
        }
        
        if (newPassword.value.length < 6) {
            alert('La nueva contraseña debe tener al menos 6 caracteres.');
            return false;
        }
        
        // Confirmar antes de enviar
        if (!confirm('¿Estás seguro de que quieres cambiar tu contraseña? Serás redirigido al login.')) {
            return false;
        }
        
        // Deshabilitar el botón para evitar envíos múltiples
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Procesando...';
        
        // Crear datos del formulario
        const formData = new FormData();
        formData.append('current_password', document.getElementById('current_password').value);
        formData.append('new_password', newPassword.value);
        formData.append('confirm_password', confirmPassword.value);
        
        // Enviar petición AJAX
        fetch('<?php echo base_url('auth/change_password'); ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes('success') || data.includes('exitosamente')) {
                alert('Contraseña actualizada exitosamente. Serás redirigido al login.');
                window.location.href = '<?php echo base_url('auth'); ?>';
            } else if (data.includes('error') || data.includes('incorrecta')) {
                alert('Error: ' + data);
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-key me-2"></i>Cambiar Contraseña';
            } else {
                alert('Respuesta inesperada del servidor. Por favor, intente nuevamente.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-key me-2"></i>Cambiar Contraseña';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error de conexión. Por favor, intente nuevamente.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-key me-2"></i>Cambiar Contraseña';
        });
    });
});
</script>