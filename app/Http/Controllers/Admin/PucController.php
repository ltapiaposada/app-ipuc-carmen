<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Puc;

class PucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pucs = Puc::all();
        $heads = [
           'id',
           'Código',
           'Nombre',
           'Clasificación',           
           'Editar',
           'Eliminar'
        ];
        return view('admin.pucs.index', compact('pucs','heads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pucs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'codigo' => "required|unique:pucs",
                'nombre' => "required",                
            ]
            );
        Puc::create($request->all());
        $pucs = Puc::all();
        return redirect()->route('admin.pucs.index', compact('pucs'))->with('info','El Puc se creó con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Puc $puc)
    {
        return view('admin.pucs.show',compact('puc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Puc $puc)
    {
        return view('admin.pucs.edit',compact('puc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Puc $puc)
    {
        $request->validate(
            [
                'codigo' => "required|unique:pucs,codigo,$puc->id",
                'nombre' => "required",                
            ]
            );
        
        $puc->update($request->all());
        return redirect()->route('admin.pucs.edit', compact('puc'))->with('info','El Puc se modificó con éxito');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Puc $puc)
    {
        $puc->delete();
        return redirect()->route('admin.pucs.index', compact('puc'))->with('info','El Puc se eliminó con éxito');
    }
}
