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
            'tipo_usuario' => $request->input('tipo_usuario'),
            'estado' => $request->input('estado'),
            'email' => $request->input('email'), // Adicionar o campo de email
            'password' => bcrypt('password'), // Definir o valor padrão para a senha
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
}
