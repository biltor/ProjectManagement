<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    protected $fillable = ['ref','type_contrat','date_recrutement','date_fin','period','employee_id' ];


    public function employees(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
