<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected  $table='producto';
    protected  $fillable=['codigo_barras','nombre','descripcion','stock_inicial','stock','stock_minimo','precio_compra','id_categoria','foto','pre1','pre2','pre3'];
    protected  $primaryKey  = 'id_producto';
    public $timestamps = false;

    public function sucursalproducto(){

        return $this->hasMany(SucursalProducto::class,'id_producto');

    }
}
