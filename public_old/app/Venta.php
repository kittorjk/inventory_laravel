<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected  $table='venta';
    protected  $fillable=['fecha','id_cliente','id_admin','id_sucursal'];
    protected  $primaryKey  = 'id_venta';
    public $timestamps = false;

    public function admin(){
        return $this->belongsTo(Admin::class,'id_admin');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class,'id_cliente');
    }

    public function sucursal(){
        return $this->belongsTo(Sucursal::class,'id_sucursal');
    }

    public function detalle(){

        return $this->hasMany(DetalleVenta::class,'id_venta');

    }
}
