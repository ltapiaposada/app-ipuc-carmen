<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduccion extends Model
{
    use HasFactory;
    protected $fillable =[
        'descripcion',
        'tipo',
        'valor'
    ];
    
    public function egresos(){
        return $this->belongsToMany("App\Models\Egreso");
    }
}
