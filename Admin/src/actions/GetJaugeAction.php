<?php

namespace NRV\Admin\actions;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Views\Twig;

class GetJaugeAction extends AbstractAction {

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        $client = new Client();
        try {
            if (!isset($_SESSION["acces_token"])){
                $view = Twig::fromRequest($request);
                return $view->render($response, 'Accueil.twig');
            }
            $headers = [
                'Authorization' => 'Bearer ' . $_SESSION["acces_token"],
                'Accept' => 'application/json',
            ];

            $res = $client->request('GET', "http://nrv.auth.api/api/users/validate", ['headers' => $headers]);
            $res = $res->getBody()->getContents();
            $res = json_decode($res, true);
        } catch (ClientException $e){
            throw new HttpUnauthorizedException($request, "Mauvais log");
        }

        if ($res["estAdmin"] == 1) {


            $client = new Client();
            $res = $client->request('GET', "http://nrv.api/api/soiree/");
            $res = $res->getBody()->getContents();
            $res = json_decode($res, true);
            $view = Twig::fromRequest($request);
            return $view->render($response, 'Jauge.twig', ["soirees" => $res]);
        } else {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'Accueil.twig');
        }
    }
}