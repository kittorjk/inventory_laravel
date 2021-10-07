<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SucursalProductoAdicion extends Model
{

    protected  $table='sucursal_producto_adicion';
    protected  $fillable=['id_sucursal_producto','fecha','cantidad','id_user'];
    public $timestamps = false;

    public function getFechaAttribute($value){
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }
}
