<?php

use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EscuelaController;
use App\Http\Controllers\DomicilioController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\RentaController;
use App\Http\Controllers\ReporteController;


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

// En routes/web.php
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth']);
//oute::get('rentas/pdf/{id}', [RentaController::class, 'pdf'])->name('rentas.pdf');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/departamentos', [App\Http\Controllers\HomeController::class, 'index'])->name('departamentos');


Route::get('rentas/comprobante/{id}', [RentaController::class, 'pdf'])->name('rentas.comprobante');
//Route::get('/rentas/comprobante/{id}',function(){
    //Mail::to ('mail')
    //->send(new ComprobanteMailable);
    //[RentaController::class, 'pdf'];
//})->name('rentas.comprobante');
// Ruta para mostrar un departamento específico
// Mostrar el formulario para crear un nuevo departamento

Route::get('/departamentos/create', [DepartamentoController::class, 'create'])->name('departamentos.create');

// Mostrar un departamento específico
Route::get('/departamentos/{id}', [DepartamentoController::class, 'show'])->name('departamentos.show');

// Almacenar un nuevo departamento
Route::post('/departamentos', [DepartamentoController::class, 'store'])->name('departamentos.store');


//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    //Route::resource('blogs', BlogController::class);
    //Route::resource('escuelas', EscuelaController::class);
    Route::resource('domicilios', DomicilioController::class);
    Route::resource('departamentos', DepartamentoController::class);
    Route::resource('rentas', RentaController::class);
    
});
