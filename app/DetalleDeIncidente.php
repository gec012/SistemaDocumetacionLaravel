<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleDeIncidente extends Model
{
    protected $table='detalles_de_incidentes';

    protected $fillable = [
    
        'send_id','recived_id','estado','sector_id'
        ,'observaciones','hora_de_recivido',
    ];

    
    public function sectores(){
        return $this->belongsTo('App\Sector','sector_id');
    }

    public function sendes(){
        return $this->belongsTo('App\User','send_id');
    }

    public function recivedes(){
        return $this->belongsTo('App\User','recived_id');
    }
}
