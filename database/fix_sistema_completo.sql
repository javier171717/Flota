-- SCRIPT COMPLETO PARA SOLUCIONAR PROBLEMAS DEL SISTEMA DE TICKETS
-- Ejecutar en la base de datos flota_db

USE flota_db;

-- =====================================================
-- PASO 1: ACTUALIZAR TABLA DE USUARIOS
-- =====================================================

-- Agregar campo teléfono si no existe
ALTER TABLE usuarios ADD COLUMN IF NOT EXISTS telefono VARCHAR(20) NULL AFTER password;

-- Modificar la columna rol para incluir 'pasajero'
ALTER TABLE usuarios MODIFY COLUMN rol ENUM('admin', 'operador', 'conductor', 'pasajero') DEFAULT 'operador';

-- Verificar que se aplicó el cambio
SELECT 'Tabla usuarios actualizada correctamente' as mensaje;
DESCRIBE usuarios;

-- =====================================================
-- PASO 2: CREAR TABLA DE TICKETS
-- =====================================================

-- Eliminar tabla si existe (para recrear limpia)
DROP TABLE IF EXISTS tickets;

-- Crear tabla de tickets
CREATE TABLE tickets (
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
DROP TRIGGER IF EXISTS actualizar_fecha_tickets//
CREATE TRIGGER actualizar_fecha_tickets
    BEFORE UPDATE ON tickets
    FOR EACH ROW
    SET NEW.fecha_actualizacion = CURRENT_TIMESTAMP//
DELIMITER ;

SELECT 'Tabla de tickets creada exitosamente' as mensaje;

-- =====================================================
-- PASO 3: VERIFICAR QUE EXISTEN DATOS BÁSICOS
-- =====================================================

-- Verificar que existen buses
SELECT COUNT(*) as total_buses FROM buses;
SELECT COUNT(*) as total_rutas FROM rutas;
SELECT COUNT(*) as total_conductores FROM conductores;
SELECT COUNT(*) as total_viajes FROM viajes;

-- =====================================================
-- PASO 4: CREAR DATOS DE PRUEBA SI NO EXISTEN
-- =====================================================

-- Insertar ruta de prueba si no existe
INSERT IGNORE INTO rutas (nombre, origen, destino, distancia, tiempo_estimado, estado) 
VALUES ('Ruta de Prueba', 'Quito', 'Guayaquil', 420.5, '8 horas', 'activo');

-- Insertar bus de prueba si no existe
INSERT IGNORE INTO buses (placa, marca, modelo, anio, capacidad, estado) 
VALUES ('PRU-001', 'Mercedes-Benz', 'Sprinter', 2023, 25, 'activo');

-- Insertar conductor de prueba si no existe
INSERT IGNORE INTO conductores (nombre, licencia, telefono, email, estado) 
VALUES ('Conductor Prueba', 'LIC-001', '0991234567', 'conductor@test.com', 'activo');

-- Insertar viaje de prueba si no existe
INSERT IGNORE INTO viajes (bus_id, conductor_id, ruta_id, fecha_salida, estado) 
SELECT 
    (SELECT id FROM buses WHERE placa = 'PRU-001' LIMIT 1),
    (SELECT id FROM conductores WHERE licencia = 'LIC-001' LIMIT 1),
    (SELECT id FROM rutas WHERE nombre = 'Ruta de Prueba' LIMIT 1),
    DATE_ADD(NOW(), INTERVAL 2 DAY),
    'programado'
WHERE EXISTS (SELECT 1 FROM buses WHERE placa = 'PRU-001')
  AND EXISTS (SELECT 1 FROM conductores WHERE licencia = 'LIC-001')
  AND EXISTS (SELECT 1 FROM rutas WHERE nombre = 'Ruta de Prueba');

-- =====================================================
-- PASO 5: VERIFICAR FINAL
-- =====================================================

SELECT 'Sistema actualizado correctamente' as mensaje;

-- Mostrar viajes disponibles para tickets
SELECT 
    v.id,
    v.fecha_salida,
    r.origen,
    r.destino,
    r.distancia,
    b.placa,
    b.capacidad,
    v.estado
FROM viajes v
JOIN rutas r ON v.ruta_id = r.id
JOIN buses b ON v.bus_id = b.id
WHERE v.estado = 'programado'
  AND v.fecha_salida > NOW()
ORDER BY v.fecha_salida ASC;

-- Mostrar roles disponibles
SELECT DISTINCT rol FROM usuarios;
