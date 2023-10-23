<?php

namespace NRV\api\actions;

use NRV\api\services\sSpectacle;
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
                        "href" => "/commandes/{$spectacle->id}"
                    ],
                    "valider" => [
                        "href" => "/commandes/{$spectacle->id}"
                    ]
                ]
            ];
        }

        $response->getBody()->write(json_encode($rep));
        return $response;
    }
}
