<?php

namespace NRV\Produit\api\models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Soiree extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'Soiree';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;

    public function spectacles(): HasMany
    {
        return $this->hasMany(Spectacle::class);
    }

    public function lieux(): BelongsTo
    {
        return $this->belongsTo(Lieu::class, "lieu_id");
    }

    public function utilisateurs(): BelongsToMany
    {
        return $this->belongsToMany(Utilisateur::class, "Billet");
    }
}
