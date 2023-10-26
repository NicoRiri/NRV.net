<?php

namespace NRV\Produit\api\models;



use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Utilisateur extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'ImageSpectacle';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;

    public function spectacles(): BelongsToMany
    {
        return $this->belongsToMany(Spectacle::class, "Billet");
    }
}
