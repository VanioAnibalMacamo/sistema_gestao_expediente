@extends('adminlte::page')

@section('title', 'Estagio de Processo')

@section('content_header')
      @if (session('mensagem'))
          <div class="alert alert-success">{{ session('mensagem') }}</div>
      @endif
      @if (session('successDelete'))
          <div class="alert alert-danger">{{ session('successDelete') }}</div>
      @endif
    <h1>Estagio de Processo</h1>
@stop

@section('content')


<div class="d-flex flex-row-reverse align-items-end mb-3">
  <a href="{{ url('estProCreate') }}"  class="btn btn-primary">
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
                      <th>Descrição</th>
                      <th>Tempo Est. Conclusão</th>
                      <th>Antecessor</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($estagioProcessos as $estagioProcesso)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $estagioProcesso->nome}}</td>
                      <td>{{ $estagioProcesso->descricao}}</td>
                      <td>{{ $estagioProcesso->tempo_estimado_conclusao}}</td>
                      <td>
                        @if ($estagioProcesso->estagioProcessoFilho)
                            <span class="badge bg-success">{{ $estagioProcesso->estagioProcessoFilho->nome }}</span>
                        @else
                            <span class="badge bg-danger">Nenhum estágio antecessor encontrado</span>
                        @endif
                    </td>

                      <td>
                            <!-- Large modal -->
                            <a  class="btn btn-primary btn-sm d-inline" href="{{url('visualizar_est_processo',$estagioProcesso->id)}}"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-info btn-sm d-inline"  href="{{url('update_est_processo',$estagioProcesso->id)}}"> <i class="fas fa-pencil-alt"></i></a>

                            <form id="form-excluir-{{ $estagioProcesso->id }}" action="{{ route('estagio_processos.delete', ['id' => $estagioProcesso->id]) }}" method="POST" class="d-inline">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete(event, 'O Estagio do Processo ' + '{{ $estagioProcesso->nome }}', {{ $estagioProcesso->id }})"><i class="fas fa-trash"></i></button>

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
<script src="{{ asset('js/confirmDelete.js') }}"></script>

@stop
