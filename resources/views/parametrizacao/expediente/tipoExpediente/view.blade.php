@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1> Visualizar Tipo de Expediente</h1>
      
@stop

@section('content')
        <!-- general form elements -->
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Dados do Tipo de Expediente</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{url('saveTipoExpediente')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputAddress">Nome do Tipo de Expediente</label>
                        <input type="text" class="form-control" id="nome" name='nome' value="{{ $tipoExpediente->nome}}" placeholder="Digite o nome do Tipo de Expediente..." readOnly>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Descrição</label>
                        <input type="text" class="form-control" id="nome" name='descricao' value="{{ $tipoExpediente->descricao}}" placeholder="Digite a Descrição..." readOnly>
                    </div>
                   
                   
                    <div class="card-footer">
                        <a  href="{{ url('/tipo_expedienteIndex') }}" type="button" class="btn btn-warning">Voltar</a>
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
