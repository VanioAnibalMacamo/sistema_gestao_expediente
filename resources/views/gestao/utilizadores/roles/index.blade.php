@extends('adminlte::page')

@section('title', 'Funções')

@section('content_header')
    @if (session('mensagem'))
        <div class="alert alert-success">{{ session('mensagem') }}</div>
    @endif
    @if (session('successDelete'))
        <div class="alert alert-danger">{{ session('successDelete') }}</div>
    @endif
    <h1>Funções</h1>
@stop

@section('content')
    <div class="d-flex flex-row-reverse align-items-end mb-3">
        <a href="{{ url('roleCreate') }}" class="btn btn-primary">
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
                        <th>Permissões</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach($role->permissions as $permission)
                                    <span class="badge badge-primary">{{ $permission->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <!-- Visualizar -->
                                <a class="btn btn-primary btn-sm d-inline" href="{{ url('visualizar_role', $role->id) }}"><i class="fas fa-eye"></i></a>
                                <!-- Editar -->
                                <a class="btn btn-info btn-sm d-inline" href="{{ url('update_role', $role->id) }}"><i class="fas fa-pencil-alt"></i></a>
                                <!-- Excluir -->
                                <form id="form-excluir-{{ $role->id }}" action="{{ route('roles.delete', ['id' => $role->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete(event, '{{ $role->name }}', {{ $role->id }})"><i class="fas fa-trash"></i></button>
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
                title: 'Tem certeza que deseja excluir a função ' + name + '?',
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
