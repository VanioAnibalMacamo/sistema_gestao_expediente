@extends ('adminlte::page')
@section('title','Dashboard' )
@section('content_header')

<h1>Editar Estudante</h1>

@stop

@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Dados do estudante</h3>
    </div>


    <form action="{{url('updateEstudante',$estudante->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="card-body">
      <div class="form-row">
          <div class="form-group col-md-6">
              <label for="inputAddress">Nome</label>
              <input type="text" class="form-control" id="nome" name='nome' value="{{ $estudante->nome }}" placeholder="Digite o nome do Estudante...">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Apelido</label>
            <input type="text" class="form-control" id="apelido" name='apelido' value="{{ $estudante->apeido }}" placeholder="Apelido do estudante">
            </div>

        </div>
        
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputPassword4">Codigo</label>
              <input type="text" class="form-control" id="codigo" name='codigo' value="{{ $estudante->codigo }}" placeholder="Codigo do estudante">
              </div>
  
              <div class="form-group col-md-4">
                <label for="curso_id">Curso</label>
                <select class="form-control" id="curso_id" name="curso_id">
                    <option value="">Selecione um Curso</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                    @endforeach
                </select>
            </div>

                </div>
              

        

          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="inputPassword4">Contacto</label>
              <input type="text" class="form-control" id="contacto" name='contacto' value="{{ $estudante->contacto }}" placeholder="contacto do estudante">
              </div>
  

                <div class="form-group col-md-6">
                    <label for="inputEmail4">Morada</label>
                    <input type="text" class="form-control" id="morada" name='morada' value="{{ $estudante->morada }}"placeholder="Morada do estudante">
                    </div>
          </div>


          <div class="card-footer">
              <input type="submit" class="btn btn-primary" value='Actualizar'>
              <a  href="{{ url('/estudanteIndex') }}" type="button" class="btn btn-warning">Cancelar</a>
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
