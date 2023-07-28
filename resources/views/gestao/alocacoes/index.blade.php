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
                            <td>{{  $loop->index + 1  }}</td>
                            <td>{{ $alocacao->funcionario->nome ?? 'Não alocado' }}</td>
                            <td>{{ $alocacao->departamento->nome ?? 'Não alocado' }}</td>
                            <td>{{ $alocacao->cargo->nome ?? 'Não alocado' }}</td>
                            <td>
                                <a  class="btn btn-primary btn-sm d-inline" href="{{url('visualizar_alocacao',$alocacao->id)}}"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-info btn-sm d-inline" href="{{url('update_alocacao',$alocacao->id)}}"> <i class="fas fa-pencil-alt"></i></a>
                                <form id="form-excluir-{{ $alocacao->id }}" action="{{ route('alocacoes.delete', ['id' => $alocacao->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete(event, '{{ $alocacao->funcionario->nome }}', '{{ $alocacao->departamento->nome }}', '{{ $alocacao->cargo->nome }}', {{ $alocacao->id }})"><i class="fas fa-trash"></i></button>
                                </form>
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
        setTimeout(function() {
            document.querySelector('.alert').remove();
        }, 5000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <script>
        function confirmDelete(event, nome, departamento, cargo, formId) {
            event.preventDefault();
            Swal.fire({
                title: 'Tem certeza que deseja excluir a alocação de ' + nome + ' para o departamento' + departamento + ' no cargo ' + cargo + '?',
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
