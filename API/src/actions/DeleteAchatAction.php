<?php

namespace NRV\Produit\api\actions;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use NRV\Produit\api\services\sBillet;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpUnauthorizedException;

class DeleteAchatAction extends AbstractAction
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
        $body = $request->getBody();
        $sBillet = new sBillet();
        $sBillet->deleteBillet($profile["id"], $body["soiree_id"]);
        $response->getBody()->write("Article supprimé");
        return $response;
    }
}
