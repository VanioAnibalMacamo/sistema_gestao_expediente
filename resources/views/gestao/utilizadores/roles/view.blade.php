@extends('adminlte::page')

@section('title', 'Editar Função')

@section('content_header')
    <h1>Editar Função</h1>
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados da Função</h3>
        </div>
        <form  action="{{url('updateRole',$role->id)}}"  method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" disabled>
                </div>
                <!-- Outros campos da função (role) podem ser adicionados aqui -->

                <label>Permissões</label>
                <div class="row">
                    @foreach($role->permissions as $permission)
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission{{ $permission->id }}" checked disabled>
                                <label class="form-check-label" for="permission{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ url('/roleIndex') }}" class="btn btn-warning">Cancelar</a>
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
