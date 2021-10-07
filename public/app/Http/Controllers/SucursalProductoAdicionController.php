<?php

namespace App\Http\Controllers;

use App\SucursalProductoAdicion;
use App\SucursalProducto;
use App\Producto;
use App\Sucursal;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class SucursalProductoAdicionController extends Controller
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
        $sucursales =  Sucursal::select('id_sucursal','nombre')->get();
        return view('admin.adicionstk.index',compact('sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursales =  Sucursal::select('id_sucursal','nombre')->get();
        return view('admin.adicionstk.create',compact('sucursales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //return $request->cantidad;
       $mytime= Carbon::now('America/La_Paz');
        $sp=SucursalProducto::findOrFail($request->id_sucursal_producto);
        $prod = Producto::find($sp->id_producto);
       //return $producto;
        if($sp and $request->cantidad >= 0 and ($prod->stock -  $request->cantidad) >= 0 and  $request->precioc > 0 ){

            $sp->stock = $sp->stock + $request->cantidad;
            // cambia precios
            //$sp->fecha = strval($mytime);
            $sp->pre1 =  $request->pre11;
            $sp->pre2 =  $request->pre22;
            $sp->pre3 =  $request->pre33;
            $sp->p_compra =  $request->precioc;
            $sp->save();
            SucursalProductoAdicion::create([
                'id_sucursal_producto'   =>  $request->id_sucursal_producto,
                'fecha'                  =>   strval($mytime),//$mytime->toDateString(),// date('Y/m/d  h:i:s'),
                'cantidad'               =>  $request->cantidad,
                'id_user' => \Auth::user()->id
            ]);
            // actualizando producto almacen
            $prod->stock = $prod->stock - $request->cantidad;
            $prod->precio_compra =  $request->precioc;
            $prod->save();

            return 'ok';
        }else{
            return 'false';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SucursalProductoAdicion  $sucursalProductoAdicion
     * @return \Illuminate\Http\Response
     */
    public function show(SucursalProductoAdicion $sucursalProductoAdicion)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SucursalProductoAdicion  $sucursalProductoAdicion
     * @return \Illuminate\Http\Response
     */
    public function edit(SucursalProductoAdicion $sucursalProductoAdicion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SucursalProductoAdicion  $sucursalProductoAdicion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SucursalProductoAdicion $sucursalProductoAdicion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SucursalProductoAdicion  $sucursalProductoAdicion
     * @return \Illuminate\Http\Response
     */
   // public function destroy(SucursalProductoAdicion $sucursalProductoAdicion)
    public function destroy($id)
    {
        $adicion = SucursalProductoAdicion::find($id);
        $sucProd = SucursalProducto::find($adicion->id_sucursal_producto);
        // restando cantidad
        $sucProd->stock =($sucProd->stock - $adicion->cantidad);
        $sucProd->save();

        $producto = Producto::find($sucProd->id_producto);
        $producto->stock =($producto->stock + $adicion->cantidad);
        $producto->save();


        if($adicion->delete()){
            return 'ok';
        }
        else{
            return 'false';
        }
    }

    public function adicion(Request $request){
        //dd($request);

        try{

            DB::beginTransaction();

            $mytime= Carbon::now('America/La_Paz');

            $id_producto=$request->id_producto;
            $cantidad=$request->cantidad;
            $precio_compra = $request->precio_compra;
            $pre1 =$request->pre1;
            $pre2 =$request->pre2;
            $pre3 =$request->pre3;

            //Recorro todos los elementos
            $cont=0;

             while($cont < count($id_producto)){

                $detalle = new SucursalProductoAdicion();

                $detalle->id_sucursal_producto = $id_producto[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->fecha = strval($mytime);
                $detalle->id_user = \Auth::user()->id;
                $detalle->save();

                //actualuzando Sucursal Producto
                $sp=SucursalProducto::findOrFail($id_producto[$cont]);
                $prod = Producto::find($sp->id_producto);

                $sp->stock = ($sp->stock + $cantidad[$cont]);
                $sp->pre1 = $pre1[$cont];
                $sp->pre2 = $pre2[$cont];
                $sp->pre3 = $pre3[$cont];
                $sp->p_compra = $precio_compra[$cont];
                $sp->save();

                // Actualizando Producto Almacen Central

                $prod->stock = $prod->stock - $cantidad[$cont];
                $prod->precio_compra =  $precio_compra[$cont];
                $prod->save();

                 $cont=$cont+1;
            }

            DB::commit();
            $message =  'Adicion Stock realizado correctamente!!!!';

        } catch(Exception $e){

            DB::rollBack();
            $message =  'Error al realizar la Adicion Stock !!!! ';
        }

       // return Redirect::to('compra');
       return redirect('sucursal_adicion')->with( 'message',$message);
    }

    public function pdf(Request $request,$fecha,$suc){
        $detalles = DB::select("select spa.id,spa.fecha, spa.cantidad,p.nombre,sp.pre1,sp.pre2,sp.pre3
        from sucursal_producto_adicion  spa
        inner join sucursal_producto sp  on  spa.id_sucursal_producto = sp.id
        inner join sucursal s on s.id_sucursal = sp.id_sucursal
        inner join producto p on p.id_producto=sp.id_producto
        where date(spa.fecha) = '".$fecha."' and s.id_sucursal = '".$suc."'
         order by spa.id asc");
         $fecha= Carbon::now('America/La_Paz')->format('d/m/Y H:i:s');
         $usuario = \Auth::user()->name;
        $sucursal = Sucursal::find($suc);
        $pdf= \PDF::loadView('admin.pdf.adicionStk',compact('sucursal','detalles','usuario','fecha'))
        ->setPaper( array(0, 0, 226.772, 340.157));
        return $pdf->stream();
    }


}
