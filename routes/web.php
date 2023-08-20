<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FuncionarioDepartamentoCargoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\EstudanteController;

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

Route::get('/tipo_expedienteIndex',[App\Http\Controllers\TipoExpedienteController::class, 'index'])->name('tipo_expedienteIndex')->middleware('can:view,App\Models\TipoExpediente');
Route::get('/tipoExpedienteCreate', [App\Http\Controllers\TipoExpedienteController::class, 'create'])->name('tipoExpedienteCreate')->middleware('can:create,App\Models\TipoExpediente');
Route::post('/saveTipoExpediente',[App\Http\Controllers\TipoExpedienteController::class,'saveTipoExpediente'])->middleware('web')->middleware('can:create,App\Models\TipoExpediente');
Route::get('/update_tipo_expediente/{id}',[App\Http\Controllers\TipoExpedienteController::class,'update_view'])->middleware('can:update,App\Models\TipoExpediente');
Route::post('/updateTipoExpediente/{id}',[App\Http\Controllers\TipoExpedienteController::class,'update'])->middleware('can:update,App\Models\TipoExpediente');
Route::get('/visualizar_tipo_expediente/{id}',[App\Http\Controllers\TipoExpedienteController::class,'visualizar_view'])->middleware('can:view,App\Models\TipoExpediente');
Route::post('/visualizarTipoExpediente/{id}',[App\Http\Controllers\TipoExpedienteController::class,'visualizar'])->middleware('can:view,App\Models\TipoExpediente');
Route::delete('/tipo_expediente/{id}', 'App\Http\Controllers\TipoExpedienteController@delete')->name('tipo_expedientes.delete')->middleware('can:delete,App\Models\TipoExpediente');
Route::get('Cadastro_Estudante', [App\Http\Controllers\CadastroEstudanteController::class, 'index'])->name('Cadastro_Estudante');

Route::get('/depIndex', [App\Http\Controllers\DepartamentoController::class, 'index'])->name('depIndex')->middleware('can:view,App\Models\Departamento');
Route::get('/depCreate', [App\Http\Controllers\DepartamentoController::class, 'create'])->name('depCreate')->middleware('can:create,App\Models\Departamento');
Route::post('/saveDep',[App\Http\Controllers\DepartamentoController::class,'saveDep'])->middleware('web')->middleware('can:create,App\Models\Departamento');
Route::get('/update_departamento/{id}',[App\Http\Controllers\DepartamentoController::class,'update_view'])->middleware('can:update,App\Models\Departamento');
Route::post('/updateDep/{id}',[App\Http\Controllers\DepartamentoController::class,'update'])->middleware('can:update,App\Models\Departamento');
Route::get('/visualizar_departamento/{id}',[App\Http\Controllers\DepartamentoController::class,'visualizar_view'])->middleware('can:view,App\Models\Departamento');
Route::post('/visualizarDep/{id}',[App\Http\Controllers\DepartamentoController::class,'visualizar'])->middleware('can:view,App\Models\Departamento');
Route::delete('/departamento/{id}', 'App\Http\Controllers\DepartamentoController@delete')->name('departamentos.delete')->middleware('can:delete,App\Models\Departamento');

Route::get('/est_proIndex', [App\Http\Controllers\EstagioProcessoController::class, 'index'])->name('est_proIndex')->middleware('can:view,App\Models\EstagioProcesso');
Route::get('/estProCreate', [App\Http\Controllers\EstagioProcessoController::class, 'create'])->name('estProCreate')->middleware('can:create,App\Models\EstagioProcesso');
Route::post('/saveEstagioProcesso',[App\Http\Controllers\EstagioProcessoController::class,'saveEstagioProcesso'])->middleware('web')->middleware('can:create,App\Models\EstagioProcesso');
Route::get('/update_est_processo/{id}',[App\Http\Controllers\EstagioProcessoController::class,'update_view'])->middleware('can:update,App\Models\EstagioProcesso');
Route::post('/updateEstagioProcesso/{id}',[App\Http\Controllers\EstagioProcessoController::class,'update'])->middleware('can:update,App\Models\EstagioProcesso');
Route::get('/visualizar_est_processo/{id}',[App\Http\Controllers\EstagioProcessoController::class,'visualizar_view'])->middleware('can:view,App\Models\EstagioProcesso');
Route::post('/visualizarEstPro/{id}',[App\Http\Controllers\EstagioProcessoController::class,'visualizar'])->middleware('can:view,App\Models\EstagioProcesso');
Route::delete('/est_processo/{id}', 'App\Http\Controllers\EstagioProcessoController@delete')->name('estagio_processos.delete')->middleware('can:delete,App\Models\EstagioProcesso');

