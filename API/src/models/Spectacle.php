<?php

namespace NRV\api\models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Spectacle extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'Spectacle';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function billets(): HasMany
    {
        return $this->hasMany(Billet::class);
    }

    public function soirees(): BelongsTo
    {
        return $this->belongsTo(Soiree::class);
    }

    public function artistes(): BelongsToMany
    {
        return $this->belongsToMany(Artiste::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ImageSpectacle::class);
    }
}
