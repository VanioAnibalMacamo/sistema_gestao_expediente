@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
      @if (session('mensagem'))
          <div class="alert alert-success">{{ session('mensagem') }}</div>
      @endif
      @if (session('successDelete'))
          <div class="alert alert-danger">{{ session('successDelete') }}</div>
      @endif
    <h1>Funcionários</h1>
@stop

@section('content')
<div class="d-flex flex-row-reverse align-items-end mb-3">
  <a href="{{ url('funcCreate') }}"  class="btn btn-primary">
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
                      <th>Contacto</th>
                      <th>E-mail</th>
                      <th>Genero</th>
                      <th></th>
                      <th>N. Documento</th>
                      <th>Departamento</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($funcionarios as $funcionario)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $funcionario->nome}}</td>
                      <td>{{ $funcionario->contacto}}</td>
                      <td>{{ $funcionario->email}}</td>
                      <td>{{ $funcionario->genero}}<td>
                      <td>{{ $funcionario->num_bi}}</td>
                      <td></td>
                      <td>
                            <!-- Large modal -->
                            <a  class="btn btn-primary btn-sm d-inline" href="{{url('visualizar_funcionario',$funcionario->id)}}"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-info btn-sm d-inline" href="{{url('update_funcionario',$funcionario->id)}}"> <i class="fas fa-pencil-alt"></i></a>
                            <form id="form-excluir-{{ $funcionario->id }}" action="{{ route('funcionarios.delete', ['id' => $funcionario->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete(event, '{{ $funcionario->nome }}', {{ $funcionario->id }})"><i class="fas fa-trash"></i></button>
                            </form>

                      </td>
                    </tr>
                   @endforeach
                  </tbody>
                </table>
                {{ $funcionarios->links('pagination::bootstrap-4') }}
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
            title: 'Tem certeza que deseja excluir o Funcionario ' + nome + '?',
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
