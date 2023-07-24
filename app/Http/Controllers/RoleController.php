<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role:: paginate(8);
        return view('gestao.utilizadores.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all(); // Obtém todas as permissões do banco de dados
        return view('gestao.utilizadores.roles.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array', // Garante que o campo "permissions" seja um array
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
        ]);

        // Sincronizar as permissões selecionadas com a função recém-criada
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->input('permissions'))->get();
            $role->permissions()->attach($permissions);
        }

        return redirect()->route('roles.index')->with('mensagem', 'Função cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('gestao.utilizadores.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->save();

        // Sincronizar as permissões selecionadas para a função
        $role->permissions()->sync($request->input('permissions'));

        return redirect()->route('roleIndex')->with('mensagem', 'Função actualizada com sucesso!');
    }

    public function visualizar_role($id)
    {
        $role = Role::findOrFail($id);

        return view('gestao.utilizadores.roles.view', compact('role'));
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect('/roleIndex')->with('mensagem', 'Função excluída com sucesso!');
    }
}
