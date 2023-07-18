<?php

namespace App\Http\Controllers;

use App\Models\EstagioProcesso;
use Illuminate\Http\Request;

class EstagioProcessoController extends Controller
{

    public function index()
    {
        $estagioProcessos = EstagioProcesso::paginate(8);
        return view('estagio_processo.index',['estagioProcessos' => $estagioProcessos]);
    }

    public function create()
    {
        $estagiosDisponiveis = EstagioProcesso::whereDoesntHave('estagioProcessoPai')->get();
        return view('estagio_processo.create', ['estagiosDisponiveis' => $estagiosDisponiveis]);
    }

    public function saveEstagioProcesso(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'tempo_estimado_conclusao' => 'required|numeric|min:1|max:90',
        ]);

        $estagioProcesso = new EstagioProcesso;
        $estagioProcesso->nome = $request->nome;
        $estagioProcesso->descricao = $request->descricao;
        $estagioProcesso->tempo_estimado_conclusao = $request->tempo_estimado_conclusao;
        $estagioProcesso->parent_estagio_processo_id = $request->parent_estagio_processo_id;
        $estagioProcesso->save();

        return redirect('/est_proIndex')->with('mensagem', 'Estágio do Processo criado com sucesso!');
    }

    public function update_view($id)
    {
        $estagioProcesso = EstagioProcesso::findOrFail($id);
        $estagiosDisponiveis = EstagioProcesso::whereDoesntHave('estagioProcessoPai')->get();

        return view('estagio_processo.edit', ['estagioProcesso' => $estagioProcesso, 'estagiosDisponiveis' => $estagiosDisponiveis]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'tempo_estimado_conclusao' => 'required|numeric|min:1|max:90',
        ]);

        $estagioProcesso = EstagioProcesso::findOrFail($id);
        $estagioProcesso->nome = $request->nome;
        $estagioProcesso->descricao = $request->descricao;
        $estagioProcesso->tempo_estimado_conclusao = $request->tempo_estimado_conclusao;
        $estagioProcesso->parent_estagio_processo_id = $request->parent_estagio_processo_id;
        $estagioProcesso->save();

        return redirect('/est_proIndex')->with('mensagem', 'Estágio do Processo actualizado com sucesso!');
    }
    public function visualizar_view($id){
        $estagioProcesso = EstagioProcesso::findOrFail($id);
        return view('/estagio_processo/view', compact('estagioProcesso'));

    }
    public function delete($id)
    {
        $estagioProcesso = EstagioProcesso::findOrFail($id);
        $estagioProcesso->delete();

        return redirect('/est_proIndex')->with('successDelete', 'Estágio do Processo excluído com sucesso!');
    }
}
