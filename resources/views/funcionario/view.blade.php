@extends('adminlte::page')

@section('title', 'Visualizar Funcionários')

@section('content_header')
    <h1>Visualizar Funcionários</h1>
@stop

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados dos Funcionários</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ url('updateFunc') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="inputAddress">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name='nome' value="{{ $funcionario->nome }}" readonly>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Contacto</label>
                        <input type="text" class="form-control" id="contacto" name='contacto' value="{{ $funcionario->contacto }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="email" name='email' value="{{ $funcionario->email }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Morada</label>
                    <input type="text" class="form-control" id="morada" name='morada' value="{{ $funcionario->morada }}" readonly>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputState">Gênero</label>
                        <input type="text" class="form-control" id="genero" name='genero' value="{{ $funcionario->genero }}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Bilhete de Identidade</label>
                        <input type="text" class="form-control" id="num_bi" name='num_bi' value="{{ $funcionario->num_bi }}" readonly>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url('/funcIndex') }}" type="button" class="btn btn-warning">Voltar</a>
                </div>
            </form>
        </div>
    </div>
    <!-- /.card -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
