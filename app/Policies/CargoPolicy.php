<?php

namespace App\Policies;

use App\Models\Cargo;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CargoPolicy
{

    public function create(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Cadastrar Cargo');
    }

    public function view(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Visualizar Cargo');
    }
    public function update(User $user)
    {
        // Verifica se o usuário tem a permissão "Editar Cargo"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Editar Cargo');
    }

    public function delete(User $user)
    {
        // Verifica se o usuário tem a permissão "Apagar Cargo"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Apagar Cargo');
    }
}
