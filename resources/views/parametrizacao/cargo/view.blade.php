@extends('adminlte::page')

@section('title', 'Visualizar Cargo')

@section('content_header')
    <h1>Visualizar Cargo</h1>
@stop

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados do Cargo</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-group">
                <label for="nome">Nome do Cargo</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $cargo->nome }}" readonly>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição do Cargo</label>
                <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $cargo->descricao }}" readonly>
            </div>
            <!-- Outros campos, se necessário -->
        </div>
        <div class="card-footer">
            <a href="{{ route('cargoIndex') }}" class="btn btn-warning">Voltar</a>
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
