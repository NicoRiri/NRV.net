<?php

namespace NRV\api\DTO;

class SoireeDTO extends DTO
{
    public $id;
    public $nom;
    public $date;
    public $thematique;
    public $lieu_id;
    public $heureDebut;
    public $heureFin;
    public $placeRestante;
    public $spectacleArrayId;
    public $prixPlace;
    public $nbPlaceAssiseRestante;
    public $nbPlaceDeboutRestante;
    public $nbPlaceRestanteTotale;

    /**
     * @param $id
     * @param $nom
     * @param $date
     * @param $thematique
     * @param $lieu_id
     * @param $heureDebut
     * @param $heureFin
     * @param $placeRestante
     * @param $spectacleArrayId
     * @param $prixPlace
     * @param $nbPlaceAssiseRestante
     * @param $nbPlaceDeboutRestante
     * @param $nbPlaceRestanteTotale
     */
    public function __construct($id, $nom, $date, $thematique, $lieu_id, $heureDebut, $heureFin, $placeRestante, $spectacleArrayId, $prixPlace, $nbPlaceAssiseRestante, $nbPlaceDeboutRestante, $nbPlaceRestanteTotale)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->date = $date;
        $this->thematique = $thematique;
        $this->lieu_id = $lieu_id;
        $this->heureDebut = $heureDebut;
        $this->heureFin = $heureFin;
        $this->placeRestante = $placeRestante;
        $this->spectacleArrayId = $spectacleArrayId;
        $this->prixPlace = $prixPlace;
        $this->nbPlaceAssiseRestante = $nbPlaceAssiseRestante;
        $this->nbPlaceDeboutRestante = $nbPlaceDeboutRestante;
        $this->nbPlaceRestanteTotale = $nbPlaceRestanteTotale;
    }


}