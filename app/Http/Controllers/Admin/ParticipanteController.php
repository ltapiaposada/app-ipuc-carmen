<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Participante;

class ParticipanteController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-participantes',['only'=>['index']]);
        $this->middleware('permission:crear-participantes',['only'=>['create','store']]);
        $this->middleware('permission:editar-participantes',['only'=>['edit','update']]);
        $this->middleware('permission:elimnar-participantes',['only'=>['destroy']]);
    }
    public function index()
    {
        $participantes = Participante::all();
        $heads = [
            'id',
            'Nombre',
            'Teléfono',
            'Dirección',           
            'Editar',
            'Eliminar'
         ];
        return view('admin.participantes.index', compact('participantes','heads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.participantes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'documento' => "required|unique:participantes,documento",
                'tipo_documento' => "required",
                'nombre_completo' => "required"
            ]
            );
        Participante::create($request->all());
        //  return response()->json([
        //     'res' => true,
        //     "msg" => "Participante creado con éxito"
        //  ]);
        $participantes = Participante::all();
        return redirect()->route('admin.participantes.index', compact('participantes'))->with('info','El participante se creó con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Participante $participante)
    {
        return view('admin.participantes.show',compact('participante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participante $participante)
    {
        return view('admin.participantes.edit',compact('participante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participante $participante)
    {
        $request->validate(
            [
                'documento' => "required|unique:participantes,documento,$participante->id",
                'tipo_documento' => "required",
                'primer_nombre' => "required",
                'primer_apellido' => "required",
                'nombre_completo' => "required"
            ]
            );
        
        $participante->update($request->all());
        return redirect()->route('admin.participantes.edit', compact('participante'))->with('info','El participante se modificó con éxito');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participante $participante)
    {
        $participante->delete();
        return redirect()->route('admin.participantes.index', compact('participante'))->with('info','El participante se eliminó con éxito');
    }
}
