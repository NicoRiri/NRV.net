<?php

namespace NRV\Produit\api\models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Billet extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'Billet';
    public $timestamps = false;

    public function utilisateurs() : BelongsTo
    {
        return $this->belongsTo(Utilisateur::class);
    }
    public function soirees(): BelongsTo
    {
        return $this->belongsTo(Soiree::class);
    }
}
