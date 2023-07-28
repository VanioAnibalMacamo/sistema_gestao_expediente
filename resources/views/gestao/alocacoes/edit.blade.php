@extends('adminlte::page')

@section('title', 'Atualizar Alocacao')

@section('content_header')
    <h1>Atualizar Alocacao</h1>
@stop

@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados de Alocacoes</h3>
        </div>

        <form action="{{ url('updateAlocacao', ['id' => $alocacao->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="funcionario_id">Funcionario</label>
                        <select class="form-control" id="funcionario_id" name="funcionario_id">
                            <option value="">Selecione um funcionário</option>
                            @foreach($funcionarios as $funcionario)
                                <option value="{{ $funcionario->id }}" @if($alocacao->funcionario_id == $funcionario->id) selected @endif>{{ $funcionario->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="departamento_id">Departamento</label>
                        <select class="form-control" id="departamento_id" name="departamento_id">
                            <option value="">Selecione um departamento</option>
                            @foreach($departamentos as $departamento)
                                <option value="{{ $departamento->id }}" @if($alocacao->departamento_id == $departamento->id) selected @endif>{{ $departamento->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cargo_id">Cargo</label>
                        <select class="form-control" id="cargo_id" name="cargo_id">
                            <option value="">Selecione um cargo</option>
                            @foreach($cargos as $cargo)
                                <option value="{{ $cargo->id }}" @if($alocacao->cargo_id == $cargo->id) selected @endif>{{ $cargo->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value='Actualizar'>
                <a href="{{ url('/funcDepCargoIndex') }}" type="button" class="btn btn-warning">Cancelar</a>
            </div>
        </form>
    </div>
    <!-- /.card -->

@stop
