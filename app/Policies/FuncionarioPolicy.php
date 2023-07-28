<?php

namespace App\Policies;

use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FuncionarioPolicy
{




    public function create(User $user)
    {
        // Verifica se o usuário tem a permissão "Cadastrar Funcionario"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Cadastrar Funcionario');
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Funcionario $funcionario): bool
    {
        //
    }


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Funcionario $funcionario): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Funcionario $funcionario): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Funcionario $funcionario): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Funcionario $funcionario): bool
    {
        //
    }
}
