# Sistema de Gestión de Flota de Buses

Sistema web desarrollado en **CodeIgniter 3** para la gestión integral de una flota de buses, implementando el patrón **MVC** y relaciones **maestro-detalle**.

## 🚌 Características Principales

- **Framework**: CodeIgniter 3
- **Base de Datos**: MySQL (normalizada)
- **Patrón**: MVC (Modelo-Vista-Controlador)
- **Relación**: Maestro-Detalle (Viajes → Detalles de Paradas)
- **Interfaz**: Bootstrap 5 + Font Awesome
- **Servidor**: XAMPP

## 🏗️ Estructura del Proyecto

```
Flota/
├── application/
│   ├── config/
│   │   ├── autoload.php      # Configuración de autoload
│   │   └── database.php      # Configuración de base de datos
│   ├── controllers/
│   │   └── Flota.php         # Controlador principal
│   ├── models/
│   │   ├── Buses_model.php      # Modelo de buses
│   │   ├── Conductores_model.php # Modelo de conductores
│   │   ├── Rutas_model.php      # Modelo de rutas
│   │   └── Viajes_model.php     # Modelo de viajes (maestro-detalle)
│   └── views/
│       ├── templates/
│       │   ├── header.php    # Template header
│       │   └── footer.php    # Template footer
│       └── flota/
│           ├── dashboard.php  # Dashboard principal
│           ├── buses/
│           │   └── index.php  # Gestión de buses
│           ├── conductores/
│           │   └── index.php  # Gestión de conductores
│           ├── rutas/
│           │   └── index.php  # Gestión de rutas
│           └── viajes/
│               └── index.php  # Gestión de viajes (maestro-detalle)
├── database/
│   └── flota.sql             # Script SQL de la base de datos
└── README.md                 # Este archivo
```

## 🗄️ Base de Datos

### Estructura Normalizada

1. **buses** - Información de los vehículos
2. **conductores** - Información de los conductores
3. **rutas** - Definición de las rutas disponibles
4. **viajes** - Registro de viajes (entidad maestro)
5. **viajes_detalles** - Detalles de paradas (entidad detalle)

### Relación Maestro-Detalle

- **Viajes** (maestro): Información general del viaje
- **Viajes_Detalles** (detalle): Paradas específicas con información de pasajeros

## 🚀 Instalación

### Requisitos Previos

- XAMPP instalado y funcionando
- PHP 7.4 o superior
- MySQL 5.7 o superior
- Navegador web moderno

### Pasos de Instalación

1. **Clonar/Descargar el proyecto**
   ```bash
   # Colocar en la carpeta htdocs de XAMPP
   C:\xampp\htdocs\Flota\
   ```

2. **Configurar la base de datos**
   - Abrir phpMyAdmin: `http://localhost/phpmyadmin`
   - Crear nueva base de datos llamada `flota_db`
   - Importar el archivo `database/flota.sql`

3. **Configurar la conexión a la base de datos**
   - Editar `application/config/database.php`
   - Actualizar credenciales:
   ```php
   'hostname' => 'localhost',
   'username' => 'root',        // Usuario por defecto de XAMPP
   'password' => '',            // Contraseña por defecto de XAMPP
   'database' => 'flota_db',
   ```

4. **Acceder a la aplicación**
   - URL: `http://localhost/Flota/`
   - La aplicación redirigirá automáticamente a `http://localhost/Flota/flota`

## 📱 Funcionalidades

### Dashboard Principal
- Estadísticas generales de la flota
- Contadores de buses, conductores, rutas y viajes
- Acceso rápido a todas las secciones

### Gestión de Buses
- CRUD completo de vehículos
- Información: placa, marca, modelo, año, capacidad, estado
- Estados: activo, inactivo, mantenimiento

### Gestión de Conductores
- CRUD completo de conductores
- Información: nombre, licencia, teléfono, email, estado
- Estados: activo, inactivo, suspendido

### Gestión de Rutas
- CRUD completo de rutas
- Información: nombre, origen, destino, distancia, tiempo estimado
- Estados: activo, inactivo, mantenimiento

### Gestión de Viajes (Maestro-Detalle)
- **Viaje (Maestro)**: bus, conductor, ruta, fechas, estado
- **Detalles (Detalle)**: paradas, horarios, pasajeros que suben/bajan
- Estados: programado, en curso, completado, cancelado
- Vista expandible de detalles por viaje

## 🔧 Configuración Adicional

### Autoload Configurado
```php
$autoload['libraries'] = array('database', 'session', 'form_validation');
$autoload['helper'] = array('url', 'form', 'html');
```

### Características de la Base de Datos
- Claves foráneas con restricciones apropiadas
- Índices para optimizar consultas
- Triggers para actualización automática de fechas
- Vista para consultas complejas
- Procedimiento almacenado para estadísticas

## 🎨 Interfaz de Usuario

- **Diseño Responsivo**: Adaptable a diferentes dispositivos
- **Bootstrap 5**: Framework CSS moderno y profesional
- **Font Awesome**: Iconos intuitivos para mejor UX
- **Sidebar de Navegación**: Acceso rápido a todas las secciones
- **Modales**: Formularios integrados sin recargar la página
- **Tablas Interactivas**: Con acciones de edición y eliminación

## 📊 Relación Maestro-Detalle Implementada

### Ejemplo de Uso
1. **Crear un Viaje** (maestro)
   - Seleccionar bus, conductor y ruta
   - Definir fecha y hora de salida
   - Establecer estado inicial

2. **Agregar Detalles** (detalle)
   - Definir paradas intermedias
   - Establecer horarios programados
   - Registrar pasajeros que suben/bajan en cada parada

3. **Visualización**
   - Lista principal de viajes
   - Detalles expandibles por viaje
   - Información consolidada de pasajeros

## 🚨 Notas Importantes

- **Seguridad**: Implementar autenticación de usuarios en producción
- **Validación**: Los formularios incluyen validación básica HTML5
- **Responsabilidad**: Implementar manejo de errores robusto
- **Backup**: Realizar respaldos regulares de la base de datos

## 🔮 Próximas Mejoras

- Sistema de autenticación y autorización
- Reportes y estadísticas avanzadas
- API REST para integración con aplicaciones móviles
- Sistema de notificaciones
- Dashboard con gráficos interactivos
- Exportación de datos a Excel/PDF

## 📞 Soporte

Para consultas o problemas técnicos, revisar:
1. Logs de error de CodeIgniter en `application/logs/`
2. Logs de MySQL en XAMPP
3. Configuración de la base de datos
4. Permisos de archivos y carpetas

## 📄 Licencia

Este proyecto es de uso educativo y demostrativo. Adaptar según necesidades específicas del negocio.

---

**Desarrollado con CodeIgniter 3, PHP, MySQL y Bootstrap 5**
