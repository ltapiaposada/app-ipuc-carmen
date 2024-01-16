<?php

use App\Http\Controllers\Admin\EgresoController;
use App\Http\Controllers\Admin\PucController;
use App\Http\Controllers\Admin\BancoController;
use App\Http\Controllers\Admin\ConceptoController;
use App\Http\Controllers\Admin\ParticipanteController;
use App\Http\Controllers\Admin\DeduccionController;
//Spatie para manejo de roles
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/home', function() {
//     return view('home');
// })->name('home')->middleware('auth');

Route::resource('participantes',ParticipanteController::class)->names('admin.participantes')->middleware('auth');
Route::resource('conceptos',ConceptoController::class)->names('admin.conceptos')->middleware('auth');
Route::resource('bancos',BancoController::class)->names('admin.bancos')->middleware('auth');
Route::resource('pucs',PucController::class)->names('admin.pucs')->middleware('auth');//ruta para el controlador del plan unico de cuentas puc
Route::resource('egresos',EgresoController::class)->names('admin.egresos')->middleware('auth');
Route::get('/cuenta{egreso}', [EgresoController::class, 'cuenta'])->name('admin.egresos.cuenta');
Route::get('/orden{egreso}', [EgresoController::class, 'orden'])->name('admin.egresos.orden');
Route::resource('deduccions',DeduccionController::class)->names('admin.deducciones')->middleware('auth');

Route::group(['middleware'=>['auth']],function(){
    Route::resource('roles',RolController::class);
    Route::resource('usuarios',UsuarioController::class);
});