<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Estudante;
use App\Models\Funcionario;
use App\Models\Departamento;
use Illuminate\Support\Facades\Auth;
use App\Models\NotificacaoEmail;
use Illuminate\Support\Facades\Mail;

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

        $assunto = 'Confirmação de Cadastro';
        $mensagem = 'Caro,'.$user->name.' Confirmamos o seu Cadastro no SGE-ISARC';
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

            // Redirect back to the users list with a success message
            return redirect()->route('users')->with('success', 'User updated successfully!');
        }else {
            return redirect()->back()->with('error', 'Você não tem permissão para editar este User.');
        }
    }

    public function enviarEmail($emailDestino,$assunto, $mensagem)
    {
        try {
            Mail::to($emailDestino)->send(new NotificacaoEmail($assunto, $mensagem));
        } catch (\Exception $e) {
        }
    }
}
