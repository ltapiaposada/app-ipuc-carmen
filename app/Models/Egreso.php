<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Egreso extends Model
{
    use HasFactory;
    protected $fillable =[
       'consecutivo',
        'participante_id',
        'forma_pago',
        'fecha',
        'cheque_numero',
        'banco_id',
        'valor'       
    ];

    public function participante(){
        return $this->hasOne(Participante::class,'id','participante_id');
    }

    public function conceptos(){
        return $this->belongsToMany("App\Models\Concepto");
    }
    
    public function deduccions(){    
        return $this->belongsToMany("App\Models\Deduccion");
    }

    public function banco(){
        return $this->hasOne(Banco::class,'id','banco_id');
    }
}
