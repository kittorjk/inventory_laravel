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
    $data=  DB::table('producto')->select('id_producto','nombre','stock','stock','stock_minimo','precio_compra','stock_inicial','foto')->orderBy('nombre','asc');
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
    ->select('sp.id','p.nombre','sp.fecha','sp.estado','sp.pre1','sp.pre2','sp.pre3', 'sp.stock','sp.stock_min','p.foto','p.descripcion','p.id_producto');
     // return App\SucursalProducto::query()->get();

     return datatables()
        ->queryBuilder($data)
        ->addColumn('action', function($row){

            if($row->estado=="1"){
                $btn = '<button type="button" class="btn btn-success"><i class="icon-copy fa fa-check-square" aria-hidden="true"></i></button>';
                $btn = $btn.' <button type="button" class="btn btn-primary" data-id="'.$row->id.'" data-producto="'.$row->nombre.'" data-toggle="modal" data-target="#addStock"><i class="icon-copy fa fa-cart-plus" aria-hidden="true"></i></button>';
                $btn = $btn.' <button type="button" class="btn btn-danger deleteSucursalProducto"data-id="'.$row->id.'" ><i class="icon-copy fa fa-window-close" aria-hidden="true"></i></button>';
            }
            else{
                $btn = '<button type="button" class="btn btn-danger"><i class="icon-copy fa fa-window-close" aria-hidden="true"></i></button>';
                $btn = $btn.' <button type="button" class="btn btn-primary" data-id="'.$row->id.'" data-producto="'.$row->nombre.'" data-toggle="modal" data-target="#addStock"><i class="icon-copy fa fa-cart-plus" aria-hidden="true"></i></button>';
                $btn = $btn.' <button type="button" class="btn btn-success deleteSucursalProducto" data-id="'.$row->id.'"><i class="icon-copy fa fa-check-square" aria-hidden="true"></i></button>';
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
        ->select ('t.id', 'id_sucursal1','sc1.nombre as origen', 'sc2.nombre as destino', 't.fecha', 't.id_user');

        return datatables()
         ->queryBuilder($traspaso)
        ->addColumn('action', function($row){
            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Add" class="edit btn btn-primary btn-sm addProductos"><i class="icon-copy fa fa-cart-plus" aria-hidden="true"></i></a>';
            $btn = $btn.' <a href="javascript:void(0)" data-toggle="modal" data-target="#mdetalletraspaso"  data-id="'.$row->id.'" data-original-title="View" class="edit btn btn-success btn-sm viewTraspasos" ><i class="dw dw-eye"></i></a>';
            // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm reporteTraspaso"><i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i></i></a>';
             $btn = $btn.' <a  href="'. route('pdfT', $row->id) .'"  target="_blank" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-info btn-sm reporteTraspaso"><i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i></i></a>';
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

Route::get('sucursales', function(){
    return App\Sucursal::select('id_sucursal','nombre')->get();
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
