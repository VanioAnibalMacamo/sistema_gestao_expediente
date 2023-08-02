<?php

namespace App\Policies;

use App\Models\Expediente;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExpedientePolicy
{

    public function create(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Cadastrar Expediente');
    }

    public function view(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Visualizar Expediente');
    }
    public function update(User $user)
    {
        // Verifica se o usuário tem a permissão "Editar Expediente"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Editar Expediente');
    }

    public function delete(User $user)
    {
        // Verifica se o usuário tem a permissão "Apagar Expediente"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Apagar Expediente');
    }
}
