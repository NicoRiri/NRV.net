<?php

namespace NRV\Produit\api\services;

use NRV\Produit\api\DTO\LieuDTO;
use NRV\Produit\api\DTO\SoireeDTO;
use NRV\Produit\api\models\Billet;
use NRV\Produit\api\models\Soiree;

class sSoiree
{
    public function getSoiree()
    {
        $soiree = Soiree::all();
        $tabSoiree = [];
        foreach ($soiree as $s){

            $lieu = $s->lieux()->first();
            $spectacle = $s->spectacles()->get();


            $billets = Billet::where("soiree_id", $s->id)->get();
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
            $tabSoiree[] = new SoireeDTO($s->id, $s->nom, $s->date, $s->thematique, new LieuDTO($lieu->id, $lieu->nom, $lieu->adresse, $lieu->nbPlaceAssise, $lieu->nbPlaceDebout, $lieu->lien), $s->heureDebut, $s->heureFin, $lieu->nbPlaceAssise + $lieu->nbPlaceDebout, $specArrayId, $s->prixPlace, $assisRestant, $deboutRestant, $assisRestant + $deboutRestant);
        }

        return $tabSoiree;
    }

    public function getSoireeById(int $id)
    {
        $s = Soiree::where("id", $id)->first();
        if ($s == null) {
            throw new \Exception("Id inexistant");
        } else {
            $lieu = $s->lieux()->first();
            $spectacle = $s->spectacles()->get();


            $billets = Billet::where("soiree_id", $id)->get();
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
            return new SoireeDTO($s->id, $s->nom, $s->date, $s->thematique, new LieuDTO($lieu->id, $lieu->nom, $lieu->adresse, $lieu->nbPlaceAssise, $lieu->nbPlaceDebout, $lieu->lien), $s->heureDebut, $s->heureFin, $lieu->nbPlaceAssise + $lieu->nbPlaceDebout, $specArrayId, $s->prixPlace, $assisRestant, $deboutRestant, $assisRestant + $deboutRestant);
        }
    }

    public function acheterPlaceSoiree(int $id, $soiree_id, $quantite_debout, $quantite_assise)
    {

        $soiree = Soiree::where("id", $soiree_id)->first();
        $lieu = $soiree->lieux()->first();
        $nbPlaceDeb = $lieu->nbPlaceDebout;
        $nbPlaceAss = $lieu->nbPlaceAssise;

        $nbPlaceAss -= $quantite_assise;
        $nbPlaceDeb -= $quantite_debout;

        if ($nbPlaceDeb < 0 ||$nbPlaceAss < 0){
            return new \Exception("Plus assez de place disponible !");
        }

        $billets = Billet::where([["utilisateur_id", $id],["soiree_id", $soiree_id]])->first();
        if ($billets != null){
            Billet::where([["utilisateur_id", $id],["soiree_id", $soiree_id]])->update([["quantiteDebout" => $billets->quantiteDebout + $quantite_debout], ["quantiteAssise" => $billets->quantiteAssise + $quantite_assise]]);
        } else {
            $dataBillet = new Billet();
            $dataBillet->utilisateur_id = $id;
            $dataBillet->soiree_id = $soiree_id;
            $dataBillet->quantiteDebout = $quantite_debout;
            $dataBillet->quantiteAssise = $quantite_assise;
            $dataBillet->estAchete = 0;
            $dataBillet->save();
        }
        return true;
    }

}