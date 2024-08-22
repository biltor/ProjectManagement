<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Model;

class BonCommande extends Model
{
    protected $fillable=['code_bc','date_of_purchase','fournisseur_id'];

    public function fournisseurs(): BelongsTo
    {
        return $this->belongsTo(Fournisseur::class);
    }
}
