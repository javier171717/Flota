<div class="row">
    <?php if (isset($total_buses) && $permissions->can_access('buses')): ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Buses</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_buses; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-bus fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (isset($total_conductores) && $permissions->can_access('conductores')): ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Conductores</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_conductores; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (isset($total_rutas) && $permissions->can_access('rutas')): ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Rutas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_rutas; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-route fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (isset($total_viajes) && $permissions->can_access('viajes')): ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Viajes</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_viajes; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-white">Acciones Rápidas</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if ($permissions->can_access('buses')): ?>
                    <div class="col-md-6 mb-3">
                        <a href="<?php echo base_url('flota/buses'); ?>" class="btn btn-primary btn-block w-100">
                            <i class="fas fa-bus me-2"></i><?php echo $permissions->is_driver() ? 'Ver Buses' : 'Gestionar Buses'; ?>
                        </a>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($permissions->can_access('conductores')): ?>
                    <div class="col-md-6 mb-3">
                        <a href="<?php echo base_url('flota/conductores'); ?>" class="btn btn-success btn-block w-100">
                            <i class="fas fa-user me-2"></i><?php echo $permissions->is_driver() ? 'Ver Conductores' : 'Gestionar Conductores'; ?>
                        </a>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($permissions->can_access('rutas')): ?>
                    <div class="col-md-6 mb-3">
                        <a href="<?php echo base_url('flota/rutas'); ?>" class="btn btn-info btn-block w-100">
                            <i class="fas fa-route me-2"></i><?php echo $permissions->is_driver() ? 'Ver Rutas' : 'Gestionar Rutas'; ?>
                        </a>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($permissions->can_access('viajes')): ?>
                    <div class="col-md-6 mb-3">
                        <a href="<?php echo base_url('flota/viajes'); ?>" class="btn btn-warning btn-block w-100">
                            <i class="fas fa-calendar-alt me-2"></i><?php echo $permissions->is_driver() ? 'Ver Viajes' : 'Gestionar Viajes'; ?>
                        </a>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($permissions->can_see_tickets_dashboard()): ?>
                    <div class="col-md-6 mb-3">
                        <a href="<?php echo base_url('tickets'); ?>" class="btn btn-secondary btn-block w-100">
                            <i class="fas fa-ticket-alt me-2"></i><?php echo $permissions->is_passenger() ? 'Mis Tickets' : 'Gestionar Tickets'; ?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-white">Información del Sistema</h6>
            </div>
            <div class="card-body">
                <p><strong>Framework:</strong> CodeIgniter 3</p>
                <p><strong>Base de Datos:</strong> MySQL</p>
                <p><strong>Patrón:</strong> MVC (Modelo-Vista-Controlador)</p>
                <p><strong>Relación:</strong> Maestro-Detalle (Viajes → Detalles)</p>
                <p><strong>Interfaz:</strong> Bootstrap 5 + Font Awesome</p>
            </div>
        </div>
    </div>
</div>
