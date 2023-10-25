<?php

namespace NRV\api\DTO;

class SpectacleDTO extends DTO
{
    public $id;
    public $titre;
    public $description;
    public $soiree_id;
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
    public function __construct($id, $titre, $description, $soiree_id, $VideoUrl, $horaire, $tabImg)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->soiree_id = $soiree_id;
        $this->VideoUrl = $VideoUrl;
        $this->horaire = $horaire;
        $this->tabImg = $tabImg;
    }


}