Route::get('/expedienteIndex', [App\Http\Controllers\ExpedienteController::class, 'index'])->name('expedienteIndex')->middleware('can:view,App\Models\Expediente');
Route::get('/expedienteCreate', [App\Http\Controllers\ExpedienteController::class, 'create'])->name('expedienteCreate')->middleware('can:create,App\Models\Expediente');
Route::post('/saveExpediente',[App\Http\Controllers\ExpedienteController::class,'saveExpediente'])->middleware('web')->middleware('can:create,App\Models\Expediente');
Route::get('/update_expediente/{id}',[App\Http\Controllers\ExpedienteController::class,'update_view'])->middleware('can:update,App\Models\Expediente');
Route::post('/updateExpediente/{id}',[App\Http\Controllers\ExpedienteController::class,'update'])->middleware('can:update,App\Models\Expediente');
Route::get('/visualizar_expediente/{id}',[App\Http\Controllers\ExpedienteController::class,'visualizar_view'])->middleware('can:view,App\Models\Expediente');
Route::post('/visualizarExpediente/{id}',[App\Http\Controllers\ExpedienteController::class,'visualizar'])->middleware('can:view,App\Models\Expediente');
Route::delete('/expediente/{id}', 'App\Http\Controllers\ExpedienteController@delete')->name('expedientes.delete')->middleware('can:delete,App\Models\Expediente');

Route::post('adicionarComentario/{id}', 'App\Http\Controllers\ExpedienteController@adicionarComentario')->name('adicionar.comentario');
Route::post('/avancar-expediente/{id}', 'App\Http\Controllers\ExpedienteController@avancarExpediente')->name('avancar.expediente');
Route::get('/expediente/{id}/download-documentos', [App\Http\Controllers\ExpedienteController::class, 'downloadDocumentos'])->name('download.documentos');

Route::get('/estudanteIndex', [App\Http\Controllers\EstudanteController::class, 'index'])->name('estudanteIndex')->middleware('can:view,App\Models\Estudante');
route::get('/estudanteCreate',[App\Http\Controllers\EstudanteController::class,'create'])->name('estudanteCreate')->middleware('can:create,App\Models\Estudante');
Route::post('/saveEstudante',[App\Http\Controllers\EstudanteController::class,'saveEstudante'])->middleware('web')->middleware('can:create,App\Models\Estudante');
Route::get('/update_estudante/{id}',[App\Http\Controllers\EstudanteController::class,'update_view'])->middleware('can:update,App\Models\Estudante');
route::post('/updateEstudante/{id}',[App\Http\Controllers\EstudanteController::class,'update'])->middleware('can:update,App\Models\Estudante');
Route::get('/visualizar_estudante/{id}',[App\Http\Controllers\EstudanteController::class,'visualizar_view'])->middleware('can:view,App\Models\Estudante');
Route::post('/visualizEstdante/{id}',[App\Http\Controllers\EstudanteController::class,'visualizar'])->middleware('can:view,App\Models\Estudante');
Route::delete('/estudante/{id}', 'App\Http\Controllers\EstudanteController@delete')->name('estudantes.delete')->middleware('can:delete,App\Models\Estudante');

Route::get('/AlocacoesIndex', [App\Http\Controllers\AlocacoesController::class, 'index'])->name('AlocacoesIndex')->middleware('can:view,App\Models\Alocacao');
route::get('/AlocacoesCreate',[App\Http\Controllers\AlocacoesController::class,'create'])->name('AlocacoeseCreate')->middleware('can:create,App\Models\Alocacao');
Route::post('/saveAlocacoes',[App\Http\Controllers\AlocacoesController::class,'saveAlocacoes'])->middleware('web')->middleware('can:create,App\Models\Alocacao');
Route::get('/update_Alocacoes/{id}',[App\Http\Controllers\AlocacoesController::class,'update_view'])->middleware('can:update,App\Models\Alocacao');
route::post('/updateAlocacoes/{id}',[App\Http\Controllers\AlocacoesController::class,'update'])->middleware('can:update,App\Models\Alocacao');
Route::get('/visualizar_Alocacoes/{id}',[App\Http\Controllers\AlocacoesController::class,'visualizar_view'])->middleware('can:view,App\Models\Alocacao');
Route::post('/visualizAlocacoes/{id}',[App\Http\Controllers\AlocacoesController::class,'visualizar'])->middleware('can:view,App\Models\Alocacao');
Route::delete('/Alocacoes/{id}', 'App\Http\Controllers\AlocacoesController@delete')->name('Alocacoess.delete')->middleware('can:delete,App\Models\Alocacao');

