@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Actualizar Departamento</h1>
      
@stop

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Dados do Departamento</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
  
              <form action="{{url('updateDep',$departamento->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputAddress">Nome Completo</label>
                        <input type="text" class="form-control" id="nome" name='nome' value="{{ $departamento->nome }}" placeholder="Digite o nome do Departamento...">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputPassword4">Sigla</label>
                        <input type="text" class="form-control" id="sigla" name='sigla' value="{{ $departamento->sigla }}" placeholder="ex: GRH">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputEmail4">Descricao</label>
                        <input type="text" class="form-control" id="descricao" name='descricao' value="{{ $departamento->descricao }}"placeholder="ex: Estamos todos juntos">
                        </div>
                    </div>
                   
                   
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value='Actualizar'>
                        <a  href="{{ url('/depIndex') }}" type="button" class="btn btn-warning">Cancelar</a>
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