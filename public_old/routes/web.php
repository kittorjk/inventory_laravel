<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('theme.inicio');
});

Route::resource('/categoria', 'CategoriaController');
Route::resource('/producto', 'ProductoController');
Route::resource('/proveedor', 'ProveedorController');
Route::resource('/sucursal', 'SucursalController');
Route::get('/pdfSucursal/{id}', 'SucursalProductoController@pdf')->name('pdfSucursal'); //reporte traspasos
Route::get('/pdfSucursalFecha/{id}', 'SucursalProductoController@pdfecha')->name('pdfSucursalFecha'); //reporte traspasos x fecha
Route::resource('/sucursal_producto', 'SucursalProductoController');
Route::resource('/sucursal_adicion', 'SucursalProductoAdicionController');
Route::post('/adicionarstk', 'SucursalProductoAdicionController@adicion')->name('sucursal_adicion.adicionstk');;
Route::get('/pdfAdicionStk/{fecha}/{suc}', 'SucursalProductoAdicionController@pdf')->name('pdfAdicionStk');

Route::get('/search/productos', 'SucursalProductoController@productos')->name('search.productos');
Route::get('/search/productoSucursal/{id}', 'SucursalProductoController@productoSucursal')->name('search.productoSucursal');
Route::get('/adicion', 'SucursalProductoController@adicion')->name('sucursal_producto.adicion');
/* Route::get('/sucursal_sucursal', function () {
    return view('admin.sucursal_sucursal.index');
}); */
Route::resource('/admin', 'AdminController');
Route::resource('/user', 'UserController');
Route::resource('/traspaso', 'TraspasoController');
Route::get('/pdfAddStock/{id}', 'TraspasoController@pdf2')->name('pdfAddStock'); //reporte adicion a sucursalproducto stick
Route::resource('/venta', 'VentaController');
Route::get('/pdfVenta/{id}/{fechaIni}/{fechaFin}', 'VentaController@pdf')->name('pdfVenta'); //reporte Venta "pdfVenta"
Route::get('/pdfVentaMaster/{id}/{fechaIni}/{fechaFin}', 'VentaController@pdfMaster')->name('pdfVentaMaster'); //reporte Venta Master
//Route::post('/detalle_traspaso', 'TraspasoController@detalle_traspaso');
Route::resource('/detalle_traspaso', 'DetalleTraspasoController');
Route::get('/pdfTraspaso/{id}', 'TraspasoController@pdf')->name('pdfT'); //reporte traspasos
Route::post('/traspasar', 'TraspasoController@traspasar')->name('traspaso.traspasar');
Route::post('/traspasars', 'SucursalProductoController@traspasar')->name('sucursal_producto.traspasar');
// compras
Route::resource('/compra', 'CompraController');
Route::get('/pdfCompra/{id}', 'CompraController@pdf')->name('pdfCompra'); //reporte traspasos
//adicion stock
//Route::resource('/adicion', 'SucursalProductoAdicionController');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

