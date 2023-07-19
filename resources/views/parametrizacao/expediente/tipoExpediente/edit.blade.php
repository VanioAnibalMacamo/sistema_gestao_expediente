@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1> Actualizar Tipo de Expediente</h1>

@stop

@section('content')
        <!-- general form elements -->
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Dados do Tipo de Expediente</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{url('updateTipoExpediente',$tipoExpediente->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputAddress">Nome do Tipo de Expediente</label>
                        <input type="text" class="form-control" id="nome" name='nome'  value="{{ $tipoExpediente->nome}}" placeholder="Digite o nome do Tipo de Expediente...">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Descrição</label>
                        <input type="text" class="form-control" id="nome" name='descricao' value="{{ $tipoExpediente->descricao}}" placeholder="Digite a Descrição...">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="departamento_id">Departamento</label>
                        <select class="form-control" id="departamento_id" name="departamento_id">
                            <option value="">Selecione um departamento</option>
                            @foreach($departamentos as $departamento)
                                <option value="{{ $departamento->id }}" @if(old('departamento_id', $tipoExpediente->departamento_id) == $departamento->id) selected @endif>{{ $departamento->nome }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value='Actualizar'>
                        <a  href="{{ url('/tipo_expedienteIndex') }}" type="button" class="btn btn-warning">Cancelar</a>
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
