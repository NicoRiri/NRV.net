<?php

use Illuminate\Database\Capsule\Manager;
use pizzashop\shop\domain\service\Eloquent\Eloquent;
use Slim\Factory\AppFactory;

date_default_timezone_set('Europe/Paris');

$app = AppFactory::create();


// Ajoute le routing middleware
$app->addRoutingMiddleware();

// Ajoute le middleware d'erreurs
$app->addErrorMiddleware(true, false, false);

// Définit le chemin de base
$app->setBasePath('');

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$db = new Manager();
$db->addConnection(parse_ini_file(__DIR__ . '/../config/db.ini'));
$db->setAsGlobal();
$db->bootEloquent();

// Initialise la session
session_start();

return $app;
