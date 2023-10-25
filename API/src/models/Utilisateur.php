<?php

namespace NRV\api\models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Utilisateur extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'ImageSpectacle';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function spectacles(): BelongsToMany
    {
        return $this->belongsToMany(Spectacle::class, "Billet");
    }
}
