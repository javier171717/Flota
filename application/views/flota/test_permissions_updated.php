<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-white">Demostración de Títulos Mejorados</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h6>Tipos de Títulos Disponibles:</h6>
                <div class="mb-4">
                    <div class="page-title-container">
                        <h1 class="h2 page-title title-buses">
                            <i class="fas fa-bus me-3"></i>
                            Vista de Buses
                        </h1>
                        <div class="title-underline" style="background: linear-gradient(135deg, #3498db, #2980b9);"></div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="page-title-container">
                        <h1 class="h2 page-title title-routes">
                            <i class="fas fa-route me-3"></i>
                            Vista de Rutas
                        </h1>
                        <div class="title-underline" style="background: linear-gradient(135deg, #e74c3c, #c0392b);"></div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="page-title-container">
                        <h1 class="h2 page-title title-trips">
                            <i class="fas fa-calendar-alt me-3"></i>
                            Vista de Viajes
                        </h1>
                        <div class="title-underline" style="background: linear-gradient(135deg, #f39c12, #e67e22);"></div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <h6>Más Títulos:</h6>
                <div class="mb-4">
                    <div class="page-title-container">
                        <h1 class="h2 page-title title-drivers">
                            <i class="fas fa-user-tie me-3"></i>
                            Vista de Conductores
                        </h1>
                        <div class="title-underline" style="background: linear-gradient(135deg, #9b59b6, #8e44ad);"></div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="page-title-container">
                        <h1 class="h2 page-title title-tickets">
                            <i class="fas fa-ticket-alt me-3"></i>
                            Gestión de Tickets
                        </h1>
                        <div class="title-underline" style="background: linear-gradient(135deg, #27ae60, #2ecc71);"></div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="page-title-container">
                        <h1 class="h2 page-title title-profile">
                            <i class="fas fa-user-cog me-3"></i>
                            Mi Perfil
                        </h1>
                        <div class="title-underline" style="background: linear-gradient(135deg, #34495e, #2c3e50);"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="alert alert-info mt-3">
            <h6><i class="fas fa-info-circle me-2"></i>Características de los Títulos Mejorados:</h6>
            <ul class="mb-0">
                <li><strong>Iconos temáticos:</strong> Cada tipo de página tiene su icono distintivo</li>
                <li><strong>Colores únicos:</strong> Paleta de colores específica para cada sección</li>
                <li><strong>Efectos animados:</strong> Los iconos tienen una animación sutil de flotación</li>
                <li><strong>Separadores decorativos:</strong> Líneas de color con gradientes y sombras</li>
                <li><strong>Efectos hover:</strong> Interactividad al pasar el mouse</li>
                <li><strong>Diseño responsive:</strong> Se adapta perfectamente a móviles</li>
            </ul>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-white">Demostración de Colores de Roles</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h6>Colores de Roles Disponibles:</h6>
                <div class="user-info text-white mb-3">
                    <small>
                        <i class="fas fa-user me-1"></i>
                        Usuario Ejemplo
                    </small>
                    <br>
                    <small class="text-danger fw-bold">Admin</small>
                </div>
                <div class="user-info text-white mb-3">
                    <small>
                        <i class="fas fa-user me-1"></i>
                        Usuario Ejemplo
                    </small>
                    <br>
                    <small class="text-warning fw-bold">Operador</small>
                </div>
                <div class="user-info text-white mb-3">
                    <small>
                        <i class="fas fa-user me-1"></i>
                        Usuario Ejemplo
                    </small>
                    <br>
                    <small class="text-info fw-bold">Conductor</small>
                </div>
                <div class="user-info text-white mb-3">
                    <small>
                        <i class="fas fa-user me-1"></i>
                        Usuario Ejemplo
                    </small>
                    <br>
                    <small class="text-success fw-bold">Pasajero</small>
                </div>
            </div>
            <div class="col-md-6">
                <h6>Tu Rol Actual:</h6>
                <div class="user-info text-white">
                    <small>
                        <i class="fas fa-user me-1"></i>
                        <?php echo $this->session->userdata('nombre'); ?>
                    </small>
                    <br>
                    <?php 
                    $rol = $this->session->userdata('rol');
                    $rol_class = '';
                    switch($rol) {
                        case 'admin':
                            $rol_class = 'text-danger fw-bold';
                            break;
                        case 'operador':
                            $rol_class = 'text-warning fw-bold';
                            break;
                        case 'conductor':
                            $rol_class = 'text-info fw-bold';
                            break;
                        case 'pasajero':
                            $rol_class = 'text-success fw-bold';
                            break;
                        default:
                            $rol_class = 'text-light fw-bold';
                    }
                    ?>
                    <small class="<?php echo $rol_class; ?>">
                        <?php echo ucfirst($rol); ?>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-white">Prueba de Permisos Actualizados</h6>
    </div>
    <div class="card-body">
        <h5>Información del Usuario</h5>
        <ul class="list-group mb-4">
            <li class="list-group-item"><strong>Rol:</strong> <?php echo ucfirst($permissions->get_user_role()); ?></li>
            <li class="list-group-item"><strong>¿Es Admin?</strong> <?php echo $permissions->is_admin() ? '✅ Sí' : '❌ No'; ?></li>
            <li class="list-group-item"><strong>¿Es Operador?</strong> <?php echo $permissions->is_operator() ? '✅ Sí' : '❌ No'; ?></li>
            <li class="list-group-item"><strong>¿Es Conductor?</strong> <?php echo $permissions->is_driver() ? '✅ Sí' : '❌ No'; ?></li>
            <li class="list-group-item"><strong>¿Es Pasajero?</strong> <?php echo $permissions->is_passenger() ? '✅ Sí' : '❌ No'; ?></li>
        </ul>

        <h5>Permisos por Módulo</h5>
        <div class="row">
            <div class="col-md-6">
                <h6>Buses</h6>
                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>¿Puede ver buses?</strong> <?php echo $permissions->can_read('buses') ? '✅ Sí' : '❌ No'; ?></li>
                    <li class="list-group-item"><strong>¿Puede crear buses?</strong> <?php echo $permissions->can_create('buses') ? '✅ Sí' : '❌ No'; ?></li>
                    <li class="list-group-item"><strong>¿Puede editar buses?</strong> <?php echo $permissions->can_update('buses') ? '✅ Sí' : '❌ No'; ?></li>
                    <li class="list-group-item"><strong>¿Puede eliminar buses?</strong> <?php echo $permissions->can_delete('buses') ? '✅ Sí' : '❌ No'; ?></li>
                </ul>
            </div>
            
            <div class="col-md-6">
                <h6>Conductores</h6>
                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>¿Puede ver conductores?</strong> <?php echo $permissions->can_read('conductores') ? '✅ Sí' : '❌ No'; ?></li>
                    <li class="list-group-item"><strong>¿Puede crear conductores?</strong> <?php echo $permissions->can_create('conductores') ? '✅ Sí' : '❌ No'; ?></li>
                    <li class="list-group-item"><strong>¿Puede editar conductores?</strong> <?php echo $permissions->can_update('conductores') ? '✅ Sí' : '❌ No'; ?></li>
                    <li class="list-group-item"><strong>¿Puede eliminar conductores?</strong> <?php echo $permissions->can_delete('conductores') ? '✅ Sí' : '❌ No'; ?></li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h6>Rutas</h6>
                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>¿Puede ver rutas?</strong> <?php echo $permissions->can_read('rutas') ? '✅ Sí' : '❌ No'; ?></li>
                    <li class="list-group-item"><strong>¿Puede crear rutas?</strong> <?php echo $permissions->can_create('rutas') ? '✅ Sí' : '❌ No'; ?></li>
                    <li class="list-group-item"><strong>¿Puede editar rutas?</strong> <?php echo $permissions->can_update('rutas') ? '✅ Sí' : '❌ No'; ?></li>
                    <li class="list-group-item"><strong>¿Puede eliminar rutas?</strong> <?php echo $permissions->can_delete('rutas') ? '✅ Sí' : '❌ No'; ?></li>
                </ul>
            </div>
            
            <div class="col-md-6">
                <h6>Viajes</h6>
                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>¿Puede ver viajes?</strong> <?php echo $permissions->can_read('viajes') ? '✅ Sí' : '❌ No'; ?></li>
                    <li class="list-group-item"><strong>¿Puede crear viajes?</strong> <?php echo $permissions->can_create('viajes') ? '✅ Sí' : '❌ No'; ?></li>
                    <li class="list-group-item"><strong>¿Puede editar viajes?</strong> <?php echo $permissions->can_update('viajes') ? '✅ Sí' : '❌ No'; ?></li>
                    <li class="list-group-item"><strong>¿Puede eliminar viajes?</strong> <?php echo $permissions->can_delete('viajes') ? '✅ Sí' : '❌ No'; ?></li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h6>Tickets</h6>
                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>¿Puede ver tickets?</strong> <?php echo $permissions->can_read('tickets') ? '✅ Sí' : '❌ No'; ?></li>
                    <li class="list-group-item"><strong>¿Puede crear tickets?</strong> <?php echo $permissions->can_create('tickets') ? '✅ Sí' : '❌ No'; ?></li>
                    <li class="list-group-item"><strong>¿Puede gestionar tickets?</strong> <?php echo $permissions->can_manage_tickets() ? '✅ Sí' : '❌ No'; ?></li>
                    <li class="list-group-item"><strong>¿Ve tickets en dashboard?</strong> <?php echo $permissions->can_see_tickets_dashboard() ? '✅ Sí' : '❌ No'; ?></li>
                </ul>
            </div>
        </div>

        <h5>Acciones Disponibles</h5>
        <div class="row">
            <div class="col-md-6">
                <a href="<?php echo base_url('flota/buses'); ?>" class="btn btn-primary btn-sm w-100 mb-2">
                    <i class="fas fa-bus me-2"></i><?php echo $permissions->is_driver() ? 'Ver Buses' : 'Gestionar Buses'; ?>
                </a>
                
                <?php if ($permissions->can_access('conductores')): ?>
                <a href="<?php echo base_url('flota/conductores'); ?>" class="btn btn-success btn-sm w-100 mb-2">
                    <i class="fas fa-user me-2"></i><?php echo $permissions->is_driver() ? 'Ver Conductores' : 'Gestionar Conductores'; ?>
                </a>
                <?php else: ?>
                <div class="alert alert-warning p-2 mb-2">
                    <small><i class="fas fa-exclamation-triangle me-1"></i>No tienes acceso a la información de conductores</small>
                </div>
                <?php endif; ?>
                
                <a href="<?php echo base_url('flota/rutas'); ?>" class="btn btn-info btn-sm w-100 mb-2">
                    <i class="fas fa-route me-2"></i><?php echo $permissions->is_driver() ? 'Ver Rutas' : 'Gestionar Rutas'; ?>
                </a>
                
                <a href="<?php echo base_url('flota/viajes'); ?>" class="btn btn-warning btn-sm w-100 mb-2">
                    <i class="fas fa-calendar-alt me-2"></i><?php echo $permissions->is_driver() ? 'Ver Viajes' : 'Gestionar Viajes'; ?>
                </a>
            </div>
            
            <div class="col-md-6">
                <?php if ($permissions->can_see_tickets_dashboard()): ?>
                <a href="<?php echo base_url('tickets'); ?>" class="btn btn-secondary btn-sm w-100 mb-2">
                    <i class="fas fa-ticket-alt me-2"></i><?php echo $permissions->is_passenger() ? 'Mis Tickets' : 'Gestionar Tickets'; ?>
                </a>
                <?php endif; ?>
                
                <a href="<?php echo base_url('flota'); ?>" class="btn btn-success btn-sm w-100 mb-2">
                    <i class="fas fa-home me-2"></i>Volver al Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
