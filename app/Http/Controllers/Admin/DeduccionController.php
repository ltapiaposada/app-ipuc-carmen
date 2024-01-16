<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deduccion;

class DeduccionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-deducciones',['only'=>['index']]);
        $this->middleware('permission:crear-deducciones',['only'=>['create','store']]);
        $this->middleware('permission:editar-deducciones',['only'=>['edit','update']]);
        $this->middleware('permission:elimnar-deducciones',['only'=>['destroy']]);
    }
    public function index()
    {
        $deducciones = Deduccion::all();
        $heads = [
           'id',
           'Descripción',
           'Tipo',
           'Valor',           
           'Editar',
           'Eliminar'
        ];
        return view('admin.deducciones.index', compact('deducciones','heads'));
    }

    public function create()
    {
        return view('admin.deducciones.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'descripcion' => "required|unique:deduccions",
                'tipo' => "required",                
                'valor' => "required",
            ]
            );
        Deduccion::create($request->all());
        $deducciones = Deduccion::all();
        return redirect()->route('admin.deducciones.index', compact('deducciones'))->with('info','El Deduccion se creó con éxito');
    }

    public function show(Deduccion $deduccion)
    {
        return view('admin.deducciones.show',compact('deduccion'));
    }

    public function edit(Deduccion $deduccion)
    {
        return view('admin.deducciones.edit',compact('deduccion'));
    }

    public function update(Request $request, Deduccion $deduccion)
    {
        $request->validate(
            [
                'descripcion' => "required|unique:deduccions,id,$deduccion->id",
                'tipo' => "required",
                'valor' => "required",                                
            ]
            );
        
        $deduccion->update($request->all());
        return redirect()->route('admin.deducciones.index', compact('deduccion'))->with('info','La Deducción se modificó con éxito');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deduccion $deduccion)
    {
        $deduccion->delete();
        return redirect()->route('admin.deducciones.index', compact('deduccion'))->with('info','La Deducción se eliminó con éxito');
    }
}
