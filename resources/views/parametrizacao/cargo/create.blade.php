@extends('adminlte::page')

@section('title', 'Cadastrar Cargo')

@section('content_header')
    <h1>Cadastrar Cargo</h1>
@stop

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados do Cargo</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('saveCargo') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nome">Nome do Cargo</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do cargo">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição do Cargo</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite a descrição do cargo">
                </div>
                <!-- Outros campos, se necessário -->
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{ route('cargoIndex') }}" class="btn btn-warning">Cancelar</a>
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
