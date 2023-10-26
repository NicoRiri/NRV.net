<?php

namespace NRV\Produit\api\actions;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use NRV\auth\api\service\sAuthentification;
use NRV\Produit\api\models\Billet;
use NRV\Produit\api\services\sBillet;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpUnauthorizedException;

class GetProfileAction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
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
            $res = $res->getBody()->getContents(); // Obtenez le contenu de la réponse
            $res = json_decode($res, true); // Décoder la réponse JSON en un tableau associatif

            $sbi = new sBillet();

            if (isset($res["id"])) {
                $billet = $sbi->getBilletByUserId($res["id"]); // Utilisez $res["id"] pour obtenir l'ID
                $retour = [
                    "profile" => $res,
                    "billets" => $billet
                ];

                $response->getBody()->write(json_encode($retour));
            } else {
                // Gérer le cas où "id" n'existe pas dans la réponse
            }
        } catch (ClientException $e) {
            throw new HttpUnauthorizedException($request, "Mauvais log");
        }

        return $response;
    }
}
