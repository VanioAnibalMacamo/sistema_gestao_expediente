<?php

namespace App\Http\Controllers;

use App\Models\EstagioProcesso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Expediente;

class EstagioProcessoController extends Controller
{

    public function index()
    {    $user = Auth::user();

        if ($user->can('view', EstagioProcesso::class)) {

            $estagioProcessos = EstagioProcesso::paginate(8);
            return view('estagio_processo.index',['estagioProcessos' => $estagioProcessos]);
        }else {
            return redirect()->back()->with('error', 'Você não tem permissão para visualizar os Estagio do Processos.');
        }
    }
    public function ordenarEstagios($estagio, &$estagiosOrdenados)
    {
        // Adicionar o estágio atual na coleção de estágios ordenados
        $estagiosOrdenados->push($estagio);

        // Buscar os estágios filhos do estágio atual
        $estagiosFilhos = EstagioProcesso::where('parent_estagio_processo_id', $estagio->id)->get();

        // Verificar se o estágio atual possui sucessor
        if ($estagiosFilhos->count() > 0) {
            foreach ($estagiosFilhos as $estagioFilho) {
                // Se possuir sucessor, chamar a função recursivamente para ordenar o sucessor e seus sucessores
                $this->ordenarEstagios($estagioFilho, $estagiosOrdenados);
            }
        }
    }


    public function create()
    {
        if (Auth::user()->can('create', EstagioProcesso::class)){
        $estagiosDisponiveis = EstagioProcesso::whereDoesntHave('estagioProcessoFilho')->get();
        return view('estagio_processo.create', ['estagiosDisponiveis' => $estagiosDisponiveis]);
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para criar um novo Estagio do Processo.');
    }
}

    public function saveEstagioProcesso(Request $request)
    {

     if (Auth::user()->can('create', EstagioProcesso::class)) {
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
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para criar um novo Estagio do Processo.');
    }
}

    public function update_view($id)
    {
        if (Auth::user()->can('update', EstagioProcesso::class)) {
        $estagioProcesso = EstagioProcesso::findOrFail($id);
        $estagiosDisponiveis = EstagioProcesso::whereDoesntHave('estagioProcessoFilho')->get();

        return view('estagio_processo.edit', ['estagioProcesso' => $estagioProcesso, 'estagiosDisponiveis' => $estagiosDisponiveis]);
    } else {
        return redirect()->back()->with('error', 'Você não tem permissão para editar este Estagio do Processo.');
    }
}


    public function update(Request $request, $id)
    {
        if (Auth::user()->can('update', EstagioProcesso::class)) {
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
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para editar este Estagio do Processo.');
    }}


    public function visualizar_view($id){
        if (Auth::user()->can('view' ,EstagioProcesso::class)) {
            $estagioProcesso = EstagioProcesso::findOrFail($id);
            return view('/estagio_processo/view', compact('estagioProcesso'));

        }else {
            return redirect()->back()->with('error', 'Você não tem permissão para visualizar este Estagio do Processo.');
        }
    }
    public function delete($id)
    {
        if (Auth::user()->can('delete', EstagioProcesso::class)) {
            $estagioProcesso = EstagioProcesso::findOrFail($id);

            // Verificar se o Estágio de Processo está sendo usado em algum Expediente
            $existeExpedienteComEstagio = Expediente::where('estagio_processo_id', $id)->exists();

            if ($existeExpedienteComEstagio) {
                return redirect()->back()->with('error', 'Não é possível apagar o Estágio de Processo, pois está sendo usado em algum Expediente.');
            }

            // Se não estiver sendo usado em nenhum Expediente, pode prosseguir com a exclusão
            $estagioProcesso->delete();

            return redirect('/est_proIndex')->with('successDelete', 'Estágio do Processo excluído com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Você não tem permissão para apagar este Estágio do Processo.');
        }
    }
}
