<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Departamento;
use App\Models\Cargo;
use App\Models\Alocacao;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FuncionarioDepartamentoCargoController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if ($user->can('view', Alocacao::class)) {
            $alocacoes = Alocacao::with('funcionario', 'departamento', 'cargo')->get();
            return view('gestao.alocacoes.index', compact('alocacoes'));
        }else {
            return redirect()->back()->with('error', 'Você não tem permissão para visualizar as Alocações.');
    }
}

    public function create()
    {
        if (Auth::user()->can('create', Alocacao::class)){
            $funcionarios = Funcionario::all();
            $departamentos = Departamento::all();
            $cargos = Cargo::all();
            return view('gestao.alocacoes.create',compact('funcionarios','departamentos','cargos'));
        } else {
            return redirect()->back()->with('error', 'Você não tem permissão para criar um novo FuncionarioDepartamentoCargo.');
    }
}


    public function saveAlocacoes(Request $request)
    {
        if (Auth::user()->can('create', Alocacao::class)) {
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
        }else {
            // O usuário não tem permissão, exibe uma mensagem de erro ou redireciona para outra página
            return redirect()->back()->with('error', 'Você não tem permissão para criar um novo FuncionarioDepartamentoCargo.');
        }    
    }

    public function delete($id)
    {
        if (Auth::user()->can('delete', Alocacao::class)) {
            $alocacao = Alocacao::find($id);

            if (!$alocacao) {
                return redirect()->back()->with('successDelete', 'Alocação não encontrada.');
            }
            $alocacao->delete();
            return redirect()->route('funcDepCargoIndex')->with('successDelete', 'Alocação excluída com sucesso.');
        }else {
            return redirect()->back()->with('error', 'Você não tem permissão para apagar este FuncionarioDepartamentoCargo.');
        }
}

    public function visualizar_view($id){
        if (Auth::user()->can('view',Alocacao::class)) {
            $alocacao = Alocacao::find($id);

            if (!$alocacao) {
                return redirect()->back()->with('successDelete', 'Alocação não encontrada.');
            }
            return view('gestao.alocacoes.view', compact('alocacao'));
        }else {
            return redirect()->back()->with('error', 'Você não tem permissão para visualizar este FuncionarioDepartamentoCargo.');
        }
}

    public function update_view($id){
        $alocacao = Alocacao::find($id);

        if (!$alocacao) {
            return redirect()->back()->with('successDelete', 'Alocação não encontrada.');
        }
        $funcionarios = Funcionario::all();
        $departamentos = Departamento::all();
        $cargos = Cargo::all();

        return view('gestao.alocacoes.edit', compact('alocacao', 'funcionarios', 'departamentos', 'cargos'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'funcionario_id' => 'required|exists:funcionarios,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'cargo_id' => 'required|exists:cargos,id',
        ]);
        $alocacao = Alocacao::find($id);

        if (!$alocacao) {
            return redirect()->back()->with('error', 'Alocação não encontrada.');
        }

        $alocacao->funcionario_id = $request->funcionario_id;
        $alocacao->departamento_id = $request->departamento_id;
        $alocacao->cargo_id = $request->cargo_id;
        $alocacao->save();

        return redirect()->route('funcDepCargoIndex', ['id' => $alocacao->id])->with('mensagem', 'Alocação actualizada com sucesso.');
    }
}
