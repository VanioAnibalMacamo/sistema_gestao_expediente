@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1> Cadastrar Estudante</h1>
      
@stop

@section('content')

    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Dados do estudante</h3>
              </div>
             
              <form action="{{url('saveEstudante')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class= "form-row">
                    <div class="form-group col-md-6">
                        <label for="inputAddress">Nome</label>
                        <input type="text" class="form-control" id="nome" name='nome' placeholder="Digite o nome do Estudante...">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Apelido</label>
                        <input type="text" class="form-control" id="apelido" name='apelido' placeholder="Apelido do Estudante">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputPassword4">Codigo</label>
                        <input type="text" class="form-control" id="codigo" name='codigo' placeholder="Apelido do Estudante">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputEmail4">Curso</label>
                        <input type="text" class="form-control" id="curso" name='curso' placeholder="Curso do Estudante">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputPassword4">Contacto</label>
                        <input type="text" class="form-control" id="contacto" name='contacto' placeholder="Contacto do Estudante">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputEmail4">Morada</label>
                        <input type="text" class="form-control" id="morada" name='morada' placeholder="Morada do Estudante">
                        </div>
                    </div>

                   
                   
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value='Salvar'>
                        <a  href="{{ url('/EstudanteIndex') }}" type="button" class="btn btn-warning">Cancelar</a>
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