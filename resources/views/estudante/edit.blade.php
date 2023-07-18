@extends ('admiblte::page')
@section('title','Dashboard' )
@section('content_header')

<h1>Editar Estudante</h1>

@stop

@section('contente')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Dados do estudante</h3>
    </div>
   

    <form action="{{url('updateEstu',$estudante->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="card-body">
      <div class="form-row">
          <div class="form-group col-md-6">
              <label for="inputAddress">Nome</label>
              <input type="text" class="form-control" id="nome" name='nome' value="{{ $estudante->nome }}" placeholder="Digite o nome do Estudante...">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Apelido</label>
            <input type="text" class="form-control" id="apelido" name='apelido' value="{{ $estudante->apelido }}" placeholder="Apelido do estudante">
            </div>
          
        </div>
        <div>
          <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Codigo</label>
                <input type="text" class="form-control" id="codigo" name='codigo' value="{{ $estudante->codigo }}"placeholder="Codigo do estudante">
                </div>
                <div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">curso</label>
                        <input type="text" class="form-control" id="curso" name='curso' value="{{ $estudante->codigo }}"placeholder="Curso do estudante">
                        </div>

                </div>
              </div>

        </div>

          <div class="form-row">
            
            <div class="form-group col-md-6">
                <label for="inputEmail4">Contacto</label>
                <input type="text" class="form-control" id="contacto" name='contacto' value="{{ $estudante->contancto }}"placeholder="Contacto do estudante">
                </div>

                <div class="form-group col-md-6">
                    <label for="inputEmail4">Morada</label>
                    <input type="text" class="form-control" id="morada" name='morada' value="{{ $estudante->morada }}"placeholder="Morada do estudante">
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