<?php

namespace NRV\api\DTO;

class LieuDTO extends DTO
{
    public $id;
    public $nom;
    public $adresse;
    public $nbPlaceAssise;
    public $nbPlaceDebout;

    /**
     * @param $id
     * @param $nom
     * @param $adresse
     * @param $nbPlaceAssise
     * @param $nbPlaceDebout
     */
    public function __construct($id, $nom, $adresse, $nbPlaceAssise, $nbPlaceDebout)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->nbPlaceAssise = $nbPlaceAssise;
        $this->nbPlaceDebout = $nbPlaceDebout;
    }


}