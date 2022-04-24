<?php

# Colocar 0 em produção
error_reporting(E_ALL);

# Colocar 0 em produção
ini_set('display_errors', '1');

// Timezone
date_default_timezone_set('America/Sao_Paulo');

# Configurações
$settings = [
    'displayErrorDetails' => true, // set to false in production
    'addContentLengthHeader' => false, // Allow the web server to send the content-length header
    'determineRouteBeforeAppMiddleware' => true, //Para o Slim iniciar as Rotas antes do Middleware
    
    // Path settings
    'root' => dirname(__DIR__),

    // Error Handling Middleware settings
    'error' => [

        // Should be set to false in production
        'display_error_details' => true,

        // Parameter is passed to the default ErrorHandler
        // View in rendered output by enabling the "displayErrorDetails" setting.
        // For the console and unit tests we also disable it
        'log_errors' => true,

        // Display error details in error log
        'log_error_details' => true,
    ],

    // Database settings
    'db' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'username' => 'root',
        'database' => 'notes_api',
        'password' => 'root',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'flags' => [
            // Turn off persistent connections
            PDO::ATTR_PERSISTENT => false,
            // Enable exceptions
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Emulate prepared statements
            PDO::ATTR_EMULATE_PREPARES => true,
            // Set default fetch mode to array
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // Set character set
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
        ],
    ],
    
    'jwt' => [
        'secret' => 'supersecretkeyyoushouldnotcommittogithub'
    ]
];

return $settings;
