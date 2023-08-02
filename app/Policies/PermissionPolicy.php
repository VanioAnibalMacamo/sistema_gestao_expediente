<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{

    public function create(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Cadastrar Permission');
    }

    public function view(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Visualizar Permission');
    }
    public function update(User $user)
    {
        // Verifica se o usuário tem a permissão "Editar Permission"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Editar Permission');
    }

    public function delete(User $user)
    {
        // Verifica se o usuário tem a permissão "Apagar Permission"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Apagar Permission');
    }
}
