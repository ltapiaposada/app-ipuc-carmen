@extends('adminlte::page')

@section('content_header')
<div style="display: flex; justify-content:space-between;">
    <h1 class="m-0 text-dark">Detalle del egreso</h1>
    <a href="{{route('admin.egresos.index')}}" class="btn btn-info"><i class="fas fa-arrow-left"> Volver</i></a>
</div>
@stop

@section('content')   
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <table  style="border: solid 0.5px #000; width: 100%;"  class="table-bordered mt-1">
                        <thead>
                            <tr>
                                <td colspan="3" rowspan="3">
                                    <div style="min-width:450px; max-width: 550px; margin:5px;">
                                        <img src="{{asset('/img/logoGaita.png')}}" alt="" style="width: 100%;">
                                    </div>
                                </td>
                                <td style="padding: 5px;"colspan="4">Comprobante de Egreso No.</td>
                                <td style="padding: 5px; text-align: center;" colspan="2">{{ $egreso->consecutivo }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 5px;">Día</td>
                                <td style="padding: 5px;">Mes</td>
                                <td style="padding: 5px;">Año</td>
                                <td style="padding: 5px;" rowspan="2">Valor</td>
                                <td rowspan="2" colspan="2">
                                    <div style="display: flex; justify-content: flex-end; align-items: center; font-size:1.2em;font-weight:bold;margin: 5px;">
                                    $ {{ number_format($egresoValorNeto,0,',','.') }}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 5px;">{{ date('d',strtotime($egreso->fecha))}}</td>
                                <td style="padding: 5px;">{{ date('m',strtotime($egreso->fecha))}}</td>
                                <td style="padding: 5px;">{{ date('Y',strtotime($egreso->fecha))}}</td>
                            </tr>
                            <tr>
                                <td style="padding: 5px;">Pagado a:</td>
                                <td style="padding: 5px;" colspan="2">{{ $egreso->participante->nombre_completo }}</td>
                                <td style="padding: 5px;">CC/NIT</td>
                                <td style="padding: 5px;" colspan="4">{{$egreso->participante->documento}}</td>
                            </tr>
                            <tr>
                                <td style="padding: 5px;">Dirección</td>
                                <td style="padding: 5px;" colspan="2">{{$egreso->participante->direccion}}</td>
                                <td style="padding: 5px;">Teléfono</td>
                                <td style="padding: 5px;" colspan="4">{{$egreso->participante->telefono}}</td>
                            </tr>
                            <tr>
                                <td style="padding: 5px;">Concepto</td>
                                <td style="padding: 5px;" colspan="7">
                                    @foreach($egreso->conceptos as $concepto)
                                        <p>
                                            {{ $concepto->descripcion }} 
                                        </p>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 5px;">Valor en letra</td>
                                <td style="padding: 5px;" colspan="7">
                                    <p>
                                        {{ $valorEnLetras }}
                                    </p>
                                </td>
                            </tr>
                        </thead>    
                        <tbody></tbody>
                        </table>
                        <table style="width: 100%;"  class="table-bordered mt-1">
                            <tr style="text-align: center;">
                                <th>Código</th>
                                <th>Cuenta</th>
                                <th>Débitos</th>
                                <th>Créditos</th>
                                <th rowspan="2">
                                    <div style="display: flex; justify-content: flex-start; align-items: start;font-size:0.8em;font-weight:bold;margin: 5px;">
                                        <p>
                                            CHEQUE No.
                                        </p><br>
                                            @if($egreso->forma_pago == 'CH')
                                                {{ $egreso->cheque_numero }}
                                            @endIf
                                    </div>
                                </th>
                                <th rowspan="2" colspan="2">
                                    <div style="display: flex; justify-content: flex-start; align-items: start;font-size:0.8em;font-weight:bold;margin: 5px;">
                                        <p>BANCO</p><br>
                                        @if($egreso->forma_pago == 'CH' || $egreso->forma_pago == 'TF')
                                            {{ $egreso->banco->nombre }}
                                        @endIf
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>SUCURSAL</td>
                                <td>EFECTIVO</td>
                                <td>
                                    <div style="display: flex; justify-content: center; align-items: center; font-size:1.2em;font-weight:bold; width: 100%; height:20px;">
                                    @if($egreso->forma_pago == 'EF')
                                    X
                                    @endIf
                                    </div>
                                </td>    
                            </tr>
                            <tr>
                                <td><br></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th rowspan="4" colspan="3">
                                    <div style="display: flex; justify-content: flex-start; align-items: start;font-size:0.8em;font-weight:bold;margin: 5px;">
                                        <p>
                                            FIRMA Y SELLO DEL BENEFICIARIO
                                        </p>
                                    </div>
                                    <br><br>
                                </th>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td rowspan="2" >
                                    <div style="display: flex; justify-content: center; align-items: start;height:60px;font-size:0.8em;font-weight:bold;">
                                        <p>
                                            ELABORADO
                                        </p>
                                    </div>
                                </td>
                                <td rowspan="2" >
                                    <div style="display: flex; justify-content: center; align-items: start;height:60px;font-size:0.8em;font-weight:bold;">
                                        <p>
                                            APROBADO
                                        </p>
                                    </div>
                                </td>
                                <td rowspan="2" colspan="2">
                                    <div style="display: flex; justify-content: center; align-items: start;height:60px;font-size:0.8em;font-weight:bold;">
                                        <p>
                                            CONTABILIZADO
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>CC/NIT: </td>
                                <td colspan="2">{{$egreso->participante->documento}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop