<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'Cadastrar Funcionario'],
            ['name' => 'Editar Funcionario'],
            ['name' => 'Visualizar Funcionario'],
            ['name' => 'Apagar Funcionario'],
        ];

        Permission::insert($permissions);
    }
}
