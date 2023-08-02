<?php

namespace App\Policies;

use App\Models\Departamento;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DepartamentoPolicy
{

    public function create(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Cadastrar Departamento');
    }

    public function view(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Visualizar Departamento');
    }
    public function update(User $user)
    {
        // Verifica se o usuário tem a permissão "Editar Departamento"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Editar Departamento');
    }

    public function delete(User $user)
    {
        // Verifica se o usuário tem a permissão "Apagar Departamento"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Apagar Departamento');
    }
}
