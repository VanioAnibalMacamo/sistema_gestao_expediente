<?php

namespace App\http\Controllers;


use Illuminate\Http\Request;
use App\Models\Estudante;
use App\Models\Curso;




class  EstudanteController extends Controller{



public function index(){

$estudantes = Estudante:: paginate(8);
return view('/estudante.index',compact('estudantes'));
}


public function update_view($id){
    $estudante = Estudante:: find($id);
    return view('/estudante/edit', compact('estudante'));
}
public function create()
{
    $cursos = Curso::all();
    return view('estudante.create',compact('cursos'));
}

public function saveEstudante(Request $request)
{

    $estudante = new Estudante();

        $estudante->nome = $request->nome;
        $estudante->apelido = $request->apelido;
        $estudante->curso_id = $request->curso_id;
        $estudante->codigo = $request->codigo;
        $estudante->contacto = $request->contacto;
        $estudante->morada = $request->morada;

        $estudante->save();

        return redirect()->route('estudanteIndex')->with('mensagem', 'estudate Cadastrado com sucesso!');

}
public function update(Request $request, $id){

    $estudante =  Estudante:: find($id);
    $estudante->nome=$request->nome;
    $estudante->apelido=$request->apelido;
    $estudante->curso_id=$request->curso_id;
    $estudante->codigo=$request->codigo;
    $estudante->contacto=$request->contacto;
    $estudante->morada=$request->morada;

    $estudante->save();

    return redirect()->route('estudanteIndex')->with('mensagem', 'Estudante Actualizado com sucesso!');
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


