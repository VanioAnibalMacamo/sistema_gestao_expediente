

@extends('adminlte::page')

@section('title', 'Estudante')

@section('content_header')
      @if (session('mensagem'))
          <div class="alert alert-success">{{ session('mensagem') }}</div>
      @endif
      @if (session('successDelete'))
          <div class="alert alert-danger">{{ session('successDelete') }}</div>
      @endif
      @if (session('error'))
         <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
    <h1>Estudantes</h1>
@stop

@section('content')


<div class="d-flex flex-row-reverse align-items-end mb-3">
  <a href="{{ url('estudanteCreate') }}"  class="btn btn-primary">
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
                      <th>Apelido</th>
                      <th>Codigo</th>
                      <th>Curso</th>
                      <th>Contacto</th>
                      <th>Morada</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $count = 0;
                @endphp

                @foreach ($estudantes as $estudante)
                    @php
                        $count++;
                    @endphp
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $estudante->nome }}</td>
                        <td>{{ $estudante->apelido }}</td>
                        <td>{{ $estudante->codigo }}</td>
                        <td>{{ $estudante->curso ? $estudante->curso->nome : 'Nenhum curso associado' }}</td>
                        <td>{{ $estudante->contacto }}</td>
                        <td>{{ $estudante->morada }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm d-inline" href="{{ url('visualizar_estudante', $estudante->id) }}"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-info btn-sm d-inline" href="{{ url('update_estudante', $estudante->id) }}"><i class="fas fa-pencil-alt"></i></a>

                            <form id="form-excluir-{{ $estudante->id }}" action="{{ route('estudantes.delete', ['id' => $estudante->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete(event, '{{ $estudante->nome }}', {{ $estudante->id }})"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($count > 1)
                    {{ $estudantes->links('pagination::bootstrap-4') }}
                @endif

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
        event.preventDefault();

        Swal.fire({
            title: 'Tem certeza que deseja excluir o Estudane ' + nome + '?',
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
@stop
