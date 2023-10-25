<?php

namespace NRV\api\services;

use NRV\api\DTO\SpectacleDTO;
use NRV\api\models\Soiree;
use NRV\api\models\Spectacle;

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
            $arr[] = new SpectacleDTO($s->id, $s->titre, $s->description, $s->soirees()->first()->id, $s->videoUrl, $s->horaire, $arrdeux);
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
            return new SpectacleDTO($s->id, $s->titre, $s->description, $s->soirees()->first()->id, $s->videoUrl, $s->horaire, $arrdeux);
        }
    }

}