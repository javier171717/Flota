<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-white">Mis Tickets</h6>
                <div>
                    <a href="<?php echo base_url('tickets/comprar'); ?>" class="btn btn-success btn-sm">
                        <i class="fas fa-plus me-1"></i>Comprar Nuevo Ticket
                    </a>
                </div>
            </div>
            <div class="card-body">
                <?php if (empty($tickets)): ?>
                    <div class="alert alert-info text-center">
                        <i class="fas fa-ticket-alt fa-3x mb-3 text-info"></i>
                        <h5>No tienes tickets aún</h5>
                        <p class="mb-3">¿Quieres viajar? Compra tu primer ticket ahora mismo.</p>
                        <a href="<?php echo base_url('tickets/comprar'); ?>" class="btn btn-primary">
                            <i class="fas fa-shopping-cart me-1"></i>Comprar Ticket
                        </a>
                    </div>
                <?php else: ?>
                    <div class="row">
                        <?php foreach ($tickets as $ticket): ?>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 border-<?php 
                                    switch ($ticket->estado) {
                                        case 'confirmado': echo 'success'; break;
                                        case 'cancelado': echo 'danger'; break;
                                        default: echo 'warning';
                                    }
                                ?>">
                                    <div class="card-header bg-<?php 
                                        switch ($ticket->estado) {
                                            case 'confirmado': echo 'success'; break;
                                            case 'cancelado': echo 'danger'; break;
                                            default: echo 'warning';
                                        }
                                    ?> text-white text-center">
                                        <h6 class="mb-0">
                                            <i class="fas fa-ticket-alt me-2"></i>
                                            Ticket #<?php echo $ticket->codigo_ticket; ?>
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center mb-3">
                                            <span class="badge badge-<?php 
                                                switch ($ticket->estado) {
                                                    case 'confirmado': echo 'success'; break;
                                                    case 'cancelado': echo 'danger'; break;
                                                    default: echo 'warning';
                                                }
                                            ?> fs-6">
                                                <?php 
                                                switch ($ticket->estado) {
                                                    case 'confirmado': echo 'Confirmado'; break;
                                                    case 'cancelado': echo 'Cancelado'; break;
                                                    default: echo 'Reservado';
                                                }
                                                ?>
                                            </span>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <h6 class="text-primary">
                                                <i class="fas fa-route me-2"></i>
                                                <?php echo $ticket->origen; ?> → <?php echo $ticket->destino; ?>
                                            </h6>
                                        </div>
                                        
                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <small class="text-muted">Fecha:</small><br>
                                                <strong><?php echo date('d/m/Y', strtotime($ticket->fecha_viaje)); ?></strong>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted">Hora:</small><br>
                                                <strong><?php echo date('H:i', strtotime($ticket->fecha_viaje)); ?></strong>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <small class="text-muted">Asiento:</small><br>
                                                <span class="badge badge-info"><?php echo $ticket->asiento; ?></span>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted">Precio:</small><br>
                                                <strong class="text-success">$<?php echo number_format($ticket->precio, 2); ?></strong>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-2">
                                            <small class="text-muted">Bus:</small><br>
                                            <strong><?php echo $ticket->marca . ' ' . $ticket->modelo; ?></strong><br>
                                            <small class="text-muted">Placa: <?php echo $ticket->placa; ?></small>
                                        </div>
                                        
                                        <div class="mb-2">
                                            <small class="text-muted">Distancia:</small><br>
                                            <strong><?php echo $ticket->distancia; ?> km</strong>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo base_url('tickets/ver/' . $ticket->id); ?>" 
                                               class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye me-1"></i>Ver
                                            </a>
                                            <a href="<?php echo base_url('tickets/imprimir/' . $ticket->id); ?>" 
                                               class="btn btn-info btn-sm" target="_blank">
                                                <i class="fas fa-print me-1"></i>Imprimir
                                            </a>
                                            <?php if ($ticket->estado == 'confirmado'): ?>
                                                <a href="<?php echo base_url('tickets/cancelar/' . $ticket->id); ?>" 
                                                   class="btn btn-danger btn-sm"
                                                   onclick="return confirm('¿Estás seguro de que quieres cancelar este ticket?')">
                                                    <i class="fas fa-times me-1"></i>Cancelar
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
