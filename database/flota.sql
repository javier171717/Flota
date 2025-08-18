-- Script SQL para crear la base de datos de la flota de buses
-- Base de datos normalizada con relaciones maestro-detalle

-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS flota_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE flota_db;

-- Tabla de buses (entidad principal)
CREATE TABLE buses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    placa VARCHAR(20) UNIQUE NOT NULL,
    marca VARCHAR(50) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    anio INT NOT NULL,
    capacidad INT NOT NULL,
    estado ENUM('activo', 'inactivo', 'mantenimiento') DEFAULT 'activo',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de conductores (entidad principal)
CREATE TABLE conductores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    licencia VARCHAR(50) UNIQUE NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    estado ENUM('activo', 'inactivo', 'suspendido') DEFAULT 'activo',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de rutas (entidad principal)
CREATE TABLE rutas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    origen VARCHAR(100) NOT NULL,
    destino VARCHAR(100) NOT NULL,
    distancia DECIMAL(8,2) NOT NULL,
    tiempo_estimado VARCHAR(20) NOT NULL,
    estado ENUM('activo', 'inactivo', 'mantenimiento') DEFAULT 'activo',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de viajes (entidad maestro)
CREATE TABLE viajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bus_id INT NOT NULL,
    conductor_id INT NOT NULL,
    ruta_id INT NOT NULL,
    fecha_salida DATETIME NOT NULL,
    fecha_llegada DATETIME NULL,
    estado ENUM('programado', 'en_curso', 'completado', 'cancelado') DEFAULT 'programado',
    observaciones TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Claves foráneas
    FOREIGN KEY (bus_id) REFERENCES buses(id) ON DELETE RESTRICT,
    FOREIGN KEY (conductor_id) REFERENCES conductores(id) ON DELETE RESTRICT,
    FOREIGN KEY (ruta_id) REFERENCES rutas(id) ON DELETE RESTRICT,
    
    -- Índices para mejorar rendimiento
    INDEX idx_bus_id (bus_id),
    INDEX idx_conductor_id (conductor_id),
    INDEX idx_ruta_id (ruta_id),
    INDEX idx_fecha_salida (fecha_salida),
    INDEX idx_estado (estado)
);

-- Tabla de detalles de viajes (entidad detalle - relación maestro-detalle)
CREATE TABLE viajes_detalles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    viaje_id INT NOT NULL,
    orden INT NOT NULL,
    parada VARCHAR(100) NOT NULL,
    hora_programada TIME NOT NULL,
    hora_real TIME NULL,
    pasajeros_suben INT DEFAULT 0,
    pasajeros_bajan INT DEFAULT 0,
    observaciones TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Clave foránea
    FOREIGN KEY (viaje_id) REFERENCES viajes(id) ON DELETE CASCADE,
    
    -- Índices
    INDEX idx_viaje_id (viaje_id),
    INDEX idx_orden (orden),
    
    -- Restricción única para evitar duplicados de orden en el mismo viaje
    UNIQUE KEY unique_viaje_orden (viaje_id, orden)
);

-- Insertar datos de ejemplo para buses
INSERT INTO buses (placa, marca, modelo, anio, capacidad, estado) VALUES
('ABC-123', 'Mercedes-Benz', 'Sprinter', 2020, 20, 'activo'),
('XYZ-789', 'Volkswagen', 'Crafter', 2019, 25, 'activo'),
('DEF-456', 'Ford', 'Transit', 2021, 18, 'activo'),
('GHI-789', 'Fiat', 'Ducato', 2018, 22, 'mantenimiento');

-- Insertar datos de ejemplo para conductores
INSERT INTO conductores (nombre, licencia, telefono, email, estado) VALUES
('Juan Pérez González', 'LIC-001-2020', '555-0101', 'juan.perez@flota.com', 'activo'),
('María García López', 'LIC-002-2019', '555-0102', 'maria.garcia@flota.com', 'activo'),
('Carlos Rodríguez Martín', 'LIC-003-2021', '555-0103', 'carlos.rodriguez@flota.com', 'activo'),
('Ana Martínez Silva', 'LIC-004-2018', '555-0104', 'ana.martinez@flota.com', 'suspendido');

-- Insertar datos de ejemplo para rutas
INSERT INTO rutas (nombre, origen, destino, distancia, tiempo_estimado, estado) VALUES
('Centro - Norte', 'Centro Comercial', 'Zona Norte', 15.5, '45 min', 'activo'),
('Este - Oeste', 'Terminal Este', 'Terminal Oeste', 22.3, '1h 15m', 'activo'),
('Sur - Centro', 'Zona Sur', 'Centro Histórico', 18.7, '55 min', 'activo'),
('Circular Norte', 'Terminal Norte', 'Terminal Norte', 35.2, '2h 30m', 'activo');

