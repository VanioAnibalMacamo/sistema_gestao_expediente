@extends('adminlte::page')

@section('title', 'Alocação de Funcionários')

@section('content_header')
@if (session('mensagem'))
<div class="alert alert-success">{{ session('mensagem') }}</div>
@endif
@if (session('successDelete'))
<div class="alert alert-danger">{{ session('successDelete') }}</div>
@endif
    <h1>Alocação de Funcionários aos Departamentos e Cargos</h1>
@stop

@section('content')
    <!-- general table elements -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Alocações</h3>
            <div class="card-tools">
                <a href="{{ route('createAlocacao') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Adicionar Alocação
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Funcionário</th>
                        <th>Departamento</th>
                        <th>Cargo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alocacoes as $alocacao)
                        <tr>
                            <td>{{ $alocacao->id }}</td>
                            @if ($alocacao->funcionario)
                                <td>{{ $alocacao->funcionario->nome }}</td>
                            @else
                                <td>Não alocado</td>
                            @endif
                            <td>
                                @if ($alocacao->departamento)
                                    {{ $alocacao->departamento->nome }}
                                @else
                                    Não alocado
                                @endif
                            </td>

                            <td>
                                @if ($alocacao->cargo)
                                    {{ $alocacao->cargo->nome }}
                                @else
                                    Não alocado
                                @endif
                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        function confirmDelete(event, nome, formId) {
            event.preventDefault();
            Swal.fire({
                title: 'Tem certeza que deseja excluir a alocação de ' + nome + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-excluir-' + formId).submit();
                }
            });
        }
    </script>
@endsection
