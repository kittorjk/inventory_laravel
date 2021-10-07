<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Traspaso extends Model
{
    protected  $table='traspaso';
    protected  $fillable=['fecha','id_sucursal1','id_sucursal2','id_user'];
    // protected  $primaryKey  = 'id_categoria';
    public $timestamps = false;
}
