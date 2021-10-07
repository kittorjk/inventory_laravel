<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SucursalProducto extends Model
{
    protected  $table='sucursal_producto';
    protected  $fillable=['id_sucursal','id_producto','fecha','estado','pre1','pre2','pre3','stock','stock_min','p_compra','id_user','stock_ini'];
    // protected  $primaryKey  = 'id_categoria';
    public $timestamps = false;

    public function detalle_venta(){

        return $this->hasMany(DetalleVenta::class,'id_sucursal_producto');

    }

    public function producto(){
        return $this->belongsTo(Producto::class,'id_producto');
    }


   /*  public function getFechaAttribute($value){
        return Carbon\Carbon::parse($value)->format('d/m/Y');
        return $this->attributes['fecha']->format('m/d/Y');
    } */
}
