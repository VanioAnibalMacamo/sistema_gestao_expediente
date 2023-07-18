<?php

namespace App\http\Controllers;

use Illuminate\http\Request;
use App\Models\Estudante;

class  EstudanteController extends Controller{



public function index(){

$estudantes = Estudante:: paginate(8);
return view('/estudante.index',['estudantes'=>$estudantes]);
}


public function update_view($id){
    $estudante = Estudante:: find($id);
    return view('/estudante/edit', compact('estudante'));
}
public function create()
{
    return view('estudante.create');
}

public function saveEstudante(Request $request)
{

    $estudante = new Estudante();

        $estudante->nome = $request->nome;
        $estudante->apeido = $request->apelido;
        $estudante->curso = $request->curso;
        $estudante->codigo = $request->codigo;
        $estudante->contacto = $request->contacto;
        $estudante->morada = $request->morada;

        $estudante->save();

        return redirect()->route('estudanteIndex')->with('mensagem', 'estudate Cadastrado com sucesso!');

}

    public function visualizar_view($id){
        $estudante = Estudante :: find($id);
        return view('/estudante/view', compact('estudante'));

    }

    public function delete($id)
    {
        $estudante = estudante::find($id);
        $estudante->delete();

        return redirect()->route('estudanteIndex')->with('successDelete', 'Estudante Excluido com Sucesso!');
    }

















}


