<?php

namespace NRV\Produit\api\services;

use NRV\Produit\api\DTO\ArtisteDTO;
use NRV\Produit\api\DTO\SpectacleDTO;
use NRV\Produit\api\models\Spectacle;

class sSpectacle
{

    public function getSpectacle()
    {
        $arr = [];
        $spect = Spectacle::all();
        foreach ($spect as $s){
            $arrdeux = [];
            foreach ($s->images()->get() as $image){
                $arrdeux[] = $image;
            }
            $artiste = $s->artistes()->get();
            $artisteArray = [];
            foreach ($artiste as $a){
                $artisteArray[] = new ArtisteDTO($a->id, $a->pseudonyme);
            }
            $arr[] = new SpectacleDTO($s->id, $s->titre, $s->description, $s->soirees()->first()->id, $s->videoUrl, $s->horaire, $arrdeux, $artisteArray);
        }
        return $arr;
    }

    public function getSpectacleById(int $id){
        $s = Spectacle::where("id", $id)->first();
        if ($s == null){
            throw new \Exception("Id inexistant");
        } else {
            $arrdeux = [];
            foreach ($s->images()->get() as $image){
                $arrdeux[] = $image;
            }
            $artiste = $s->artistes()->get();
            $artisteArray = [];
            foreach ($artiste as $a){
                $artisteArray[] = new ArtisteDTO($a->id, $a->pseudonyme);
            }
            return new SpectacleDTO($s->id, $s->titre, $s->description, $s->soirees()->first()->id, $s->videoUrl, $s->horaire, $arrdeux, $artisteArray);
        }
    }

}