<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Estudante;
use App\Models\Curso;
use App\Models\Funcionario;
use App\Models\Departamento;
use Illuminate\Support\Facades\Auth;
use App\Models\NotificacaoEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class UserController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if ($user->can('view',User::class)) {
        $users = User::with('roles')->paginate(10);
        return view('gestao.utilizadores.users.index', compact('users'));
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para visualizar os Users.');
    }
}


    public function create()
    {

    if (Auth::user()->can('create', User::class)){
        $roles = Role::all();
        $estudantes = Estudante::all();
        $funcionarios = Funcionario::all();
        return view('gestao.utilizadores.users.create', compact('roles', 'estudantes', 'funcionarios'));
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para criar um novo User.');
    }
}

    public function store(Request $request)
    {

       // Valide os dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'estado' => 'required|string',
            'tipo_usuario' => 'required|string',
        ]);


        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'tipo_usuario' => $request->input('tipo_usuario'),
            'estado' => $request->input('estado'),
        ]);

        $userName = $user->name;
        $parteAleatoria = Str::random(6);
        $resultado = substr($userName, 0, 2) . $parteAleatoria;

        $user->password = Hash::make($resultado);
        $user->save();

        // Obtenha o tipo de usuário selecionado (Estudante ou Funcionário)
        $tipoUsuario = $request->input('tipo_usuario');

        // Encontre o registro correspondente na tabela Estudantes ou Funcionários
        if ($tipoUsuario === 'Estudante') {
            $estudante = Estudante::find($request->input('estudante_id'));

            // Verifique se o estudante foi encontrado
            if ($estudante) {
                $user->userable()->associate($estudante);
            }
        } elseif ($tipoUsuario === 'Funcionario') {
            $funcionario = Funcionario::find($request->input('funcionario_id'));

            // Verifique se o funcionário foi encontrado
            if ($funcionario) {
                $user->userable()->associate($funcionario);
            }
        }

        $assunto = 'Confirmação de Cadastro';
        $mensagem = "Caro {$user->name},\n\n" .
                    "Confirmamos o seu Cadastro no SGE-ISARC. Seu username é: {$user->name}.\n" .
                    "e o Password: {$resultado}\n" .
                    "Pedimos que troque rapidamente o seu password para o password desejado.";

        $emailDestino = $user->email;

        $this->enviarEmail($emailDestino, $assunto, $mensagem);
        $user->save();

        // Atribua funções ao usuário
        if ($request->has('roles')) {
            $user->roles()->attach($request->input('roles'));
        }

        return redirect()->route('users')->with('mensagem', 'Usuário criado com sucesso!');
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('users')->with('successDelete', 'Usuário excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('users')->with('successDelete', 'Não foi possível excluir o usuário.');
        }
    }

    public function visualizarView($id)
    {
        if (Auth::user()->can('view',User::class)) {
        $user = User::findOrFail($id);

        if ($user->tipo_usuario === 'Estudante') {
            $usuarioDetalhe = $user->estudante; // Relacionamento "estudante" definido na model User
            $usuarioNome = $usuarioDetalhe->nome; // Nome do estudante
        } elseif ($user->tipo_usuario === 'Funcionario') {
            $usuarioDetalhe = $user->funcionario; // Relacionamento "funcionario" definido na model User
            $usuarioNome = $usuarioDetalhe->nome; // Nome do funcionário
        } else {
            $usuarioDetalhe = null;
            $usuarioNome = '-';
        }
        return view('gestao.utilizadores.users.view', compact('user','usuarioDetalhe', 'usuarioNome'));
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para visualizar este User.');
    }
}

    public function updateView($id)
    {
        if (Auth::user()->can('update', User::class)) {
        $user = User::findOrFail($id);
        $funcionarios = Funcionario::all();
        $estudantes = Estudante::all();
        $departamentos = Departamento::all();
        $roles = Role::all();
        return view('gestao.utilizadores.users.edit', compact('user','funcionarios','estudantes','departamentos','roles'));
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para editar este User.');
    }
}

    public function update(Request $request, $id)
    {
            if (Auth::user()->can('update', User::class)) {
            // Find the user by ID
            $user = User::findOrFail($id);

            // Validate the request data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,'.$user->id,
                'estado' => 'required|string',
                'tipo_usuario' => 'required|string',
                // Add other validation rules here...
            ]);

            $estado = $user->estado;
            // Update the user data
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->estado = $request->input('estado');
            $user->tipo_usuario = $request->input('tipo_usuario');

            // Save the user
            $user->save();

            // Update userable data if applicable (Estudante or Funcionario)
            if ($user->tipo_usuario === 'Estudante') {
                $estudante = Estudante::find($request->input('estudante_id'));
                if ($estudante) {
                    $user->userable()->associate($estudante);
                    $user->save();
                }
            } elseif ($user->tipo_usuario === 'Funcionario') {
                $funcionario = Funcionario::find($request->input('funcionario_id'));
                if ($funcionario) {
                    $user->userable()->associate($funcionario);
                    $user->save();
                }
            }

            // Update roles if applicable
            if ($request->has('roles')) {
                $user->roles()->sync($request->input('roles'));
            } else {
                $user->roles()->detach();
            }

            if ($estado === 'Pendente'){

                $assunto = 'Confirmação de Aprovação';
                $mensagem = "Caro {$user->name},\n\n" .
                            "Confirmamos a sua aprovação no SGE-ISARC. Pode fazer login através das suas credenciais";

                $emailDestino = $user->email;
                $this->enviarEmail($emailDestino, $assunto, $mensagem);
            }
            // Redirect back to the users list with a success message
            return redirect()->route('users')->with('success', 'User updated successfully!');
        }else {
            return redirect()->back()->with('error', 'Você não tem permissão para editar este User.');
        }
    }

    public function registerEstudante(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed', // Certifique-se de que a senha e a confirmação da senha coincidam
        ]);

        $estudante = new Estudante();
        $estudante->nome = $request->nome;
        $estudante->apelido = $request->apelido;
        $estudante->curso_id = $request->curso_id;
        $estudante->codigo = $request->codigo;
        $estudante->contacto = $request->contacto;
        $estudante->morada = $request->morada;

        $estudante->save();

        // Crie um novo usuário com os dados do formulário
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'estado' => 'Pendente',
            'tipo_usuario' => 'Estudante', // Defina o tipo de usuário como Estudante
        ]);

        $user->password = Hash::make($request->input('password'));

        $estudante = Estudante::find($estudante->id);
        $user->userable()->associate($estudante);
        $user->save();


        session()->flash('success', 'Registro bem-sucedido!, Aguarde a aprovação do Administrador do Sistema,
                                     Vai Receber uma notificação por email assim que aprovado.');

        // Redirecione o usuário de volta à página de registro
        return redirect('/');
    }


    public function enviarEmail($emailDestino,$assunto, $mensagem)
    {
        try {
            Mail::to($emailDestino)->send(new NotificacaoEmail($assunto, $mensagem));
        } catch (\Exception $e) {
        }
    }


}
