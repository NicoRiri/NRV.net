<?php

namespace NRV\Produit\api\actions;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use NRV\Produit\api\services\sSoiree;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpUnauthorizedException;

class PostAchatAction extends AbstractAction
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
	$body = json_decode($body, true);
        $soiree_id = $body["soiree_id"];
        $quantite_debout = $body["quantite_debout"];
        $quantite_assise = $body["quantite_assise"];

        $sSoiree = new sSoiree();
        $sSoiree->acheterPlaceSoiree($profile["id"], intval($soiree_id), intval($quantite_debout), intval($quantite_assise));
        $response = $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization');
        $response->getBody()->write("Billets achetés");

        return $response->withAddedHeader('Access-Control-Allow-Origin', '*');
    }
}
