<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class AcoplarPermissoes28_07_23Seeder extends Seeder
{
    public function run()
    {
        $permissions = [
            ['name' => 'Cadastrar Estudante'],
            ['name' => 'Editar Estudante'],
            ['name' => 'Visualizar Estudante'],
            ['name' => 'Apagar Estudante'],

            ['name' => 'Cadastrar Departamento'],
            ['name' => 'Editar Departamento'],
            ['name' => 'Visualizar Departamento'],
            ['name' => 'Apagar Departamento'],

            ['name' => 'Cadastrar Curso'],
            ['name' => 'Editar Curso'],
            ['name' => 'Visualizar Curso'],
            ['name' => 'Apagar Curso'],

            ['name' => 'Cadastrar Alocacao'],
            ['name' => 'Editar Alocacao'],
            ['name' => 'Visualizar Alocacao'],
            ['name' => 'Apagar Alocacao'],

            ['name' => 'Cadastrar Cargo'],
            ['name' => 'Editar Cargo'],
            ['name' => 'Visualizar Cargo'],
            ['name' => 'Apagar Cargo'],

            ['name' => 'Cadastrar EstagioProcesso'],
            ['name' => 'Editar EstagioProcesso'],
            ['name' => 'Visualizar EstagioProcesso'],
            ['name' => 'Apagar EstagioProcesso'],

            ['name' => 'Cadastrar Expediente'],
            ['name' => 'Editar Expediente'],
            ['name' => 'Visualizar Expediente'],
            ['name' => 'Apagar Expediente'],

            ['name' => 'Cadastrar Role'],
            ['name' => 'Editar Role'],
            ['name' => 'Visualizar Role'],
            ['name' => 'Apagar Role'],

            ['name' => 'Cadastrar TipoExpediente'],
            ['name' => 'Editar TipoExpediente'],
            ['name' => 'Visualizar TipoExpediente'],
            ['name' => 'Apagar TipoExpediente'],

            ['name' => 'Cadastrar User'],
            ['name' => 'Editar User'],
            ['name' => 'Visualizar User'],
            ['name' => 'Apagar User'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
