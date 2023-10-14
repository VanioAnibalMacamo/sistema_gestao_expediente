<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sua Página de Registro</title>
    <!-- Inclua os estilos do Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body  style="margin-top: 5%;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registro e Dados do estudante</div>
                    <div class="card-body">
                        <form action="{{ route('registerEstudante') }}" method="post">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nome</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="password">Senha</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="password_confirmation">Confirme a senha</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="nome">Nome do Estudante</label>
                                    <input type="text" name="nome" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="apelido">Apelido do Estudante</label>
                                    <input type="text" name="apelido" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="codigo">Código</label>
                                    <input type="text" name="codigo" class="form-control" required>
                                </div>
                                @php
                                    $cursos = App\Models\Curso::all();
                                @endphp

                                <div class="form-group col-md-6">
                                    <label for="curso_id">Curso</label>
                                    <select name="curso_id" class="form-control" required>
                                        <option value="">Selecione um Curso</option>
                                        @foreach($cursos as $curso)
                                            <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="contacto">Contacto do Estudante</label>
                                    <input type="text" name="contacto" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="morada">Morada do Estudante</label>
                                    <input type="text" name="morada" class="form-control" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Registrar e Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inclua os scripts do Bootstrap e jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
