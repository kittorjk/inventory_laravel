<?php

namespace App\Http\Controllers;

use App\SucursalProducto;
use App\Sucursal;
use App\Producto;
use App\Traspaso;
use App\DetalleTraspaso;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SucursalProductoController extends Controller
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
        return view('admin.sucursal_producto.index',compact('sucursales'));
    }

    public function adicion()
    {
        $sucursales =  Sucursal::select('id_sucursal','nombre')->get();
        return view('admin.sucursal_producto.adicion',compact('sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursales =  Sucursal::select('id_sucursal','nombre')->get();
        return view('admin.sucursal_producto.create',compact('sucursales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      // return date('Y/m/d H:i:s');
       //  SucursalProducto::create($request->all());
       $mytime= Carbon::now('America/La_Paz');
       $producto = Producto::find($request->id_producto);
       $existe =DB::table('sucursal_producto')->where('id_producto','=',$producto->id_producto)->where('id_sucursal','=',$request->id_sucursal)->get();
//return count($existe);
       if( ($producto->stock - $request->stock) >= 0 ){


        if(count($existe)==0){
                $producto->stock =  ($producto->stock - $request->stock);
                $producto->save();
                SucursalProducto::create([
                    'id_sucursal'   =>  $request->id_sucursal,
                    'id_producto'   =>  $request->id_producto,
                    'fecha'         =>  strval($mytime),//date('Y/m/d H:i:s'),//$request->fecha,
                    'estado'        =>  "1",
                    'pre1'          =>  $request->pre1,
                    'pre2'          =>  $request->pre2,
                    'pre3'          =>  $request->pre3,
                    'stock'         =>  $request->stock,
                    'stock_min'     =>  $request->stock_min,
                    'p_compra'      =>  $producto->precio_compra,
                    'id_user'    => \Auth::user()->id
                ]);
                return 'ok';
            }
            else {
                return 'Producto Exite';
            }
       }
       else{
        return 'false';
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SucursalProducto  $sucursalProducto
     * @return \Illuminate\Http\Response
     */
    public function show(SucursalProducto $sucursalProducto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SucursalProducto  $sucursalProducto
     * @return \Illuminate\Http\Response
     */
    public function edit(SucursalProducto $sucursalProducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SucursalProducto  $sucursalProducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SucursalProducto $sucursalProducto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SucursalProducto  $sucursalProducto
     * @return \Illuminate\Http\Response
     */
   // public function destroy(SucursalProducto $sucursalProducto)
    public function destroy( $id)
    {
        $data = SucursalProducto::findOrFail($id);
        $producto = Producto::find($data->id_producto);
        $producto->stock = ($producto->stock + $data->stock);

        $producto->save();
        $data->delete();

       /*  $data = SucursalProducto::findOrFail($id);
        if($data->estado=="1"){
            $data->estado = '0';
            $data->save();
        }
        else{
            $data->estado = '1';
            $data->save();
        } */

    }

    public function traspasar(Request $request){

        //return $request;
        //   return $request->idorigen;

        try{

            DB::beginTransaction();

            $mytime= Carbon::now('America/La_Paz');

            $traspaso = new Traspaso();
            $traspaso->fecha = strval($mytime); //$mytime->toDateString();
            $traspaso->id_sucursal1 = $request->id_sucursal;
           $traspaso->id_sucursal2 = NULL;
            $traspaso->id_user = \Auth::user()->id;


            $traspaso->save();

            $id_producto=$request->id_producto;
            $cantidad=$request->cantidad;
            $pre1 =$request->pre1;
            $pre2 =$request->pre2;
            $pre3 =$request->pre3;
            $pcompra = $request->precio_compra;

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
               // verificando existencia de producto en sucursal
                $existe =DB::table('sucursal_producto')->where('id_producto','=',$id_producto[$cont])->where('id_sucursal','=',$request->id_sucursal)->get();

                $producto = Producto::find($id_producto[$cont]);
                $producto->stock =  ($producto->stock - $cantidad[$cont]);
                $producto->pre1 =  $pre1[$cont];
                $producto->pre2 =  $pre2[$cont];
                $producto->pre3 =  $pre3[$cont];
                $producto->save();
                // actualizando Stock en tabla Sucusal_Productos (Almacen)


                //$sc_origen =SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$id_producto[$cont])->get();
                $sc_destino =SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$id_producto[$cont])->get();



                if(count($existe)==0){

                    SucursalProducto::create([
                        'id_sucursal'   =>  $request->id_sucursal,
                        'id_producto'   =>  $id_producto[$cont],
                        'fecha'         =>  strval($mytime),//date('Y/m/d H:i:s'),//$request->fecha,
                        'estado'        =>  "1",
                        'pre1'          =>  $pre1[$cont],//$sc_origen[0]->pre1,
                        'pre2'          =>  $pre2[$cont],//$sc_origen[0]->pre2,
                        'pre3'          =>  $pre3[$cont],//$sc_origen[0]->pre3,
                        'stock'         =>  $cantidad[$cont],
                        'stock_min'     =>  5,
                        'p_compra'      =>  $pcompra[$cont],
                        'id_user'       =>     \Auth::user()->id,
                        'stock_ini'     =>  $cantidad[$cont]
                    ]);
                   // return 'ok';
                }
                else{
                    // si el preducto esta en ambas sucursales
                   // SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$id_producto[$cont])->update(['stock'=> ($sc_origen[0]->stock - $cantidad[$cont] )]);
                   //'fecha'=>strval($mytime),
                    SucursalProducto::where('id_sucursal','=',$traspaso->id_sucursal1)->where('id_producto','=',$id_producto[$cont])->update(['stock'=> ($sc_destino[0]->stock + $cantidad[$cont] ),'pre1'=> $pre1[$cont],'pre2'=> $pre2[$cont],'pre3'=> $pre3[$cont],'estado'=>true]);

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
       return redirect('sucursal_producto')->with( 'message',$message);
    }

    public function productos(Request $request)
    {
        $term = strtolower($request->get('term'));
        //$productos = Producto::where(DB::raw('CONCAT(id_producto, \' - \',nombre)'),'LIKE','%'. $term.'%')->get();
        $productos = Producto::where(DB::raw('lower(CONCAT(id_producto, \' - \',nombre))'),'LIKE','%'. $term.'%')->get();
        //where('nombre','LIKE','%'. $term.'%')->get();

        //return $productos;

        $data = [];
        foreach ($productos as $prod){
            $data[]=[
                'label' => $prod->id_producto.'-'.$prod->nombre,
                'id' => $prod->id_producto,
                'stock'=>$prod->stock,
                'precio'=>$prod->precio_compra,
                'foto'=>$prod->foto,
                'descripcion'=>$prod->descripcion,


            ];
        }
        return   $data;
    }

    public function productoSucursal(Request $request, $id){

        $term =strtolower($request->get('term'));
        $traspaso =  Traspaso::find($id);

        $producto = DB::table('producto as p')
        ->join('sucursal_producto as sp','sp.id_producto','=','p.id_producto')
        ->where('sp.id_sucursal','=',$traspaso->id_sucursal1)
        ->where(DB::raw('lower(CONCAT(p.id_producto, \' - \',p.nombre))'),'LIKE','%'. $term.'%')
        //->orWhere(DB::raw('CONCAT(p.id_producto, \' - \',p.nombre)'),'LIKE','%'. $term.'%')
        ->select('p.id_producto','p.nombre','p.descripcion','sp.fecha','sp.estado','sp.pre1','sp.pre2','sp.pre3', 'sp.stock','sp.stock_min','p.foto')
        ->get();

        //return $producto;
        $data = [];
        for ($i = 0; $i < (count($producto)); $i++) {
            $data[]=[
                'label' => $producto[$i]->id_producto.'-'.$producto[$i]->nombre,
                'id' => $producto[$i]->id_producto,
                'stock'=> $producto[$i]->stock,
                'foto'=> $producto[$i]->foto,
                'descripcion'=>$producto[$i]->descripcion,

            ];
        }
        return   $data;
    }

    public function pdf(Request $request,$id){

        $sucursal = Sucursal::find($id);
        $detalles = DB::table('producto as p')
        ->join('sucursal_producto as sp','sp.id_producto','=','p.id_producto')
        ->where('sp.id_sucursal','=',$id)
        ->select('p.id_producto','p.nombre','p.descripcion','sp.p_compra','sp.pre1','sp.pre2','sp.pre3', 'sp.stock','sp.stock_min','p.foto')
        ->get();
        //return $detalle;
        $pdf= \PDF::loadView('admin.pdf.sucursal',compact('sucursal','detalles'));
        return $pdf->stream();

    }

    public function pdfecha(Request $request,$id){
        //$traspaso =  Traspaso::find($id);

        $fecha= Carbon::now('America/La_Paz')->format('d/m/Y H:i:s');
        $usuario = \Auth::user()->name;

        $mytime= Carbon::now('America/La_Paz')->format('Y-m-d');
       //return  \Auth::user()->name;
       $sucursal = Sucursal::find($id);
        $detalles = DB::select ("select sp.id,date(sp.fecha) fecha,p.nombre,p.descripcion,sp.p_compra,sp.pre1,sp.pre2,sp.pre3
        from producto p
        inner join sucursal_producto sp on sp.id_producto=p.id_producto
        where sp.id_sucursal = '".$id."' and  date(sp.fecha) = '". $mytime."' ");
       // return $detalle;
        $pdf= \PDF::loadView('admin.pdf.sucursalFecha',compact('sucursal','detalles','usuario','fecha','id'))
        ->setPaper( array(0, 0, 226.772, 340.157));
        return $pdf->stream();

    }
    /* public function getproductos(Request $request)
    {

        return datatables()
        ->eloquent(App\Producto::query())
        ->addColumn('action', function($row){

            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_porducto.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategoria"><i class="icon-copy fa fa-pencil" aria-hidden="true"></i></a>';

           // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_categoria.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategoria"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a>';

             return $btn;
     })
        ->toJson();
    } */
}
