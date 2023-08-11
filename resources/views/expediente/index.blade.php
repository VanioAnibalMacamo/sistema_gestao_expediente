@extends('adminlte::page')

@section('title', 'Expedientes')

@section('content_header')
    @if (session('mensagem'))
        <div class="alert alert-success">{{ session('mensagem') }}</div>
    @endif
    @if (session('successDelete'))
        <div class="alert alert-danger">{{ session('successDelete') }}</div>
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
            <div class="row mt-3 mb-3">
                <div class="col-md-6 offset-md-6">
                    <input type="text" id="searchInput" class="form-control mr-2" placeholder="Pesquisar">
                </div>
            </div>
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
                        <th>Cronograma</th>
                        <th style="width: 140px">Ações</th> <!-- Nova coluna para as ações -->
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
                            <td>
                                @if ($expediente->estagioProcesso)
                                    <span class="badge badge-primary">{{ $expediente->estagioProcesso->nome }}</span>
                                @else
                                    <span class="badge badge-danger">Sem Estágio de Processo</span>
                                @endif
                            </td>
                            <td>
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
                            </td>
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
    <script>
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('.table tbody tr');

        searchInput.addEventListener('input', function () {
            const searchText = searchInput.value.toLowerCase();

            tableRows.forEach(row => {
                const nameColumn = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const descriptionColumn = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                const studentColumn = row.querySelector('td:nth-child(5)').textContent.toLowerCase();

                if (nameColumn.includes(searchText) || descriptionColumn.includes(searchText) || studentColumn.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>

@stop
