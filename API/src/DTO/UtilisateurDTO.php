<?php

namespace NRV\api\DTO;

class UtilisateurDTO extends DTO
{
    public $id;
    public $email;
    public $prenom;
    public $nom;

    /**
     * @param $id
     * @param $email
     * @param $prenom
     * @param $nom
     */
    public function __construct($id, $email, $prenom, $nom)
    {
        $this->id = $id;
        $this->email = $email;
        $this->prenom = $prenom;
        $this->nom = $nom;
    }


}