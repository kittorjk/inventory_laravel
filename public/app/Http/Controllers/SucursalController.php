<?php

namespace App\Http\Controllers;

use App\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
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
        $sucursales = Sucursal::all();
        $message = '';
        return view('admin.sucursal.index', compact('sucursales','message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sucursal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Sucursal::create($request->all());
       //  return redirect()->route('categoria');
       return redirect('sucursal')->with('success','ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show(Sucursal $sucursal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function edit(Sucursal $sucursal)
    {
        return view('admin.sucursal.edit', compact('sucursal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sucursal $sucursal)
    {
        $form_data = array(
            'nombre'            =>  $request->nombre,
            'direccion'         =>  $request->direccion,
            'nit'               =>  $request->nit,
            'telefono_fijo'     =>  $request->telefono_fijo,
            'telefono_celular'  =>  $request->telefono_celular,
            'email'             =>  $request->email,
            'web'                =>  $request->web
        );

        Sucursal::where('id_sucursal','=',$sucursal->id_sucursal)->update($form_data);
        return redirect('sucursal')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sucursal $sucursal)
    {
        //dd($sucursal->id_sucursal);
        $data = Sucursal::find($sucursal->id_sucursal);
        //$data->delete();
        try {
            $data->delete();
            $message =  'Sucursal eliminada correctamente!';
        } catch (\Throwable $th) {
            $message = 'Sucursal NO pudo eliminarse!';

        }


//return  $message;
            return redirect()->back()->with( 'message',$message);



    }
}
