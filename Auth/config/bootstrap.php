<?php

use DI\ContainerBuilder;
use Illuminate\Database\Capsule\Manager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Slim\Factory\AppFactory;
use Tuupola\Middleware\CorsMiddleware;


date_default_timezone_set('Europe/Paris');

$containerBuilder = new ContainerBuilder();


$app = AppFactory::create();

// Ajoute le routing middleware
$app->addRoutingMiddleware();

// Ajoute le middleware d'erreurs
$app->addErrorMiddleware(true, false, false);

// Définit le chemin de base
$app->setBasePath('');

$db = new Manager();
$db->addConnection(parse_ini_file(__DIR__ . '/../config/user.db.ini'));
$db->setAsGlobal();
$db->bootEloquent();

// Initialise la session
session_start();

return $app;