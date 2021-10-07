<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('admin', function(){
    // return App\Categoria::all();

      $data=  DB::table('admin')->orderBy('id','desc');
    return datatables()
        //->eloquent(App\Categoria::query())
         ->queryBuilder($data)
        ->addColumn('action', function($row){

            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategoria"><i class="icon-copy fa fa-pencil" aria-hidden="true"></i></a>';

            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategoria"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a>';

             return $btn;
     })
        ->toJson();
});

Route::get('users', function(){

      $data=  DB::table('users')->orderBy('id','desc');
    return datatables()
         ->queryBuilder($data)
        ->addColumn('action', function($row){
            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategoria"><i class="icon-copy fa fa-pencil" aria-hidden="true"></i></a>';
            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategoria"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a>';
            return $btn;
     })->toJson();
});


Route::get('categoria', function(){
    // return App\Categoria::all();

      $data=  DB::table('categoria')->orderBy('id_categoria','desc');
    return datatables()
        //->eloquent(App\Categoria::query())
         ->queryBuilder($data)
        ->addColumn('action', function($row){

            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_categoria.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategoria"><i class="icon-copy fa fa-pencil" aria-hidden="true"></i></a>';

            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_categoria.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategoria"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a>';

             return $btn;
     })
        ->toJson();
});

Route::get('proveedor', function(){
    // return App\Categoria::all();

      $data=  DB::table('proveedor')->orderBy('id_proveedor','desc');
    return datatables()
         ->queryBuilder($data)
        ->addColumn('action', function($row){

            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_proveedor.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategoria"><i class="icon-copy fa fa-pencil" aria-hidden="true"></i></a>';

            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_proveedor.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategoria"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a>';

             return $btn;
     })
        ->toJson();
});

Route::get('productodt', function(){
    $data=  DB::table('producto')->select('id_producto','nombre','descripcion','stock','stock','stock_minimo','precio_compra','stock_inicial','foto')->orderBy('nombre','asc');
    return datatables()
         ->queryBuilder($data)
        ->addColumn('action', function($row){
            $btn = '<div class="dropdown">
            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"  role="button" data-toggle="dropdown">
                <i class="dw dw-more"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list" >
            <a href="javascript:void(0)" class="dropdown-item verProducto" data-id_producto="'.$row->id_producto.'" ><i class="dw dw-eye"></i> Ver</a>

            <a class="dropdown-item" href="'. route('producto.edit', $row->id_producto) .'"><i class="dw dw-edit2"></i> Editar</a>
            <a href="javascript:void(0)" class="dropdown-item deleteProducto" data-id_producto="'.$row->id_producto.'"><i class="dw dw-delete-3"></i> Eliminar</a>
            </div>
        </div>';
        return $btn;
     })
        ->toJson();
});

// api listado de productos de la sucursal origen por id: sucursal
Route::get('productos_sucursal/{id}', function($id){
    //return 'entro';

    $traspaso =  App\Traspaso::find($id);
    $producto = DB::table('producto as p')
    ->join('sucursal_producto as sp','sp.id_producto','=','p.id_producto')
    ->where('sp.id_sucursal','=',$traspaso->id_sucursal1)
    ->select('p.id_producto','p.nombre','sp.fecha','sp.estado','sp.pre1','sp.pre2','sp.pre3', 'sp.stock','sp.stock_min')->get();
     // return App\SucursalProducto::query()->get();
     return $producto;

     /* return datatables()
        ->queryBuilder($producto)
         ->addColumn('action', function($row){
            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_producto.'" data-original-title="Delete" class="btn btn-success btn-sm AddProductoSucursal"><i class="icon-copy fa fa-cart-arrow-down" aria-hidden="true"></i></a>';
            return $btn;
        })
        ->toJson(); */
});
/* Route::get('producto/{id}', function($id){
        return App\Producto::find($id);
});
 */
Route::get('producto', function(){
    return  DB::table('producto')->orderBy('nombre','asc')->get();
});
Route::get('producto/{id}', function($id){
    return  App\Producto::findOrFail($id);
});
Route::get('productos', function(){
    // return App\Categoria::all();

     //$producto =  DB::select('select * from producto where stock > 0 and stock > stock_minimo');
   return datatables()
        //->eloquent(App\Producto::query()->where('stock','>',0))
        ->eloquent(App\Producto::query())
       // ->queryBuilder($producto)
        ->addColumn('action', function($row){

            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_producto.'" data-original-title="Edit" class="edit btn btn-primary btn-sm addSucursal"><i class="icon-copy fa fa-cart-arrow-down" aria-hidden="true"></i></a>';

           // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_categoria.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategoria"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a>';

             return $btn;
     })
        ->toJson();
});

