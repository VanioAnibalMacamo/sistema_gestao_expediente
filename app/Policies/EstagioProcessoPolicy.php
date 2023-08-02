<?php

namespace App\Policies;

use App\Models\EstagioProcesso;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EstagioProcessoPolicy
{

    public function create(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Cadastrar EstagioProcesso');
    }

    public function view(User $user)
    {
        return $user->roles->flatMap->permissions->pluck('name')->contains('Visualizar EstagioProcesso');
    }
    public function update(User $user)
    {
        // Verifica se o usuário tem a permissão "Editar EstagioProcesso"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Editar EstagioProcesso');
    }

    public function delete(User $user)
    {
        // Verifica se o usuário tem a permissão "Apagar EstagioProcesso"
        return $user->roles->flatMap->permissions->pluck('name')->contains('Apagar EstagioProcesso');
    }
}
