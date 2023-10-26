<?php

namespace NRV\Produit\api\models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Spectacle extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'Spectacle';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;

    public function billets(): HasMany
    {
        return $this->hasMany(Billet::class);
    }

    public function soirees(): BelongsTo
    {
        return $this->belongsTo(Soiree::class, "soiree_id");
    }

    public function artistes(): BelongsToMany
    {
        return $this->belongsToMany(Artiste::class, "Spectacle2Artiste", "artiste_id", "spectacle_id");
    }

    public function images(): HasMany
    {
        return $this->hasMany(ImageSpectacle::class);
    }
}
