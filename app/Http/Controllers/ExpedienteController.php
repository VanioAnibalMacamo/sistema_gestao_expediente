<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expediente;
use App\Models\TipoExpediente;
use App\Models\Estudante;
use Illuminate\Support\Facades\Auth;

class ExpedienteController extends Controller
{

    /*
    public function index(){
        $expedientes = Expediente::paginate(8);
        return view('expediente.index',['expedientes' => $expedientes]);
    }
    */

    public function index()
{
    $user = Auth::user();

    if ($user->can('view', Estudante::class)) {
        if ($user->hasRole('Estudante')) {
            // Se o usuário é um estudante, busca apenas os expedientes do estudante em questão
            $expedientes = Expediente::where('estudante_id', $user->userable_id)->paginate(8);
        } else {
            // Se o usuário é um administrador ou possui outra role, busca todos os expedientes
            $expedientes = Expediente::paginate(8);
        }

        return view('expediente.index', ['expedientes' => $expedientes]);
    } else {
        return redirect()->back()->with('error', 'Você não tem permissão para visualizar os Expedientes.');
    }
}

    public function create()
    {
        $tiposExpediente = TipoExpediente::all();
        $estudantes = Estudante::all();
        return view('expediente.create', compact('tiposExpediente','estudantes'));
    }

    public function saveExpediente(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'data_submissao' => 'required',
            'tipo_expediente_id' => 'required',
            'estudante_id' => 'required',
        ]);

        $expediente = new Expediente;
        $expediente->nome = $request->nome;
        $expediente->descricao = $request->descricao;
        $expediente->data_submissao = $request->data_submissao;
        $expediente->tipo_expediente_id = $request->tipo_expediente_id;
        $expediente->estudante_id = $request->estudante_id;
        // Encontre o Estágio de Processo sem pai
        $tipoExpediente = TipoExpediente::find($request->tipo_expediente_id);
        $estagioSemPai = $tipoExpediente->estagiosProcesso->whereNull('parent_id')->first();

        if ($estagioSemPai) {
            // Atribua o id do Estágio de Processo sem pai ao campo estagio_processo_id do Expediente
            $expediente->estagio_processo_id = $estagioSemPai->id;
        }
        $expediente->save();

        return redirect('/expedienteIndex')->with('mensagem', 'Expediente salvo com sucesso.');
    }

    public function delete($id)
    {
        $expediente = Expediente::find($id);
        $expediente->delete();

        return redirect()->route('expedienteIndex')->with('successDelete', 'Expediente Excluido com Sucesso!');
    }

    public function update_view($id)
    {
        $expediente = Expediente::find($id);
        $tiposExpediente = TipoExpediente::all();
        $estudantes = Estudante::all();

        return view('expediente.edit', compact('expediente', 'tiposExpediente','estudantes'));
    }

    public function update(Request $request, $id)
    {
        $expediente = Expediente::find($id);
        $expediente->nome = $request->input('nome');
        $expediente->descricao = $request->input('descricao');
        $expediente->data_submissao = $request->input('data_submissao');
       // $expediente->tipo_expediente_id = $request->input('tipo_expediente_id');
        $expediente->estudante_id = $request->input('estudante_id');
        $expediente->save();

        return redirect('/expedienteIndex')->with('mensagem', 'Expediente actualizado com sucesso!');
    }

    public function visualizar_view($id)
    {
        $expediente = Expediente::find($id);

        return view('expediente.view', compact('expediente'));
    }
}
