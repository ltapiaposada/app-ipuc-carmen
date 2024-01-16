<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puc extends Model
{
    use HasFactory;
    protected $fillable =[
        'codigo',
        'nombre',
        'clasificacion',
    ];
}
