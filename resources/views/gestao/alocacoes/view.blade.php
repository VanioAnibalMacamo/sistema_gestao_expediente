@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1> Visualizar Alocacoes</h1>
      
@stop

@section('content')
        
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Dados do Alocacoes</h3>
              </div>
              
              <form action="{{url('saveAlocacoes')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class= "form-row">
                        <div class="form-group col-md-6">
                            <label for="inputAddress">Funcionario</label>
                            <input type="text" class="form-control" id="funcionario" name='funcionario' value="{{ $Alocacoes->funcionario }}" placeholder="Funcionario em alocacoes..."readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Departamento</label>
                            <input type="text" class="form-control" id="departamento" name='departamento'  value="{{ $Alocacoes->departamento }}" placeholder="Departamento em Alocacoes"readonly>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputPassword4">Cargo</label>
                            <input type="text" class="form-control" id="cargo" name='cargo' value="{{ $Alocacoes->cargo }}" placeholder="Cargo em Alocacoes"readonly>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="inputEmail4">Acoes</label>
                            <input type="text" class="form-control" id="acoes" name='acoes' value="{{ $Alocacoes->acoes }}" placeholder="acoes em Alocacoes"readonly>
                            </div>
                        </div>
                       
    
                   
                   
                    <div class="card-footer">
                        <a  href="{{ url('/funcDepCargoIndex') }}" type="button" class="btn btn-warning">Voltar</a>
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