Route::get('/funcIndex', [App\Http\Controllers\FuncionarioController::class, 'index'])->name('funcIndex')->middleware('can:view,App\Models\Funcionario');
Route::get('/funcCreate', [App\Http\Controllers\FuncionarioController::class, 'create'])->name('funcCreate')->middleware('can:create,App\Models\Funcionario');
Route::post('/saveFunc',[App\Http\Controllers\FuncionarioController::class,'saveFunc'])->middleware('can:create,App\Models\Funcionario');
Route::get('/update_funcionario/{id}',[App\Http\Controllers\FuncionarioController::class,'update_view'])->middleware('can:update,App\Models\Funcionario');
Route::post('/update/{id}',[App\Http\Controllers\FuncionarioController::class,'update'])->middleware('can:update,App\Models\Funcionario');
Route::delete('/funcionarios/{id}', 'App\Http\Controllers\FuncionarioController@delete')->name('funcionarios.delete')->middleware('can:delete,App\Models\Funcionario');
Route::get('/visualizar_funcionario/{id}',[App\Http\Controllers\FuncionarioController::class,'visualizar_view'])->middleware('can:view,App\Models\Funcionario');
Route::post('/visualizarFunc/{id}',[App\Http\Controllers\FuncionarioController::class,'visualizar'])->middleware('can:view,App\Models\Funcionario');

Route::get('/cargoIndex', [CargoController::class, 'index'])->name('cargoIndex')->middleware('can:view,App\Models\Cargo');
Route::get('/cargoCreate', [CargoController::class, 'create'])->name('cargoCreate')->middleware('can:create,App\Models\Cargo');
Route::post('/saveCargo', [CargoController::class, 'saveCargo'])->name('saveCargo')->middleware('can:crete,App\Models\Cargo');
Route::get('/update_cargo/{id}', [CargoController::class, 'updateView'])->middleware('can:update,App\Models\Cargo');
Route::post('/updateCargo/{id}', [App\Http\Controllers\CargoController::class, 'update'])->name('updateCargo')->middleware('can:update,App\Models\Cargo');
Route::delete('/cargos/{id}', [CargoController::class, 'delete'])->name('cargos.delete')->middleware('can:delete,App\Models\Cargo');
Route::get('/visualizar_cargo/{id}', [CargoController::class, 'visualizarView'])->middleware('can:view,App\Models\Cargo');
Route::post('/visualizarCargo/{id}', [CargoController::class, 'visualizar'])->middleware('can:view,App\Models\Cargo');

Route::get('/permIndex', [App\Http\Controllers\PermissionController::class, 'index'])->name('permIndex')->middleware('can:view,App\Models\Permission');
Route::get('/permissionCreate', [App\Http\Controllers\PermissionController::class, 'create'])->name('permissionCreate')->middleware('can:create,App\Models\Permission');
Route::post('/savePermission',[App\Http\Controllers\PermissionController::class,'savePermission'])->middleware('web')->middleware('can:create,App\Models\Permission');
Route::delete('/permissions/{id}', 'App\Http\Controllers\PermissionController@delete')->name('permissions.delete')->middleware('can:delete,App\Models\Permission');
Route::get('/update_permission/{id}', [App\Http\Controllers\PermissionController::class, 'updateView'])->middleware('can:update,App\Models\Permission');
Route::post('/updatePermission/{id}', [App\Http\Controllers\PermissionController::class, 'update'])->name('updatePermission')->middleware('can:update,App\Models\Permission');

