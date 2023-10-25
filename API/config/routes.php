<?php
declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

return function( \Slim\App $app):void {

    $app->post('/api/connexiontoken[/]', \NRV\api\actions\ConnexionTokenAction::class)
        ->setName('connexionToken');
    $app->post('/api/connexionbasic[/]', \NRV\api\actions\ConnexionBasicAction::class)
        ->setName('connexionBasic');
    $app->get('/api/validetoken[/]', \NRV\api\actions\ValideTokenAction::class)
        ->setName('spectacles');
    $app->get('/api/spectacle[/]', \NRV\api\actions\GetSpectacleAction::class)
        ->setName('spectacles');
    $app->get('/api/spectacle/{id}[/]', \NRV\api\actions\GetSpectacleByIdAction::class)
        ->setName('spectacle');
    $app->get('/api/soiree[/]', \NRV\api\actions\GetSoireeAction::class)
        ->setName('soirees');
    $app->get('/api/soiree/{id}[/]', \NRV\api\actions\GetSoireeByIdAction::class)
        ->setName('soiree');
    $app->get('/api/profile[/]', \NRV\api\actions\GetProfileAction::class)
        ->setName('profile');
    $app->post('/api/achat[/]', \NRV\api\actions\PostAchatAction::class)
        ->setName('achat');

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });
};
