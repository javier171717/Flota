-- Script para corregir problemas de base de datos en la tabla conductores

-- 1. Primero, actualizar todos los emails vacíos a NULL
UPDATE conductores SET email = NULL WHERE email = '' OR email = ' ';

-- 2. Agregar restricción para evitar emails duplicados (solo si no existe)
-- Esto asegura que no haya emails duplicados, pero permite NULLs
ALTER TABLE conductores ADD UNIQUE INDEX idx_email_unique (email);

-- 3. Verificar que no haya emails duplicados
SELECT email, COUNT(*) as cantidad 
FROM conductores 
WHERE email IS NOT NULL 
GROUP BY email 
HAVING COUNT(*) > 1;

-- 4. Si hay emails duplicados, mantener solo uno y poner NULL en los demás
-- (Ejecutar solo si el paso 3 muestra duplicados)
-- UPDATE conductores c1 
-- JOIN (
--     SELECT email, MIN(id) as min_id 
--     FROM conductores 
--     WHERE email IS NOT NULL 
--     GROUP BY email 
--     HAVING COUNT(*) > 1
-- ) c2 ON c1.email = c2.email AND c1.id != c2.min_id
-- SET c1.email = NULL;
