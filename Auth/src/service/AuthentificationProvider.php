<?php

namespace NRV\auth\api\service;

use DateTime;
use NRV\auth\api\DTO\UsersDTO;
use NRV\auth\api\models\Users;
use Slim\Exception\HttpUnauthorizedException;

class AuthentificationProvider implements iAuthentificationProvider
{

    public function authCredentials(string $email, string $password)
    {
        $res = Users::where('email', $email)->first();
        if ($res != null) {
            if (password_verify($password, $res->password)) {
                return $res->id;
            }
        }
        return null;
    }

    public function authRefreshToken(string $token, string $refreshToken)
    {
        $jwt = new ManagerJWT();
        if ($jwt->validateToken($token)){
            $id = $jwt->getIdToken($token);
            $res = Users::where([
                ['id', $id],
                ['refresh_token', $refreshToken]
            ])->first();
            if ($res != null){
                $date = new DateTime();
                if ($res->refresh_token_expiration_date < $date)
                return true;
            }
        }
        return false;

    }

    public function getProfile(string $id)
    {
        $res = Users::where('id', $id)->first();
        $udtp =  new UsersDTO($res->id, $res->email, $res->refresh_token, $res->refresh_token_expiration_date, $res->nom, $res->prenom);
        return $udtp;
    }

    public function registerNewUser()
    {
        // TODO: Implement registerNewUser() method.
    }

    public function activateAccount()
    {
        // TODO: Implement activateAccount() method.
    }
}