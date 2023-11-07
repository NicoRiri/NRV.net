<?php
declare(strict_types=1);

use NRV\Produit\api\actions\PreflightAction;
use Slim\Exception\HttpNotFoundException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

return function(\Slim\App $app):void {
header("Access-Control-Allow-Origin: http://docketu.iutnc.univ-lorraine.fr:42775");

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
    $app->put('/api/achat[/]', \NRV\Produit\api\actions\PutAchatAction::class)
        ->setName('modifAchat');
    $app->delete('/api/achat[/]', \NRV\Produit\api\actions\PutAchatAction::class)
        ->setName('modifAchat');

    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE')
            ->withHeader('Access-Control-Allow-Credentials', 'true');
    });

header("Access-Control-Allow-Origin: http://docketu.iutnc.univ-lorraine.fr:42775");
};
