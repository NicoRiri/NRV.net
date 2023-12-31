<?php

namespace NRV\Produit\api\models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageSpectacle extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'ImageSpectacle';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;

    public function spectacles(): BelongsTo
    {
        return $this->belongsTo(Spectacle::class);
    }
}
