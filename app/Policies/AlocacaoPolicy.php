<?php

namespace App\Policies;

use App\Models\Alocacao;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AlocacaoPolicy
{

    public function create(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Cadastrar Alocacao');
    }

    public function view(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Visualizar Alocacao');
    }
    public function update(User $user)
    {
        // Verifica se o usuário tem a permissão "Editar Alocacao"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Editar Alocacao');
    }

    public function delete(User $user)
    {
        // Verifica se o usuário tem a permissão "Apagar Alocacao"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Apagar Alocacao');
    }
}
