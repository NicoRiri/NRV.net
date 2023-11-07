<?php

namespace NRV\Produit\api\actions;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpUnauthorizedException;

class InscriptionAction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $body = $request->getBody();
        $body = json_decode($body, true);
        $formData = [
            'email' => $body["email"],
            'password' => $body["password"],
            'nom' => $body["nom"],
            'prenom' => $body["prenom"]
        ];

        $client = new Client();
        try {
            $res = $client->request('POST', "http://nrv.auth.api/api/users/inscription", ['form_params' => $formData]);
            $response->getBody()->write($res->getBody()->__toString());
        } catch (ClientException $e){
            throw new HttpUnauthorizedException($request, "Inscription invalide");
        }
        return $response;



    }
}
