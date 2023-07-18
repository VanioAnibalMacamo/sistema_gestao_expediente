<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    //

    public function index()
    {

        $departamentos = Departamento::paginate(8);
        return view('departamento.index',['departamentos' => $departamentos]);
    }

    public function update_view($id){
        $departamento = Departamento :: find($id);
        return view('/departamento/edit', compact('departamento'));
    }
    public function create()
    {
        return view('departamento.create');
    }

    public function saveDep(Request $request){

        $departamento = new Departamento();

        $departamento->nome=$request->nome;
        $departamento->sigla=$request->sigla;
        $departamento->descricao=$request->descricao;

        $departamento->save();

        return redirect()->route('depIndex')->with('mensagem', 'Departamento Cadastrado com sucesso!');

    }
    public function update(Request $request, $id){

        $departamento =  Departamento:: find($id);
        $departamento->nome=$request->nome;
        $departamento->sigla=$request->sigla;
        $departamento->descricao=$request->descricao;

        $departamento->save();

        return redirect()->route('depIndex')->with('mensagem', 'Departamento Actualizado com sucesso!');
    }

    public function visualizar_view($id){
        $departamento = Departamento :: find($id);
        return view('/departamento/view', compact('departamento'));

    }
    public function delete($id)
    {
        $departamento = departamento::find($id);
        $departamento->delete();

        return redirect()->route('depIndex')->with('successDelete', 'Departamento Excluido com Sucesso!');
    }
}
