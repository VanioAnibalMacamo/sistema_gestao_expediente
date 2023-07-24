@extends('adminlte::page')

@section('title', 'Cadastrar Usuário')

@section('content_header')
    <h1>Cadastrar Usuário</h1>
@stop

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados do Usuário</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome do Usuário...">
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite o email do Usuário...">
                    </div>
                </div>

                <div class="form-group">
                    <label>Estado</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="estado" value="Activo" id="estadoActivo">
                        <label class="form-check-label" for="estadoActivo">
                            Activo
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="estado" value="Inactivo" id="estadoInactivo">
                        <label class="form-check-label" for="estadoInactivo">
                            Inactivo
                        </label>
                    </div>
                </div>

                <div class="form-group  border border-primary rounded p-2 col-md-6">
                    <label>Tipo de Usuário</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_usuario" value="Estudante" id="tipoEstudante">
                                <label class="form-check-label" for="tipoEstudante">
                                    Estudante
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_usuario" value="Funcionario" id="tipoFuncionario">
                                <label class="form-check-label" for="tipoFuncionario">
                                    Funcionário
                                </label>
                            </div>
                        </div>
                    </div>


                <div class="form-group" id="divEstudante" style="display: none;">
                    <label>Selecione o Estudante</label>
                    <select class="form-control" name="estudante_id">
                        <option value="">Selecione um Estudante</option>
                        @foreach($estudantes as $estudante)
                            <option value="{{ $estudante->id }}">{{ $estudante->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="divFuncionario" style="display: none;">
                    <label>Selecione o Funcionário</label>
                    <select class="form-control" name="funcionario_id">
                        <option value="">Selecione um Funcionario</option>
                        @foreach($funcionarios as $funcionario)
                            <option value="{{ $funcionario->id }}">{{ $funcionario->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
                <div class="form-group border border-primary rounded p-2 col-md-6">
                    <label>Roles</label>
                    <div class="row">
                        @foreach($roles as $role)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role{{ $role->id }}">
                                    <label class="form-check-label" for="role{{ $role->id }}">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="Salvar">
                <a href="{{ route('users') }}" type="button" class="btn btn-warning">Cancelar</a>
            </div>
        </form>
    </div>
    <!-- /.card -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .form-inline .form-check {
            display: inline-block;
            margin-right: 10px;
        }
        .tipo-usuario-label {
            display: block;
            margin-bottom: 5px;
        }
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipoEstudante = document.getElementById('tipoEstudante');
            const tipoFuncionario = document.getElementById('tipoFuncionario');
            const divEstudante = document.getElementById('divEstudante');
            const divFuncionario = document.getElementById('divFuncionario');

            function showDivEstudante() {
                divEstudante.style.display = 'block';
                divFuncionario.style.display = 'none';
            }

            function showDivFuncionario() {
                divEstudante.style.display = 'none';
                divFuncionario.style.display = 'block';
            }

            function hideBothDivs() {
                divEstudante.style.display = 'none';
                divFuncionario.style.display = 'none';
            }

            // Inicializar a exibição das divs com base na seleção atual do tipo de usuário
            if (tipoEstudante.checked) {
                showDivEstudante();
            } else if (tipoFuncionario.checked) {
                showDivFuncionario();
            } else {
                hideBothDivs();
            }

            // Adicionar um evento de mudança para atualizar a exibição das divs quando o usuário selecionar o tipo de usuário
            tipoEstudante.addEventListener('change', function() {
                if (tipoEstudante.checked) {
                    showDivEstudante();
                } else {
                    hideBothDivs();
                }
            });

            tipoFuncionario.addEventListener('change', function() {
                if (tipoFuncionario.checked) {
                    showDivFuncionario();
                } else {
                    hideBothDivs();
                }
            });
        });
    </script>
@stop
