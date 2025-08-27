-- Script SQL para crear la tabla de tickets del sistema
-- Ejecutar en la base de datos flota_db

USE flota_db;

-- Tabla de tickets
CREATE TABLE IF NOT EXISTS tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_ticket VARCHAR(50) UNIQUE NOT NULL,
    pasajero_id INT NOT NULL,
    viaje_id INT NOT NULL,
    asiento VARCHAR(10) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    estado ENUM('reservado', 'confirmado', 'cancelado', 'utilizado') DEFAULT 'confirmado',
    fecha_compra TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_viaje DATETIME NOT NULL,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Claves foráneas
    FOREIGN KEY (pasajero_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (viaje_id) REFERENCES viajes(id) ON DELETE CASCADE,
    
    -- Índices para mejorar rendimiento
    INDEX idx_codigo_ticket (codigo_ticket),
    INDEX idx_pasajero_id (pasajero_id),
    INDEX idx_viaje_id (viaje_id),
    INDEX idx_estado (estado),
    INDEX idx_fecha_viaje (fecha_viaje),
    INDEX idx_fecha_compra (fecha_compra),
    
    -- Restricción única para evitar duplicados de asiento en el mismo viaje
    UNIQUE KEY unique_viaje_asiento (viaje_id, asiento, estado)
);

-- Crear trigger para actualizar fecha de actualización
DELIMITER //
CREATE TRIGGER IF NOT EXISTS actualizar_fecha_tickets
    BEFORE UPDATE ON tickets
    FOR EACH ROW
    SET NEW.fecha_actualizacion = CURRENT_TIMESTAMP;
//
DELIMITER ;

-- Insertar datos de ejemplo para tickets (opcional)
-- INSERT INTO tickets (codigo_ticket, pasajero_id, viaje_id, asiento, precio, estado, fecha_viaje) VALUES
-- ('TK123456789012345', 1, 1, '1', 25.50, 'confirmado', '2024-01-15 08:00:00'),
-- ('TK123456789012346', 2, 1, '2', 25.50, 'confirmado', '2024-01-15 08:00:00');

-- Mostrar mensaje de confirmación
SELECT 'Tabla de tickets creada exitosamente' as mensaje;
