@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1> Cadastrar Tipo de Expediente</h1>
@stop

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados do Tipo de Expediente</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ url('saveTipoExpediente') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="inputAddress">Nome do Tipo de Expediente</label>
                    <input type="text" class="form-control" id="nome" name='nome' placeholder="Digite o nome do Tipo de Expediente...">
                </div>
                <div class="form-group">
                    <label for="inputAddress">Descrição</label>
                    <input type="text" class="form-control" id="nome" name='descricao' placeholder="Digite a Descrição...">
                </div>

                <div class="form-group col-md-4">
                    <label for="departamento_id">Departamento</label>
                    <select class="form-control" id="departamento_id" name="departamento_id">
                        <option value="">Selecione um departamento</option>
                        @foreach($departamentos as $departamento)
                            <option value="{{ $departamento->id }}">{{ $departamento->nome }}</option>
                        @endforeach
                    </select>
                </div>

               <!-- Estágios de Processo -->
               <div id="estagios_processo_div" class="form-group col-md-6">
                <label>Estágios de Processo</label>
                <div class="row">
                    @foreach($estagioProcessos as $estagioProcesso)
                        <div class="form-check col-md-6"> <!-- Coloca 2 checkboxes por linha (col-md-6) -->
                            <input class="form-check-input" type="checkbox" name="estagios_processo[]" value="{{ $estagioProcesso->id }}" id="estagio_{{ $estagioProcesso->id }}">
                            <label class="form-check-label" for="estagio_{{ $estagioProcesso->id }}">
                                <span class="badge badge-primary">{{ $estagioProcesso->nome }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="info-message">
                    Selecione pelo menos um Estágio de Processo.
                </div>
            </div>

            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value='Salvar'>
                <a href="{{ url('/tipo_expedienteIndex') }}" type="button" class="btn btn-warning">Cancelar</a>
            </div>
        </form>
    </div>
    <!-- /.card -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .info-message {
            font-size: 12px;
            color: #dc3545; /* Cor vermelha, você pode alterar conforme necessário */
            margin-top: 5px; /* Espaçamento entre a mensagem e os checkboxes */
        }
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <!-- Adicione o script do select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializa o select2 no campo de seleção
            $('.select2').select2();

            // Função para mostrar ou ocultar a mensagem informativa
            function toggleInfoMessage() {
                if ($('input[name="estagios_processo[]"]:checked').length === 0) {
                    $('.info-message').show(); // Mostra a mensagem informativa
                } else {
                    $('.info-message').hide(); // Oculta a mensagem informativa
                }
            }

            // Chama a função toggleInfoMessage no carregamento da página
            toggleInfoMessage();

            // Adicione a validação personalizada
            $('form').submit(function(event) {
                if ($('input[name="estagios_processo[]"]:checked').length === 0) {
                    event.preventDefault(); // Impede o envio do formulário
                    $('.info-message').show(); // Mostra a mensagem informativa
                } else {
                    $('.info-message').hide(); // Oculta a mensagem informativa se há checkboxes selecionados
                }
            });

            // Adicione um evento de clique para os checkboxes
            $('input[name="estagios_processo[]"]').click(function() {
                toggleInfoMessage();
            });
        });
    </script>
@stop
