<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected  $table='detalle_v';
    protected  $fillable=['precio','cantidad','id_venta','id_sucursal_producto'];
    protected  $primaryKey  = 'id_detalle_v';
    public $timestamps = false;

    public function venta(){
        return $this->belongsTo(Venta::class,'id_venta');
    }

    public function sucursalproducto(){
        return $this->belongsTo(SucursalProducto::class,'id_sucursal_producto');
    }


}
