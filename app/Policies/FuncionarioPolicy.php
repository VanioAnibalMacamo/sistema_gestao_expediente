<?php

namespace App\Policies;

use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FuncionarioPolicy
{

    public function create(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Cadastrar Funcionario');
    }

    public function view(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Visualizar Funcionario');
    }
    public function update(User $user)
    {
        // Verifica se o usuário tem a permissão "Editar Funcionario"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Editar Funcionario');
    }

    public function delete(User $user)
    {
        // Verifica se o usuário tem a permissão "Apagar Funcionario"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Apagar Funcionario');
    }
}
