<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'date_of_birth',
        'sex',
        'fonction_id',
        'taux',
        'is_active',
        'image',
        'note_interne'
    ];
  


    public function fonction(): BelongsTo
    {
        return $this->belongsTo(Fonction::class);
    }

        
    public function contrats(): HasMany
    {
        return $this->hasMany(Contrat::class);
    }
    
}
