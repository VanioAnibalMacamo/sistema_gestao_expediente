<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tipo_expedienteIndex',[App\Http\Controllers\TipoExpedienteController::class, 'index'])->name('tipo_expedienteIndex');
Route::get('/tipoExpedienteCreate', [App\Http\Controllers\TipoExpedienteController::class, 'create'])->name('tipoExpedienteCreate');
Route::post('/saveTipoExpediente',[App\Http\Controllers\TipoExpedienteController::class,'saveTipoExpediente'])->middleware('web');
Route::get('/update_tipo_expediente/{id}',[App\Http\Controllers\TipoExpedienteController::class,'update_view']);
Route::post('/updateTipoExpediente/{id}',[App\Http\Controllers\TipoExpedienteController::class,'update']);
Route::get('/visualizar_tipo_expediente/{id}',[App\Http\Controllers\TipoExpedienteController::class,'visualizar_view']);
Route::post('/visualizarTipoExpediente/{id}',[App\Http\Controllers\TipoExpedienteController::class,'visualizar']);
Route::delete('/tipo_expediente/{id}', 'App\Http\Controllers\TipoExpedienteController@delete')->name('tipo_expedientes.delete');
Route::get('Cadastro_Estudante', [App\Http\Controllers\CadastroEstudanteController::class, 'index'])->name('Cadastro_Estudante');

Route::get('/depIndex', [App\Http\Controllers\DepartamentoController::class, 'index'])->name('depIndex');
Route::get('/depCreate', [App\Http\Controllers\DepartamentoController::class, 'create'])->name('depCreate');
Route::post('/saveDep',[App\Http\Controllers\DepartamentoController::class,'saveDep'])->middleware('web');
Route::get('/update_departamento/{id}',[App\Http\Controllers\DepartamentoController::class,'update_view']);
Route::post('/updateDep/{id}',[App\Http\Controllers\DepartamentoController::class,'update']);
Route::get('/visualizar_departamento/{id}',[App\Http\Controllers\DepartamentoController::class,'visualizar_view']);
Route::post('/visualizarDep/{id}',[App\Http\Controllers\DepartamentoController::class,'visualizar']);
Route::delete('/departamento/{id}', 'App\Http\Controllers\DepartamentoController@delete')->name('departamentos.delete');

Route::get('/est_proIndex', [App\Http\Controllers\EstagioProcessoController::class, 'index'])->name('est_proIndex');
Route::get('/estProCreate', [App\Http\Controllers\EstagioProcessoController::class, 'create'])->name('estProCreate');
Route::post('/saveEstagioProcesso',[App\Http\Controllers\EstagioProcessoController::class,'saveEstagioProcesso'])->middleware('web');
Route::get('/update_est_processo/{id}',[App\Http\Controllers\EstagioProcessoController::class,'update_view']);
Route::post('/updateEstagioProcesso/{id}',[App\Http\Controllers\EstagioProcessoController::class,'update']);
Route::get('/visualizar_est_processo/{id}',[App\Http\Controllers\EstagioProcessoController::class,'visualizar_view']);
Route::post('/visualizarEstPro/{id}',[App\Http\Controllers\EstagioProcessoController::class,'visualizar']);
Route::delete('/est_processo/{id}', 'App\Http\Controllers\EstagioProcessoController@delete')->name('estagio_processos.delete');

Route::get('/expedienteIndex', [App\Http\Controllers\ExpedienteController::class, 'index'])->name('expedienteIndex');
Route::get('/expedienteCreate', [App\Http\Controllers\ExpedienteController::class, 'create'])->name('expedienteCreate');
Route::post('/saveExpediente',[App\Http\Controllers\ExpedienteController::class,'saveExpediente'])->middleware('web');
Route::get('/update_expediente/{id}',[App\Http\Controllers\ExpedienteController::class,'update_view']);
Route::post('/updateExpediente/{id}',[App\Http\Controllers\ExpedienteController::class,'update']);
Route::get('/visualizar_expediente/{id}',[App\Http\Controllers\ExpedienteController::class,'visualizar_view']);
Route::post('/visualizarExpediente/{id}',[App\Http\Controllers\ExpedienteController::class,'visualizar']);
Route::delete('/expediente/{id}', 'App\Http\Controllers\ExpedienteController@delete')->name('expedientes.delete');

Route::get('/estudanteIndex', [App\Http\Controllers\EstudanteController::class, 'index'])->name('estudanteIndex');
route::get('/estudanteCreate',[App\Http\Controllers\EstudanteController::class,'create'])->name('estudanteCreate');
Route::post('/saveEstudante',[App\Http\Controllers\EstudanteController::class,'saveEstudante'])->middleware('web');
Route::get('/update_estudante/{id}',[App\Http\Controllers\EstudanteController::class,'update_view']);
route::post('/updateEstudante/{id}',[App\Http\Controllers\EstudanteController::class,'update']);
Route::get('/visualizar_estudante/{id}',[App\Http\Controllers\EstudanteController::class,'visualizar_view']);
Route::post('/visualizEstdante/{id}',[App\Http\Controllers\EstudanteController::class,'visualizar']);
Route::delete('/estudante/{id}', 'App\Http\Controllers\DepartamentoController@delete')->name('estudantes.delete');

Route::get('/cursoIndex', [App\Http\Controllers\EstudanteController::class, 'index'])->name('cursoIndex');
