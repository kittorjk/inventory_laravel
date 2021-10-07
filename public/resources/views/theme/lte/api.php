<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// especialidad y medico_especialista
/*Route::get('/especialidad','ServicesController@especialidad');
Route::get('/medicoEspecialista','ServicesController@medicoEspecialista');
Route::get('/medicoEspecialista/{id}','ServicesController@medicoEspecialistaId');
*/


Route::get('/getClientes','ServicesController@getClientes');
Route::post('addCliente','ServicesController@addCliente');

Route::post('addVerSalud','ServicesController@addVerSalud');
Route::post('addVerDiagnostico','ServicesController@addVerDiagnostico');
Route::post('addVerMedico','ServicesController@addVerMedico');




