<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-white">Prueba de Permisos - FlotaPro</h6>
    </div>
    <div class="card-body">
        <h5>Usuario: <?php echo $this->session->userdata('nombre'); ?></h5>
        <h6>Rol: <?php echo ucfirst($this->session->userdata('rol')); ?></h6>
        
        <hr>
        
        <h6>Permisos por módulo:</h6>
        <ul>
            <li><strong>Dashboard:</strong> <?php echo $permissions->get_module_permissions('dashboard'); ?></li>
            <li><strong>Buses:</strong> <?php echo $permissions->get_module_permissions('buses'); ?></li>
            <li><strong>Conductores:</strong> <?php echo $permissions->get_module_permissions('conductores'); ?></li>
            <li><strong>Rutas:</strong> <?php echo $permissions->get_module_permissions('rutas'); ?></li>
            <li><strong>Viajes:</strong> <?php echo $permissions->get_module_permissions('viajes'); ?></li>
        </ul>
        
        <hr>
        
        <h6>Verificaciones de permisos:</h6>
        <ul>
            <li><strong>¿Puede crear buses?</strong> <?php echo $permissions->can_create('buses') ? '✅ Sí' : '❌ No'; ?></li>
            <li><strong>¿Puede leer conductores?</strong> <?php echo $permissions->can_read('conductores') ? '✅ Sí' : '❌ No'; ?></li>
            <li><strong>¿Puede actualizar rutas?</strong> <?php echo $permissions->can_update('rutas') ? '✅ Sí' : '❌ No'; ?></li>
            <li><strong>¿Puede eliminar viajes?</strong> <?php echo $permissions->can_delete('viajes') ? '✅ Sí' : '❌ No'; ?></li>
            <li><strong>¿Es administrador?</strong> <?php echo $permissions->is_admin() ? '✅ Sí' : '❌ No'; ?></li>
            <li><strong>¿Es operador?</strong> <?php echo $permissions->is_operator() ? '✅ Sí' : '❌ No'; ?></li>
            <li><strong>¿Es conductor?</strong> <?php echo $permissions->is_driver() ? '✅ Sí' : '❌ No'; ?></li>
        </ul>
        
        <hr>
        
        <h6>Acciones disponibles:</h6>
        <div class="row">
            <?php if ($permissions->can_access('buses')): ?>
            <div class="col-md-3 mb-2">
                <a href="<?php echo base_url('flota/buses'); ?>" class="btn btn-primary btn-sm w-100">
                    <i class="fas fa-bus me-1"></i>Gestionar Buses
                </a>
            </div>
            <?php endif; ?>
            
            <?php if ($permissions->can_access('conductores')): ?>
            <div class="col-md-3 mb-2">
                <a href="<?php echo base_url('flota/conductores'); ?>" class="btn btn-success btn-sm w-100">
                    <i class="fas fa-user me-1"></i>Gestionar Conductores
                </a>
            </div>
            <?php endif; ?>
            
            <?php if ($permissions->can_access('rutas')): ?>
            <div class="col-md-3 mb-2">
                <a href="<?php echo base_url('flota/rutas'); ?>" class="btn btn-info btn-sm w-100">
                    <i class="fas fa-route me-1"></i>Gestionar Rutas
                </a>
            </div>
            <?php endif; ?>
            
            <?php if ($permissions->can_access('viajes')): ?>
            <div class="col-md-3 mb-2">
                <a href="<?php echo base_url('flota/viajes'); ?>" class="btn btn-warning btn-sm w-100">
                    <i class="fas fa-calendar me-1"></i>Gestionar Viajes
                </a>
            </div>
            <?php endif; ?>
        </div>
        
        <hr>
        
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Nota:</strong> Esta página es solo para pruebas. En producción, deberías eliminarla.
        </div>
    </div>
</div>
