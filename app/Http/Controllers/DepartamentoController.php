<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartamentoController extends Controller
{
    //

    public function index()
    {
        $user = Auth::user();
        if ($user->can('view', Deparamento::class)) {
        $departamentos = Departamento::paginate(8);
        return view('departamento.index',['departamentos' => $departamentos]);
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para editar este Departamento.');
    }
}

    public function update_view($id){
        if (Auth::user()->can('update', Departamento::class)) {
        $departamento = Departamento :: find($id);
        return view('/departamento/edit', compact('departamento'));
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para editar este Departamento.');
    }
}


    public function create()
    {
        if (Auth::user()->can('create', Departamento::class)){
        return view('departamento.create');
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para criar um novo Departamento.');
    }
}

    public function saveDep(Request $request){

        
        if (Auth::user()->can('create', Departamento::class)) {
        $departamento = new Departamento();

        $departamento->nome=$request->nome;
        $departamento->sigla=$request->sigla;
        $departamento->descricao=$request->descricao;

        $departamento->save();

        return redirect()->route('depIndex')->with('mensagem', 'Departamento Cadastrado com sucesso!');

    }else {
        // O usuário não tem permissão, exibe uma mensagem de erro ou redireciona para outra página
        return redirect()->back()->with('error', 'Você não tem permissão para criar um novo Departamento.');
    }
    
    
    }
    public function update(Request $request, $id){

        if (Auth::user()->can('update', Departamento::class)) {
        $departamento =  Departamento:: find($id);
        $departamento->nome=$request->nome;
        $departamento->sigla=$request->sigla;
        $departamento->descricao=$request->descricao;

        $departamento->save();

        return redirect()->route('depIndex')->with('mensagem', 'Departamento Actualizado com sucesso!');
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para editar este Departamento.');
    }}

    public function visualizar_view($id){
        if (Auth::user()->can('view',Departamento::class)) {
        $departamento = Departamento :: find($id);
        return view('/departamento/view', compact('departamento'));

    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para editar este Departamento.');
    }}

    public function delete($id)
    {
        if (Auth::user()->can('delete',Departamento::class)) {
        $departamento = departamento::find($id);
        $departamento->delete();

        return redirect()->route('depIndex')->with('successDelete', 'Departamento Excluido com Sucesso!');
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para apagar este Departamento.');
    }
}
}
