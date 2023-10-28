<?php

use Illuminate\Database\Capsule\Manager;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

date_default_timezone_set('Europe/Paris');

$app = AppFactory::create();

$twig = Twig::create(__DIR__ . '/../src/templates', ['cache' => false]);
$app->add(TwigMiddleware::create($app, $twig));


// Ajoute le routing middleware
$app->addRoutingMiddleware();

// Ajoute le middleware d'erreurs
$app->addErrorMiddleware(true, false, false);

// Définit le chemin de base
$app->setBasePath('');

// Initialise la session
session_start();

return $app;
