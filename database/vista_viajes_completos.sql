-- Crear vista para facilitar consultas de viajes con detalles
-- Este archivo se ejecuta por separado en phpMyAdmin

CREATE OR REPLACE VIEW viajes_completos AS
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
