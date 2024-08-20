<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable =['code','designation','unite_id','famille_id','tva'];


    public function unites(): BelongsTo
    {
        return $this->belongsTo(Unite::class);
    }

    public function famillies(): BelongsTo
    {
        return $this->belongsTo(Famille::class);
    }

}
