<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Departamento;
use App\Models\Cargo;

class FuncionarioDepartamentoCargoController extends Controller
{
    public function index()
    {
        $alocacoes = Funcionario::with('departamentos', 'cargos')->get();
        return view('gestao.alocacoes.index', compact('alocacoes'));
    }
}
