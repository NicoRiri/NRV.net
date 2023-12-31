<?php

namespace NRV\auth\api\DTO;

class UsersDTO
{

    public $id;
    public string $email;
    public $refresh_token;
    public $refresh_token_expiration_date;
    public $nom;
    public $prenom;
    public $estAdmin;

    /**
     * @param $id
     * @param string $email
     * @param $refresh_token
     * @param $refresh_token_expiration_date
     * @param $nom
     * @param $prenom
     * @param $estAdmin
     */
    public function __construct($id, string $email, $refresh_token, $refresh_token_expiration_date, $nom, $prenom, $estAdmin)
    {
        $this->id = $id;
        $this->email = $email;
        $this->refresh_token = $refresh_token;
        $this->refresh_token_expiration_date = $refresh_token_expiration_date;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->estAdmin = $estAdmin;
    }


}