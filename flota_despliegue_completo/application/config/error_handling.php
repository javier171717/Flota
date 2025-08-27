<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Configuración de Manejo de Errores
|--------------------------------------------------------------------------
| Este archivo contiene configuraciones para mejorar el manejo de errores
| y evitar HTTP 500 en el servidor remoto
|
*/

// Configuración de logging de errores
$config['log_threshold'] = 4; // Log todos los errores
$config['log_file_permissions'] = 0644;
$config['log_file_extension'] = '';

// Configuración de manejo de excepciones
$config['exception_handler'] = TRUE;

// Configuración de timeout para operaciones de base de datos
$config['db_debug'] = FALSE; // Desactivar debug en producción
$config['db_query_timeout'] = 30; // Timeout de 30 segundos

// Configuración de sesiones
$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = NULL;
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;

// Configuración de cookies
$config['cookie_prefix'] = '';
$config['cookie_domain'] = '';
$config['cookie_path'] = '/';
$config['cookie_secure'] = FALSE;
$config['cookie_httponly'] = FALSE;

// Configuración de seguridad
$config['csrf_protection'] = FALSE; // Desactivar CSRF para evitar problemas
$config['csrf_token_name'] = 'csrf_token';
$config['csrf_cookie_name'] = 'csrf_cookie';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;
$config['csrf_exclude_uris'] = array();

// Configuración de compresión
$config['compress_output'] = FALSE; // Desactivar compresión para evitar problemas

// Configuración de caché
$config['cache_default_expires'] = 7200;

// Configuración de headers
$config['headers'] = array(
    'X-Content-Type-Options' => 'nosniff',
    'X-Frame-Options' => 'DENY',
    'X-XSS-Protection' => '1; mode=block'
);

// Configuración de manejo de errores personalizado
$config['error_handling'] = array(
    'show_errors' => FALSE, // No mostrar errores en producción
    'log_errors' => TRUE,   // Log de errores activado
    'error_reporting' => E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT
);

// Configuración de base de datos para servidor remoto
$config['database_remote'] = array(
    'persistent' => FALSE,      // No usar conexiones persistentes
    'compress' => FALSE,        // No usar compresión
    'strict_on' => FALSE,       // No ser estricto con SQL
    'init_commands' => array(
        'SET NAMES utf8',
        'SET sql_mode = "NO_AUTO_VALUE_ON_ZERO"'
    )
);

// Configuración de timeout para operaciones
$config['timeouts'] = array(
    'database' => 30,           // 30 segundos para DB
    'session' => 7200,          // 2 horas para sesión
    'redirect' => 5,            // 5 segundos para redirección
    'ajax' => 30                // 30 segundos para AJAX
);

// Configuración de manejo de memoria
$config['memory_limit'] = '256M';  // Límite de memoria
$config['max_execution_time'] = 300; // 5 minutos máximo de ejecución

// Configuración de logging específico para registro
$config['registration_logging'] = array(
    'log_success' => TRUE,      // Log de registros exitosos
    'log_errors' => TRUE,       // Log de errores de registro
    'log_validation' => TRUE,   // Log de errores de validación
    'log_database' => TRUE      // Log de operaciones de base de datos
);

// Configuración de redirección segura
$config['safe_redirect'] = array(
    'use_headers' => TRUE,      // Usar headers para redirección
    'fallback_js' => TRUE,     // Fallback a JavaScript si headers fallan
    'timeout' => 5000,         // 5 segundos de timeout
    'max_redirects' => 3       // Máximo 3 redirecciones
);