Route::get('sucursal_productos', function(){
    // return App\Categoria::all();
    return datatables()
        ->eloquent(App\SucursalProducto::query())
        ->addColumn('action', function($row){

            //$btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm addSucursal"><i class="icon-copy fa fa-cart-arrow-down" aria-hidden="true"></i></a>';

           $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategoria"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a>';

             return $btn;
     })
        ->toJson();
});

Route::get('sucursal_productos/{id}', function($id){

    $data = DB::table('producto as p')
    ->join('sucursal_producto as sp','sp.id_producto','=','p.id_producto')
    ->where('sp.id_sucursal','=',$id)
    ->select('sp.id','p.nombre','sp.fecha','sp.estado','sp.pre1','sp.pre2','sp.pre3', 'sp.stock','sp.stock_min','p.foto','p.descripcion','p.id_producto','p.precio_compra','p.stock as stockal');
     // return App\SucursalProducto::query()->get();

     return datatables()
        ->queryBuilder($data)
        ->addColumn('action', function($row){
            $add= DB::table('sucursal_producto_adicion')->where('id_sucursal_producto','=',$row->id)->get();
/*
            if($row->estado=="1"){
               $btn = '<button type="button" class="btn btn-success"><i class="icon-copy fa fa-check-square" aria-hidden="true"></i></button>';
                $btn = ' <button type="button" class="btn btn-primary" data-id="'.$row->id.'" data-producto="'.$row->nombre.'" data-pre1="'.$row->pre1.'" data-pre2="'.$row->pre2.'" data-pre3="'.$row->pre3.'" data-precio_compra="'.$row->precio_compra.'"  data-stockal="'.$row->stockal.'" data-toggle="modal" data-target="#addStock"><i class="icon-copy fa fa-cart-plus" aria-hidden="true"></i></button>';
                $btn = $btn.' <button type="button" class="btn btn-danger deleteSucursalProducto"data-id="'.$row->id.'" ><i class="icon-copy fa fa-window-close" aria-hidden="true"></i></button>';
                $btn = $btn.' <a href="'. route('pdfAddStock', $row->id) .'" target="_blank" data-id="'.$row->id.'" class="btn btn-info btn-sm"><i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i></a>';
            }
            else{
               $btn = '<button type="button" class="btn btn-danger"><i class="icon-copy fa fa-window-close" aria-hidden="true"></i></button>';
                $btn = ' <button type="button" class="btn btn-primary" data-id="'.$row->id.'" data-producto="'.$row->nombre.'" data-pre1="'.$row->pre1.'" data-pre2="'.$row->pre2.'" data-pre3="'.$row->pre3.'" data-precio_compra="'.$row->precio_compra.'" data-stockal="'.$row->stockal.'" data-toggle="modal" data-target="#addStock"><i class="icon-copy fa fa-cart-plus" aria-hidden="true"></i></button>';
                $btn = $btn.' <button type="button" class="btn btn-success deleteSucursalProducto" data-id="'.$row->id.'"><i class="icon-copy fa fa-check-square" aria-hidden="true"></i></button>';
                $btn = $btn.' <a href="'. route('pdfAddStock', $row->id) .'" target="_blank" data-id="'.$row->id.'" class="btn btn-info btn-sm"><i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i></a>';

            } */
            if(count($add)==0){
                $btn = ' <button type="button" class="btn btn-primary" data-id="'.$row->id.'" data-producto="'.$row->nombre.'" data-pre1="'.$row->pre1.'" data-pre2="'.$row->pre2.'" data-pre3="'.$row->pre3.'" data-precio_compra="'.$row->precio_compra.'"  data-stockal="'.$row->stockal.'" data-toggle="modal" data-target="#addStock"><i class="icon-copy fa fa-cart-plus" aria-hidden="true"></i></button>';
                $btn = $btn.' <button type="button" class="btn btn-danger deleteSucursalProducto"data-id="'.$row->id.'" ><i class="icon-copy fa fa-window-close" aria-hidden="true"></i></button>';
                $btn = $btn.' <a href="'. route('pdfAddStock', $row->id) .'" target="_blank" data-id="'.$row->id.'" class="btn btn-info btn-sm"><i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i></a>';

            }
            else{
                $btn = ' <button type="button" class="btn btn-primary" data-id="'.$row->id.'" data-producto="'.$row->nombre.'" data-pre1="'.$row->pre1.'" data-pre2="'.$row->pre2.'" data-pre3="'.$row->pre3.'" data-precio_compra="'.$row->precio_compra.'" data-stockal="'.$row->stockal.'" data-toggle="modal" data-target="#addStock"><i class="icon-copy fa fa-cart-plus" aria-hidden="true"></i></button>';
               // $btn = $btn.' <button type="button" class="btn btn-success deleteSucursalProducto" data-id="'.$row->id.'"><i class="icon-copy fa fa-check-square" aria-hidden="true"></i></button>';
                $btn = $btn.' <a href="'. route('pdfAddStock', $row->id) .'" target="_blank" data-id="'.$row->id.'" class="btn btn-info btn-sm"><i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i></a>';

            }

             return $btn;
     })
        ->toJson();
});

