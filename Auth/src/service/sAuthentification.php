<?php

namespace NRV\auth\api\service;

use DateTime;
use NRV\auth\api\DTO\CoupleJWTDTO;
use NRV\auth\api\models\Users;
use Ramsey\Uuid\Uuid;

class sAuthentification implements isAuthentification
{

    public function signIn($email, $password)
    {
        $pro = new AuthentificationProvider();
        $jwt = new ManagerJWT();
        $id = $pro->authCredentials($email, $password);
        if ($id != null){
            $aToken = $jwt->createToken($id);
            $refreshtoken = Uuid::uuid4();
            $date = new DateTime();
            $date->modify('+1 hour');
            Users::where('email', $email)->update(['refresh_token' => $refreshtoken]);
            Users::where('email', $email)->update(['refresh_token_expiration_date' => $date]);
            return new CoupleJWTDTO($aToken, $refreshtoken);
        }



    }

    public function validate($token)
    {
        $jwt = new ManagerJWT();
        $ap = new AuthentificationProvider();
        if ($jwt->validateToken($token)) {
            return $ap->getProfile($jwt->getIdToken($token));
        }
        return null;

    }

    public function refresh($refresh_token)
    {
        $jwt = new ManagerJWT();
        $ap = new AuthentificationProvider();
        $id = "";

        $res = Users::where('refresh_token', $refresh_token)->first();
        if ($res != null) {
            $date = new DateTime();
            if ($res->refresh_token_expiration_date > $date){
                throw new \Exception("Refresh token expiré");
            }
            $email = $res->email;
            $accessToken = $jwt->createToken($id);
            $refreshtoken = Uuid::uuid4();
            $date->modify('+1 hour');
            Users::where('email', $email)->update(['refresh_token' => $refreshtoken]);
            Users::where('email', $email)->update(['refresh_token_expiration_date' => $date]);
            return new CoupleJWTDTO($accessToken, $refreshtoken);
        }
        throw new \Exception("Pas le bon refresh token");
    }

    public function signUp($email, $password, $nom, $prenom)
    {
        $newUser = new Users();
        $newUser->email = $email;
        $newUser->password = $password;
        $newUser->nom = $nom;
        $newUser->prenom = $prenom;
        $newUser->estAdmin = 0;
        $newUser->save();
        return true;
    }
}