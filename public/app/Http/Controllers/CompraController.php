<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Proveedor;
use App\Compra;
use App\Producto;
use App\DetalleCompra;
use App\SucursalProducto;
use DB;

class CompraController extends Controller
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
        return view('admin.compra.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores= Proveedor::all();
        return view('admin.compra.create',compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    //return ($request->all());
    //strval($mytime)
        try{

            DB::beginTransaction();

            $mytime= Carbon::now('America/La_Paz');

            $compra = new Compra();
            $compra->f_compra = strval($mytime);// $mytime->toDateString();
            $compra->id_proveedor = $request->id_proveedor=="Seleccione Proveeedor..." ? 3 : $request->id_proveedor;
            $compra->id_user = \Auth::user()->id;


            $compra->save();

            $id_producto=$request->id_producto;
            $cantidad=$request->cantidad;
            $precio=$request->precio_compra;

            $pre1 =$request->pre1;
            $pre2 =$request->pre2;
            $pre3 =$request->pre3;



            //Recorro todos los elementos
            $cont=0;

             while($cont < count($id_producto)){

                $detalle = new DetalleCompra();
                /*enviamos valores a las propiedades del objeto detalle*/
                /*al idcompra del objeto detalle le envio el id del objeto compra, que es el objeto que se ingresó en la tabla compras de la bd*/
                $detalle->precio = $precio[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->id_compra = $compra->id_compra;
                $detalle->id_producto = $id_producto[$cont];
                $detalle->save();


                // actualizando Stock en tabla Productos (Almacen)
                $producto=Producto::find($id_producto[$cont]);
                $producto->stock =  $producto->stock + $cantidad[$cont];
                $producto->precio_compra =  $precio[$cont];
                $producto->pre1 =  $pre1[$cont];
                $producto->pre2 =  $pre2[$cont];
                $producto->pre3 =  $pre3[$cont];
                $producto->save();

                // Actualizando Precios en todas las Sucursales  pre,pre2,pre3 (opcional)
                //SucursalProducto::where('id_producto','=',$id_producto[$cont])->update(['pre1'=> $pre1[$cont],'pre2'=> $pre2[$cont],'pre3'=> $pre3[$cont]]);

                $cont=$cont+1;
            }

            DB::commit();
            $message =  'Compra realizado correctamente!!!!';

        } catch(Exception $e){

            DB::rollBack();
            $message =  'Error al realizar la Compra !!!! ';
        }

       // return Redirect::to('compra');
       return redirect('compra')->with( 'message',$message);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        $compra = Compra::join('proveedor','compra.id_proveedor','=','proveedor.id_proveedor')
        ->join('detalle_c','compra.id_compra','=','detalle_c.id_compra')
        ->join('users','users.id','=','compra.id_user')
        ->select('compra.id_compra','compra.f_compra','users.name as usuario',
        DB::raw('sum(detalle_c.cantidad*precio) as total'),'proveedor.nombre','proveedor.ruc_nit','proveedor.direccion')
        ->where('compra.id_compra','=',$id)
        ->orderBy('compra.id_compra', 'desc')
        ->groupBy('compra.id_compra','compra.f_compra','proveedor.nombre','proveedor.direccion','users.name','proveedor.ruc_nit')
        ->first();

    $detalles = DetalleCompra::join('producto','detalle_c.id_producto','=','producto.id_producto')
             ->select('detalle_c.cantidad','detalle_c.precio','producto.nombre as producto')
             ->where('detalle_c.id_compra','=',$id)
             ->orderBy('detalle_c.id_detalle_c', 'asc')->get();

        return view('admin.compra.show',compact('compra','detalles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $compra = Compra::find($id);
        $detalle = DetalleCompra::where('id_compra','=',$compra->id_compra)->get();

        for ($i = 0; $i < (count($detalle)); $i++) {
            // almacen Productos
            $producto = Producto::find($detalle[$i]->id_producto);
            $producto->stock =  ($producto->stock - $detalle[$i]->cantidad);
            $producto->save();
        }
        DetalleCompra::where('id_compra','=',$compra->id_compra)->delete();
        if($compra->delete()){
            return 'ok';
        }
        else{
            return 'false';
        }
    }

    public function pdf(Request $request,$id){

        $compra = Compra::join('proveedor','compra.id_proveedor','=','proveedor.id_proveedor')
        ->join('detalle_c','compra.id_compra','=','detalle_c.id_compra')
        ->join('users','users.id','=','compra.id_user')
        ->select('compra.id_compra','compra.f_compra','users.name as usuario',
        DB::raw('sum(detalle_c.cantidad*precio) as total'),'proveedor.nombre','proveedor.ruc_nit','proveedor.direccion')
        ->where('compra.id_compra','=',$id)
        ->orderBy('compra.id_compra', 'desc')
        ->groupBy('compra.id_compra','compra.f_compra','proveedor.nombre','proveedor.direccion','users.name','proveedor.ruc_nit')
        ->first();

    $detalles = DetalleCompra::join('producto','detalle_c.id_producto','=','producto.id_producto')
             ->select('detalle_c.id_detalle_c','detalle_c.cantidad','detalle_c.precio','producto.nombre as producto')
             ->where('detalle_c.id_compra','=',$id)
             ->orderBy('detalle_c.id_detalle_c', 'asc')->get();

            /*  if($detalles->count() ==1){
                $tam = 226.772; //283.465 = 10 cm
             }
             else{
                 if($detalles->count() % 2 == 0){
                    $tam = 226.772 * ($detalles->count() /2);
                 }
                 else{
                    $tam = 226.772 * ($detalles->count() /3);
                 }
             } */

        // conversion centimetros a puntos tipográficos
        $pdf= \PDF::loadView('admin.pdf.compra',compact('compra','detalles'))
        ->setPaper( array(0, 0, 615.1181,  396.85)); // habilitar IMP termica

       //return $pdf->download('traspaso.pdf');
       return $pdf->stream();
    }

}
