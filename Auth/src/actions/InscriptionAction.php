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

        $body = $request->getParsedBody();
        $email = $body["email"];
        $password = $body["password"];
        $password = password_hash($password, PASSWORD_BCRYPT);
        $nom = $body["nom"];
        $prenom = $body["prenom"];

        $sAuth = new sAuthentification();
        $boo = $sAuth->signUp($email, $password, $nom, $prenom);

        if ($boo){
            $response->getBody()->write("c'est bon");
            return $response;
        } else {
            throw new HttpUnauthorizedException($request, "Pas inscrit");
        }

        return $response;
    }
}