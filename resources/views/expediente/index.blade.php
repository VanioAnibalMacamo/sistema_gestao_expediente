@extends('adminlte::page')

@section('title', 'Expedientes')

@section('content_header')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('erroe') }}</div>
    @endif
    <h1>Expedientes</h1>
@stop

@section('content')
    <div class="d-flex flex-row-reverse align-items-end mb-3">
        <a href="{{ url('expedienteCreate') }}" class="btn btn-primary">
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
                        <th>Descrição</th>
                        <th>Data de Submissão</th>
                        <th>Estudante</th>
                        <th>Tipo Expediente </th>
                        <th>Estágio do Processo</th>
                        <th>Ações</th> <!-- Nova coluna para as ações -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expedientes as $expediente)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $expediente->nome }}</td>
                            <td>{{ $expediente->descricao }}</td>
                            <td>{{ $expediente->data_submissao }}</td>
                            <td>{{ $expediente->estudante->nome." ".$expediente->estudante->apelido }}</td>
                            <td>{{ $expediente->tipoExpediente->nome }}</td>
                            <td><span class="badge badge-primary">{{ $expediente->estagioProcesso->nome }}</span></td>

                            <td>
                                <!-- Actions -->
                                <a href="{{ url('visualizar_expediente', $expediente->id) }}" class="btn btn-primary btn-sm d-inline">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ url('update_expediente', $expediente->id) }}" class="btn btn-info btn-sm d-inline">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form id="form-excluir-{{ $expediente->id }}" action="{{ route('expedientes.delete', ['id' => $expediente->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete(event, '{{ $expediente->nome }}', {{ $expediente->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
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
        function confirmDelete(event, nome, formId) {
            event.preventDefault(); // Prevenir envio do formulário padrão

            Swal.fire({
                title: 'Tem certeza que deseja excluir o Expediente ' + nome + '?',
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
