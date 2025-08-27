-- Script para crear la tabla de usuarios en InfinityFree
-- Sistema de autenticación para la flota de buses

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'operador', 'conductor') DEFAULT 'operador',
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_ultimo_login TIMESTAMP NULL,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar usuario administrador por defecto
-- Password: admin123 (hasheado con password_hash)
INSERT IGNORE INTO usuarios (nombre, email, password, rol, estado) VALUES
('Administrador', 'admin@flota.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'activo');

-- Crear trigger para actualizar fecha de actualización
DELIMITER //
CREATE TRIGGER actualizar_fecha_usuarios
    BEFORE UPDATE ON usuarios
    FOR EACH ROW
    SET NEW.fecha_actualizacion = CURRENT_TIMESTAMP;
//
DELIMITER ;

-- Mostrar mensaje de confirmación
SELECT 'Tabla de usuarios creada exitosamente en InfinityFree' as mensaje;
