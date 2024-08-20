<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Unite extends Model
{
    protected $fillable =['code','designation'];


    public function produits(): HasMany
    {
        return $this->hasMany(Produit::class);
    }
}
