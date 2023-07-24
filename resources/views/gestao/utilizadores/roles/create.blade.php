@extends('adminlte::page')

@section('title', 'Cadastrar Função')

@section('content_header')
    <h1>Cadastrar Função</h1>
@stop

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados da Função</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome da Função...">
                </div>
                <div class="form-group border border-primary rounded p-2">
                    <label>Permissões</label>
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission{{ $permission->id }}">
                                    <label class="form-check-label" for="permission{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="Salvar">
                <a href="{{ route('roles.index') }}" type="button" class="btn btn-warning">Cancelar</a>
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
