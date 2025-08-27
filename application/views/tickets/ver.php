<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-ticket-alt me-2"></i>Ticket #<?php echo $ticket->codigo_ticket; ?>
                </h6>
                <div>
                    <?php if ($ticket->estado == 'confirmado'): ?>
                        <a href="<?php echo base_url('tickets/cancelar/' . $ticket->id); ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Estás seguro de que quieres cancelar este ticket?')">
                            <i class="fas fa-times me-1"></i>Cancelar Ticket
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo base_url('tickets'); ?>" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Volver
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Información del Ticket -->
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Información del Ticket
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>Código:</strong></td>
                                                <td>
                                                    <span class="badge badge-primary fs-6">
                                                        <?php echo $ticket->codigo_ticket; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Estado:</strong></td>
                                                <td>
                                                    <?php
                                                    $estado_class = '';
                                                    $estado_text = '';
                                                    switch ($ticket->estado) {
                                                        case 'reservado':
                                                            $estado_class = 'warning';
                                                            $estado_text = 'Reservado';
                                                            break;
                                                        case 'confirmado':
                                                            $estado_class = 'success';
                                                            $estado_text = 'Confirmado';
                                                            break;
                                                        case 'cancelado':
                                                            $estado_class = 'danger';
                                                            $estado_text = 'Cancelado';
                                                            break;

                                                    }
                                                    ?>
                                                    <span class="badge badge-<?php echo $estado_class; ?> fs-6">
                                                        <?php echo $estado_text; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Asiento:</strong></td>
                                                <td>
                                                    <span class="badge badge-info fs-6">
                                                        <?php echo $ticket->asiento; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Precio:</strong></td>
                                                <td>
                                                    <span class="text-success fs-5 fw-bold">
                                                        $<?php echo number_format($ticket->precio, 2); ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>Fecha de Compra:</strong></td>
                                                <td>
                                                    <?php echo date('d/m/Y H:i', strtotime($ticket->fecha_compra)); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Fecha del Viaje:</strong></td>
                                                <td>
                                                    <?php echo date('d/m/Y H:i', strtotime($ticket->fecha_viaje)); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Distancia:</strong></td>
                                                <td>
                                                    <strong><?php echo $ticket->distancia; ?> km</strong>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Información del Viaje -->
                        <div class="card mb-4">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0">
                                    <i class="fas fa-route me-2"></i>Detalles del Viaje
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="text-primary">
                                            <i class="fas fa-map-marker-alt me-2"></i>Ruta
                                        </h6>
                                        <p class="fs-5">
                                            <strong><?php echo $ticket->origen; ?></strong>
                                            <i class="fas fa-arrow-right mx-2 text-muted"></i>
                                            <strong><?php echo $ticket->destino; ?></strong>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="text-primary">
                                            <i class="fas fa-clock me-2"></i>Horarios
                                        </h6>
                                        <p class="mb-1">
                                            <strong>Salida:</strong> 
                                            <?php echo date('H:i', strtotime($ticket->fecha_salida)); ?>
                                        </p>
                                        <?php if ($ticket->fecha_llegada): ?>
                                            <p class="mb-0">
                                                <strong>Llegada:</strong> 
                                                <?php echo date('H:i', strtotime($ticket->fecha_llegada)); ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Información del Bus -->
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h6 class="mb-0">
                                    <i class="fas fa-bus me-2"></i>Información del Bus
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>Marca:</strong><br>
                                        <span class="fs-6"><?php echo $ticket->marca; ?></span>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Modelo:</strong><br>
                                        <span class="fs-6"><?php echo $ticket->modelo; ?></span>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Placa:</strong><br>
                                        <span class="badge badge-secondary fs-6"><?php echo $ticket->placa; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Información del Pasajero -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-warning text-dark">
                                <h6 class="mb-0">
                                    <i class="fas fa-user me-2"></i>Información del Pasajero
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <i class="fas fa-user-circle fa-4x text-warning"></i>
                                </div>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Nombre:</strong></td>
                                        <td><?php echo $ticket->pasajero_nombre; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td><?php echo $ticket->pasajero_email; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Acciones Rápidas -->
                        <div class="card mt-4">
                            <div class="card-header bg-secondary text-white">
                                <h6 class="mb-0">
                                    <i class="fas fa-cogs me-2"></i>Acciones
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="<?php echo base_url('tickets'); ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-list me-2"></i>Ver Todos mis Tickets
                                    </a>
                                                                         <a href="<?php echo base_url('tickets/imprimir/' . $ticket->id); ?>" 
                                        class="btn btn-outline-info" target="_blank">
                                         <i class="fas fa-print me-2"></i>Imprimir Ticket
                                     </a>
                                     <a href="<?php echo base_url('tickets/comprar'); ?>" class="btn btn-outline-success">
                                         <i class="fas fa-plus me-2"></i>Comprar Otro Ticket
                                     </a>
                                     <?php if ($ticket->estado == 'confirmado'): ?>
                                         <a href="<?php echo base_url('tickets/cancelar/' . $ticket->id); ?>" 
                                            class="btn btn-outline-danger"
                                            onclick="return confirm('¿Estás seguro de que quieres cancelar este ticket?')">
                                             <i class="fas fa-times me-2"></i>Cancelar Ticket
                                         </a>
                                     <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
