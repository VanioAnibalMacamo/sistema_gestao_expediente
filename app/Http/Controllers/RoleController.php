<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->can('view', Role::class)) {
        $roles = Role:: paginate(8);
        return view('gestao.utilizadores.roles.index', compact('roles'));
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para visualizar os Roles.');
    }
}

    public function create()
    {
        if (Auth::user()->can('create', Role::class)){
        $permissions = Permission::all(); // Obtém todas as permissões do banco de dados
        return view('gestao.utilizadores.roles.create',compact('permissions'));
    } else {
        return redirect()->back()->with('error', 'Você não tem permissão para criar um novo Role.');
    }
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

        return redirect()->route('roleIndex')->with('mensagem', 'Função cadastrada com sucesso!');
    }

    public function edit($id)
    {if (Auth::user()->can('update', Role::class)) {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('gestao.utilizadores.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para editar este Role.');
    }
}

    public function update(Request $request, $id)
    {
        if (Auth::user()->can('update', Role::class)) {
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->save();

        // Sincronizar as permissões selecionadas para a função
        $role->permissions()->sync($request->input('permissions'));

        return redirect()->route('roleIndex')->with('mensagem', 'Função actualizada com sucesso!');
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para editar este Role.');
    }
}

    public function visualizar_role($id)
    {
        if (Auth::user()->can('view',Role::class)) {
        $role = Role::findOrFail($id);

        return view('gestao.utilizadores.roles.view', compact('role'));
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para visualizar este Role.');
    }
}

    public function delete($id)
    {
        if (Auth::user()->can('delete', Role::class)) {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect('/roleIndex')->with('mensagem', 'Função excluída com sucesso!');
    } else {
        return redirect()->back()->with('error', 'Você não tem permissão para apagar este Role.');
    }
}
}
