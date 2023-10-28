<?php

namespace NRV\Admin\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class LoginFormAction extends AbstractAction {

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'Connexion.twig');
    }
}