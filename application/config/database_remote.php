<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Configuración de Base de Datos para Servidor Remoto
|--------------------------------------------------------------------------
| Este archivo contiene configuraciones optimizadas para servidores remotos
| como InfinityFree, que suelen tener limitaciones específicas
|
*/

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'dsn'          => '',
    'hostname'     => 'localhost', // Cambiar por tu host de InfinityFree
    'username'     => '', // Cambiar por tu usuario de InfinityFree
    'password'     => '', // Cambiar por tu contraseña de InfinityFree
    'database'     => '', // Cambiar por tu nombre de base de datos
    'dbdriver'     => 'mysqli',
    'dbprefix'     => '',
    'pconnect'     => FALSE, // Conexiones persistentes desactivadas
    'db_debug'     => FALSE, // Debug desactivado en producción
    'cache_on'     => FALSE,
    'cachedir'     => '',
    'char_set'     => 'utf8',
    'dbcollat'     => 'utf8_general_ci',
    'swap_pre'     => '',
    'encrypt'      => FALSE,
    'compress'     => FALSE, // Compresión desactivada
    'stricton'     => FALSE, // Modo estricto desactivado
    'failover'     => array(),
    'save_queries' => FALSE,
    
    // Configuraciones específicas para servidores remotos
    'autoinit'     => TRUE,
    'stricton'     => FALSE,
    'init_commands' => array(
        'SET NAMES utf8',
        'SET sql_mode = "NO_AUTO_VALUE_ON_ZERO"',
        'SET wait_timeout = 300',
        'SET interactive_timeout = 300'
    ),
    
    // Timeouts optimizados para servidores remotos
    'connect_timeout' => 30,
    'read_timeout'    => 30,
    'write_timeout'   => 30
);

/*
|--------------------------------------------------------------------------
| Configuración de Sesiones para Servidor Remoto
|--------------------------------------------------------------------------
*/

$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = APPPATH . 'cache/sessions/';
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;

/*
|--------------------------------------------------------------------------
| Configuración de Logging para Servidor Remoto
|--------------------------------------------------------------------------
*/

$config['log_threshold'] = 1; // Solo errores críticos
$config['log_file_permissions'] = 0644;
$config['log_file_extension'] = '';

/*
|--------------------------------------------------------------------------
| Configuración de Seguridad para Servidor Remoto
|--------------------------------------------------------------------------
*/

$config['csrf_protection'] = FALSE; // CSRF desactivado para evitar problemas
$config['csrf_token_name'] = 'csrf_token';
$config['csrf_cookie_name'] = 'csrf_cookie';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;
$config['csrf_exclude_uris'] = array();

/*
|--------------------------------------------------------------------------
| Configuración de Performance para Servidor Remoto
|--------------------------------------------------------------------------
*/

$config['compress_output'] = FALSE; // Compresión desactivada
$config['cache_default_expires'] = 7200;
$config['cache_query_string'] = FALSE;

/*
|--------------------------------------------------------------------------
| Configuración de Headers para Servidor Remoto
|--------------------------------------------------------------------------
*/

$config['headers'] = array(
    'X-Content-Type-Options' => 'nosniff',
    'X-Frame-Options' => 'DENY',
    'X-XSS-Protection' => '1; mode=block'
);

/*
|--------------------------------------------------------------------------
| Configuración de Manejo de Errores para Servidor Remoto
|--------------------------------------------------------------------------
*/

$config['error_handling'] = array(
    'show_errors' => FALSE, // No mostrar errores en producción
    'log_errors' => TRUE,   // Log de errores activado
    'error_reporting' => E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT
);

/*
|--------------------------------------------------------------------------
| Configuración de Timeouts para Servidor Remoto
|--------------------------------------------------------------------------
*/

$config['timeouts'] = array(
    'database' => 30,           // 30 segundos para DB
    'session' => 7200,          // 2 horas para sesión
    'redirect' => 5,            // 5 segundos para redirección
    'ajax' => 30                // 30 segundos para AJAX
);

/*
|--------------------------------------------------------------------------
| Configuración de Memoria para Servidor Remoto
|--------------------------------------------------------------------------
*/

$config['memory_limit'] = '128M';  // Límite de memoria reducido
$config['max_execution_time'] = 120; // 2 minutos máximo de ejecución

/*
|--------------------------------------------------------------------------
| Configuración de Base de Datos para InfinityFree
|--------------------------------------------------------------------------
*/

$config['infinityfree'] = array(
    'persistent' => FALSE,      // No usar conexiones persistentes
    'compress' => FALSE,        // No usar compresión
    'strict_on' => FALSE,       // No ser estricto con SQL
    'init_commands' => array(
        'SET NAMES utf8',
        'SET sql_mode = "NO_AUTO_VALUE_ON_ZERO"',
        'SET wait_timeout = 300',
        'SET interactive_timeout = 300',
        'SET max_allowed_packet = 16777216'
    ),
    'connect_timeout' => 30,    // Timeout de conexión
    'read_timeout' => 30,       // Timeout de lectura
    'write_timeout' => 30       // Timeout de escritura
);
