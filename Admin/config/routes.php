<?php
declare(strict_types=1);

return function( \Slim\App $app):void {

    $app->get('[/]', \NRV\Admin\actions\GetAccueilAction::class)
        ->setName('accueil');
    $app->post('/connexion[/]', \NRV\Admin\actions\LoginProcessAction::class)
        ->setName('connexion');
    $app->get('/jauge[/]', \NRV\Admin\actions\GetJaugeAction::class)
        ->setName('jauge');

    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        if (!$request->hasHeader('Origin')) {
            $origin = '*';
        } else {
            $origin = $request->getHeader('Origin');
        }
        return $response
            ->withHeader('Access-Control-Allow-Origin', $origin)
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
            ->withHeader('Access-Control-Allow-Credentials', 'true');
    });
};
