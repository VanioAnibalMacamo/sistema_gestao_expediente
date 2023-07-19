<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoExpediente;
use App\Models\Departamento;

class TipoExpedienteController extends Controller
{
    public function index(){
        $tipoExpedientes = TipoExpediente::paginate(8);
        return view('parametrizacao.expediente.tipoExpediente.index',['tipoExpedientes' => $tipoExpedientes]);
    }

    public function update_view($id){
        $tipoExpediente = TipoExpediente::findOrFail($id);
        $departamentos = Departamento::all();
        return view('parametrizacao.expediente.tipoExpediente.edit', compact('tipoExpediente', 'departamentos'));
    }

    public function create()
    {
        $departamentos = Departamento::all();
        return view('parametrizacao.expediente.tipoExpediente.create', compact('departamentos'));
    }

    public function saveTipoExpediente(Request $request){

        $tipoExpediente = new TipoExpediente();

        $tipoExpediente->nome=$request->nome;
        $tipoExpediente->descricao=$request->descricao;
        $tipoExpediente->departamento_id = $request->departamento_id;

        $tipoExpediente->save();

        return redirect()->route('tipo_expedienteIndex')->with('mensagem', 'Tipo de Expediente Cadastrado com sucesso!');

    }

    public function update(Request $request, $id){

        $tipoExpediente = TipoExpediente::find($id);

        $tipoExpediente->nome=$request->nome;
        $tipoExpediente->descricao=$request->descricao;
        $tipoExpediente->departamento_id = $request->departamento_id;

        $tipoExpediente->save();

        return redirect()->route('tipo_expedienteIndex')->with('mensagem', 'Tipo de Expediente Actualizado com sucesso!');

    }

    public function visualizar_view($id){
        $tipoExpediente = TipoExpediente::findOrFail($id);
        $departamentos = Departamento::all();
        return view('parametrizacao.expediente.tipoExpediente.view', compact('tipoExpediente', 'departamentos'));
    }

    public function delete($id){
        $tipoExpediente = TipoExpediente::find($id);
        $tipoExpediente->delete();
        return redirect()->route('tipo_expedienteIndex')->with('SuccessDelete', 'Tipo de Expediente Excluído com sucesso!');
    }


}
