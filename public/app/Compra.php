<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected  $table='compra';
    protected  $fillable=['f_compra','id_proveedor','id_user'];
    protected  $primaryKey  = 'id_compra';
    public $timestamps = false;

   public function getFCompraAttribute($value){
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
       // return $this->attributes['f_compra']->format('m/d/Y');
      // return \Carbon\Carbon::parse($this->birthdate)->age;
    }
}
