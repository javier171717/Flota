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
                <?php echo form_open('auth/change_password'); ?>
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Contraseña Actual</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                        <?php echo form_error('current_password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                        <?php echo form_error('new_password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirmar Nueva Contraseña</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        <?php echo form_error('confirm_password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-key me-2"></i>Cambiar Contraseña
                    </button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
