<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected  $table='cliente';
    protected  $fillable=['nombre','ci_nit'];
    protected  $primaryKey  = 'id_cliente';
    public $timestamps = false;

    public function ventas(){

        return $this->hasMany(Venta::class,'id_cliente');

    }

}
