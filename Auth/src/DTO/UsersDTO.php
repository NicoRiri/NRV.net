<?php

namespace NRV\auth\api\DTO;

class UsersDTO
{

    public $id;
    public $email;
    public $refresh_token;
    public $refresh_token_expiration_date;
    public $username;
    public $nom;
    public $prenom;

    /**
     * @param $id
     * @param $email
     * @param $refresh_token
     * @param $refresh_token_expiration_date
     * @param $username
     * @param $nom
     * @param $prenom
     */
    public function __construct($id, $email, $refresh_token, $refresh_token_expiration_date, $username, $nom, $prenom)
    {
        $this->id = $id;
        $this->email = $email;
        $this->refresh_token = $refresh_token;
        $this->refresh_token_expiration_date = $refresh_token_expiration_date;
        $this->username = $username;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }


}