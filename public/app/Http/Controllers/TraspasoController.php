<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Traspaso;
use App\DetalleTraspaso;
use App\Sucursal;
use App\SucursalProducto;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PDF;
use DB;


class TraspasoController extends Controller
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
        return view('admin.traspaso.index',compact('sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursales =  Sucursal::select('id_sucursal','nombre')->get();
        return view('admin.traspaso.create',compact('sucursales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mytime= Carbon::now('America/La_Paz');
        Traspaso::create([
            'id_sucursal1'   =>  $request->id_sucursal1,
            'id_sucursal2'   =>  $request->id_sucursal2,
            'fecha'         =>  $mytime->toDateString(),
            'id_user'       =>  \Auth::user()->id
        ]);

        return view('admin.traspaso.show');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Traspaso  $traspaso
     * @return \Illuminate\Http\Response
     */
    public function show(Traspaso $traspaso)
    {
        return view('admin.traspaso.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Traspaso  $traspaso
     * @return \Illuminate\Http\Response
     */
    public function edit(Traspaso $traspaso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Traspaso  $traspaso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Traspaso $traspaso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Traspaso  $traspaso
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Traspaso $traspaso)
    public function destroy($id)
    {
        $traspaso = Traspaso::find($id);
        $detalle = DetalleTraspaso::where('id_traspaso','=',$traspaso->id)->get();

       // return $traspaso->id_sucursal2;

       if( $traspaso->id_sucursal2 != null)
       {
            for ($i = 0; $i < (count($detalle)); $i++) {

                $sc_origen =SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$detalle[$i]->id_producto)->get();
                $sc_destino =SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal2)->where('id_producto','=',$detalle[$i]->id_producto)->get();

                SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$detalle[$i]->id_producto)->update(['stock'=> ($sc_origen[0]->stock + $detalle[$i]->cantidad)]);
                SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal2)->where('id_producto','=',$detalle[$i]->id_producto)->update(['stock'=> ($sc_destino[0]->stock - $detalle[$i]->cantidad)]);

            }
            DetalleTraspaso::where('id_traspaso','=',$traspaso->id)->delete();
            if($traspaso->delete()){
                    return 'ok';
                }
                else{
                    return 'false';
                }
       }
       else {
        //return $traspaso;
            for ($i = 0; $i < (count($detalle)); $i++) {
                $sc_origen =SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$detalle[$i]->id_producto)->get();
                SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$detalle[$i]->id_producto)->update(['stock'=> ($sc_origen[0]->stock - $detalle[$i]->cantidad)]);

                $producto = Producto::find($detalle[$i]->id_producto);
                $producto->stock = ($producto->stock + $detalle[$i]->cantidad);
                $producto->save();
            }
            DetalleTraspaso::where('id_traspaso','=',$traspaso->id)->delete();
            if($traspaso->delete()){
                    return 'ok';
                }
                else{
                    return 'false';
                }
       }


    }

    public function pdf(Request $request,$id){
        //pdfTraspaso;

        $tp=Traspaso::find($id);
        if($tp->id_sucursal2 == NULL){

            $traspaso = DB::table('traspaso as t')
            ->join('sucursal as sc1','sc1.id_sucursal', '=', 't.id_sucursal1')
            ->join('users as u','u.id','=','t.id_user')
            ->where('t.id','=',$id)
            ->select ('t.id','sc1.nombre as origen',  't.fecha', 'u.name as usuario')
            ->get();

            $detalles = DB::select("select t.id,t.fecha, dt.cantidad,p.nombre,sp.pre1,sp.pre2,sp.pre3
            from traspaso t
            inner join detalle_traspaso dt on t.id=dt.id_traspaso
            inner join producto p on p.id_producto = dt.id_producto
            inner join sucursal_producto sp on sp.id_sucursal=t.id_sucursal1 and sp.id_producto=p.id_producto
            where t.id = '".$id."' and t.id_sucursal2 is null ");

            $fecha= Carbon::now('America/La_Paz')->format('d/m/Y H:i:s');
            $usuario = \Auth::user()->name;
            $mytime= Carbon::now('America/La_Paz')->format('Y-m-d');
           $sucursal = Sucursal::find($tp->id_sucursal1);
            $pdf= \PDF::loadView('admin.pdf.sucursalFecha',compact('sucursal','detalles','usuario','fecha','id'))
            ->setPaper( array(0, 0, 226.772, 340.157));
            return $pdf->stream();
        }
        else{
            $traspaso = DB::table('traspaso as t')
            ->join('sucursal as sc1','sc1.id_sucursal', '=', 't.id_sucursal1')
            ->join('sucursal as sc2','sc2.id_sucursal', '=', 't.id_sucursal2')
            ->join('users as u','u.id','=','t.id_user')
            ->where('t.id','=',$id)
            ->select ('t.id','sc1.nombre as origen', 'sc2.nombre as destino', 't.fecha', 'u.name as usuario')
            ->get();

            $detalles = DB::select("select t.id,t.fecha, dt.cantidad,p.nombre as producto,sp.pre1,sp.pre2,sp.pre3
            from traspaso t
            inner join detalle_traspaso dt on t.id=dt.id_traspaso
            inner join producto p on p.id_producto = dt.id_producto
            inner join sucursal_producto sp on sp.id_sucursal=t.id_sucursal2 and sp.id_producto=p.id_producto
            where t.id = '".$id."' ");

            $pdf= \PDF::loadView('admin.pdf.traspaso',compact('traspaso','detalles'))
            // ->setPaper( array(0, 0, 226.772,  $tam)); // habilitar IMP termica
             ->setPaper( array(0, 0, 226.772, 340.157)); // habilitar IMP termica

            return $pdf->stream();
        }

    }


    public function traspasar(Request $request){

        //return $request->pre1[0];
        //   return $request->idorigen;

        try{

            DB::beginTransaction();

            $mytime= Carbon::now('America/La_Paz');

            $traspaso = new Traspaso();
            $traspaso->fecha = strval($mytime); //$mytime->toDateString();
            $traspaso->id_sucursal1 = $request->idorigen;
            $traspaso->id_sucursal2 = $request->id_sucursal2;
            $traspaso->id_user = \Auth::user()->id;


            $traspaso->save();

            $id_producto=$request->id_producto;
            $cantidad=$request->cantidad;
            $pre1 =$request->pre1;
            $pre2 =$request->pre2;
            $pre3 =$request->pre3;

            //Recorro todos los elementos
            $cont=0;

             while($cont < count($id_producto)){

                $detalle = new DetalleTraspaso();
                /*enviamos valores a las propiedades del objeto detalle*/
                /*al idcompra del objeto detalle le envio el id del objeto compra, que es el objeto que se ingresó en la tabla compras de la bd*/

                $detalle->cantidad = $cantidad[$cont];
                $detalle->id_producto = $id_producto[$cont];
                $detalle->id_traspaso = $traspaso->id;
                $detalle->save();


                // actualizando Stock en tabla Sucusal_Productos (Almacen)


                $sc_origen =SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$id_producto[$cont])->get();
                $sc_destino =SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal2)->where('id_producto','=',$id_producto[$cont])->get();

                if(count($sc_destino)==0){
                    // si NOOOO  existe producto en la sucursal destino proveido por almace

                    SucursalProducto::create([
                        'id_sucursal'   =>  $traspaso->id_sucursal2,
                        'id_producto'   =>  $id_producto[$cont],
                        'fecha'         => strval($mytime),//date('Y/m/d'),
                        'estado'        =>  1,
                        'pre1'          =>  $pre1[$cont],//$sc_origen[0]->pre1,
                        'pre2'          =>  $pre2[$cont],//$sc_origen[0]->pre2,
                        'pre3'          =>  $pre3[$cont],//$sc_origen[0]->pre3,
                        'stock'         =>  $cantidad[$cont],
                        'stock_min'     =>  $sc_origen[0]->stock_min,
                        'p_compra'      =>  $sc_origen[0]->p_compra,
                        'id_user'    =>     \Auth::user()->id,
                        'stock_ini'     =>  $cantidad[$cont]
                    ]);

                    //actualizando stock en Sucursal origen
                    SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$id_producto[$cont])->update(['stock'=> ($sc_origen[0]->stock - $cantidad[$cont] )]);

                }
                else{
                    // si el preducto esta en ambas sucursales

                    SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$id_producto[$cont])->update(['stock'=> ($sc_origen[0]->stock - $cantidad[$cont] )]);
                    //'fecha'=>strval($mytime),
                    SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal2)->where('id_producto','=',$id_producto[$cont])->update(['stock'=> ($sc_destino[0]->stock + $cantidad[$cont] ),'pre1'=> $pre1[$cont],'pre2'=> $pre2[$cont],'pre3'=> $pre3[$cont]]);

                }


                $cont=$cont+1;
            }

            DB::commit();
            $message =  'Traspaso realizado correctamente!!!!';

        } catch(Exception $e){

            DB::rollBack();
            $message =  'Error al realizar el Traspaso !!!! ';
        }

       // return Redirect::to('compra');
       return redirect('traspaso')->with( 'message',$message);
    }

    public function pdf2(Request $request,$id){

        $sucprod = SucursalProducto::find($id);
        $producto = $sucprod->producto;

       // return $producto;

        $detalles = DB::select("
        select date(spa.fecha),spa.cantidad,u.name
            from sucursal_producto_adicion  spa
            inner join users u on u.id=spa.id_user
            where spa.id_sucursal_producto='".$id."'
            order by date desc");
        //return $detalle;
        //$pdf= \PDF::loadView('admin.pdf.addstock',compact('sucursal','detalles'));
        //return $pdf->stream();

        if(count($detalles) ==1){
            $tam = 170.079; //283.465 = 10 cm
         }
         else{
             if(count($detalles) % 2 == 0){
                $tam = 170.079 * (count($detalles) /2);
             }
             else{
                $tam = 170.079 * (count($detalles) /3);
             }
         }


       $pdf= \PDF::loadView('admin.pdf.addstock',compact('producto','detalles'))
       ->setPaper( array(0, 0, 226.772,  $tam)); // habilitar IMP termica

      return $pdf->stream();

    }
    /* public function detalle_traspaso(Request $request){

        return $request->all();
    } */
}