Route::get('traspasos', function(){

    $traspaso = DB::table('traspaso as t')
        ->join('sucursal as sc1','sc1.id_sucursal', '=', 't.id_sucursal1')
        ->join('sucursal as sc2','sc2.id_sucursal', '=', 't.id_sucursal2')
        ->orderBy('t.id','desc')
       // ->select ('t.id', 't.id_sucursal1','sc1.nombre as origen', 'sc2.nombre as destino', 't.fecha', 't.id_user');
        ->select ('t.id','sc1.nombre as origen', 'sc2.nombre as destino', 't.fecha', 't.id_user');
       // ->select ('t.id','sc1.nombre as origen', 'sc2.nombre as destino',DB::raw("DATE_FORMAT(t.fecha, '%d-%b-%Y') as formatted_dob"), 't.id_user');

        return datatables()
         ->queryBuilder($traspaso)
        ->addColumn('action', function($row){
           // $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Add" class="edit btn btn-primary btn-sm addProductos"><i class="icon-copy fa fa-cart-plus" aria-hidden="true"></i></a>';
            $btn = ' <a href="javascript:void(0)" data-toggle="modal" data-target="#mdetalletraspaso"  data-id="'.$row->id.'" data-original-title="View" class="edit btn btn-success btn-sm viewTraspasos" ><i class="dw dw-eye"></i></a>';
             $btn = $btn.' <a  href="'. route('pdfT', $row->id) .'"  target="_blank" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-info btn-sm reporteTraspaso"><i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i></i></a>';
             $btn = $btn.' <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-danger btn-sm deleteTrasp"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a>';
             return $btn;
     })
    /*  ->editColumn('t.fecha', function ($traspaso) {
        return $traspaso->fecha->format('Y/m/d');
    }) */

        ->toJson();
});

Route::get('traspaso', function(){

    $traspaso = DB::table('traspaso as t')
        ->join('sucursal as sc1','sc1.id_sucursal', '=', 't.id_sucursal1')
        ->whereNull('t.id_sucursal2')
        ->orderBy('t.id','desc')
       ->select ('t.id','sc1.nombre as origen', 't.fecha', 't.id_user');

        return datatables()
         ->queryBuilder($traspaso)
        ->addColumn('action', function($row){
          $btn = ' <a href="javascript:void(0)" data-toggle="modal" data-target="#mdetalletraspaso"  data-id="'.$row->id.'" data-original-title="View" class="edit btn btn-success btn-sm viewTraspasos" ><i class="dw dw-eye"></i></a>';
             $btn = $btn.' <a  href="'. route('pdfT', $row->id) .'"  target="_blank" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-info btn-sm reporteTraspaso"><i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i></i></a>';
             $btn = $btn.' <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-danger btn-sm deleteTrasp"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a>';
             return $btn;
     })


        ->toJson();
});


Route::get('detalle_traspaso/{id}', function($id){
    $dtraspaso = DB::table('detalle_traspaso as dt')
        ->join('producto as p','p.id_producto','=','dt.id_producto')
        ->where('dt.id_traspaso','=',$id)
        ->select('dt.id','p.nombre','dt.cantidad','p.foto');

    return datatables()
        ->queryBuilder($dtraspaso)
        ->addColumn('action', function($row){
          // $btn = '<a href="{{route(sucursal_adicion.destroy,$row->id)}}" type="button" class="btn btn-danger deleteDetalleTraspado" data-id="'.$row->id.'" ><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a>';
         //mDeleteTraspaso ---- deleteDetalleTraspado -- data-toggle="modal" data-target="#mDeleteTraspaso"
          $btn = '<button type="button" class="btn btn-danger deleteDetalleTraspado" data-id="'.$row->id.'" ><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></button>';
            return $btn;
    })
       ->toJson();
});

