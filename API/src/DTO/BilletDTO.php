<?php

namespace NRV\Produit\api\DTO;

class BilletDTO extends DTO
{
    public $utilisateur_id;
    public $soiree_id;
    public $quantiteDebout;
    public $quantiteAssise;
    public $estAchete;

    /**
     * @param $utilisateur_id
     * @param $soiree_id
     * @param $quantiteDebout
     * @param $quantiteAssise
     * @param $estAchete
     */
    public function __construct($utilisateur_id, $soiree_id, $quantiteDebout, $quantiteAssise, $estAchete)
    {
        $this->utilisateur_id = $utilisateur_id;
        $this->soiree_id = $soiree_id;
        $this->quantiteDebout = $quantiteDebout;
        $this->quantiteAssise = $quantiteAssise;
        $this->estAchete = $estAchete;
    }


}