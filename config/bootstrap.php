<?php

use App\Handler\HttpErrorHandler;
use DI\ContainerBuilder;
use Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

// Set up settings
$containerBuilder->addDefinitions(__DIR__ . '/container.php');

// Build PHP-DI Container instance
$container = $containerBuilder->build();

// Create App instance
$app = $container->get(App::class);
$callableResolver = $app->getCallableResolver();
$responseFactory = $app->getResponseFactory();

// Set custom error handler

/** @var bool $displayErrorDetails */
$displayErrorDetails = $container->get('settings')['error']['display_error_details'];

// Create Error Handler
$errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, false, false);
$errorMiddleware->setDefaultErrorHandler($errorHandler);

// Add new signature
/*
$app->add(new Tuupola\Middleware\JwtAuthentication([
    "path" => ["/usuarios"],
    "secret" => "supersecretkeyyoushouldnotcommittogithub",
    "algorithm" => ["HS256"],
    "error" => function ($response, $arguments) {
        $data["status"] = "error";
        $data["message"] = $arguments["message"];
        return $response
            ->withHeader("Content-Type", "application/json")
            ->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
]));*/

// Register routes
(require __DIR__ . '/routes.php')($app);

// Register middleware
(require __DIR__ . '/middleware.php')($app);

return $app;