<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Sucursal;
use App\Venta;
use App\DetalleVenta;
use App\SucursalProducto;
//use DB;
use Illuminate\Support\Facades\DB;
class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $venta = Venta::with('admin','cliente','sucursal','detalle','detalle.sucursalproducto','detalle.sucursalproducto.producto')->get();
        //return $venta;
        $sucursales =  Sucursal::select('id_sucursal','nombre')->get();
        return view('admin.venta.index',compact('sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     //return count($request->detalle);
     //return $request->detalle[1];
        try {
            DB::beginTransaction();
            $mytime= Carbon::now('America/La_Paz');

            $venta = new Venta();
            $venta->fecha       =  $mytime->toDateString();
            $venta->id_cliente  =   $request->id_cliente;
            $venta->id_admin    =   $request->id_admin;
            $venta->id_sucursal =   $request->id_sucursal;

            $venta->save();
            // agregando detalle
            for ($i=0; $i < count($request->detalle); $i++) {

                $detalle = new DetalleVenta();
                $detalle->precio                = $request->detalle[$i]['precio'];
                $detalle->cantidad              = $request->detalle[$i]['cantidad'];
                $detalle->id_sucursal_producto  = $request->detalle[$i]['id_sucursal_producto'];
                $detalle->id_venta              =  $venta->id_venta;

                $detalle->save();

                 // actualizando Stock en tabla Sucursal_producto por sucursal

                 $sucprod = SucursalProducto::find($request->detalle[$i]['id_sucursal_producto']);
                 $sucprod->stock =  $sucprod->stock - $request->detalle[$i]['cantidad'];
                 $sucprod->save();

            }


            DB::commit();
            return 'ok';

        } catch(Exception $e){
            DB::rollBack();
            return 'false';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta = Venta::with('admin','cliente','sucursal','detalle','detalle.sucursalproducto','detalle.sucursalproducto.producto')->where('id_sucursal',$id)->get();
        return $venta;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    public function pdf(Request $request,$id,$fechaIni,$fechaFin){

        $sql = "select
        v.id,
        s.nombre as sucursal,
        date(v.fecha),
        p.nombre,
        p.descripcion,
        dv.precio as precio_venta,
        dv.cantidad,
        (dv.precio*dv.cantidad)as subtotal


        from venta v
        inner join detalle_v dv on v.id=dv.id_venta
        inner join sucursal s on s.id_sucursal = v.id_sucursal
        inner join sucursal_producto sp on sp.id = dv.id_sucursal_producto
        inner join producto p on p.id_producto = sp.id_producto ";

        if($id==0 and $fechaIni ==0 and  $fechaFin==0){
            $servicee = DB::select ($sql);
        }

        if($id==0 and $fechaIni !=0 and  $fechaFin==0){
            $servicee = DB::select (
                $sql."where date(v.fecha) = '".$fechaIni."'");
        }
        if($id==0 and $fechaIni !=0 and  $fechaFin!=0){
            $servicee = DB::select (
                $sql."where date(v.fecha) BETWEEN  '".$fechaIni."' AND  '".$fechaFin."'
                order by date asc
                ");
        }
        if($id!=0 and $fechaIni ==0 and  $fechaFin==0){
            $servicee = DB::select (
                $sql."where s.id_sucursal = '".$id."'
                order by date");
        }
        if($id!=0 and $fechaIni !=0 and  $fechaFin==0){
            $servicee = DB::select (
                $sql."where s.id_sucursal = '".$id."' AND date(v.fecha) = '".$fechaIni."'
                order by sucursal, date
                "
            );
        }
        if($id!=0 and $fechaIni !=0 and  $fechaFin!=0){
            $servicee = DB::select (
                $sql."where s.id_sucursal = '".$id."' AND date(v.fecha) BETWEEN  '".$fechaIni."' AND  '".$fechaFin."'
                order by sucursal, date"
            );
        }


         //return $servicee;
          // $pdf= \PDF::loadView('admin.pdf.venta',compact('sucursal','detalles'));
           $pdf= \PDF::loadView('admin.pdf.venta',compact('servicee'));
           return $pdf->stream();


    }

    public function pdfMaster(Request $request,$id,$fechaIni,$fechaFin){

        $sql = "select
        v.id,
        s.nombre as sucursal,
        to_char(v.fecha,'DD/MM/YYYY HH24:MI:SS') as date,
        p.nombre,
        p.descripcion,
        dv.precio as precio_venta,
        dv.cantidad,
        (dv.precio*dv.cantidad)as subingreso,
        p.precio_compra,
        (p.precio_compra*dv.cantidad)as subcapital,
        (dv.precio*dv.cantidad - p.precio_compra*dv.cantidad)as subganancia


        from venta v
        inner join detalle_v dv on v.id=dv.id_venta  and dv.estado = true
        inner join sucursal s on s.id_sucursal = v.id_sucursal
        inner join sucursal_producto sp on sp.id = dv.id_sucursal_producto
        inner join producto p on p.id_producto = sp.id_producto ";

        $sqlTotal = "select
            sum( dv.precio*dv.cantidad ) as tingreso,
            sum( p.precio_compra*dv.cantidad)tcap,
            sum ( (dv.precio*dv.cantidad) - ( p.precio_compra*dv.cantidad))as tgan

            from venta v
            inner join detalle_v dv on dv.id_venta = v.id and dv.estado = true
            inner join sucursal_producto sp on sp.id = dv.id_sucursal_producto
            inner join producto p on p.id_producto = sp.id_producto ";

        if($id==0 and $fechaIni ==0 and  $fechaFin==0){
            $servicee = DB::select ($sql."where v.estado=true");
            $total = DB::select ($sqlTotal."where v.estado=true");

        }

        if($id==0 and $fechaIni !=0 and  $fechaFin==0){
            $servicee = DB::select (
                $sql."where date(v.fecha) = '".$fechaIni."'  and v.estado=true");
            $total = DB::select (
                    $sqlTotal."where date(v.fecha) = '".$fechaIni."'  and v.estado=true");
        }
        if($id==0 and $fechaIni !=0 and  $fechaFin!=0){
            $servicee = DB::select (
                $sql."where date(v.fecha) BETWEEN  '".$fechaIni."' AND  '".$fechaFin."' and v.estado=true
                order by date asc
                ");

            $total = DB::select (
                    $sqlTotal."where date(v.fecha) BETWEEN  '".$fechaIni."' AND  '".$fechaFin."' and v.estado=true");
        }
        if($id!=0 and $fechaIni ==0 and  $fechaFin==0){
            $servicee = DB::select (
                $sql."where s.id_sucursal = '".$id."' and v.estado=true
                order by date");

            $total = DB::select (
                    $sqlTotal."where v.id_sucursal = '".$id."' and v.estado=true");
        }
        if($id!=0 and $fechaIni !=0 and  $fechaFin==0){
            $servicee = DB::select (
                $sql."where s.id_sucursal = '".$id."' AND date(v.fecha) = '".$fechaIni."' and v.estado=true
                order by sucursal, date
                "
            );

            $total = DB::select (
                $sqlTotal."where v.id_sucursal = '".$id."' AND date(v.fecha) = '".$fechaIni."'
                and v.estado=true");
        }
        if($id!=0 and $fechaIni !=0 and  $fechaFin!=0){
            $servicee = DB::select (
                $sql."where s.id_sucursal = '".$id."' AND date(v.fecha) BETWEEN  '".$fechaIni."' AND  '".$fechaFin."' and v.estado=true
                order by sucursal, date"
            );

            $total = DB::select (
                $sqlTotal."where v.id_sucursal = '".$id."' AND date(v.fecha) BETWEEN  '".$fechaIni."' AND  '".$fechaFin."' and v.estado=true
                "
            );
        }


         //return $servicee;
          // $pdf= \PDF::loadView('admin.pdf.venta',compact('sucursal','detalles'));
           $pdf= \PDF::loadView('admin.pdf.ventaMaster',compact('servicee','total'));
           return $pdf->stream();

    }
}
