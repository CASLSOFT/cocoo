<?php

namespace App\Http\Controllers;

use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function list()
    {
        return $roles = Role::orderBy('name')->paginate(10);
    }

    public function show($id)
    {
        return $role = Role::findOrFail($id);
    }

    public function store(Request $request)
    {
    	$role = new Role;
	    $role->name = $request->input("name") ;
	    $role->slug = $request->input("slug") ;
	    $role->description = $request->input("description") ;
	    $role->save();
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->all());
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $roles = Role::where('name','like','%'.$query.'%')->get();
        return response()->json($roles);
    }

    public function assingrole($iduser,$slugrole)
    {
        $usuario = User::findOrFail($iduser);
        $usuario->assignRoles($slugrole);
        return $usuario;
    }

    public function rolexuser($id)
    {
        $usuario = User::findOrFail($id);
        $roles = $usuario->roles()->get();
        return $roles;
    }

    public function destroyrole($iduser,$slugrole)
    {
        $usuario = User::findOrFail($iduser);
        $usuario->removeRoles($slugrole);
    }
}
