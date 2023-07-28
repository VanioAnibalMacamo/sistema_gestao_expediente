@extends('adminlte::page')

@section('title', 'Visualizar Alocacao')

@section('content_header')
    <h1>Visualizar Alocacao</h1>
@stop

@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados de Alocacoes</h3>
        </div>

        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="funcionario_id">Funcionario</label>
                    <input type="text" class="form-control" id="funcionario_id" name="funcionario_id" value="{{ $alocacao->funcionario->nome }}" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="departamento_id">Departamento</label>
                    <input type="text" class="form-control" id="departamento_id" name="departamento_id" value="{{ $alocacao->departamento->nome }}" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="cargo_id">Cargo</label>
                    <input type="text" class="form-control" id="cargo_id" name="cargo_id" value="{{ $alocacao->cargo->nome }}" disabled>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ url('/funcDepCargoIndex') }}" type="button" class="btn btn-warning">Voltar</a>
        </div>
    </div>
    <!-- /.card -->

@stop