-- Insertar datos de ejemplo para viajes
INSERT INTO viajes (bus_id, conductor_id, ruta_id, fecha_salida, fecha_llegada, estado) VALUES
(1, 1, 1, '2024-01-15 08:00:00', '2024-01-15 08:45:00', 'completado'),
(2, 2, 2, '2024-01-15 09:00:00', '2024-01-15 10:15:00', 'completado'),
(3, 3, 3, '2024-01-15 10:00:00', NULL, 'en_curso'),
(1, 1, 4, '2024-01-15 14:00:00', NULL, 'programado');

-- Insertar datos de ejemplo para detalles de viajes (relación maestro-detalle)
INSERT INTO viajes_detalles (viaje_id, orden, parada, hora_programada, hora_real, pasajeros_suben, pasajeros_bajan) VALUES
-- Detalles del viaje 1 (Centro - Norte)
(1, 1, 'Centro Comercial', '08:00:00', '08:00:00', 15, 0),
(1, 2, 'Plaza Mayor', '08:15:00', '08:16:00', 8, 3),
(1, 3, 'Parque Central', '08:30:00', '08:31:00', 5, 7),
(1, 4, 'Zona Norte', '08:45:00', '08:45:00', 0, 18),

-- Detalles del viaje 2 (Este - Oeste)
(2, 1, 'Terminal Este', '09:00:00', '09:00:00', 20, 0),
(2, 2, 'Avenida Principal', '09:20:00', '09:22:00', 12, 5),
(2, 3, 'Centro de Negocios', '09:45:00', '09:47:00', 8, 10),
(2, 4, 'Terminal Oeste', '10:15:00', '10:15:00', 0, 25),

-- Detalles del viaje 3 (Sur - Centro)
(3, 1, 'Zona Sur', '10:00:00', '10:00:00', 18, 0),
(3, 2, 'Mercado Sur', '10:20:00', '10:21:00', 10, 4),
(3, 3, 'Hospital General', '10:40:00', '10:42:00', 6, 8),
(3, 4, 'Centro Histórico', '10:55:00', NULL, 0, 22);

-- Crear vista para facilitar consultas de viajes con detalles
CREATE VIEW viajes_completos AS
SELECT 
    v.id,
    v.fecha_salida,
    v.fecha_llegada,
    v.estado,
    b.placa as bus_placa,
    b.marca as bus_marca,
    b.modelo as bus_modelo,
    c.nombre as conductor_nombre,
    c.licencia as conductor_licencia,
    r.nombre as ruta_nombre,
    r.origen,
    r.destino,
    r.distancia,
    r.tiempo_estimado,
    COUNT(vd.id) as total_paradas,
    SUM(vd.pasajeros_suben) as total_pasajeros_suben,
    SUM(vd.pasajeros_bajan) as total_pasajeros_bajan
FROM viajes v
JOIN buses b ON v.bus_id = b.id
JOIN conductores c ON v.conductor_id = c.id
JOIN rutas r ON v.ruta_id = r.id
LEFT JOIN viajes_detalles vd ON v.id = vd.viaje_id
GROUP BY v.id;

-- Crear procedimiento almacenado para obtener estadísticas
DELIMITER //
CREATE PROCEDURE ObtenerEstadisticasFlota()
BEGIN
    SELECT 
        (SELECT COUNT(*) FROM buses WHERE estado = 'activo') as buses_activos,
        (SELECT COUNT(*) FROM conductores WHERE estado = 'activo') as conductores_activos,
        (SELECT COUNT(*) FROM rutas WHERE estado = 'activo') as rutas_activas,
        (SELECT COUNT(*) FROM viajes WHERE estado = 'completado') as viajes_completados,
        (SELECT COUNT(*) FROM viajes WHERE estado = 'en_curso') as viajes_en_curso,
        (SELECT COUNT(*) FROM viajes WHERE estado = 'programado') as viajes_programados;
END //
DELIMITER ;

-- Crear trigger para actualizar fecha de actualización
DELIMITER //
CREATE TRIGGER actualizar_fecha_buses
    BEFORE UPDATE ON buses
    FOR EACH ROW
    SET NEW.fecha_actualizacion = CURRENT_TIMESTAMP;
//

CREATE TRIGGER actualizar_fecha_conductores
    BEFORE UPDATE ON conductores
    FOR EACH ROW
    SET NEW.fecha_actualizacion = CURRENT_TIMESTAMP;
//

CREATE TRIGGER actualizar_fecha_rutas
    BEFORE UPDATE ON rutas
    FOR EACH ROW
    SET NEW.fecha_actualizacion = CURRENT_TIMESTAMP;
//

CREATE TRIGGER actualizar_fecha_viajes
    BEFORE UPDATE ON viajes
    FOR EACH ROW
    SET NEW.fecha_actualizacion = CURRENT_TIMESTAMP;
//
DELIMITER ;

-- Mostrar mensaje de confirmación
SELECT 'Base de datos de flota creada exitosamente' as mensaje;
