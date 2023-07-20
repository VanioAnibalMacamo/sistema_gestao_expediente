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
}
