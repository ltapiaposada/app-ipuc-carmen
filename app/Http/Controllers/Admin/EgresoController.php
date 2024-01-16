<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banco;
use Illuminate\Http\Request;
use App\Models\Egreso;
use App\Models\Concepto;
use App\Models\Participante;
use App\Models\EgresoDetalle;
use App\Models\Deduccion;
use App\Models\Puc;
use Barryvdh\DomPDF\Facade\Pdf;
use Rmunate\Utilities\SpellNumber;
class EgresoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-egreso')->only(['index','show','cuenta','orden']);
        $this->middleware('permission:crear-egreso',['only'=>['create','store']]);
        //$this->middleware('permission:editar-egreso',['only'=>['edit','update']]);
        $this->middleware('permission:elimnar-egreso',['only'=>['destroy']]);
    }
    public function index()
    {
        $egresos = Egreso::all();
        $heads = [
            'id',
            'Consecutivo',
            'Fecha',
            'Participante',
            'Valor',
            'Concepto',
            'Ver egreso',
            'Ver cuenta',
            'Ver orden',
            'Anular'
        ];
        //$pdf = PDF::loadView('admin.egresos.index', compact('egresos','heads'));
     
        //return $pdf->download('egreso.pdf');
        return view('admin.egresos.index', compact('egresos','heads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataParticipantes = Participante::all();
        $dataConceptos = Concepto::all();
        $bancosDatos = Banco::all();
        $dataDeducciones = Deduccion::all();
        $conceptos = [];
        $participantes = [];
        $bancos = [];
        $deducciones = [];
        foreach ($dataConceptos as  $concepto) {
            $conceptos[$concepto->id] = $concepto->descripcion;
        }
        foreach ($dataParticipantes as  $participante) {
            $participantes[$participante->id] = $participante->nombre_completo;
        }
        
        foreach ($bancosDatos as  $banco) {
            $bancos[$banco->id] = $banco->nombre;
        }
        
        foreach ($dataDeducciones as  $deduccion) {
            $deducciones[$deduccion->id] = $deduccion->descripcion;
        }
        return view('admin.egresos.create', compact('participantes','conceptos','bancos','deducciones'));
    }

    public function store(Request $request)
    {
        var_dump($request->all());
        $request->validate(
            [
                'consecutivo' => "required|unique:egresos",
                'participante_id' => "required",
                'forma_pago' => "required",
                'valor' => "required"
            ]
            );
           // Egreso::create($request->all());
        $egreso = Egreso::create($request->all());
        $egreso->conceptos()->sync($request->input('conceptos'));
        $egreso->deduccions()->sync($request->input('deduccions'));
        $egresos = Egreso::all();
        return redirect()->route('admin.egresos.index', compact('egresos'))->with('info','El Egreso se creó con éxito');
    }

    public function show(Egreso $egreso)
    {
        //$pdf = PDF::loadView('admin.egresos.report',compact('egreso'));
        //return $pdf->stream('egreso.pdf');
        
        $egresoValorNeto = $this->valorNeto($egreso->valor, $egreso->deduccions);
        $valorEnLetras = strtoupper(SpellNumber::value($egresoValorNeto)->locale('es_COL', SpellNumber::SPECIFIC_LOCALE)->currency('Pesos')->toMoney());        
        return view('admin.egresos.show',compact('egreso','valorEnLetras','egresoValorNeto'));
        //return view('admin.egresos.cuenta',compact('egreso'));
    }

    public function edit(Egreso $egreso)
    {
        return view('admin.egresos.edit',compact('egreso'));
    }

    public function update(Request $request, Egreso $egreso)
    {
        $request->validate(
            [
                'consecutivo' => "required|unique:egresos,consecutivo,$egreso->id",
                'id_participante' => "required",
                'fecha' => "required",
                'valor' => "required",
                'id_concepto' => "required"              
            ]
            );
        
        $egreso->update($request->all());
        return redirect()->route('admin.egresos.edit', compact('egreso'))->with('info','El Egreso se modificó con éxito');    
    }

    public function destroy(Egreso $egreso)
    {
        $egreso->delete();
        return redirect()->route('admin.egresos.index', compact('egreso'))->with('info','El Egreso se eliminó con éxito');
    }

    public function cuenta(Egreso $egreso)
    {
        //$pdf = Pdf::loadView('admin.egresos.cuenta',compact('egreso'));
        //return $pdf->stream('cuenta.pdf');
        $egresoValorNeto = $this->valorNeto($egreso->valor, $egreso->deduccions);
        $valorEnLetras = strtoupper(SpellNumber::value($egresoValorNeto)->locale('es_COL', SpellNumber::SPECIFIC_LOCALE)->currency('Pesos')->toMoney());        
        return view('admin.egresos.cuenta',compact('egreso','valorEnLetras',"egresoValorNeto"));
    }

    public function orden(Egreso $egreso)
    {
        //$pdf = Pdf::loadView('admin.egresos.cuenta',compact('egreso'));
        //return $pdf->stream('cuenta.pdf');
        $egresoValorNeto = $this->valorNeto($egreso->valor, $egreso->deduccions);
        $valorEnLetras = strtoupper(SpellNumber::value($egresoValorNeto)->locale('es_COL', SpellNumber::SPECIFIC_LOCALE)->currency('Pesos')->toMoney());        
        return view('admin.egresos.orden',compact('egreso','valorEnLetras',"egresoValorNeto"));
    }

    public function valorNeto($egresoValor, $deducciones){
        foreach($deducciones as $deduccion){
            $valor = 0;
            if($deduccion->tipo == 'Porcentaje'){ 
                $valor = ($egresoValor * $deduccion->valor) /100;
            } elseif ($deduccion->tipo == 'Monto'){ 
                $valor = $deduccion->valor;
            }
            $egresoValor -= $valor;
        }
        return $egresoValor;
    }
}
