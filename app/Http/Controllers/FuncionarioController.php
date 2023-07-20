<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    //

    public function index()
    {
        $funcionarios = Funcionario::paginate(8);
        return view('funcionario.index',['funcionarios' => $funcionarios]);
    }

    public function create()
    {
        return view('funcionario.create');
    }

    public function saveFunc(Request $request){

        // Crie um novo registro de funcionário a partir dos dados da solicitação
        //$funcionario = new Funcionario($request->all());
        $funcionario = new Funcionario();
        $funcionario->nome=$request->nome;
        $funcionario->morada=$request->morada;
        $funcionario->email=$request->email;
        $funcionario->contacto=$request->contacto;
        $funcionario->genero=$request->genero;
        $funcionario->num_bi=$request->num_bi;
     //   $funcionario->tipo_id=$request->tipo_doc;
        $funcionario->save();

        return redirect()->route('funcIndex')->with('mensagem', 'Funcionário Cadastrado com sucesso!');
    }

    public function visualizar_view($id){
        $funcionario = Funcionario :: find($id);
        return view('/funcionario/view', compact('funcionario'));
    }
    public function update_view($id){

        $funcionario = Funcionario :: find($id);
        return view('/funcionario/edit', compact('funcionario'));
    }
    public function update(Request $request, $id)
    {
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
    }

    public function delete($id)
    {
        $funcionario = Funcionario::find($id);
        $funcionario->delete();
        return redirect()->route('funcIndex')->with('successDelete', 'Funcionario excluído com sucesso!');
    }
}
