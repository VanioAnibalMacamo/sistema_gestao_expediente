<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo; 
use Illuminate\Support\Facades\Auth;// Certifique-se de importar o modelo Cargo
// Importe outros modelos, se necessário

class CargoController extends Controller
{
    public function index()
    { 
        $user = Auth::user();
        if ($user->can('view', Cargo::class)) {
        $cargos = Cargo::paginate(8);
        return view('parametrizacao.cargo.index', ['cargos' => $cargos]);
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para visualizar os Cargo.');
    }
    }
    public function updateView($id)
    {
        if (Auth::user()->can('update', Cargo::class)) {
        $cargo = Cargo::findOrFail($id);
        // Lógica adicional, se necessário
        return view('parametrizacao.cargo.edit', compact('cargo'));
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para editar este Cargo.');
    }}

    public function create()
    {
        // Lógica adicional, se necessário
        if (Auth::user()->can('create', Cargo::class)){
        return view('parametrizacao.cargo.create');
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para criar um novo Cargo.');
    }}

    public function saveCargo(Request $request)
    { 
        if (Auth::user()->can('create', Cargo::class)) {
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
    }else {
        // O usuário não tem permissão, exibe uma mensagem de erro ou redireciona para outra página
        return redirect()->back()->with('error', 'Você não tem permissão para criar um novo Cargo.');
    }}

    public function update(Request $request, $id)
    {
        if (Auth::user()->can('update', Cargo::class)) {
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
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para editar este Cargo.');
    }}
    

    public function visualizarView($id)
    { 
        if (Auth::user()->can('view',Cargo::class)) {
        $cargo = Cargo::findOrFail($id);
        // Lógica adicional, se necessário
        return view('parametrizacao.cargo.view', compact('cargo'));
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para visualizar este Cargo.');
    }
}

    public function delete($id)
    {
        if (Auth::user()->can('delete', Cargo::class)) {
        // Encontrar o Cargo pelo ID
        $cargo = Cargo::find($id);
        if ($cargo) {
            // Remover o Cargo (opcionalmente, pode adicionar verificação de associações e lógica adicional antes de excluir)
            $cargo->delete();
            return redirect()->route('cargoIndex')->with('successDelete', 'Cargo excluído com sucesso!');
        }
        // Caso não encontre o Cargo, redireciona para a página de index com mensagem de erro
        return redirect()->route('cargoIndex')->with('successDelete', 'Cargo não encontrado!');
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para apagar este Cargo.');
    }
}

    // Adicione outros métodos, se necessário
}
