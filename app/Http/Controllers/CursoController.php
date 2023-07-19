<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{


public function index(){


    $cursos = Curso:: paginate(8);
    return view('curso.index',['cursos' => $cursos]);
}

public function update_view($id){
    $curso = curso:: find($id);
    return view('/curso/edit', compact('curso'));
}
public function create()
{
    return view('curso.create');
}

public function savecurso(Request $request)
{

    $curso = new curso();

        $curso->nome = $request->nome;
        $curso->sigla = $request->sigla;
       
        $curso->save();

        return redirect()->route('cursoIndex')->with('mensagem', 'curso Cadastrado com sucesso!');

}

public function update(Request $request, $id){

    $curso =  Curso:: find($id);
    $curso->nome=$request->nome;
    $curso->sigla=$request->sigla;
    

    $curso->save();

    return redirect()->route('cursoIndex')->with('mensagem', 'curso Actualizado com sucesso!');
}

public function visualizar_view($id){
    $curso = curso :: find($id);
    return view('/curso/view', compact('curso'));

}
public function delete($id)
{


    $curso = curso::find($id);
    $curso->delete();

    return redirect()->route('cursoIndex')->with('successDelete', 'Curso Excluido com Sucesso!');
}

}
