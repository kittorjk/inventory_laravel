<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    protected  $table='detalle_c';
    protected  $fillable=['precio','cantidad','id_compra','id_producto'];
    protected  $primaryKey  = 'id_detalle_c';
    public $timestamps = false;
}
