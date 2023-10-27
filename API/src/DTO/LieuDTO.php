<?php

namespace NRV\Produit\api\DTO;

class LieuDTO extends DTO
{
    public $id;
    public $nom;
    public $adresse;
    public $nbPlaceAssise;
    public $nbPlaceDebout;
    public $lien;

    /**
     * @param $id
     * @param $nom
     * @param $adresse
     * @param $nbPlaceAssise
     * @param $nbPlaceDebout
     * @param $lien
     */
    public function __construct($id, $nom, $adresse, $nbPlaceAssise, $nbPlaceDebout, $lien)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->nbPlaceAssise = $nbPlaceAssise;
        $this->nbPlaceDebout = $nbPlaceDebout;
        $this->lien = $lien;
    }
}