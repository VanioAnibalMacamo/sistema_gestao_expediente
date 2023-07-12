<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoExpediente;

class TipoExpedienteController extends Controller
{
    public function index(){
        $tipoExpedientes = TipoExpediente::paginate(8);
        return view('parametrizacao.expediente.tipoExpediente.index',['tipoExpedientes' => $tipoExpedientes]);
    }

    public function update_view($id){
        $tipoExpediente = TipoExpediente::find($id);
        return view('/parametrizacao.expediente.tipoExpediente.edit', compact('tipoExpediente'));
    }

    public function create()
    {
        return view('parametrizacao.expediente.tipoExpediente.create');
    }

    public function saveTipoExpediente(Request $request){

        $tipoExpediente = new TipoExpediente();

        $tipoExpediente->nome=$request->nome;
        $tipoExpediente->descricao=$request->descricao;

        $tipoExpediente->save();

        return redirect()->route('tipo_expedienteIndex')->with('mensagem', 'Tipo de Expediente Cadastrado com sucesso!');
    
    }

    public function update(Request $request, $id){

        $tipoExpediente = TipoExpediente::find($id);

        $tipoExpediente->nome=$request->nome;
        $tipoExpediente->descricao=$request->descricao;

        $tipoExpediente->save();

        return redirect()->route('tipo_expedienteIndex')->with('mensagem', 'Tipo de Expediente Actualizado com sucesso!');
    
    }

    public function visualizar_view($id){
        $tipoExpediente = TipoExpediente::find($id);
        return view('/parametrizacao.expediente.tipoExpediente.view', compact('tipoExpediente'));
    }

    public function delete($id){
        $tipoExpediente = TipoExpediente::find($id);
        $tipoExpediente->delete();
        return redirect()->route('tipo_expedienteIndex')->with('SuccessDelete', 'Tipo de Expediente Excluído com sucesso!');
    }


}
