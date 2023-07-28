@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    @if (session('mensagem'))
        <div class="alert alert-success">{{ session('mensagem') }}</div>
    @endif
    @if (session('successDelete'))
        <div class="alert alert-danger">{{ session('successDelete') }}</div>
    @endif
    <h1>Usuários</h1>
@stop

@section('content')
    <div class="d-flex flex-row-reverse align-items-end mb-3">
        <a href="{{ route('userCreate') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Adicionar
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nome</th>
                        <th>Roles</th>
                        <th>Curso</th>
                        <th>Departamento</th>
                        <th>Estado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="badge badge-success">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            @if ($user->userable_type === 'App\Models\Estudante' && $user->userable->curso)
                                <td>{{ $user->userable->curso->nome }}</td>
                                <td>-</td>
                            @elseif ($user->userable_type === 'App\Models\Funcionario')
                                @if ($user->userable->alocacao && $user->userable->alocacao->departamento)
                                    <td>-</td>
                                    <td>{{ $user->userable->alocacao->departamento->nome }}</td>
                                @else
                                    <td>Funcionário sem alocação</td>
                                    <td>-</td>
                                @endif
                            @else
                                <td>-</td>
                                <td>-</td>
                            @endif
                            <td>
                                @if ($user->estado === 'Activo')
                                    <span class="badge badge-primary">{{ $user->estado }}</span>
                                @elseif ($user->estado === 'Inactivo')
                                    <span class="badge badge-danger">{{ $user->estado }}</span>
                                @endif
                            </td>
                            <td>
                                <!-- Visualizar -->
                                <a class="btn btn-primary btn-sm d-inline" href="{{ url('visualizar_user', $user->id) }}"><i class="fas fa-eye"></i></a>
                                <!-- Editar -->
                                <a class="btn btn-info btn-sm d-inline" href="{{ url('update_user', $user->id) }}"><i class="fas fa-pencil-alt"></i></a>
                                <!-- Excluir -->
                                <form id="form-excluir-{{ $user->id }}" action="{{ route('users.delete', ['id' => $user->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete(event, '{{ $user->name }}', {{ $user->id }})"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script>
        setTimeout(function() {
            document.querySelector('.alert').remove();
        }, 5000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(event, name, formId) {
            event.preventDefault(); // Prevenir envio do formulário padrão

            Swal.fire({
                title: 'Tem certeza que deseja excluir o usuário ' + name + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-excluir-' + formId).submit(); // Enviar formulário específico após confirmação
                }
            });
        }
    </script>
@stop
