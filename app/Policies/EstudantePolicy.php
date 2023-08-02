<?php

namespace App\Policies;

use App\Models\Estudante;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EstudantePolicy
{

    public function create(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Cadastrar Estudante');
    }

    public function view(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Visualizar Estudante');
    }
    public function update(User $user)
    {
        // Verifica se o usuário tem a permissão "Editar Estudante"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Editar Estudante');
    }

    public function delete(User $user)
    {
        // Verifica se o usuário tem a permissão "Apagar Estudante"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Apagar Estudante');
    }
}
