<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expediente;
use App\Models\TipoExpediente;

class ExpedienteController extends Controller
{

    public function index(){
        $expedientes = Expediente::paginate(8);
        return view('expediente.index',['expedientes' => $expedientes]);
    }

    public function create()
    {
        $tiposExpediente = TipoExpediente::all();
        return view('expediente.create', compact('tiposExpediente'));
    }

    public function saveExpediente(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'data_submissao' => 'required',
            'tipo_expediente_id' => 'required',
        ]);

        $expediente = new Expediente;
        $expediente->nome = $request->nome;
        $expediente->descricao = $request->descricao;
        $expediente->data_submissao = $request->data_submissao;
        $expediente->tipo_expediente_id = $request->tipo_expediente_id;
        $expediente->save();

        return redirect('/expedienteIndex')->with('mensagem', 'Expediente salvo com sucesso.');
    }




    public function delete($id)
    {
        $expediente = Expediente::find($id);
        $expediente->delete();

        return redirect()->route('expedienteIndex')->with('successDelete', 'Expediente Excluido com Sucesso!');
    }
}
