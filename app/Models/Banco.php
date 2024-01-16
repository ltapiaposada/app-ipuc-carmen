<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;
    protected $fillable =[
        'nombre',
    ];

    
    public function egresos(){
            return $this->belongsToMany("App\Models\Egreso");
    }
}
