<?php

namespace NRV\Admin\actions;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Views\Twig;

class LoginProcessAction extends AbstractAction {

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        $params = $request->getParsedBody();
        $client = new Client();
        try {
            $res = $client->request('POST', "http://nrv.auth.api/api/users/signin", ['auth' => [$params["email"], $params["password"]]]);
            $res = $res->getBody()->getContents();
            $res = json_decode($res, true);

            $_SESSION["acces_token"] = $res["accesToken"];

            $headers = [
                'Authorization' => 'Bearer ' . $res["accesToken"],
                'Accept' => 'application/json',
            ];

            $res = $client->request('GET', "http://nrv.auth.api/api/users/validate", ['headers' => $headers]);
            $res = $res->getBody()->getContents();
            $res = json_decode($res, true);
        } catch (ClientException $e){
            $view = Twig::fromRequest($request);
            return $view->render($response, 'Accueil.twig');
        }

        $view = Twig::fromRequest($request);
        return $view->render($response, 'Accueil.twig', ["estAdmin" => $res["estAdmin"]]);
    }
}