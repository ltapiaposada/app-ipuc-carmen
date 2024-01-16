<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UsuarioController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-usuario',['only'=>['index']]);
        $this->middleware('permission:crear-usuario',['only'=>['create','store']]);
        $this->middleware('permission:editar-usuario',['only'=>['edit','update']]);
        $this->middleware('permission:elimnar-usuario',['only'=>['destroy']]);
    }
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index',compact('usuarios'));

    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        
        return view('usuarios.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:config-password',
        ]);
        $input=$request->all();
        $input['pasword']=Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route('usuarios.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $usuario = User::find($id);        
        $roles = Role::pluck('name','name')->all();
        $userRole = $usuario->roles->pluck('name','name')->all();
        return view('usuarios.edit',compact('usuario','roles','userRole'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles'=> 'required'
        ]);
        $input=$request->all();
        if(!empty($input['pasword'])){
            $input['pasword'] =Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('usuarios.index');
    }

    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('usuarios.index');
    }
}
