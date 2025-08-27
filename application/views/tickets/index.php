<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-white">Gestión de Tickets</h6>
        <div>
            <a href="<?php echo base_url('tickets/comprar'); ?>" class="btn btn-success btn-sm">
                <i class="fas fa-plus me-1"></i>Comprar Ticket
            </a>
        </div>
    </div>
    <div class="card-body">
        <?php if (empty($tickets)): ?>
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                No hay tickets registrados en el sistema.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="ticketsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Pasajero</th>
                            <th>Viaje</th>
                            <th>Bus</th>
                            <th>Asiento</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Fecha Compra</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tickets as $ticket): ?>
                            <tr>
                                <td>
                                    <span class="badge badge-primary"><?php echo $ticket->codigo_ticket; ?></span>
                                </td>
                                <td>
                                    <div>
                                        <strong><?php echo $ticket->pasajero_nombre; ?></strong><br>
                                        <small class="text-muted"><?php echo $ticket->pasajero_email; ?></small>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <strong><?php echo $ticket->origen; ?> → <?php echo $ticket->destino; ?></strong><br>
                                        <small class="text-muted">
                                            <?php echo date('d/m/Y H:i', strtotime($ticket->fecha_salida)); ?>
                                        </small>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <strong><?php echo $ticket->placa; ?></strong><br>
                                        <small class="text-muted"><?php echo $ticket->marca . ' ' . $ticket->modelo; ?></small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info"><?php echo $ticket->asiento; ?></span>
                                </td>
                                <td>
                                    <span class="badge badge-success">$<?php echo number_format($ticket->precio, 2); ?></span>
                                </td>
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
                                    <span class="badge badge-<?php echo $estado_class; ?>"><?php echo $estado_text; ?></span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <?php echo date('d/m/Y H:i', strtotime($ticket->fecha_compra)); ?>
                                    </small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="<?php echo base_url('tickets/ver/' . $ticket->id); ?>" 
                                           class="btn btn-primary btn-sm" title="Ver Ticket">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?php echo base_url('tickets/imprimir/' . $ticket->id); ?>" 
                                           class="btn btn-info btn-sm" title="Imprimir Ticket" target="_blank">
                                            <i class="fas fa-print"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#ticketsTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
        },
        "order": [[6, "desc"]] // Ordenar por fecha de compra descendente
    });
});


</script>
