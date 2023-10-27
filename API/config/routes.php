<?php
declare(strict_types=1);

return function( \Slim\App $app):void {

    $app->post('/api/connexion[/]', \NRV\Produit\api\actions\ConnexionBasicAction::class)
        ->setName('connexionBasic');
    $app->post('/api/inscription[/]', \NRV\Produit\api\actions\InscriptionAction::class)
        ->setName('inscription');
    $app->get('/api/spectacle[/]', \NRV\Produit\api\actions\GetSpectacleAction::class)
        ->setName('spectacles');
    $app->get('/api/spectacle/{id}[/]', \NRV\Produit\api\actions\GetSpectacleByIdAction::class)
        ->setName('spectacle');
    $app->get('/api/soiree[/]', \NRV\Produit\api\actions\GetSoireeAction::class)
        ->setName('soirees');
    $app->get('/api/soiree/{id}[/]', \NRV\Produit\api\actions\GetSoireeByIdAction::class)
        ->setName('soiree');
    $app->get('/api/profile[/]', \NRV\Produit\api\actions\GetProfileAction::class)
        ->setName('profile');
    $app->post('/api/achat[/]', \NRV\Produit\api\actions\PostAchatAction::class)
        ->setName('achat');
    $app->post('/api/achat[/]', \NRV\Produit\api\actions\PutAchatAction::class)
        ->setName('modifAchat');

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });
};
