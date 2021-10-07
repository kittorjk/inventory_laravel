<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Categoria;
use Illuminate\Http\Request;
use DB;

class ProductoController extends Controller
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
       $productos = Producto::all();
        /* $productos = DB::table('producto')//->where('nombre','LIKE','%'.$sql.'%')
        ->orderBy('id_producto','desc')
        ->paginate(20); */
       //return  $productos;
        return view('admin.producto.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // $categorias = Categoria::orderBy('id_categoria', 'desc')->select('nombre', 'id_categoria');
       $categorias = Categoria::all();
        return view('admin.producto.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $request->validate([
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'image'         =>  'required|image|max:2048'
        ]); */
        $new_name="noimagen.jpg";
        $image = $request->file('foto');
        if(! empty($image)){
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
        }

        //$ruta=config('global.IP').''."images/";
        $ruta='http://178.128.144.208:9091/'.''."images/";

        $form_data = array(
            'codigo_barras'    =>   $request->codigo_barras,
            'nombre'           =>   $request->nombre,
            'descripcion'      =>   $request->descripcion,
            'stock'            =>   0,//$request->stock,
            'stock_minimo'     =>   $request->stock_minimo,
            'precio_compra'    =>   $request->precio_compra,
            'id_categoria'     =>   $request->id_categoria,
            'stock_inicial'    =>   $request->stock_inicial,
            'foto'             =>  $ruta.''.$new_name,
            'pre1'    =>   $request->pre1,
            'pre2'    =>   $request->pre2,
            'pre3'    =>   $request->pre3,
        );

        Producto::create($form_data);

        return redirect('producto')->with('success', 'Data Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto= Producto::findOrFail($id);
        $categorias = Categoria::all();
        $categoria_p = Categoria::findOrFail($producto->id_categoria);
        return view('admin.producto.edit', compact('categorias','producto','categoria_p'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, Producto $producto)
    public function update(Request $request, Producto $producto)
    {
        $image_name = $request->hidden_image;
        $image = $request->file('foto');
        if($image != '')
        {
           /*  $request->validate([
                'first_name'    =>  'required',
                'last_name'     =>  'required',
                'image'         =>  'image|max:2048'
            ]); */
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);

            //$image_name=config('global.IP').''."images/".$image_name;
            $image_name='http://178.128.144.208:9091/'.''."images/".$image_name;
        }
        else
        {
           /*  $request->validate([
                'first_name'    =>  'required',
                'last_name'     =>  'required'
            ]); */
        }

        $form_data = array(
            'codigo_barras'    =>   $request->codigo_barras,
            'nombre'           =>   $request->nombre,
            'descripcion'      =>   $request->descripcion,
            'stock'            =>   $request->stock,
            'stock_minimo'     =>   $request->stock_minimo,
            'precio_compra'    =>   $request->precio_compra,
            'id_categoria'     =>   $request->id_categoria,
            'stock_inicial'    =>   $request->stock_inicial,
            'foto'             =>   $image_name,
            'pre1'    =>   $request->pre1,
            'pre2'    =>   $request->pre2,
            'pre3'    =>   $request->pre3,
        );

        Producto::where('id_producto','=',$producto->id_producto)->update($form_data);
        return redirect('producto')->with('success', 'Data is successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Producto $producto)
    public function destroy($id)
    {
        $data = Producto::findOrFail($id);
        if( $data->delete()){
            return 'ok';
        }
        else{
            return 'false';
        }

      /*   $message = $data ? 'Producto eliminada correctamente!' : 'El Producto NO pudo eliminarse!';
        return redirect('producto')->with('success', $message); */
    }
}
