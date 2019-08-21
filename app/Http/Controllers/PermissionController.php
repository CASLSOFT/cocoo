<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function list()
    {
        return $roles = Permission::orderBy('description')->orderBy('slug')->paginate(10);
    }

    public function store(Request $request)
    {
    	$permission = new Permission;
	    $permission->name = $request->input("name") ;
	    $permission->slug = $request->input("slug") ;
	    $permission->description = $request->input("description") ;
	    $permission->save();
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
    }

    public function show($id)
    {
    	return $permission = Permission::findOrFail($id);
    }

    public function permissionxgroup($description)
    {
        $permission = Permission::where('description',$description)->get();
        return $permission;
    }

    public function permissionxrole($idrole, $modulo)
    {
        $role = Role::findOrFail($idrole);
        $permissionxrole = $role->permissions()->where('description', $modulo)->paginate(10);
        return $permissionxrole;
    }

    public function assingpermission($idrole, $slugpermissions)
    {
	    $role = Role::findOrFail($idrole);
	    $role->givePermissionTo($slugpermissions);
    }

    public function destroypermission($idrole, $slugpermissions)
    {
    	$role = Role::findOrFail($idrole);
	    $role->revokePermissionTo($slugpermissions);
    }
}
