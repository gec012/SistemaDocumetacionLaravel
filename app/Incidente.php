<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incidente extends Model
{
    protected $table='incidentes';

    protected $fillable = [
    
        'detalle','estado','caracter','reporter_id'
        ,'resolver_id','tipo_id','imagen','finalizado',
        'nombre',
    ];
    public function tipos(){
        return $this->belongsTo('App\Tipo','tipo_id');
    }

    public function resuleto(){
        return $this->belongsTo('App\User','resolver_id');
    }

    public function generado(){
        return $this->belongsTo('App\User','reporter_id');
    }

}
