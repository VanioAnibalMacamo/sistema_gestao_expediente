@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Expediente</h1>

    @if (session('success'))
         <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@stop

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados do Expediente</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ url('updateExpediente/'.$expediente->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="{{ $expediente->nome }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $expediente->descricao }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="data_submissao">Data de Submissão</label>
                            <input type="date" class="form-control" id="data_submissao" name="data_submissao" value="{{ $expediente->data_submissao }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipo_expediente_id">Estudante</label>
                            <select class="form-control" id="estudante_id" name="estudante_id">
                                <option value="">Selecione O Estudante</option> <!-- Added "Select" option -->

                                @foreach ($estudantes as $estudante)
                                    <option value="{{ $estudante->id }}" {{ $estudante->id == $expediente->estudante_id ? 'selected' : '' }}>{{ $estudante->codigo." - ".$estudante->nome." ".$estudante->apelido }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipo_expediente_id">Tipo de Expediente</label>
                            <select class="form-control" id="tipo_expediente_id" name="tipo_expediente_id" disabled>
                                <option value="">Selecione O Tipo de Expediente</option> <!-- Added "Select" option -->

                                @foreach ($tiposExpediente as $tipoExpediente)
                                    <option value="{{ $tipoExpediente->id }}" {{ $tipoExpediente->id == $expediente->tipo_expediente_id ? 'selected' : '' }}>
                                        {{ $tipoExpediente->nome }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipo_expediente_id">Estágio do Processo</label> <br>
                            @if ($expediente->estagioProcesso)
                                <span class="badge badge-primary">{{ $expediente->estagioProcesso->nome }}</span>
                            @else
                                <span class="badge badge-danger">Sem Estágio de Processo</span>
                            @endif
                        </div>
                    </div>
                </div>
               <div class="row">
                    @if(auth()->user()->userable instanceof \App\Models\Funcionario)
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="formFileMultiple" class="form-label">Documento(s)</label>
                                    <input class="form-control" type="file" name="documentos[]" id="formFileMultiple" multiple>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="mb-3">
                                <div>
                                    <label>Documentos:</label>
                                    <br>
                                    @if ($expediente->documentos->isEmpty())
                                        <span class="badge badge-danger">Sem Documentos</span>
                                    @else
                                        @foreach ($expediente->documentos as $documento)
                                            <span class="badge badge-primary">{{ $documento->nome_original }}</span>
                                        @endforeach
                                    @endif
                                    <br>
                                    @if ($expediente->documentos->isNotEmpty())
                                        <a href="{{ route('download.documentos', ['id' => $expediente->id]) }}" class="btn btn-primary">
                                            <i class="fas fa-download"></i> Baixar Documentos
                                        </a>
                                    @else
                                        <button class="btn btn-primary" disabled>
                                            <i class="fas fa-download"></i> Baixar Documentos
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <input type="submit" class="btn btn-primary mr-2" value="Actualizar">
                <a href="{{ url('/expedienteIndex') }}" type="button" class="btn btn-warning">Voltar</a>
            </div>


        </form>
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Histórico do Expediente</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Comentário</th>
                            <th>Funcionário</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comentariosExpediente as $comentario)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $comentario->pivot->comentario }}</td>
                            <td>{{ $comentario->nome }}</td>
                            <td>{{ $comentario->pivot->data_comentario }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <form id="formAddComentario" action="{{ route('adicionar.comentario', $expediente->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comentarios">Comentário</label>
                                <textarea class="form-control" id="comentarios" name="comentarios"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <button type="submit" class="btn btn-success">Adicionar Comentário</button>
                    <button type="submit" formaction="{{ route('avancar.expediente', $expediente->id) }}" class="btn btn-info" id="btnAvancarExpediente">Avançar Expediente</button>
                </div>
            </div>
        </form>


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

@stop

