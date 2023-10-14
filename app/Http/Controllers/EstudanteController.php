<?php

namespace App\http\Controllers;


use Illuminate\Http\Request;
use App\Models\Estudante;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;

class  EstudanteController extends Controller{

    public function index()
    {
        $user = Auth::user();

        if ($user->can('view', Estudante::class)) {
            if ($user->hasRole('Estudante')) {
                // Se o usuário é um estudante, busca apenas esse estudante
                $estudante = $user->userable;
                return view('/estudante.index', ['estudantes' => collect([$estudante])]);
            } else {
                // Se o usuário é um administrador ou possui outra role, busca todos os estudantes com paginação
                $estudantes = Estudante::paginate(8);
                return view('/estudante.index', ['estudantes' => $estudantes]);
            }
        } else {
            return redirect()->back()->with('error', 'Você não tem permissão para visualizar os Estudantes.');
        }
    }


/*
public function index(){

    if (Auth::user()->can('view', Estudante::class)) {
        $cursos = Curso::all();
        $estudantes = Estudante:: paginate(8);
        return view('/estudante.index',['estudantes' => $estudantes]);
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para visualizar os Estudantes.');
    }

    if (Auth::user()->can('view', Estudante::class)) {
        $user = Auth::user();

        if ($user->hasRole('Estudante')) {
            // Se o usuário é um estudante, busca apenas seus próprios dados
            $estudantes = Estudante::where('user_id', $user->id)->paginate(8);
        } else {
            // Se o usuário é um administrador ou possui outra role, busca todos os estudantes
            $estudantes = Estudante::paginate(8);
        }

        $cursos = Curso::all();
        return view('/estudante.index', ['estudantes' => $estudantes, 'cursos' => $cursos]);
    } else {
        return redirect()->back()->with('error', 'Você não tem permissão para visualizar os Estudantes.');
    }
}
*/

public function update_view($id){
    if (Auth::user()->can('update', Estudante::class)) {
        $cursos = Curso::all();
        $estudante = Estudante:: find($id);
        return view('/estudante/edit', compact('estudante','cursos'));
    }
    else {
        return redirect()->back()->with('error', 'Você não tem permissão para editar este Estudante.');
    }
}


public function create()
{

    if (Auth::user()->can('create', Estudante::class)){
        $cursos = Curso::all();
        return view('estudante.create',compact('cursos'));
    } else {
        return redirect()->back()->with('error', 'Você não tem permissão para criar um novo Estudante.');
    }
}

public function saveEstudante(Request $request)
{


     if (Auth::user()->can('create', Estudante::class)) {
        $estudante = new Estudante();
        $estudante->nome = $request->nome;
        $estudante->apelido = $request->apelido;
        $estudante->curso_id = $request->curso_id;
        $estudante->codigo = $request->codigo;
        $estudante->contacto = $request->contacto;
        $estudante->morada = $request->morada;

        $estudante->save();

        return redirect()->route('estudanteIndex')->with('mensagem', 'estudante Cadastrado com sucesso!');

}else {
    // O usuário não tem permissão, exibe uma mensagem de erro ou redireciona para outra página
    return redirect()->back()->with('error', 'Você não tem permissão para criar um novo Estudante.');
}


}
public function update(Request $request, $id){

    if (Auth::user()->can('update', Estudante::class)) {



    $estudante =  Estudante:: find($id);
    $estudante->nome=$request->nome;
    $estudante->apelido=$request->apelido;
    $estudante->curso_id=$request->curso_id;
    $estudante->codigo=$request->codigo;
    $estudante->contacto=$request->contacto;
    $estudante->morada=$request->morada;

    $estudante->save();

    return redirect()->route('estudanteIndex')->with('mensagem', 'Estudante Actualizado com sucesso!');
}else {
    return redirect()->back()->with('error', 'Você não tem permissão para editar este Estudante.');
}}


    public function visualizar_view($id){

        if (Auth::user()->can('view',Estudante::class)) {

            $estudante = Estudante :: find($id);
            return view('/estudante/view', compact('estudante'));
        }else {
            return redirect()->back()->with('error', 'Você não tem permissão para visualizar este Estudante.');
        }
    }

    public function delete($id)
    {
        if (Auth::user()->can('delete', Estudante::class)) {
        $estudante = estudante::find($id);
        $estudante->delete();
        return redirect()->route('estudanteIndex')->with('successDelete', 'Estudante Excluido com Sucesso!');

        } else {
            return redirect()->back()->with('error', 'Você não tem permissão para apagar este Estudante.');
        }
    }

    }




















