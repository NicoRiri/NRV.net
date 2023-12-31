<?php

namespace NRV\Produit\api\services;

use NRV\Produit\api\DTO\BilletDTO;
use NRV\Produit\api\DTO\LieuDTO;
use NRV\Produit\api\DTO\SoireeDTO;
use NRV\Produit\api\models\Billet;
use NRV\Produit\api\models\Soiree;

class sBillet
{
    public function getBilletByUserId(int $id)
    {
        $billsql = Billet::where("utilisateur_id", $id)->get();
        $billetArray = [];
        foreach ($billsql as $b){
            $billetArray[] = new BilletDTO($b->utilisateur_id, $b->soiree_id, $b->quantiteDebout, $b->quantiteAssise, $b->estAchete);
        }
        return $billetArray;
    }

    public function validateBillet($idUser)
    {
        Billet::where([["utilisateur_id", $idUser], ["estAchete", 0]])->update(["estAchete" => 1]);
    }

    public function deleteBillet($id_user, $id_soiree){
        $supp = Billet::where(["utilisateur_id", $id_user], ["soiree_id", $id_soiree])->delete();
    }
}