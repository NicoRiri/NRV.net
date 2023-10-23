<?php

namespace NRV\api\models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Utilisateur extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'ImageSpectacle';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function billets(): HasMany
    {
        return $this->hasMany(Billet::class);
    }
}
