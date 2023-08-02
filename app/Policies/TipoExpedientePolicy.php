<?php

namespace App\Policies;

use App\Models\TipoExpediente;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TipoExpedientePolicy
{

    public function create(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Cadastrar TipoExpediente');
    }

    public function view(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Visualizar TipoExpediente');
    }
    public function update(User $user)
    {
        // Verifica se o usuário tem a permissão "Editar TipoExpediente"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Editar TipoExpediente');
    }

    public function delete(User $user)
    {
        // Verifica se o usuário tem a permissão "Apagar TipoExpediente"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Apagar TipoExpediente');
    }
}
