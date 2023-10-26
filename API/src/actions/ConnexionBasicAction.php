<?php

namespace NRV\Produit\api\actions;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpUnauthorizedException;

class ConnexionBasicAction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $auth = $request->getHeader("Authorization");
        $idmdp = explode(" ", $auth[0]);
        $idmdp = base64_decode($idmdp[1]);
        $idmdp = explode(":", $idmdp);
        $mail = $idmdp[0];
        $mdp = $idmdp[1];

        $client = new Client();
        try {
            $res = $client->request('POST', "http://nrv.auth.api/api/users/signin", ['auth' => [$mail, $mdp]]);
            $response->getBody()->write($res->getBody()->__toString());
        } catch (ClientException $e){
            throw new HttpUnauthorizedException($request, "Mauvais log");
        }
        return $response;



    }
}
