<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Concepto;

class ConceptoController extends Controller
{    
    function __construct()
    {
        $this->middleware('permission:ver-conceptos',['only'=>['index']]);
        $this->middleware('permission:crear-conceptos',['only'=>['create','store']]);
        $this->middleware('permission:editar-conceptos',['only'=>['edit','update']]);
        $this->middleware('permission:elimnar-conceptos',['only'=>['destroy']]);
    }
    public function index()
    {
        $conceptos = Concepto::all();
        return view('admin.conceptos.index', compact('conceptos'));
    }

    public function create()
    {
        return view('admin.conceptos.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'descripcion' => "required|unique:conceptos"
            ]
            );
        Concepto::create($request->all());
        $conceptos = Concepto::all();
        return redirect()->route('admin.conceptos.index', compact('conceptos'))->with('info','El Concepto se creó con éxito');
    }

    public function show(Concepto $concepto)
    {
        return view('admin.conceptos.show',compact('concepto'));
    }

    public function edit(Concepto $concepto)
    {
        return view('admin.conceptos.edit',compact('concepto'));
    }

    public function update(Request $request, Concepto $concepto)
    {
        $request->validate(
            [
                'descripcion' => "required|unique:conceptos,descripcion,$concepto->id"
            ]
            );
        
        $concepto->update($request->all());
        return redirect()->route('admin.conceptos.edit', compact('concepto'))->with('info','El Concepto se modificó con éxito');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Concepto $concepto)
    {
        $concepto->delete();
        return redirect()->route('admin.conceptos.index', compact('concepto'))->with('info','El Concepto se eliminó con éxito');
    }
}
