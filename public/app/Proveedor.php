<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected  $table='proveedor';
    protected  $fillable=['nombre','ruc_nit','direccion','celular','telefono'];
    protected  $primaryKey  = 'id_proveedor';
    public $timestamps = false;
}
