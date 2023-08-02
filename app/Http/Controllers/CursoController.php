<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CursoController extends Controller
{


public function index(){

    $user = Auth::user();

    if ($user->can('view', Curso::class)) {
        if ($user->hasRole('Curso')) {
            // Se o usuário é um Curso, busca apenas esse Curso
            $curso = $user->userable;
    $cursos = Curso:: paginate(8);
    return view('curso.index',['cursos' => $cursos]);
}else {
    // Se o usuário é um administrador ou possui outra role, busca todos os cursos com paginação
    $cursos = Curso::paginate(8);
    return view('/curso.index', ['cursos' => $cursos]);
}
} else {
return redirect()->back()->with('error', 'Você não tem permissão para visualizar os cursos.');
}

}


public function update_view($id){

    if (Auth::user()->can('update', Curso::class)) {
    $curso = curso:: find($id);
    return view('/curso/edit', compact('curso'));
}else {
    return redirect()->back()->with('error', 'Você não tem permissão para editar este Curso.');
}

}

public function create()
{
    if (Auth::user()->can('create', Curso::class)){
    return view('curso.create');
}else {
    return redirect()->back()->with('error', 'Você não tem permissão para criar um novo Curso.');
}}








public function savecurso(Request $request)
{

    if (Auth::user()->can('create', Curso::class)) {
       $curso = new curso();
        $curso->nome = $request->nome;
        $curso->sigla = $request->sigla;
       
        $curso->save();

        return redirect()->route('cursoIndex')->with('mensagem', 'curso Cadastrado com sucesso!');

}else {
    // O usuário não tem permissão, exibe uma mensagem de erro ou redireciona para outra página
    return redirect()->back()->with('error', 'Você não tem permissão para criar um novo Curso.');
}}






public function update(Request $request, $id){

    if (Auth::user()->can('update', Curso::class)) {
    $curso =  Curso:: find($id);
    $curso->nome=$request->nome;
    $curso->sigla=$request->sigla;
    

    $curso->save();

    return redirect()->route('cursoIndex')->with('mensagem', 'curso Actualizado com sucesso!');
}else {
    return redirect()->back()->with('error', 'Você não tem permissão para editar este Curso.');
}}




public function visualizar_view($id){
    if (Auth::user()->can('view',Curso::class)) {
    $curso = curso :: find($id);
    return view('/curso/view', compact('curso'));

}else {
    return redirect()->back()->with('error', 'Você não tem permissão para visualizar este Curso.');
}
}





public function delete($id)
{

    if (Auth::user()->can('delete',Curso::class)) {
    $curso = curso::find($id);
    $curso->delete();

    return redirect()->route('cursoIndex')->with('successDelete', 'Curso Excluido com Sucesso!');
}else {
    return redirect()->back()->with('error', 'Você não tem permissão para apagar Curso.');
}


}

}
