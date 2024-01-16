<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolController extends Controller
{
    
    function __construct()
    {
        $this->middleware('permission:ver-rol',['only'=>['index']]);
        $this->middleware('permission:crear-rol',['only'=>['create','store']]);
        $this->middleware('permission:editar-rol',['only'=>['edit','update']]);
        $this->middleware('permission:elimnar-rol',['only'=>['destroy']]);
    }
    public function index()
    {
        $roles = Role::all();
        return view('roles.index',compact('roles'));

    }

    public function create()
    {
       $permisos = Permission::get();
       return view('roles.create',compact('permisos'));
    }

    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required','permission'=>'required']);
        $rol = Role::create(['name'=>$request->input('name')]);
        $rol->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index');
    }

    public function edit(string $id)
    {
        $rol = Role::find($id);
        $permisos = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id',$id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();
        return view('roles.edit',compact('rol','permisos','rolePermissions'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request,['name'=>'required','permission'=>'required']);
        $rol = Role::find($id);
        $rol->name = $request->input('name');
        $rol->save();
        $rol->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('roles')->where('id',$id)->delete();
        return redirect()->route('roles.index');
        
    }
}
