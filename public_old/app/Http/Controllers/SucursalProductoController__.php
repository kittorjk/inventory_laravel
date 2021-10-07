<?php

namespace App\Http\Controllers;

use App\SucursalProducto;
use App\Sucursal;
use App\Producto;
use App\Traspaso;
use DB;
use Illuminate\Http\Request;

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
       //  SucursalProducto::create($request->all());

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
                    //'fecha'         =>  $request->fecha,
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
