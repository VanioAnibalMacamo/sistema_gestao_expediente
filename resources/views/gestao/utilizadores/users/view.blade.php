@extends('adminlte::page')

@section('title', 'Visualizar Usuário')

@section('content_header')
    <h1>Visualizar Usuário</h1>
@stop

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados do Usuário</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control disabled" id="nome" name="nome" value="{{ $usuarioNome ?? '-' }}" disabled>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control disabled" id="email" name="email" value="{{ $user->email }}" disabled>
                </div>

                <div class="form-group">
                    <label>Estado</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="estado" value="Activo" id="estadoActivo" {{ $user->estado === 'Activo' ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="estadoActivo">
                            Activo
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="estado" value="Inactivo" id="estadoInactivo" {{ $user->estado === 'Inactivo' ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="estadoInactivo">
                            Inactivo
                        </label>
                    </div>
                </div>

                <div class="form-group border border-primary rounded p-2 col-md-6">
                    <label>Tipo de Usuário</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_usuario" value="Estudante" id="tipoEstudante" {{ $user->tipo_usuario === 'Estudante' ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="tipoEstudante">
                                    Estudante
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_usuario" value="Funcionario" id="tipoFuncionario" {{ $user->tipo_usuario === 'Funcionario' ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="tipoFuncionario">
                                    Funcionário
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="divEstudante" style="{{ $user->tipo_usuario === 'Estudante' ? 'display: block;' : 'display: none;' }}">
                    <label>Curso</label>
                    <input type="text" class="form-control disabled" value="{{ $user->userable && $user->userable->curso ? $user->userable->curso->nome : '-' }}" disabled>
                </div>

                <div class="form-group" id="divFuncionario" style="{{ $user->tipo_usuario === 'Funcionario' ? 'display: block;' : 'display: none;' }}">
                    <label>Departamento</label>
                    <input type="text" class="form-control disabled" value="{{ $user->userable && $user->userable->departamento ? $user->userable->departamento->nome : '-' }}" disabled>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('users') }}" class="btn btn-warning">Voltar</a>
            </div>
        </form>
    </div>
    <!-- /.card -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- ... estilos personalizados ... -->
@stop
