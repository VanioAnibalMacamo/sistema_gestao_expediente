@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1> Cadastrar Alocacoes</h1>

@stop

@section('content')

    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Dados de Alocacoes</h3>
              </div>

              <form action="{{url('saveAlocacoes')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class= "form-row">
                        <div class="form-group col-md-4">
                            <label for="funcionario_id">Funcionario</label>
                            <select class="form-control" id="funcionario_id" name="funcionario_id">
                                <option value="">Selecione um funcionario</option>
                                @foreach($funcionarios as $funcionario)
                                    <option value="{{ $funcionario->id }}">{{ $funcionario->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="form-group col-md-4">
                        <label for="departamento_id">Departamento</label>
                        <select class="form-control" id="departamento_id" name="departamento_id">
                            <option value="">Selecione um Departamento</option>
                            @foreach($departamentos as $departamento)
                                <option value="{{ $departamento->id }}">{{ $departamento->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="cargo_id">Cargo</label>
                            <select class="form-control" id="cargo_id" name="cargo_id">
                                <option value="">Selecione um Cargo</option>
                                @foreach($cargos as $cargo)
                                    <option value="{{ $cargo->id }}">{{ $cargo->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                  



                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value='Salvar'>
                        <a  href="{{ url('/funcDepCargoIndex') }}" type="button" class="btn btn-warning">Cancelar</a>
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
