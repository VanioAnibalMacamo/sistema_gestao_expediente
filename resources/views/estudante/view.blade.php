@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1> Visualizar Estudante</h1>
      
@stop

@section('content')
        
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Dados do Estudante</h3>
              </div>
              
              <form action="{{url('saveEstudante')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class= "form-row">
                        <div class="form-group col-md-6">
                            <label for="inputAddress">Nome</label>
                            <input type="text" class="form-control" id="nome" name='nome' value="{{ $estudante->nome }}" placeholder="Digite o nome do Estudante..."readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Apelido</label>
                            <input type="text" class="form-control" id="apelido" name='apelido'  value="{{ $estudante->apelido }}" placeholder="Apelido do Estudante"readonly>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputPassword4">Codigo</label>
                            <input type="text" class="form-control" id="codigo" name='codigo' value="{{ $estudante->codigo }}" placeholder="Apelido do Estudante"readonly>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="inputEmail4">Curso</label>
                            <input type="text" class="form-control" id="curso" name='curso' value="{{ $estudante->curso }}" placeholder="Curso do Estudante"readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputPassword4">Contacto</label>
                            <input type="text" class="form-control" id="contacto" name='contacto' value="{{ $estudante->contacto }}"placeholder="Contacto do Estudante"readonly>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="inputEmail4">Morada</label>
                            <input type="text" class="form-control" id="morada" name='morada' value="{{ $estudante->morada }}" placeholder="Morada do Estudante"readonly>
                            </div>
                        </div>
    
                   
                   
                    <div class="card-footer">
                        <a  href="{{ url('/estudanteIndex') }}" type="button" class="btn btn-warning">Voltar</a>
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
