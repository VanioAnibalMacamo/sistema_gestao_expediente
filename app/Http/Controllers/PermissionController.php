<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    public function index(){
        $user = Auth::user();

        if ($user->can('view', Permission::class)) {

        $permissions = Permission:: paginate(12);
        return view('gestao.utilizadores.permissions.index',['permissions' => $permissions]);
    } else {
        return redirect()->back()->with('error', 'Você não tem permissão para visualizar os Permissions.');
    }
}

    public function create()
    {
        if (Auth::user()->can('create', Permission::class)){
        return view('gestao.utilizadores.permissions.create');
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para criar um novo Permission.');
    }
}

    public function savePermission(Request $request)
    {
        if (Auth::user()->can('create', Permission::class)) {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        $permission = new Permission();
        $permission->name = $request->input('name');

        $permission->save();

        return redirect('/permIndex')->with('mensagem', 'Permissão cadastrada com sucesso!');
    }else {
        // O usuário não tem permissão, exibe uma mensagem de erro ou redireciona para outra página
        return redirect()->back()->with('error', 'Você não tem permissão para criar um novo Permission.');
    }
    
    
    }

    public function delete($id)
    {
        if (Auth::user()->can('delete', Permission::class)) {
        $permission = Permission::findOrFail($id);

        $permission->delete();

        return redirect('/permIndex')->with('successDelete', 'Permissão excluída com sucesso!');
    } else {
        return redirect()->back()->with('error', 'Você não tem permissão para apagar este Permission.');
    }
}


    public function updateView($id)
    {
        if (Auth::user()->can('update', Permission::class)) {

        $permission = Permission::find($id);
        return view('gestao.utilizadores.permissions.edit', compact('permission'));
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para editar este Permission.');
    }}
    

    public function update(Request $request, $id)
    {
        if (Auth::user()->can('update', Permission::class)) {
        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->save();

        return redirect('/permIndex')->with('mensagem', 'Permissão atualizada com sucesso!');
    }else {
        return redirect()->back()->with('error', 'Você não tem permissão para editar este Permission.');
    }}

}
