<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo; // Certifique-se de importar o modelo Cargo
// Importe outros modelos, se necessário

class CargoController extends Controller
{
    public function index()
    {
        $cargos = Cargo::paginate(8);
        return view('parametrizacao.cargo.index', ['cargos' => $cargos]);
    }

    public function updateView($id)
    {
        $cargo = Cargo::findOrFail($id);
        // Lógica adicional, se necessário
        return view('parametrizacao.cargo.edit', compact('cargo'));
    }

    public function create()
    {
        // Lógica adicional, se necessário
        return view('parametrizacao.cargo.create');
    }

    public function saveCargo(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            // Outras regras de validação, se necessário
        ]);

        // Salvar o Cargo
        $cargo = new Cargo();
        $cargo->nome = $request->nome;
        $cargo->descricao = $request->descricao;
        // Salvar outros campos, se necessário
        $cargo->save();

        // Redirecionar para a página desejada após o salvamento
        return redirect()->route('cargoIndex')->with('mensagem', 'Cargo cadastrado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            // Outras regras de validação, se necessário
        ]);

        // Encontrar o Cargo pelo ID
        $cargo = Cargo::findOrFail($id);
        // Atualizar os campos
        $cargo->nome = $request->nome;
        $cargo->descricao = $request->descricao;
        // Atualizar outros campos, se necessário
        $cargo->save();

        // Redirecionar para a página desejada após a atualização
        return redirect()->route('cargoIndex')->with('mensagem', 'Cargo atualizado com sucesso!');
    }

    public function visualizarView($id)
    {
        $cargo = Cargo::findOrFail($id);
        // Lógica adicional, se necessário
        return view('parametrizacao.cargo.view', compact('cargo'));
    }

    public function delete($id)
    {
        // Encontrar o Cargo pelo ID
        $cargo = Cargo::find($id);
        if ($cargo) {
            // Remover o Cargo (opcionalmente, pode adicionar verificação de associações e lógica adicional antes de excluir)
            $cargo->delete();
            return redirect()->route('cargoIndex')->with('successDelete', 'Cargo excluído com sucesso!');
        }
        // Caso não encontre o Cargo, redireciona para a página de index com mensagem de erro
        return redirect()->route('cargoIndex')->with('successDelete', 'Cargo não encontrado!');
    }

    // Adicione outros métodos, se necessário
}
