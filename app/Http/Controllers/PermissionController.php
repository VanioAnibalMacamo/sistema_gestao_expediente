<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(){

        $permissions = Permission:: paginate(8);
        return view('gestao.utilizadores.permissions.index',['permissions' => $permissions]);
    }

    public function create()
    {
        return view('gestao.utilizadores.permissions.create');
    }

    public function savePermission(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        $permission = new Permission();
        $permission->name = $request->input('name');

        $permission->save();

        return redirect('/permIndex')->with('mensagem', 'Permissão cadastrada com sucesso!');
    }

    public function delete($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect('/permIndex')->with('successDelete', 'Permissão excluída com sucesso!');
    }
}
