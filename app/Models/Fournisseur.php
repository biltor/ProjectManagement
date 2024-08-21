<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
protected $fillable=['code','nomination','nis','nif','rc','ci','email','phone_number'];

}
