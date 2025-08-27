-- Consultas SQL útiles para la flota de buses
-- Usar estas consultas en lugar de la vista que no se puede crear en InfinityFree

-- =====================================================
-- CONSULTA 1: Viajes completos con todos los detalles
-- =====================================================
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

-- =====================================================
-- CONSULTA 2: Estadísticas de la flota
-- =====================================================
SELECT 
    (SELECT COUNT(*) FROM buses WHERE estado = 'activo') as buses_activos,
    (SELECT COUNT(*) FROM conductores WHERE estado = 'activo') as conductores_activos,
    (SELECT COUNT(*) FROM rutas WHERE estado = 'activo') as rutas_activas,
    (SELECT COUNT(*) FROM viajes WHERE estado = 'completado') as viajes_completados,
    (SELECT COUNT(*) FROM viajes WHERE estado = 'en_curso') as viajes_en_curso,
    (SELECT COUNT(*) FROM viajes WHERE estado = 'programado') as viajes_programados;

-- =====================================================
-- CONSULTA 3: Buses disponibles para viajes
-- =====================================================
SELECT 
    id,
    placa,
    marca,
    modelo,
    capacidad,
    estado
FROM buses 
WHERE estado = 'activo'
ORDER BY marca, modelo;

-- =====================================================
-- CONSULTA 4: Conductores disponibles
-- =====================================================
SELECT 
    id,
    nombre,
    licencia,
    telefono,
    email,
    estado
FROM conductores 
WHERE estado = 'activo'
ORDER BY nombre;

-- =====================================================
-- CONSULTA 5: Rutas activas
-- =====================================================
SELECT 
    id,
    nombre,
    origen,
    destino,
    distancia,
    tiempo_estimado
FROM rutas 
WHERE estado = 'activo'
ORDER BY nombre;

-- =====================================================
-- CONSULTA 6: Viajes del día actual
-- =====================================================
SELECT 
    v.id,
    v.fecha_salida,
    v.fecha_llegada,
    v.estado,
    b.placa as bus_placa,
    c.nombre as conductor_nombre,
    r.nombre as ruta_nombre
FROM viajes v
JOIN buses b ON v.bus_id = b.id
JOIN conductores c ON v.conductor_id = c.id
JOIN rutas r ON v.ruta_id = r.id
WHERE DATE(v.fecha_salida) = CURDATE()
ORDER BY v.fecha_salida;

-- =====================================================
-- CONSULTA 7: Detalles de un viaje específico
-- =====================================================
-- Cambia el número 1 por el ID del viaje que quieras consultar
SELECT 
    vd.orden,
    vd.parada,
    vd.hora_programada,
    vd.hora_real,
    vd.pasajeros_suben,
    vd.pasajeros_bajan,
    vd.observaciones
FROM viajes_detalles vd
WHERE vd.viaje_id = 1
ORDER BY vd.orden;

-- =====================================================
-- CONSULTA 8: Buses en mantenimiento
-- =====================================================
SELECT 
    id,
    placa,
    marca,
    modelo,
    anio,
    capacidad
FROM buses 
WHERE estado = 'mantenimiento'
ORDER BY marca, modelo;

-- =====================================================
-- CONSULTA 9: Conductores suspendidos
-- =====================================================
SELECT 
    id,
    nombre,
    licencia,
    telefono,
    email
FROM conductores 
WHERE estado = 'suspendido'
ORDER BY nombre;

-- =====================================================
-- CONSULTA 10: Resumen de pasajeros por viaje
-- =====================================================
SELECT 
    v.id as viaje_id,
    r.nombre as ruta,
    SUM(vd.pasajeros_suben) as total_suben,
    SUM(vd.pasajeros_bajan) as total_bajan,
    (SUM(vd.pasajeros_suben) - SUM(vd.pasajeros_bajan)) as pasajeros_actuales
FROM viajes v
JOIN rutas r ON v.ruta_id = r.id
LEFT JOIN viajes_detalles vd ON v.id = vd.viaje_id
GROUP BY v.id, r.nombre
ORDER BY v.fecha_salida DESC;