Route::get('compra', function(){
//DB::raw('DATE_FORMAT(c.f_compra, "%d-%b-%Y") as fecha1')
    $compra = DB::table('compra as c')
        ->join('proveedor as pr','pr.id_proveedor','=','c.id_proveedor')
        ->join('users as u','u.id','=','c.id_user')
        ->orderBy('c.f_compra','desc')
        ->select ('c.id_compra','c.f_compra','pr.nombre', 'u.name');

        //return $compra;

        return datatables()
         ->queryBuilder($compra)
        ->addColumn('action', function($row){
            $btn = ' <a href="'. route('compra.show', $row->id_compra) .'"  data-id="'.$row->id_compra.'" data-original-title="View" class="edit btn btn-warning btn-sm viewTraspasos" ><i class="dw dw-eye"></i></a>';
            $btn = $btn.' <a href="'. route('pdfCompra', $row->id_compra) .'" target="_blank" data-id="'.$row->id_compra.'" class="btn btn-info btn-sm"><i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i></a>';
            $btn = $btn.' <a href="javascript:void(0)" data-id="'.$row->id_compra.'" class="btn btn-danger btn-sm deleteCompra"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a>';
              return $btn;
     })
        ->toJson();
});

Route::get('compra_detalle', function(){
    // return App\Categoria::all();

      $data =  DB::table('compra as c')
      ->join('detalle_c as dc','c.id_compra','=','dc.id_compra')
      ->join('producto as p','p.id_producto','=','dc.id_producto')
      ->orderBy('c.f_compra','desc')
     ->orderBy('c.id_compra')
    ->select ('c.id_compra','c.f_compra','p.nombre', 'p.descripcion','dc.cantidad','dc.precio');
    return datatables()
         ->queryBuilder($data)
        ->toJson();
});

Route::get('traspaso_detalle', function(){
    // return App\Categoria::all();

      $data =  DB::table('traspaso as t')
      ->join('detalle_traspaso as dt','t.id','=','dt.id_traspaso')
      ->join('producto as p','p.id_producto','=','dt.id_producto')
     ->orderBy('t.id')
     ->orderBy('t.fecha','desc')

    ->select ('t.id','t.fecha','p.nombre', 'p.descripcion','dt.cantidad');
    return datatables()
         ->queryBuilder($data)
        ->toJson();
});

Route::get('traspaso_detalle_o', function(){
    // return App\Categoria::all();

      $data =  DB::table('traspaso as t')
      ->join('detalle_traspaso as dt','t.id','=','dt.id_traspaso')
      ->join('producto as p','p.id_producto','=','dt.id_producto')
      ->whereNull('t.id_sucursal2')
     ->orderBy('t.id')
     ->orderBy('t.fecha','desc')

    ->select ('t.id','t.fecha','p.nombre', 'p.descripcion','dt.cantidad');
    return datatables()
         ->queryBuilder($data)
        ->toJson();
});

// search sucursal producto
Route::get('sucursal_producto_search', function(){
    // return App\Categoria::all();

      $data =  DB::table('sucursal_producto as sp')
      ->join('sucursal as s','s.id_sucursal','=','sp.id_sucursal')
      ->join('producto as p','p.id_producto','=','sp.id_producto')
   //  ->orderBy('sp.id')
   ->orderBy('sp.fecha','desc')
   ->orderBy('s.nombre')
     ->select ('sp.id','sp.fecha','s.nombre as sucursal','p.nombre', 'p.descripcion','sp.pre1','sp.pre2','sp.pre3');
    return datatables()
         ->queryBuilder($data)
        ->toJson();
});

Route::get('adicion_sucursal_producto_search', function(){
    // return App\Categoria::all();

      $data =  DB::table('sucursal_producto_adicion as spa')
      ->join('sucursal_producto as sp','sp.id','=','spa.id_sucursal_producto')
      ->join('sucursal as s','s.id_sucursal','=','sp.id_sucursal')
      ->join('producto as p','p.id_producto','=','sp.id_producto')
     // ->orderBy('s.nombre')
     ->orderBy('spa.fecha','desc')
     ->select ('spa.id','spa.fecha','s.nombre as sucursal','p.nombre', 'p.descripcion','spa.cantidad');
    return datatables()
         ->queryBuilder($data)
         ->addColumn('action', function($row){
          $btn = ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-danger btn-sm deleteAdicion"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a>';
              return $btn;
     })
        ->toJson();
});


