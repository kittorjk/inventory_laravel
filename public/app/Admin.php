<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected  $table='admin';
    protected  $fillable=['nombre','pass','estado'];
    public $timestamps = false;

    public function ventas(){

        return $this->hasMany(Venta::class,'id_admin');

    }
}
