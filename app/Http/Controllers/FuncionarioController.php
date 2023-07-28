<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Auth;

class FuncionarioController extends Controller
{
    //

    public function index()
    {
        if (Auth::user()->can('view', Funcionario::class)) {
            $funcionarios = Funcionario::paginate(8);
            return view('funcionario.index',['funcionarios' => $funcionarios]);
        }else {
            return redirect()->back()->with('error', 'Você não tem permissão para visualizar os Funcionários.');
        }
    }

    public function create()
    {
        if (Auth::user()->can('create', Funcionario::class)) {
            return view('funcionario.create');
        } else {
            return redirect()->back()->with('error', 'Você não tem permissão para criar um novo Funcionário.');
        }
    }

    public function saveFunc(Request $request)
    {

        if (Auth::user()->can('create', Funcionario::class)) {
            $funcionario = new Funcionario();
            $funcionario->nome=$request->nome;
            $funcionario->morada=$request->morada;
            $funcionario->email=$request->email;
            $funcionario->contacto=$request->contacto;
            $funcionario->genero=$request->genero;
            $funcionario->num_bi=$request->num_bi;
            //$funcionario->tipo_id=$request->tipo_doc;
            $funcionario->save();

            return redirect()->route('funcIndex')->with('mensagem', 'Funcionário Cadastrado com sucesso!');
        } else {
            // O usuário não tem permissão, exibe uma mensagem de erro ou redireciona para outra página
            return redirect()->back()->with('error', 'Você não tem permissão para criar um novo Funcionário.');
        }
    }
    public function visualizar_view($id)
    {
        if (Auth::user()->can('view', Funcionario::class)) {
            $funcionario = Funcionario :: find($id);
            return view('/funcionario/view', compact('funcionario'));
        } else {
            return redirect()->back()->with('error', 'Você não tem permissão para visualizar os detalhes deste Funcionário.');
        }
    }

    public function update_view($id)
    {
        if (Auth::user()->can('update', Funcionario::class)) {
             $funcionario = Funcionario :: find($id);
             return view('/funcionario/edit', compact('funcionario'));
        } else {
            return redirect()->back()->with('error', 'Você não tem permissão para editar este Funcionário.');
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->can('update', Funcionario::class)) {
             // Validate the form data
            $request->validate([
                'nome' => 'required|string|max:255',
                'contacto' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'morada' => 'required|string|max:255',
                'genero' => 'required|string|in:Masculino,Feminino',
                'num_bi' => 'required|string|max:20',
            ]);

            // Find the employee by ID
            $funcionario = Funcionario::find($id);

            // Update the employee's data
            $funcionario->nome = $request->input('nome');
            $funcionario->contacto = $request->input('contacto');
            $funcionario->email = $request->input('email');
            $funcionario->morada = $request->input('morada');
            $funcionario->genero = $request->input('genero');
            $funcionario->num_bi = $request->input('num_bi');

            // Save the updated employee
            $funcionario->save();

            // Redirect back to the employee index page or any other appropriate page
            return redirect('/funcIndex')->with('mensagem', 'Funcionário Actualizado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Você não tem permissão para editar este Funcionário.');
        }
    }
    public function delete($id)
    {
        if (Auth::user()->can('delete', Funcionario::class)) {
            $funcionario = Funcionario::find($id);
             $funcionario->delete();
            return redirect()->route('funcIndex')->with('successDelete', 'Funcionario excluído com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Você não tem permissão para apagar este Funcionário.');
        }
    }

}
