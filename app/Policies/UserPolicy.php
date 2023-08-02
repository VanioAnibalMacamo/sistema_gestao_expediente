<?php

namespace App\Policies;


use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    public function create(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Cadastrar User');
    }

    public function view(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Visualizar User');
    }
    public function update(User $user)
    {
        // Verifica se o usuário tem a permissão "Editar User"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Editar User');
    }

    public function delete(User $user)
    {
        // Verifica se o usuário tem a permissão "Apagar User"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Apagar User');
    }
}
