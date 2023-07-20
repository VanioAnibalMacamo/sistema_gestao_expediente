@extends('adminlte::page')

@section('title', 'Editar Funcionário')

@section('content_header')
    <h1>Editar Funcionário</h1>
@stop

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados do Funcionário</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ url('update', ['id' => $funcionario->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="inputAddress">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name='nome' placeholder="Digite o seu nome completo..." value="{{ $funcionario->nome }}">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Contacto</label>
                        <input type="text" class="form-control" id="contacto" name='contacto' placeholder="ex: 841234567" value="{{ $funcionario->contacto }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="email" name='email' placeholder=" ex: quick@check.co.mz" value="{{ $funcionario->email }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Morada</label>
                    <input type="text" class="form-control" id="morada" name='morada' placeholder="Bairro, quarteirao, rua, etc..." value="{{ $funcionario->morada }}">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputState">Gênero</label>
                        <select id="genero" class="form-control" name='genero'>
                            <option value='Masculino' {{ $funcionario->genero === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value='Feminino' {{ $funcionario->genero === 'Feminino' ? 'selected' : '' }}>Feminino</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Bilhete de Identidade</label>
                        <input type="text" class="form-control" id="num_bi" name='num_bi' placeholder="" value="{{ $funcionario->num_bi }}">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value='Actualizar'>
                <a href="{{ url('/funcIndex') }}" type="button" class="btn btn-warning">Cancelar</a>
            </div>
        </form>
    </div>
    <!-- /.card -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
