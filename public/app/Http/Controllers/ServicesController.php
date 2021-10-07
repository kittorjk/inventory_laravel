<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\Producto;
use App\Cliente;
use App\SucursalProducto;


class ServicesController extends Controller
{

    public function categories(){

        return Categoria::all();

    }

    public function products(){

        return Producto::all();

    }
    public function clients(){

        return Cliente::all();

    }

    public function Addclients (Request $request ){
        Cliente::create($request->all());
        return 'ok';
    }

    public function sucursalProductos ($id){
        return SucursalProducto::where('id_sucursal','=',$id)->where('estado','<>','false')->get();
    }

}
