<?php

namespace NRV\Produit\api\actions;

use NRV\Produit\api\services\sSoiree;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetSoireeAction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $sSoir = new sSoiree();
        $res = $sSoir->getSoiree();
        $rep = [
            "type" => "ressource",
            "soiree" => $res
        ];

        $response->getBody()->write(json_encode($rep));
        return $response;
    }
}
