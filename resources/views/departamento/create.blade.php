@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1> Cadastrar Departamento</h1>
      
@stop

@section('content')
        <!-- general form elements -->
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Dados do Departamento</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{url('saveDep')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputAddress">Nome Completo</label>
                        <input type="text" class="form-control" id="nome" name='nome' placeholder="Digite o nome do Departamento...">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputPassword4">Sigla</label>
                        <input type="text" class="form-control" id="sigla" name='sigla' placeholder="ex: GRH">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputEmail4">Descricao</label>
                        <input type="text" class="form-control" id="descricao" name='descricao'>
                        </div>
                    </div>
                   
                   
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value='Salvar'>
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