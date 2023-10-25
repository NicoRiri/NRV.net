<?php

namespace NRV\api\DTO;

class SoireeDTO extends DTO
{
    public $id;
    public $nom;
    public $date;
    public $thematique;
    public $lieuId;
    public $heureDebut;
    public $heureFin;

    /**
     * @param $id
     * @param $nom
     * @param $date
     * @param $thematique
     * @param $lieuId
     * @param $heureDebut
     * @param $heureFin
     */
    public function __construct($id, $nom, $date, $thematique, $lieuId, $heureDebut, $heureFin)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->date = $date;
        $this->thematique = $thematique;
        $this->lieuId = $lieuId;
        $this->heureDebut = $heureDebut;
        $this->heureFin = $heureFin;
    }


}