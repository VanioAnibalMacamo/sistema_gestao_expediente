<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Models\Permission;

class SuperAdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Busca a Role 'Super Admin' ou cria uma nova caso não exista
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);

        // Busca todas as permissões disponíveis
        $allPermissions = Permission::all();

        // Filtra apenas as permissões que a Role 'Super Admin' ainda não possui
        $permissionsToAdd = $allPermissions->diff($superAdminRole->permissions);

        // Atribui as permissões à Role 'Super Admin'
        $superAdminRole->permissions()->attach($permissionsToAdd->pluck('id')->toArray());
    }
}
