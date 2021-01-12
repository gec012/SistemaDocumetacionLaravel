<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleDelDocumento extends Model
{
    protected $table='detalle_de_documentos';

    

    
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
