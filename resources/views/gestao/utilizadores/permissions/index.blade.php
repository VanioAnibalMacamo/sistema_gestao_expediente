@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
    @if (session('mensagem'))
        <div class="alert alert-success">{{ session('mensagem') }}</div>
    @endif
    @if (session('successDelete'))
        <div class="alert alert-danger">{{ session('successDelete') }}</div>
    @endif
    <h1>Permissões</h1>
@stop

@section('content')
    <div class="d-flex flex-row-reverse align-items-end mb-3">
        <a href="{{ url('permissionCreate') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Adicionar
        </a>
    </div>

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nome</th>
                    <th>Acções</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>
                             <!-- Editar -->
                            <a class="btn btn-info btn-sm d-inline" href="{{ url('update_permission', $permission->id) }}"><i class="fas fa-pencil-alt"></i></a>
                            <!-- Excluir -->
                            <form id="form-excluir-{{ $permission->id }}" action="{{ route('permissions.delete', ['id' => $permission->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete(event, '{{ $permission->name }}', {{ $permission->id }})"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $permissions->links('pagination::bootstrap-4') }}
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
                title: 'Tem certeza que deseja excluir a permissão ' + name + '?',
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
