<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Estudante;
use App\Models\Funcionario;


class UserController extends Controller
{

    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('gestao.utilizadores.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $estudantes = Estudante::all();
        $funcionarios = Funcionario::all();
        return view('gestao.utilizadores.users.create', compact('roles', 'estudantes', 'funcionarios'));
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


       // Crie o usuário
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'tipo_usuario' => $request->input('tipo_usuario'), // Adicione esta linha para definir o tipo de usuário
            'estado' => $request->input('estado'),
            'password' => bcrypt($request->input('name')), // Criptografe a senha fornecida pelo usuário
        ]);

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

        // Salve o relacionamento userable
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
    }

    public function updateView($id)
    {
        $user = User::findOrFail($id);
        return view('gestao.utilizadores.users.edit', compact('user'));
    }
}
