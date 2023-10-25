<?php

namespace NRV\api\DTO;

class SpectacleDTO extends DTO
{
    public $id;
    public $titre;
    public $description;
    public $soireeId;
    public $VideoUrl;
    public $horaire;
    public $tabImg;

    /**
     * @param $id
     * @param $titre
     * @param $description
     * @param $soireeId
     * @param $VideoUrl
     * @param $horaire
     * @param $tabImg
     */
    public function __construct($id, $titre, $description, $soireeId, $VideoUrl, $horaire, $tabImg)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->soireeId = $soireeId;
        $this->VideoUrl = $VideoUrl;
        $this->horaire = $horaire;
        $this->tabImg = $tabImg;
    }


}