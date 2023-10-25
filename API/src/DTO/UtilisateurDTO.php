<?php

namespace NRV\Produit\api\DTO;

class UtilisateurDTO extends DTO
{
    public $id;
    public $email;
    public $prenom;
    public $nom;
    public $refresh_token;
    public $refresh_token_expiration_date;

    /**
     * @param $id
     * @param $email
     * @param $prenom
     * @param $nom
     * @param $refresh_token
     * @param $refresh_token_expiration_date
     */
    public function __construct($id, $email, $prenom, $nom, $refresh_token, $refresh_token_expiration_date)
    {
        $this->id = $id;
        $this->email = $email;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->refresh_token = $refresh_token;
        $this->refresh_token_expiration_date = $refresh_token_expiration_date;
    }


}