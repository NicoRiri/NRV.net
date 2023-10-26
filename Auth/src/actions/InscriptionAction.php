<?php

namespace NRV\auth\api\actions;

use NRV\auth\api\service\sAuthentification;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpUnauthorizedException;

class InscriptionAction extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        $body = $request->getBody();
        $email = $body["email"];
        $password = $body["password"];
        $nom = $body["nom"];
        $prenom = $body["prenom"];


        $auth = $request->getHeader("Authorization");
        $arr = explode(" ", $auth[0]);
        $token = $arr[1];
        $sAuth = new sAuthentification();

        try {
            $cpl = $sAuth->refresh($token);
        } catch (\Exception $e){
            throw new HttpUnauthorizedException($request, $e->getMessage());
        }


        if ($cpl != null){
            $response->withStatus(200);
            $response->getBody()->write(json_encode($cpl));
        } else {
            throw new HttpUnauthorizedException($request, "Mauvais token");
        }

        return $response;
    }
}