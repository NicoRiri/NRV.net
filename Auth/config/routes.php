<?php
declare(strict_types=1);

use NRV\auth\api\actions\RefreshAction;
use NRV\auth\api\actions\SignInAction;
use NRV\auth\api\actions\ValidateAction;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpNotFoundException;

return function( \Slim\App $app):void {

    $app->post('/api/users/signin[/]', SignInAction::class)
        ->setName('signin');
    $app->post('/api/users/inscription[/]', \NRV\auth\api\actions\InscriptionAction::class)
        ->setName('inscription');
    $app->get('/api/users/validate[/]', ValidateAction::class)
        ->setName('valider');
    $app->post("/api/users/refresh[/]", RefreshAction::class)
        ->setName('refresh');

    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
	    ->withHeader('Access-Control-Allow-Credentials', 'true');
    });
};
