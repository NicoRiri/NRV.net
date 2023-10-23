<?php

namespace NRV\api\DTO;

class ArtisteDTO extends DTO
{
    public $id;
    public $pseudonyme;

    /**
     * @param $id
     * @param $pseudonyme
     */
    public function __construct($id, $pseudonyme)
    {
        $this->id = $id;
        $this->pseudonyme = $pseudonyme;
    }


}