<?php

namespace NRV\api\services;

use NRV\api\DTO\SpectacleDTO;
use NRV\api\models\Spectacle;

class sSpectacle
{

    public function getSpectacle()
    {
        $arr = [];
        $spect = Spectacle::all();
        foreach ($spect as $s){
            $arrdeux = [];
            foreach ($s->images() as $image){
                $arrdeux[] = $image;
            }
            $arr[] = new SpectacleDTO($s->id, $s->titre, $s->description, $s->soirees(), $s->videoUrl, $s->horaire, $arrdeux);
        }
        return $arr;
    }

}