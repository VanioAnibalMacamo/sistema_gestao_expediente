@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Visualizar Expediente</h1>
@stop

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados do Expediente</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{{ $expediente->nome }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $expediente->descricao }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="data_submissao">Data de Submissão</label>
                        <input type="date" class="form-control" id="data_submissao" name="data_submissao" value="{{ $expediente->data_submissao }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_expediente_id">Estudante</label>
                        <input type="text" class="form-control" id="estudante_id" name="estudante_id" value="{{ $expediente->estudante->codigo." - ".$expediente->estudante->nome." ".$expediente->estudante->apelido }}" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tipo_expediente_id">Tipo de Expediente</label>
                    <input type="text" class="form-control" id="tipo_expediente_id" name="tipo_expediente_id" value="{{ $expediente->tipoExpediente->nome }}" readonly>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url('/expedienteIndex') }}" type="button" class="btn btn-warning">Voltar</a>
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
