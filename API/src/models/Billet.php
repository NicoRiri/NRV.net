<?php

namespace NRV\api\models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Billet extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'Billet';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function utilisateurs() : BelongsTo
    {
        return $this->belongsTo(Utilisateur::class);
    }
    public function spectacles(): BelongsTo
    {
        return $this->belongsTo(Spectacle::class);
    }
}
