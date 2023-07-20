<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoExpediente;
use App\Models\Departamento;
use App\Models\EstagioProcesso;
use Illuminate\Validation\Rule;

class TipoExpedienteController extends Controller
{
    public function index(){
        $tipoExpedientes = TipoExpediente::paginate(8);
        return view('parametrizacao.expediente.tipoExpediente.index',['tipoExpedientes' => $tipoExpedientes]);
    }

    public function update_view($id){
        $tipoExpediente = TipoExpediente::findOrFail($id);
        $departamentos = Departamento::all();
        $estagioProcessos = EstagioProcesso::all();
        return view('parametrizacao.expediente.tipoExpediente.edit', compact('tipoExpediente', 'departamentos','estagioProcessos'));
    }

    public function create()
    {
        $departamentos = Departamento::all();
        $estagioProcessos = EstagioProcesso::all();
        return view('parametrizacao.expediente.tipoExpediente.create', compact('departamentos','estagioProcessos'));
    }

    public function saveTipoExpediente(Request $request){

        // Validação dos dados do formulário (adicione mais regras de validação conforme necessário)
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'departamento_id' => 'required|exists:departamentos,id',
            'estagios_processo' => 'array', // Certifique-se de que os estágios de processo são enviados como array
        ]);

        // Salvar o Tipo de Expediente
        $tipoExpediente = new TipoExpediente();
        $tipoExpediente->nome = $request->nome;
        $tipoExpediente->descricao = $request->descricao;
        $tipoExpediente->departamento_id = $request->departamento_id;
        $tipoExpediente->save();

        // Associar os Estágios de Processo ao Tipo de Expediente
        if ($request->has('estagios_processo')) {
            $tipoExpediente->estagiosProcesso()->sync($request->estagios_processo);
        }

        // Redirecionar para a página desejada após o salvamento
        return redirect()->route('tipo_expedienteIndex')->with('mensagem', 'Tipo de Expediente Cadastrado com sucesso!');
    }

    public function update(Request $request, $id){

        // Validação dos dados do formulário (adicione mais regras de validação conforme necessário)
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'departamento_id' => 'required|exists:departamentos,id',
            'estagios_processo' => 'array', // Certifique-se de que os estágios de processo são enviados como array
        ]);

        $tipoExpediente = TipoExpediente::findOrFail($id);
        $tipoExpediente->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'departamento_id' => $request->departamento_id,
        ]);

        // Associar os Estágios de Processo ao Tipo de Expediente
        if ($request->has('estagios_processo')) {
            $tipoExpediente->estagiosProcesso()->sync($request->estagios_processo);
        } else {
            // Se nenhum estágio de processo for selecionado, desassocie todos os existentes
            $tipoExpediente->estagiosProcesso()->detach();
        }

        // Redirecionar para a página desejada após a atualização
        return redirect()->route('tipo_expedienteIndex')->with('mensagem', 'Tipo de Expediente Actualizado com sucesso!');
    }

    public function visualizar_view($id){
        $tipoExpediente = TipoExpediente::findOrFail($id);
        $departamentos = Departamento::all();
        $estagioProcessos = EstagioProcesso::all();
        return view('parametrizacao.expediente.tipoExpediente.view', compact('tipoExpediente', 'departamentos','estagioProcessos'));
    }

    public function delete($id){
        $tipoExpediente = TipoExpediente::find($id);
        $tipoExpediente->delete();
        return redirect()->route('tipo_expedienteIndex')->with('successDelete', 'Tipo de Expediente Excluído com sucesso!');
    }


}
