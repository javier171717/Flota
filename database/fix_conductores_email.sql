-- Script para corregir el campo email en la tabla conductores
-- Ejecutar en la base de datos flota_db

USE flota_db;

-- Modificar la tabla conductores para permitir emails opcionales
ALTER TABLE conductores MODIFY COLUMN email VARCHAR(100) UNIQUE NULL;

-- Verificar el cambio
DESCRIBE conductores;

-- Mostrar mensaje de confirmación
SELECT 'Campo email modificado exitosamente para permitir valores NULL' as mensaje;
