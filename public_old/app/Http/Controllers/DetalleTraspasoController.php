<?php

namespace App\Http\Controllers;

use App\DetalleTraspaso;
use App\Traspaso;
use App\Producto;
use App\SucursalProducto;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
//use Carbon\Carbon; Carbon::now()->toTimeString(),

class DetalleTraspasoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // TODO: manejar ultima fecha de ingreso del  almacen a ambas sucursales --falta
        $traspaso = Traspaso::find( $request->id_traspaso);
        $sc_origen =SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$request->id_producto)->get();
        $sc_destino =SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal2)->where('id_producto','=',$request->id_producto)->get();
        // VERIFICANDO SI EXISTE PRODUCTO EN LA SUCUCURSAL DESTINO PROVEIDO POR ALMACEN CENTRAL
        //return count($sc_destino);
        if(count($sc_destino)==0){
            // agrgando a sucursal_producto

            //if( ( $sc_origen[0]->stock - $request->cantidad ) > $sc_origen[0]->stock_min and  $request->cantidad > 0 ){
            if( ( $sc_origen[0]->stock - $request->cantidad ) >= 0 and  $request->cantidad > 0 ){

            SucursalProducto::create([
                'id_sucursal'   =>  $traspaso->id_sucursal2,
                'id_producto'   =>  $request->id_producto,
                'fecha'         =>  date('Y/m/d'),
                'estado'        =>  1,
                'pre1'          =>  $sc_origen[0]->pre1,
                'pre2'          =>  $sc_origen[0]->pre2,
                'pre3'          =>  $sc_origen[0]->pre3,
                'stock'         =>  $request->cantidad,
                'stock_min'     =>  $sc_origen[0]->stock_min,
                'p_compra'      =>  $sc_origen[0]->p_compra
                //'id_user'    =>
            ]);
            SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$request->id_producto)->update(['stock'=> ($sc_origen[0]->stock - $request->cantidad )]);
            DetalleTraspaso::create($request->all());
            return'ok';
            }

            return  $request->cantidad > 0 ? 'stock' :'false';
        }
        else{
            // producto existe en ambas sucursales
            if( ( $sc_origen[0]->stock - $request->cantidad ) > $sc_origen[0]->stock_min and  $request->cantidad > 0)
            {
           SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$request->id_producto)->update(['stock'=> ($sc_origen[0]->stock - $request->cantidad )]);
           SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal2)->where('id_producto','=',$request->id_producto)->update(['stock'=> ($sc_destino[0]->stock + $request->cantidad )]);
           DetalleTraspaso::create($request->all());
           return'ok';
            }
            return  $request->cantidad > 0 ? 'stock' :'false';
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DetalleTraspaso  $detalleTraspaso
     * @return \Illuminate\Http\Response
     */
    public function show(DetalleTraspaso $detalleTraspaso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DetalleTraspaso  $detalleTraspaso
     * @return \Illuminate\Http\Response
     */
    public function edit(DetalleTraspaso $detalleTraspaso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DetalleTraspaso  $detalleTraspaso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleTraspaso $detalleTraspaso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DetalleTraspaso  $detalleTraspaso
     * @return \Illuminate\Http\Response
     */
    // public function destroy(DetalleTraspaso $detalleTraspaso)
    public function destroy($id)
    {
       //return $id;

        $dtraspaso = DetalleTraspaso::find($id);
        $traspaso = Traspaso::find($dtraspaso->id_traspaso);

        if( $traspaso->id_sucursal2 != null){

        $sc_origen =SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$dtraspaso->id_producto)->get();
        $sc_destino =SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal2)->where('id_producto','=',$dtraspaso->id_producto)->get();

        SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$dtraspaso->id_producto)->update(['stock'=> ($sc_origen[0]->stock + $dtraspaso->cantidad )]);
        SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal2)->where('id_producto','=',$dtraspaso->id_producto)->update(['stock'=> ($sc_destino[0]->stock - $dtraspaso->cantidad )]);

        $dtraspaso->delete();
        return 'ok';
        }
        else{

            //producto aumenta
            // sucursal_producto reduce
            $fecha_actual = strtotime(date("d-m-Y",time()));

            $prod = Producto::find($dtraspaso->id_producto);
            $prod->stock = ($prod->stock + $dtraspaso->cantidad);
            $prod->save();
            $sc_origen =SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$dtraspaso->id_producto)->get();

            $mytime= Carbon::now('America/La_Paz');
            if( ($sc_origen[0]->stock - $dtraspaso->cantidad) == 0  and  strval($mytime->format('Y-m-d')) == substr($sc_origen[0]->fecha,0,10)){
               // return strval($mytime->format('Y-m-d'));
              //  return substr($sc_origen[0]->fecha,0,10);
                SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$dtraspaso->id_producto)->update(['stock'=> ($sc_origen[0]->stock - $dtraspaso->cantidad),'stock_ini'=> 0,'estado'=>false]);
            }


            else{

                SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$dtraspaso->id_producto)->update(['stock'=> ($sc_origen[0]->stock - $dtraspaso->cantidad)]);
            }
            $dtraspaso->delete();
            return 'ok';
        }



    }
}
