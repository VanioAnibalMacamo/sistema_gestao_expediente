@extends ('adminlte::page')
@section('title','Dashboard' )
@section('content_header')

<h1>Editar curso</h1>

@stop

@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Dados do curso</h3>
    </div>


    <form action="{{url('updateCurso',$curso->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="card-body">
      <div class="form-row">
          <div class="form-group col-md-6">
              <label for="inputAddress">Nome</label>
              <input type="text" class="form-control" id="nome" name='nome' value="{{ $curso->nome }}" placeholder="Digite o nome do curso...">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Sigla</label>
            <input type="text" class="form-control" id="sigla" name='sigla' value="{{ $curso->sigla }}" placeholder="Sigla do curso, Ex: GRH">
            </div>

        </div>
        
          

          <div class="card-footer">
              <input type="submit" class="btn btn-primary" value='Actualizar'>
              <a  href="{{ url('/cursoIndex') }}" type="button" class="btn btn-warning">Cancelar</a>
          </div>
    </form>
  </div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script> console.log('Hi!'); </script>
@stop
