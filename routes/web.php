<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FuncionarioDepartamentoCargoController;

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

Route::get('/AlocacoesIndex', [App\Http\Controllers\AlocacoesController::class, 'index'])->name('AlocacoesIndex');
route::get('/AlocacoesCreate',[App\Http\Controllers\AlocacoesController::class,'create'])->name('AlocacoeseCreate');
Route::post('/saveAlocacoes',[App\Http\Controllers\AlocacoesController::class,'saveAlocacoes'])->middleware('web');
Route::get('/update_Alocacoes/{id}',[App\Http\Controllers\AlocacoesController::class,'update_view']);
route::post('/updateAlocacoes/{id}',[App\Http\Controllers\AlocacoesController::class,'update']);
Route::get('/visualizar_Alocacoes/{id}',[App\Http\Controllers\AlocacoesController::class,'visualizar_view']);
Route::post('/visualizAlocacoes/{id}',[App\Http\Controllers\AlocacoesController::class,'visualizar']);
Route::delete('/Alocacoes/{id}', 'App\Http\Controllers\AlocacoesController@delete')->name('Alocacoess.delete');

Route::get('/funcIndex', [App\Http\Controllers\FuncionarioController::class, 'index'])->name('funcIndex');
Route::get('/funcCreate', [App\Http\Controllers\FuncionarioController::class, 'create'])->name('funcCreate');
Route::post('/saveFunc',[App\Http\Controllers\FuncionarioController::class,'saveFunc'])->middleware('web');
Route::get('/update_funcionario/{id}',[App\Http\Controllers\FuncionarioController::class,'update_view']);
Route::post('/update/{id}',[App\Http\Controllers\FuncionarioController::class,'update']);
Route::delete('/funcionarios/{id}', 'App\Http\Controllers\FuncionarioController@delete')->name('funcionarios.delete');
Route::get('/visualizar_funcionario/{id}',[App\Http\Controllers\FuncionarioController::class,'visualizar_view']);
Route::post('/visualizarFunc/{id}',[App\Http\Controllers\FuncionarioController::class,'visualizar']);

Route::get('/cargoIndex', [CargoController::class, 'index'])->name('cargoIndex');
Route::get('/cargoCreate', [CargoController::class, 'create'])->name('cargoCreate');
Route::post('/saveCargo', [CargoController::class, 'saveCargo'])->name('saveCargo');
Route::get('/update_cargo/{id}', [CargoController::class, 'updateView']);
Route::post('/updateCargo/{id}', [App\Http\Controllers\CargoController::class, 'update'])->name('updateCargo');
Route::delete('/cargos/{id}', [CargoController::class, 'delete'])->name('cargos.delete');
Route::get('/visualizar_cargo/{id}', [CargoController::class, 'visualizarView']);
Route::post('/visualizarCargo/{id}', [CargoController::class, 'visualizar']);

Route::get('/permIndex', [App\Http\Controllers\PermissionController::class, 'index'])->name('permIndex');
Route::get('/permissionCreate', [App\Http\Controllers\PermissionController::class, 'create'])->name('permissionCreate');
Route::post('/savePermission',[App\Http\Controllers\PermissionController::class,'savePermission'])->middleware('web');
Route::delete('/permissions/{id}', 'App\Http\Controllers\PermissionController@delete')->name('permissions.delete');

Route::get('/roleIndex', [RoleController::class, 'index'])->name('roleIndex');
Route::get('/roleCreate', [RoleController::class, 'create'])->name('roles.create');
Route::post('/saveRole', [RoleController::class, 'store'])->name('roles.store');
Route::get('/update_role/{id}', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/updateRole/{id}', [RoleController::class, 'update'])->name('updateRole');
Route::delete('/delete_role/{id}', [RoleController::class, 'delete'])->name('roles.delete');
Route::get('visualizar_role/{id}', [RoleController::class, 'visualizar_role'])->name('roles.visualizar');

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/userCreate', [App\Http\Controllers\UserController::class, 'create'])->name('userCreate');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');
Route::get('/visualizar_user/{id}', [UserController::class, 'visualizarView']);
Route::get('/update_user/{id}', [UserController::class, 'updateView']);
route::post('/updateUser/{id}',[App\Http\Controllers\UserController::class,'update'])->name('updateUser');

Route::get('/funcDepCargoIndex', [App\Http\Controllers\FuncionarioDepartamentoCargoController::class, 'index'])->name('funcDepCargoIndex');
Route::get('/createAlocacao', [App\Http\Controllers\FuncionarioDepartamentoCargoController::class, 'create'])->name('createAlocacao');
Route::post('saveAlocacoes', 'App\Http\Controllers\FuncionarioDepartamentoCargoController@saveAlocacoes')->name('saveAlocacoes');
//Route::post('/saveAlocacoes',[App\Http\Controllers\FuncionarioDepartamentoCargoController::class,'saveAlocacoes'])->middleware('web');
Route::get('/update_alocacao/{id}',[App\Http\Controllers\FuncionarioDepartamentoCargoController::class,'update_view']);
route::post('/updateAlocacoes/{id}',[App\Http\Controllers\FuncionarioDepartamentoCargoController::class,'update']);
Route::get('/visualizar_Alocacoes/{id}',[App\Http\Controllers\FuncionarioDepartamentoCargoController::class,'visualizar_view']);
Route::post('/visualizAlocacoes/{id}',[App\Http\Controllers\FuncionarioDepartamentoCargoController::class,'visualizar']);
Route::delete('/alocacoes/{id}', 'App\Http\Controllers\FuncionarioDepartamentoCargoController@delete')->name('alocaoes.delete');
