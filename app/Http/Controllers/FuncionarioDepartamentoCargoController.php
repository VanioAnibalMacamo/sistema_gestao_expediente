<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Departamento;
use App\Models\Cargo;

class FuncionarioDepartamentoCargoController extends Controller
{
    public function index()
    {
        $alocacoes = Funcionario::with('departamentos', 'cargos')->get();
        return view('gestao.alocacoes.index', compact('alocacoes'));
    }

    public function update_view($id){
      
        return view('/gestao.alocacoes.edit', compact('alocacoes'));
    }

    public function create()
{
    $funcionarios = Funcionario::all();
    $departamentos = Departamento::all();
    $cargos = Cargo::all();
    return view('gestao.alocacoes.create',compact('funcionarios','departamentos','cargos'));
}

public function saveAlocacoes(Request $request)
{

    $alocacoes = new Alocacoes();

        $alocacoes->funcionario = $request->funcionario;
        $alocacoes->departamento = $request->departamento;
        $alocacoes->cargo = $request->cargo;
        $alocacoes->acoes = $request->acoes;
       

        $alocacoes->save();

        return redirect()->route('funcDepCargoIndex')->with('mensagem', 'Alocacao Cadastrado com sucesso!');

}
}
