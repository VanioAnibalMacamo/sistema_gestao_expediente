@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Visualizar Expediente</h1>
@stop

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados do Expediente</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{{ $expediente->nome }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $expediente->descricao }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="data_submissao">Data de Submissão</label>
                        <input type="date" class="form-control" id="data_submissao" name="data_submissao" value="{{ $expediente->data_submissao }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_expediente_id">Estudante</label>
                        <input type="text" class="form-control" id="estudante_id" name="estudante_id" value="{{ $expediente->estudante->codigo." - ".$expediente->estudante->nome." ".$expediente->estudante->apelido }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_expediente_id">Tipo de Expediente</label>
                        <input type="text" class="form-control" id="tipo_expediente_id" name="tipo_expediente_id" value="{{ $expediente->tipoExpediente->nome }}" readonly>
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cronograma_id">Cronograma</label> <br>
                        @if ($expediente->estagioProcesso && $expediente->data_inicio_estagio)
                                    @php
                                        $tempoEstimado = $expediente->estagioProcesso->tempo_estimado_conclusao;
                                        $dataInicioEstagio = \Carbon\Carbon::parse($expediente->data_inicio_estagio);

                                        // Ajustar o cálculo dos dias úteis restantes
                                        $dataPrevista = $dataInicioEstagio->copy();
                                        $diasUteisRestantes = 0;

                                        while ($diasUteisRestantes < $tempoEstimado) {
                                            $dataPrevista->addDay();
                                            if ($dataPrevista->isWeekday()) { // Verificar se o dia é um dia útil
                                                $diasUteisRestantes++;
                                            }
                                        }

                                        $hoje = now();
                                        $diasAtrasados = $hoje->diffInDays($dataPrevista, false);
                                    @endphp

                                    @if ($diasAtrasados > 0)
                                        <span class="badge badge-danger">Atrasado ({{ $diasAtrasados }} dias)</span>
                                    @else
                                        <span class="badge badge-success">Dentro do prazo ({{ $diasUteisRestantes }} dias úteis restantes)</span>
                                    @endif
                                @elseif ($expediente->estagioProcesso)
                                    <span class="badge badge-danger">Data de Início de Estágio não definida</span>
                                @else
                                    <span class="badge badge-danger">Sem Estágio de Processo</span>
                                @endif
                    </div>
                </div>
            </div>
            <div class="row">
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
                            </div>
                        </div>
                    </div>
                </div>

            </div>
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
        </div>
        <div class="card-footer">
            <a href="{{ url('/expedienteIndex') }}" type="button" class="btn btn-warning">Voltar</a>
        </div>
    </div>
    <!-- /.card -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
