<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleTraspaso extends Model
{
    protected  $table='detalle_traspaso';
    protected  $fillable=['id_producto','cantidad','id_traspaso'];
    // protected  $primaryKey  = 'id_categoria';
    public $timestamps = false;
}
