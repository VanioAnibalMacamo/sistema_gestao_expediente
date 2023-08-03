<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expediente;
use App\Models\TipoExpediente;
use App\Models\Estudante;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ExpedienteController extends Controller
{


    public function index()
    {
        $user = Auth::user();

        if ($user->can('view', Expediente::class)) {
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
        if (Auth::user()->can('create', Expediente::class)) {
        $tiposExpediente = TipoExpediente::all();
        $estudantes = Estudante::all();
        return view('expediente.create', compact('tiposExpediente','estudantes'));
        }else {
            return redirect()->back()->with('error', 'Você não tem permissão para criar um novo Funcionário.');
        }
    }

    public function saveExpediente(Request $request)
    {

        if (Auth::user()->can('create', Expediente::class)) {
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
        }else {
            // O usuário não tem permissão, exibe uma mensagem de erro ou redireciona para outra página
            return redirect()->back()->with('error', 'Você não tem permissão para criar um novo Funcionário.');
        }
    }

    public function delete($id)
    {
        if (Auth::user()->can('delete', Expediente::class)) {
        $expediente = Expediente::find($id);
        $expediente->delete();

        return redirect()->route('expedienteIndex')->with('successDelete', 'Expediente Excluido com Sucesso!');
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para apagar este Funcionário.');
    }
}

    public function update_view($id)
    {
        if (Auth::user()->can('update', Expediente::class)) {
        $expediente = Expediente::find($id);
        $tiposExpediente = TipoExpediente::all();
        $estudantes = Estudante::all();

        $comentariosExpediente = $expediente->funcionarios()->withPivot('comentario', 'data_comentario')->get();

        return view('expediente.edit', compact('expediente', 'tiposExpediente','estudantes','comentariosExpediente'));
    } else {
        return redirect()->back()->with('error', 'Você não tem permissão para editar este Funcionário.');
    }
}

    public function update(Request $request, $id)
    {
        if (Auth::user()->can('update', Expediente::class)) {
        $expediente = Expediente::find($id);
        $expediente->nome = $request->input('nome');
        $expediente->descricao = $request->input('descricao');
        $expediente->data_submissao = $request->input('data_submissao');
       // $expediente->tipo_expediente_id = $request->input('tipo_expediente_id');
        $expediente->estudante_id = $request->input('estudante_id');
        $expediente->save();

        return redirect('/expedienteIndex')->with('mensagem', 'Expediente actualizado com sucesso!');
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para editar este Funcionário.');
    }
}

    public function visualizar_view($id)
    {
        if (Auth::user()->can('view', Expediente::class)) {
            $expediente = Expediente::find($id);
             $comentariosExpediente = $expediente->funcionarios()->withPivot('comentario', 'data_comentario')->get();
             return view('expediente.view', compact('expediente','comentariosExpediente'));
        }
        else {
            return redirect()->back()->with('error', 'Você não tem permissão para visualizar os detalhes deste Funcionário.');
        }
    }

    public function adicionarComentario(Request $request, $id)
    {

        if (Auth::user()->can('update', Expediente::class)) {
             // Encontre o expediente pelo ID
            $expediente = Expediente::findOrFail($id);

            // Verifique se o funcionário está autenticado
            if (Auth::check()) {
                // Obtenha o funcionário associado ao usuário logado
                $funcionario = Auth::user()->funcionario;

                // Se o funcionário existir, adicione o comentário
                if ($funcionario) {
                    $comentario = $request->input('comentarios');
                    $dataComentario = now(); // ou use Carbon para formatar a data

                    // Use o relacionamento expedientes() para adicionar o comentário à tabela pivot
                    $expediente->funcionarios()->attach($funcionario->id, [
                        'comentario' => $comentario,
                        'data_comentario' => $dataComentario,
                    ]);

                    // Redirecione de volta para a página de edição do expediente
                    return redirect()->back()->with('success', 'Comentário adicionado com sucesso!');
                }
            }

            // Redirecione para algum lugar ou retorne um erro caso o funcionário não esteja autenticado
            return redirect()->back()->with('error', 'Você não tem permissão para adicionar um comentário a este expediente.');

            }else {
                return redirect()->back()->with('error', 'Você não tem permissão para visualizar os detalhes deste Funcionário.');
            }
        }

        public function avancarExpediente($id)
        {
            // Buscar o expediente pelo ID
            $expediente = Expediente::findOrFail($id);

            // Verificar se o expediente possui um estágio de processo associado
            if ($expediente->estagioProcesso) {
                // Verificar se o estágio atual possui um estágio sucessor
                if ($expediente->estagioProcesso->estagioProcessoFilho) {
                    // Avançar o expediente para o estágio sucessor
                    $expediente->estagio_processo_id = $expediente->estagioProcesso->estagioProcessoFilho->id;
                    $expediente->save();

                    // Redirecionar o usuário para a página desejada após o avanço
                    return redirect()->route('/expedienteIndex')->with('success', 'Expediente avançado com sucesso!');
                } else {
                    return redirect()->back()->with('error', 'Não é possível avançar o Expediente, pois não há um Estágio sucessor definido.');
                }
            } else {
                return redirect()->back()->with('error', 'Não é possível avançar o Expediente, pois não há um Estágio de Processo associado a ele.');
            }
        }
}
