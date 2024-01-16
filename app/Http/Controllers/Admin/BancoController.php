<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banco;

class BancoController extends Controller
{    
    function __construct()
    {
        $this->middleware('permission:ver-bancos',['only'=>['index']]);
        $this->middleware('permission:crear-bancos',['only'=>['create','store']]);
        $this->middleware('permission:editar-bancos',['only'=>['edit','update']]);
        $this->middleware('permission:elimnar-bancos',['only'=>['destroy']]);
    }
    public function index()
    {
        $bancos = Banco::all();
        return view('admin.bancos.index', compact('bancos'));
    }

    public function create()
    {
        return view('admin.bancos.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nombre' => "required|unique:bancos"
            ]
            );
        Banco::create($request->all());
        $bancos = Banco::all();
        return redirect()->route('admin.bancos.index', compact('bancos'))->with('info','El Banco se creó con éxito');
    }

    public function show(Banco $banco)
    {
        return view('admin.bancos.show',compact('banco'));
    }

    public function edit(Banco $banco)
    {
        return view('admin.bancos.edit',compact('banco'));
    }

    public function update(Request $request, Banco $banco)
    {
        $request->validate(
            [
                'nombre' => "required|unique:bancos,nombre,$banco->id"
            ]
            );
        
        $banco->update($request->all());
        return redirect()->route('admin.bancos.edit', compact('banco'))->with('info','El Banco se modificó con éxito');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banco $banco)
    {
        $banco->delete();
        return redirect()->route('admin.bancos.index', compact('banco'))->with('info','El Banco se eliminó con éxito');
    }
}
