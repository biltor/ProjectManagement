<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Produit extends Model
{
    protected $fillable = [
        'code',
        'designation',
        'famille_id',
        'unite_id',
        'tva',
        'type'
    ];


    public function familles(): BelongsTo
    {
        return $this->belongsTo(Famille::class);
    }

    public function unites(): BelongsTo
    {
        return $this->belongsTo(Unite::class);
    }


    

}