Route::get('/roleIndex', [RoleController::class, 'index'])->name('roleIndex')->middleware('can:view,App\Models\Role');
Route::get('/roleCreate', [RoleController::class, 'create'])->name('roles.create')->middleware('can:create,App\Models\Role');
Route::post('/saveRole', [RoleController::class, 'store'])->name('roles.store')->middleware('can:create,App\Models\Role');
Route::get('/update_role/{id}', [RoleController::class, 'edit'])->name('roles.edit')->middleware('can:update,App\Models\Role');
Route::put('/updateRole/{id}', [RoleController::class, 'update'])->name('updateRole')->middleware('can:update,App\Models\Role');
Route::delete('/delete_role/{id}', [RoleController::class, 'delete'])->name('roles.delete')->middleware('can:delete,App\Models\Role');
Route::get('visualizar_role/{id}', [RoleController::class, 'visualizar_role'])->name('roles.visualizar')->middleware('can:view,App\Models\Role');


Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('can:view,App\Models\User');
Route::get('/userCreate', [App\Http\Controllers\UserController::class, 'create'])->name('userCreate')->middleware('can:create,App\Models\User');
Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('can:view,App\Models\User');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete')->middleware('can:delete,App\Models\User');
Route::get('/visualizar_user/{id}', [UserController::class, 'visualizarView'])->middleware('can:view,App\Models\User');
Route::get('/update_user/{id}', [UserController::class, 'updateView'])->middleware('can:update,App\Models\User');
route::post('/updateUser/{id}',[App\Http\Controllers\UserController::class,'update'])->name('updateUser')->middleware('can:update,App\Models\User');

/*
Se deixarmos as rotas como estavam o Usuario podera ser notificado, se deixarmos como esta na nova abordagem ele é direccionado
para a pagina error nao autorizado, Provavelmente no futuro temos que melhorar isso.

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/userCreate', [App\Http\Controllers\UserController::class, 'create'])->name('userCreate');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');
Route::get('/visualizar_user/{id}', [UserController::class, 'visualizarView']);
Route::get('/update_user/{id}', [UserController::class, 'updateView']);
route::post('/updateUser/{id}',[App\Http\Controllers\UserController::class,'update'])->name('updateUser');*/

Route::get('/funcDepCargoIndex', [App\Http\Controllers\FuncionarioDepartamentoCargoController::class, 'index'])->name('funcDepCargoIndex')->middleware('can:view,App\Models\Alocacao');
Route::get('/createAlocacao', [App\Http\Controllers\FuncionarioDepartamentoCargoController::class, 'create'])->name('createAlocacao')->middleware('can:create,App\Models\Alocacao');
Route::post('saveAlocacoes', 'App\Http\Controllers\FuncionarioDepartamentoCargoController@saveAlocacoes')->name('saveAlocacoes')->middleware('can:create,App\Models\Alocacao');
Route::get('/update_alocacao/{id}',[App\Http\Controllers\FuncionarioDepartamentoCargoController::class,'update_view'])->middleware('can:update,App\Models\Alocacao');
route::post('/updateAlocacao/{id}',[App\Http\Controllers\FuncionarioDepartamentoCargoController::class,'update'])->middleware('can:update,App\Models\Alocacao');
Route::get('/visualizar_alocacao/{id}',[App\Http\Controllers\FuncionarioDepartamentoCargoController::class,'visualizar_view'])->middleware('can:view,App\Models\Alocacao');
Route::post('/visualizAlocacoes/{id}',[App\Http\Controllers\FuncionarioDepartamentoCargoController::class,'visualizar'])->middleware('can:view,App\Models\Alocacao');
Route::delete('/alocacoes/{id}', 'App\Http\Controllers\FuncionarioDepartamentoCargoController@delete')->name('alocacoes.delete')->middleware('can:delete,App\Models\Alocacao');

Route::get('/cursoIndex', [App\Http\Controllers\CursoController::class, 'index'])->name('cursoIndex')->middleware('can:view,App\Models\Curso');
Route::delete('/curso/{id}', 'App\Http\Controllers\CursoController@delete')->name('cursos.delete')->middleware('can:delete,App\Models\Curso');
Route::get('/CursoCreate', [App\Http\Controllers\CursoController::class, 'create'])->name('CursoCreate')->middleware('can:create,App\Models\Curso');
Route::post('saveCurso', 'App\Http\Controllers\CursoController@saveCurso')->name('saveCurso')->middleware('can:create,App\Models\Curso');
Route::get('/update_curso/{id}',[App\Http\Controllers\CursoController::class,'update_view'])->middleware('can:update,App\Models\Curso');
route::post('/updateCurso/{id}',[App\Http\Controllers\CursoController::class,'update'])->middleware('can:update,App\Models\Curso');
Route::get('/visualizar_curso/{id}',[App\Http\Controllers\CursoController::class,'visualizar_view'])->middleware('can:view,App\Models\Curso');
Route::post('/visualizCursos/{id}',[App\Http\Controllers\CursoController::class,'visualizar'])->middleware('can:view,App\Models\Curso');

//Route::get('/enviar-email', [EstudanteController::class, 'enviarEmail'])->name('enviar.email');
