<?php

namespace NRV\Produit\api\actions;

use NRV\Produit\api\services\sSpectacle;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetSpectacleAction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $sSpec = new sSpectacle();
        $res = $sSpec->getSpectacle();

        $rep = [
            "type" => "ressource",
            "spectacle" => []
        ];

        foreach ($res as $spectacle) {
            $rep['spectacle'][] = [
                "details" => $spectacle,
                "link" => [
                    "self" => [
                        "href" => "/api/spectacle/{$spectacle->id}"
                    ],
                    "soiree" => "/api/soiree/{$spectacle->soiree_id}"
                ]
            ];
        }

        $response->getBody()->write(json_encode($rep));
        return $response;
    }
}
