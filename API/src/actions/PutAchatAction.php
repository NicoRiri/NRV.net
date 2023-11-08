<?php

namespace NRV\Produit\api\actions;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use NRV\Produit\api\services\sBillet;
use NRV\Produit\api\services\sSoiree;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpUnauthorizedException;

class PutAchatAction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        //Vérif
        $auth = $request->getHeader("Authorization");
        $arr = explode(" ", $auth[0]);
        $token = $arr[1];

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];

        $client = new Client();
        try {
            $res = $client->request('GET', "http://nrv.auth.api/api/users/validate", ['headers' => $headers]);
        } catch (ClientException $e) {
            throw new HttpUnauthorizedException($request, "Mauvais log");
        }
        $profile = json_decode($res->getBody()->getContents(), true);
        $sBillet = new sBillet();
        $sBillet->validateBillet($profile["id"]);
        $response->getBody()->write("Panier validé");
        return $response;
    }
}
