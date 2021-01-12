<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $table='sectores';

    protected $fillable = [
    
        'nombre','descripcion',
    ];

    
    public function detalle_de_documentos(){
        return $this->hasMany('App\DetalleDelDocumento','sector_id');
    }
    public function detalle_de_incidentes(){
        return $this->hasMany('App\DetalleDeIncidente','sector_id');
    }
    public function users(){
        return $this->belongsToMany('App\User');
    }
}
