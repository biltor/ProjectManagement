<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    protected $fillable = ['Ref','Type_contrat','Date_recrutement','Date_fin','period','employee_id' ];

    
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
