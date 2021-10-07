<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
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
        /* $categorias = Categoria::all();
        return view('admin.categoria.index', compact('categorias')); */

        return view('admin.categoria.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Categoria::create($request->all());
        //return response()->json(['success'=>'Product saved successfully.']);
         //return redirect()->route('admin.categoria.index');
       //return redirect('categoria')->with('success','ok');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    //public function edit(Categoria $categoria)
    public function edit($id)
    {
         $data = Categoria::findOrFail($id);
        return view('admin.categoria.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
   // public function update(Request $request, Categoria $categoria)
    public function update(Request $request, $id)
    {
        $form_data = array(
            'descripcion'    =>  $request->descripcion
        );

        Categoria::where('id_categoria','=',$id)->update($form_data);
        //return redirect('categoria')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
   // public function destroy(Categoria $categoria)
    public function destroy($id)
    {
        /* $deleted = $categoria->delete();

        $message = $deleted ? 'Categoría eliminada correctamente!' : 'La Categoría NO pudo eliminarse!';

        return redirect()->route('admin.categoria.index')->with('message', $message);
    } */

    $data = Categoria::find($id);
       // $data->delete();
        $message = $data ? 'Categoría eliminada correctamente!' : 'La Categoría NO pudo eliminarse!';
        //return redirect('categoria')->with('success', $message);
        if( $data->delete()){
            return 'ok';
        }
        else{
            return 'false';
        }
    }
}
