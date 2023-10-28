<?php

namespace NRV\Admin\actions;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetJaugeAction extends AbstractAction {

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        $client = new Client();
        $res = $client->request('GET', "http://nrv.api/api/soiree/");
        $res = $res->getBody()->getContents();
        $res = json_decode($res, true);
        $view = Twig::fromRequest($request);
        return $view->render($response, 'Jauge.twig', ["soirees" => $res]);
    }
}