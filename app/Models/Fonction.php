<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    protected $fillable = [
        'designation',
    ];
    
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
