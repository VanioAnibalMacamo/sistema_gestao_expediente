<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoExpediente;

class TipoExpedienteController extends Controller
{
    public function index(){
        $tipoExpedientes = TipoExpediente::paginate(8);
        return view('parametrizacao.expediente.tipoExpediente.index',['tipoExpedientes' => $tipoExpedientes]);
    }
}
