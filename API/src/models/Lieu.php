<?php

namespace NRV\api\models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Lieu extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'Lieu';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function soirees() : HasMany
    {
        return $this->hasMany(Soiree::class);
    }
}
