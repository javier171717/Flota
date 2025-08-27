<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket #<?php echo $ticket->codigo_ticket; ?> - FlotaPro</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/print-tickets.css'); ?>">
    <style>
        /* Estilos optimizados para impresión */
        @media print {
            body { margin: 0; padding: 0; }
            .no-print { display: none !important; }
            .page-break { page-break-before: always; }
        }
        
        /* Estilos generales */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 10px;
            line-height: 1.2;
            color: #000;
            background: #fff;
            padding: 12px;
        }
        
        /* Header del ticket */
        .ticket-header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        
        .company-logo {
            font-size: 20px;
            font-weight: bold;
            color: #6f42c1;
            margin-bottom: 3px;
        }
        
        .company-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 3px;
        }
        
        .ticket-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 3px;
        }
        
        .ticket-code {
            font-size: 12px;
            font-weight: bold;
            color: #007bff;
            background: #f8f9fa;
            padding: 3px 8px;
            border-radius: 3px;
            display: inline-block;
        }
        
        /* Información del ticket */
        .ticket-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 12px;
        }
        
        .info-section {
            border: 1px solid #ddd;
            padding: 8px;
            border-radius: 3px;
        }
        
        .section-title {
            font-size: 11px;
            font-weight: bold;
            color: #333;
            margin-bottom: 6px;
            text-align: center;
            background: #f8f9fa;
            padding: 2px;
            border-radius: 3px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
            padding: 1px 0;
            border-bottom: 1px solid #eee;
        }
        
        .info-label {
            font-weight: bold;
            color: #555;
        }
        
        .info-value {
            color: #000;
        }
        
        /* Estado del ticket */
        .ticket-status {
            text-align: center;
            margin: 12px 0;
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 14px;
            border-radius: 12px;
            font-weight: bold;
            font-size: 11px;
            color: white;
        }
        
        .status-confirmado { background: #28a745; }
        .status-reservado { background: #ffc107; color: #000; }
        .status-cancelado { background: #dc3545; }
        
        /* Información del viaje */
        .trip-info {
            text-align: center;
            margin: 12px 0;
            padding: 10px;
            border: 2px solid #007bff;
            border-radius: 6px;
            background: #f8f9fa;
        }
        
        .route {
            font-size: 15px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 6px;
        }
        
        .arrow {
            font-size: 16px;
            color: #666;
            margin: 0 6px;
        }
        
        /* Información del bus */
        .bus-info {
            text-align: center;
            margin: 12px 0;
            padding: 10px;
            border: 2px solid #28a745;
            border-radius: 6px;
            background: #f8f9fa;
        }
        
        .bus-details {
            font-size: 11px;
            margin-bottom: 2px;
        }
        
        .placa {
            font-size: 13px;
            font-weight: bold;
            color: #28a745;
            background: #fff;
            padding: 2px 6px;
            border-radius: 3px;
            display: inline-block;
            border: 1px solid #28a745;
        }
        
        /* Asiento y precio */
        .seat-price {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin: 12px 0;
        }
        
        .seat-info, .price-info {
            text-align: center;
            padding: 10px;
            border-radius: 6px;
        }
        
        .seat-info {
            background: #e3f2fd;
            border: 2px solid #2196f3;
        }
        
        .price-info {
            background: #e8f5e8;
            border: 2px solid #4caf50;
        }
        
        .seat-number, .price-amount {
            font-size: 18px;
            font-weight: bold;
            margin: 6px 0;
        }
        
        .seat-number { color: #2196f3; }
        .price-amount { color: #4caf50; }
        
        /* Información del pasajero */
        .passenger-info {
            text-align: center;
            margin: 12px 0;
            padding: 10px;
            border: 2px solid #ff9800;
            border-radius: 6px;
            background: #fff3e0;
        }
        
        .passenger-name {
            font-size: 13px;
            font-weight: bold;
            color: #ff9800;
            margin-bottom: 2px;
        }
        
        .passenger-email {
            font-size: 9px;
            color: #666;
        }
        
        /* Footer */
        .ticket-footer {
            text-align: center;
            margin-top: 15px;
            padding-top: 12px;
            border-top: 2px solid #333;
            font-size: 8px;
            color: #666;
        }
        
        .print-instructions {
            background: #f8f9fa;
            border: 1px solid #ddd;
            padding: 10px;
            margin: 20px 0;
            border-radius: 5px;
            font-size: 11px;
            color: #666;
        }
        
        /* Botón de impresión (solo visible en pantalla) */
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        
        .print-button:hover {
            background: #0056b3;
        }
        
        @media print {
            .print-button { display: none; }
        }
    </style>
</head>
<body>
    <!-- Botón de impresión (solo visible en pantalla) -->
    <button class="print-button no-print" onclick="window.print()">
        🖨️ Imprimir Ticket
    </button>
    
    <!-- Instrucciones de impresión -->
    <div class="print-instructions no-print">
        <strong>💡 Consejos para impresión:</strong><br>
        • Usa papel A4 o carta<br>
        • Configura la impresora en modo "Sin márgenes" si es posible<br>
        • Imprime en color para mejor presentación<br>
        • Guarda como PDF si prefieres formato digital
    </div>
    
    <!-- Header del Ticket -->
    <div class="ticket-header">
        <div class="company-logo">🚌</div>
        <div class="company-name">FlotaPro</div>
        <div class="ticket-title">TICKET DE VIAJE</div>
        <div class="ticket-code"><?php echo $ticket->codigo_ticket; ?></div>
    </div>
    
    <!-- Estado del Ticket -->
    <div class="ticket-status">
        <?php
        $status_class = '';
        $status_text = '';
        switch ($ticket->estado) {
            case 'reservado':
                $status_class = 'status-reservado';
                $status_text = 'RESERVADO';
                break;
            case 'confirmado':
                $status_class = 'status-confirmado';
                $status_text = 'CONFIRMADO';
                break;
            case 'cancelado':
                $status_class = 'status-cancelado';
                $status_text = 'CANCELADO';
                break;
        }
        ?>
        <div class="status-badge <?php echo $status_class; ?>">
            <?php echo $status_text; ?>
        </div>
    </div>
    
    <!-- Información del Viaje -->
    <div class="trip-info">
        <div class="section-title">DETALLES DEL VIAJE</div>
        <div class="route">
            <?php echo $ticket->origen; ?>
            <span class="arrow">→</span>
            <?php echo $ticket->destino; ?>
        </div>
        <div class="info-row">
            <span class="info-label">Fecha de Salida:</span>
            <span class="info-value"><?php echo date('d/m/Y', strtotime($ticket->fecha_viaje)); ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Hora de Salida:</span>
            <span class="info-value"><?php echo date('H:i', strtotime($ticket->fecha_salida)); ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Distancia:</span>
            <span class="info-value"><?php echo $ticket->distancia; ?> km</span>
        </div>
    </div>
    
    <!-- Asiento y Precio -->
    <div class="seat-price">
        <div class="seat-info">
            <div class="section-title">ASIENTO</div>
            <div class="seat-number"><?php echo $ticket->asiento; ?></div>
        </div>
        <div class="price-info">
            <div class="section-title">PRECIO</div>
            <div class="price-amount">$<?php echo number_format($ticket->precio, 2); ?></div>
        </div>
    </div>
    
    <!-- Información del Bus -->
    <div class="bus-info">
        <div class="section-title">INFORMACIÓN DEL BUS</div>
        <div class="bus-details">
            <strong>Marca:</strong> <?php echo $ticket->marca; ?>
        </div>
        <div class="bus-details">
            <strong>Modelo:</strong> <?php echo $ticket->modelo; ?>
        </div>
        <div class="bus-details">
            <strong>Placa:</strong> <span class="placa"><?php echo $ticket->placa; ?></span>
        </div>
    </div>
    
    <!-- Información del Pasajero -->
    <div class="passenger-info">
        <div class="section-title">INFORMACIÓN DEL PASAJERO</div>
        <div class="passenger-name"><?php echo $ticket->pasajero_nombre; ?></div>
        <div class="passenger-email"><?php echo $ticket->pasajero_email; ?></div>
    </div>
    
    <!-- Información Adicional -->
    <div class="ticket-info">
        <div class="info-section">
            <div class="section-title">DETALLES DEL TICKET</div>
            <div class="info-row">
                <span class="info-label">Fecha de Compra:</span>
                <span class="info-value"><?php echo date('d/m/Y H:i', strtotime($ticket->fecha_compra)); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Código:</span>
                <span class="info-value"><?php echo $ticket->codigo_ticket; ?></span>
            </div>
        </div>
        
        <div class="info-section">
            <div class="section-title">CONDICIONES</div>
            <div class="info-row">
                <span class="info-label">Presentar:</span>
                <span class="info-value">Documento de identidad</span>
            </div>
            <div class="info-row">
                <span class="info-label">Llegar:</span>
                <span class="info-value">15 min antes</span>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="ticket-footer">
        <div><strong>FlotaPro</strong> - Sistema de Gestión de Flota</div>
        <div>Este ticket es válido solo para la fecha y viaje especificados</div>
        <div>Para consultas: contacto@flotapro.com</div>
        <div>Impreso el: <?php echo date('d/m/Y H:i:s'); ?></div>
    </div>
    
    <script>
        // Auto-print cuando se abre la página (opcional)
        // window.onload = function() {
        //     window.print();
        // };
        
        // Detectar si es impresión
        window.addEventListener('beforeprint', function() {
            console.log('Iniciando impresión...');
        });
        
        window.addEventListener('afterprint', function() {
            console.log('Impresión completada');
        });
    </script>
</body>
</html>
