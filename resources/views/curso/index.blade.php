@extends('adminlte::page')

@section('title', 'Cursos')

@section('content_header')
      @if (session('mensagem'))
          <div class="alert alert-success">{{ session('mensagem') }}</div>
      @endif
      @if (session('successDelete'))
          <div class="alert alert-danger">{{ session('successDelete') }}</div>
      @endif
    <h1>Cursos</h1>
@stop

@section('content')
    

<div class="d-flex flex-row-reverse align-items-end mb-3">
  <a href="{{ url('CursoCreate') }}"  class="btn btn-primary">
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
                      <th>Sigla</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($cursos as $curso)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $curso->nome}}</td>
                      <td>{{ $curso->sigla}}</td>
                     
                      <td> 
                            <!-- Large modal -->
                            <a  class="btn btn-primary btn-sm d-inline" href="{{url('visualizar_curso',$curso->id)}}"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-info btn-sm d-inline"  href="{{url('update_curso',$curso->id)}}"> <i class="fas fa-pencil-alt"></i></a>
                           
                            <form id="form-excluir-{{ $curso->id }}" action="{{ route('cursos.delete', ['id' => $curso->id]) }}" method="POST" class="d-inline">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete(event, '{{ $curso->nome }}', {{ $curso->id }})"><i class="fas fa-trash"></i></button>
                            </form>

                      </td>
                    </tr>
                   @endforeach
                  </tbody>
                </table>
                {{ $cursos->links('pagination::bootstrap-4') }}
              </div>
            </div>      
@stop