// ADICION STOCK
Route::get('adicion', function(){

    $add = DB::select("select  date(spa.fecha),s.nombre,s.id_sucursal
    from sucursal_producto_adicion  spa
    inner join sucursal_producto sp  on  spa.id_sucursal_producto = sp.id
    inner join sucursal s on s.id_sucursal = sp.id_sucursal
    group by date(spa.fecha),s.nombre,s.id_sucursal
     order by date(spa.fecha) desc");
//return $add;

        return datatables($add)
        ->addColumn('action', function($row){
          $btn = ' <a href="javascript:void(0)" data-toggle="modal" data-target="#mdetalletraspaso"  data-fecha="'.$row->date.'" data-suc="'.$row->id_sucursal.'" data-original-title="View" class="edit btn btn-success btn-sm viewTraspasos" ><i class="dw dw-eye"></i></a>';
         $btn = $btn.' <a  href="'. route('pdfAdicionStk', [$row->date,$row->id_sucursal]) .'"  target="_blank" data-toggle="tooltip"  data-id="'.$row->date.'" data-original-title="Delete" class="btn btn-info btn-sm reporteTraspaso"><i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i></i></a>';
            // $btn = $btn.' <a href="javascript:void(0)" data-id="'.$row->date.'" class="btn btn-danger btn-sm deleteTrasp"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a>';
             return $btn;
     })


        ->toJson();
});
Route::get('adicion_detalle/{fecha}/{sucursal}', function($fecha,$sucursal){

    $add = DB::select("select spa.id, spa.fecha,p.nombre,spa.cantidad,p.foto
    from sucursal_producto_adicion  spa
    inner join sucursal_producto sp  on  spa.id_sucursal_producto = sp.id
    inner join sucursal s on s.id_sucursal = sp.id_sucursal
    inner join producto p on p.id_producto=sp.id_producto
    where date(spa.fecha) = '".$fecha."' and s.id_sucursal = '".$sucursal."'
     order by spa.fecha asc");
//return $add;

        return datatables($add)
        ->addColumn('action', function($row){
        /*   $btn = ' <a href="javascript:void(0)" data-toggle="modal" data-target="#mdetalletraspaso"  data-fecha="'.$row->date.'" data-suc="'.$row->id_sucursal.'" data-original-title="View" class="edit btn btn-success btn-sm viewTraspasos" ><i class="dw dw-eye"></i></a>';
         $btn = $btn.' <a  href="'. route('pdfT', $row->date."/".$row->id_sucursal) .'"  target="_blank" data-toggle="tooltip"  data-id="'.$row->date.'" data-original-title="Delete" class="btn btn-info btn-sm reporteTraspaso"><i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i></i></a>';
            // $btn = $btn.' <a href="javascript:void(0)" data-id="'.$row->date.'" class="btn btn-danger btn-sm deleteTrasp"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a>';
             return $btn; */
             $btn = '<button type="button" class="btn btn-danger deleteDetalleTraspado" data-id="'.$row->id.'" ><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></button>';
             return $btn;
     })


        ->toJson();
});


Route::get('adicion_search', function(){
    // return App\Categoria::all();

      $data =  DB::table('sucursal_producto_adicion as spa')
      ->join('sucursal_producto as sp','spa.id_sucursal_producto','=','sp.id')
      ->join('producto as p','p.id_producto','=','sp.id_producto')
     ->orderBy('spa.fecha','desc')
    ->select ('spa.id','spa.fecha','p.nombre', 'p.descripcion','spa.cantidad');

    return datatables()
         ->queryBuilder($data)
        ->toJson();
});

Route::get('sucursales', function(){
    return App\Sucursal::select('id_sucursal','nombre')->get();
});
Route::get('sucursales/{id}', function($id){
    return App\Sucursal::select('id_sucursal','nombre')->where('id_sucursal','<>',$id)->get();
});



  //==========================
 // servicios
// ===========================
Route::get('categories','ServicesController@categories');
Route::get('products','ServicesController@products');
Route::get('clients','ServicesController@clients');
Route::post('clients','ServicesController@Addclients');

Route::get('sucursalProductos/{id}','ServicesController@sucursalProductos');

Route::resource('venta', 'VentaController');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
