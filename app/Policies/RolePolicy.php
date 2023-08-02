<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{

    public function create(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Cadastrar Role');
    }

    public function view(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Visualizar Role');
    }
    public function update(User $user)
    {
        // Verifica se o usuário tem a permissão "Editar Role"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Editar Role');
    }

    public function delete(User $user)
    {
        // Verifica se o usuário tem a permissão "Apagar Role"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Apagar Role');
    }
}
