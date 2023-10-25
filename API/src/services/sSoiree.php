<?php

namespace NRV\api\services;

use NRV\api\DTO\LieuDTO;
use NRV\api\DTO\SoireeDTO;
use NRV\api\models\Billet;
use NRV\api\models\Soiree;

class sSoiree
{
    public function getSoireeById(int $id)
    {
        $s = Soiree::where("id", $id)->first();
        if ($s == null) {
            throw new \Exception("Id inexistant");
        } else {
            $lieu = $s->lieux()->first();
            $spectacle = $s->spectacles()->get();


            $billets = Billet::where("spectacle_id", $id)->get();
            $deboutRestant = $lieu->nbPlaceDebout;
            $assisRestant = $lieu->nbPlaceAssise;
            foreach ($billets as $b){
                $deboutRestant -= $b->quantiteDebout;
                $assisRestant -= $b->quantiteAssise;
            }


            $specArrayId = [];
            foreach ($spectacle as $spec){
                $specArrayId[] = $spec->id;
            }
            return new SoireeDTO($s->id, $s->nom, $s->date, $s->thematique, new LieuDTO($lieu->id, $lieu->nom, $lieu->adresse, $lieu->nbPlaceAssise, $lieu->nbPlaceDebout), $s->heureDebut, $s->heureFin, $lieu->nbPlaceAssise + $lieu->nbPlaceDebout, $specArrayId, $s->prixPlace, $assisRestant, $deboutRestant, $assisRestant + $deboutRestant);
        }
    }

}