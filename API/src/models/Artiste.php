<?php

namespace NRV\Produit\api\models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Artiste extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'Artiste';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function spectacles(): BelongsToMany
    {
        return $this->belongsToMany(Spectacle::class);
    }
}