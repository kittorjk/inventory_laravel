<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected  $table='sucursal';
    protected  $fillable=['nombre','direccion','nit','telefono_fijo','telefono_celular','email','web'];
    protected  $primaryKey  = 'id_sucursal';
    public $timestamps = false;

    public function ventas(){

        return $this->hasMany(Venta::class,'id_sucursal');

    }
}
