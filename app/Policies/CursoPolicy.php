<?php

namespace App\Policies;

use App\Models\Curso;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CursoPolicy
{

    public function create(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Cadastrar Curso');
    }

    public function view(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Visualizar Curso');
    }
    public function update(User $user)
    {
        // Verifica se o usuário tem a permissão "Editar Curso"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Editar Curso');
    }

    public function delete(User $user)
    {
        // Verifica se o usuário tem a permissão "Apagar Curso"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Apagar Curso');
    }
}
