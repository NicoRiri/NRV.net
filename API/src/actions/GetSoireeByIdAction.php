<?php

namespace NRV\api\actions;

use NRV\api\services\sSoiree;
use NRV\api\services\sSpectacle;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetSoireeByIdAction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $sSoir = new sSoiree();
        $res = $sSoir->getSoireeById($args["id"]);
        $rep = [
            "type" => "ressource",
            "soiree" => [
                "details" => $res,
                "link" => [
                    "spectacle" => []
                ]
            ]
        ];

        $link = [];

        foreach ($res->spectacleArrayId as $specId){
            $link[] = [
                "href" => "/api/spectacle/{$specId}"
            ];
        }

        $rep["soiree"]["link"]["spectacle"] = $link;

        $response->getBody()->write(json_encode($rep));
        return $response;
    }
}
