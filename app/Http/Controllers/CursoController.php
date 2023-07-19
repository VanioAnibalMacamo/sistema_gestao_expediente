<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{


public function index(){


    $cursos = Curso:: paginate(8);
    return view('departamento.index',['departamentos' => $departamentos]);
}





}
