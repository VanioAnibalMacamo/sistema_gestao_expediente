@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Cadastrar Estágio do Processo</h1>
@stop

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados do Estágio do Processo</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ url('saveEstagioProcesso') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do Estágio do Processo...">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="descricao">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite a descrição do Estágio do Processo...">

                    </div>
                    <div class="form-group col-md-6">
                        <label for="tempo_estimado_conclusao">Tempo Estimado de Conclusão (Dias)</label>
                        <input type="number" class="form-control" id="tempo_estimado_conclusao" name="tempo_estimado_conclusao" placeholder="Digite o tempo estimado de conclusão (1 a 90 dias)" inputmode="numeric" min="1" max="90" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="estagio_processo_pai_id">Estágio Antecessor</label>
                    <select class="form-control" id="estagio_processo_pai_id" name="parent_estagio_processo_id">
                        <option value="">Selecione o Estágio Antecessor</option>
                        @foreach ($estagiosDisponiveis as $estagioDisponivel)
                            <option value="{{ $estagioDisponivel->id }}">{{ $estagioDisponivel->nome }}</option>
                        @endforeach
                    </select>
                </div>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="Salvar">
                <a href="{{ url('/est_proIndex') }}" type="button" class="btn btn-warning">Cancelar</a>
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
