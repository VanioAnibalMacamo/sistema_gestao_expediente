<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Departamento;
use App\Models\Cargo;
use Illuminate\Support\Facades\DB;

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
        $funcionarioId = $request->input('funcionario_id');
        $departamentoId = $request->input('departamento_id');
        $cargoId = $request->input('cargo_id');

        $alocado = DB::table('funcionario_departamento_cargo')
            ->where('funcionario_id', $funcionarioId)
            ->where('departamento_id', $departamentoId)
            ->where('cargo_id', $cargoId)
            ->exists();

        if (!$alocado) {
            DB::table('funcionario_departamento_cargo')->insert([
                'funcionario_id' => $funcionarioId,
                'departamento_id' => $departamentoId,
                'cargo_id' => $cargoId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->route('funcDepCargoIndex')->with('mensagem', 'Alocacao Cadastrado com sucesso!');
        } else {
            return redirect()->route('funcDepCargoIndex')->with('successDelete', 'Alocacao Cadastrado com sucesso!');
        }
    }





}
