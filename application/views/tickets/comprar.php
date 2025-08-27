<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-shopping-cart me-2"></i>Comprar Ticket
                </h6>
            </div>
            <div class="card-body">
                <?php if (!$this->permissions->is_passenger()): ?>
                    <div class="alert alert-info mb-4">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Modo Venta:</strong> Como <?php echo ucfirst($this->session->userdata('rol')); ?>, 
                        estás vendiendo un ticket para otro pasajero. 
                        Por favor, ingresa los datos del pasajero que realizará el viaje.
                    </div>
                <?php endif; ?>
                
                <form method="post" id="ticketForm">
                    <div class="row">
                        <!-- Selección de Viaje -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="viaje_id" class="form-label">
                                    <i class="fas fa-route me-1"></i>Seleccionar Viaje
                                </label>
                                <select class="form-control" id="viaje_id" name="viaje_id" required>
                                    <option value="">-- Selecciona un viaje --</option>
                                    <?php if (empty($viajes)): ?>
                                        <option value="" disabled>No hay viajes disponibles</option>
                                    <?php else: ?>
                                                                                    <?php foreach ($viajes as $viaje): ?>
                                                <?php 
                                                    // Calcular precio para este viaje
                                                    $precio_viaje = $this->Tickets_model->calculate_price($viaje->distancia);
                                                ?>
                                                <option value="<?php echo $viaje->id; ?>" 
                                                        data-distancia="<?php echo $viaje->distancia; ?>"
                                                        data-precio="<?php echo $precio_viaje; ?>">
                                                    <?php echo $viaje->origen . ' → ' . $viaje->destino; ?> 
                                                    (<?php echo date('d/m/Y H:i', strtotime($viaje->fecha_salida)); ?>)
                                                    - $<?php echo number_format($precio_viaje, 2); ?>
                                                </option>
                                            <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <!-- DEBUG INFO -->
                                <small class="form-text text-muted">
                                    Total de viajes disponibles: <?php echo count($viajes); ?>
                                </small>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="asiento" class="form-label">
                                    <i class="fas fa-chair me-1"></i>Seleccionar Asiento
                                </label>
                                <select class="form-control" id="asiento" name="asiento" required disabled>
                                    <option value="">-- Primero selecciona un viaje --</option>
                                </select>
                                <small class="form-text text-muted">
                                    Los asientos se cargarán automáticamente según la disponibilidad
                                </small>
                            </div>
                            
                            <div class="alert alert-info" id="infoViaje" style="display: none;">
                                <div class="row">
                                    <div class="col-6">
                                        <strong>Distancia:</strong><br>
                                        <span id="distanciaInfo">-</span> km
                                    </div>
                                    <div class="col-6">
                                        <strong>Precio:</strong><br>
                                        <span id="precioInfo" class="text-success">$-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Información del Pasajero -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="nombre" class="form-label">
                                    <i class="fas fa-user me-1"></i>Nombre Completo del Pasajero
                                </label>
                                <input type="text" class="form-control" id="nombre" name="nombre" 
                                       placeholder="Ingrese el nombre completo del pasajero"
                                       required>
                                <small class="form-text text-muted">
                                    Ingrese los datos del pasajero que viajará
                                </small>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-1"></i>Email del Pasajero
                                </label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       placeholder="Ingrese el email del pasajero"
                                       required>
                                <small class="form-text text-muted">
                                    Se usará para identificar al pasajero
                                </small>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="telefono" class="form-label">
                                    <i class="fas fa-phone me-1"></i>Teléfono del Pasajero
                                </label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" 
                                       placeholder="Ej: 0991234567" required>
                                <small class="form-text text-muted">
                                    Teléfono de contacto del pasajero
                                </small>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <!-- Resumen del Ticket -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-receipt me-2"></i>Resumen del Ticket
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Ruta:</strong><br>
                                            <span id="resumenRuta">-</span>
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Fecha:</strong><br>
                                            <span id="resumenFecha">-</span>
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Asiento:</strong><br>
                                            <span id="resumenAsiento">-</span>
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Precio Total:</strong><br>
                                            <span id="resumenPrecio" class="text-success fs-5">$-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success btn-lg" id="btnComprar" disabled>
                            <i class="fas fa-credit-card me-2"></i>Comprar Ticket
                        </button>
                        <a href="<?php echo base_url('tickets'); ?>" class="btn btn-secondary btn-lg ms-2">
                            <i class="fas fa-arrow-left me-2"></i>Volver
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Cuando se selecciona un viaje
    $('#viaje_id').change(function() {
        const viajeId = $(this).val();
        const selectedOption = $(this).find('option:selected');
        
        if (viajeId) {
            // Habilitar selección de asiento
            $('#asiento').prop('disabled', false);
            
            // Cargar asientos disponibles
            $.ajax({
                url: '<?php echo base_url("tickets/get_asientos_disponibles/"); ?>' + viajeId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        alert('Error: ' + response.error);
                        return;
                    }
                    
                    // Limpiar opciones de asiento
                    $('#asiento').empty().append('<option value="">-- Selecciona un asiento --</option>');
                    
                    // Agregar asientos disponibles
                    response.asientos_disponibles.forEach(function(asiento) {
                        $('#asiento').append('<option value="' + asiento + '">Asiento ' + asiento + '</option>');
                    });
                    
                    // Mostrar información del viaje
                    const distancia = selectedOption.data('distancia');
                    const precio = selectedOption.data('precio');
                    
                    $('#distanciaInfo').text(distancia);
                    $('#precioInfo').text('$' + parseFloat(precio).toFixed(2));
                    $('#infoViaje').show();
                    
                    // Actualizar resumen
                    updateResumen();
                },
                error: function() {
                    alert('Error al cargar los asientos disponibles');
                }
            });
        } else {
            // Deshabilitar selección de asiento
            $('#asiento').prop('disabled', true).empty().append('<option value="">-- Primero selecciona un viaje --</option>');
            $('#infoViaje').hide();
            updateResumen();
        }
    });
    
    // Cuando se selecciona un asiento
    $('#asiento').change(function() {
        updateResumen();
    });
    
    // Función para actualizar el resumen
    function updateResumen() {
        const viajeOption = $('#viaje_id option:selected');
        const asiento = $('#asiento').val();
        
        if (viajeOption.val() && asiento) {
            const ruta = viajeOption.text().split(' (')[0];
            const fecha = viajeOption.text().match(/\((.*?)\)/)[1];
            const precio = viajeOption.data('precio');
            
            $('#resumenRuta').text(ruta);
            $('#resumenFecha').text(fecha);
            $('#resumenAsiento').text('Asiento ' + asiento);
            $('#resumenPrecio').text('$' + parseFloat(precio).toFixed(2));
            
            // Habilitar botón de compra
            $('#btnComprar').prop('disabled', false);
        } else {
            $('#resumenRuta').text('-');
            $('#resumenFecha').text('-');
            $('#resumenAsiento').text('-');
            $('#resumenPrecio').text('$-');
            
            // Deshabilitar botón de compra
            $('#btnComprar').prop('disabled', true);
        }
    }
    
    // Validación del formulario
    $('#ticketForm').submit(function(e) {
        if (!$('#viaje_id').val() || !$('#asiento').val()) {
            e.preventDefault();
            alert('Por favor, completa todos los campos obligatorios');
            return false;
        }
        
        // Mostrar confirmación
        if (!confirm('¿Estás seguro de que quieres comprar este ticket?')) {
            e.preventDefault();
            return false;
        }
        
        // Deshabilitar botón para evitar doble envío
        $('#btnComprar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Procesando...');
    });
});
</script>
