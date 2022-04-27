<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usr;
use App\Http\Controllers\Reportes;
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
    return 'hola mundo';
});

//funcion de login de usuario.

//Route::post('/login','Usr@login');

Route::get('/login',[Usr::class, 'login']);
Route::get('/wel',[Usr::class, 'wel']);
Route::get('/change',[Usr::class, 'cambio']);
Route::post('/cambiopass',[Usr::class, 'cambio_p']);

//reporte de ingresos nuevos
Route::get('/reported',[Reportes::class, 'rep_detalle']);
Route::get('/repingreso',[Reportes::class, 'rep_ingresos']);

Route::get('/en',[envios::class, 'en']);
