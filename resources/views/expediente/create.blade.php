@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Cadastrar Expediente</h1>

@stop

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados do Expediente</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ url('saveExpediente') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do expediente...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite a descrição do expediente...">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="data_submissao">Data de Submissão</label>
                            <input type="date" class="form-control" id="data_submissao" name="data_submissao" value="{{ now()->format('Y-m-d') }}" max="{{ now()->format('Y-m-d') }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estudante_id">Estudante</label>
                            @if (auth()->user()->tipo_usuario === 'Estudante')
                                <input type="text" class="form-control" id="estudante_details" value="{{ auth()->user()->userable->codigo }} - {{ auth()->user()->userable->nome }} {{ auth()->user()->userable->apelido }}" readonly>
                                <input type="hidden" name="estudante_id" value="{{ auth()->user()->userable->id }}">
                            @else
                                <select class="form-control" id="estudante_id" name="estudante_id">
                                    <option value="">Selecione o Estudante</option>
                                    @foreach ($estudantes as $estudante)
                                        <option value="{{ $estudante->id }}">{{ $estudante->codigo . " - " . $estudante->nome . " " . $estudante->apelido }}</option>
                                    @endforeach
                                </select>
                            @endif

                        </div>
                    </div>


                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_expediente_id">Tipo de Expediente</label>
                        <select class="form-control" id="tipo_expediente_id" name="tipo_expediente_id">
                            <option value="">Selecione O Tipo de Expediente</option> <!-- Added "Select" option -->

                            @foreach ($tiposExpediente as $tipoExpediente)
                                <option value="{{ $tipoExpediente->id }}">{{ $tipoExpediente->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="Salvar">
                <a href="{{ url('/expedienteIndex') }}" type="button" class="btn btn-warning">Cancelar</a>
            </div>
        </form>
    </div>
    <!-- /.card -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
