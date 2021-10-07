<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected  $table='categoria';
    protected  $fillable=['descripcion'];
    protected  $primaryKey  = 'id_categoria';
    public $timestamps = false;
}
