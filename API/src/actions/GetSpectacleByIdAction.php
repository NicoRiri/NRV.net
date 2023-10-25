<?php

namespace NRV\api\actions;

use NRV\api\services\sSpectacle;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetSpectacleByIdAction extends AbstractAction
{
    /**
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $sSpec = new sSpectacle();
        $res = $sSpec->getSpectacleById($args["id"]);
        $rep = [
            "type" => "ressource",
            "spectacle" => [
                "details" => $res,
                "link" => [
                ],
                "soiree" => "/api/soiree/{$res->soiree_id}"
            ]
        ];


        $response->getBody()->write(json_encode($rep));
        return $response;
    }
}
