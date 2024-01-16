    <h1 class="m-0 text-dark">Detalle de egreso</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <table border="1" width='100%'>
                        <thead>
                            <tr>
                                <td colspan="3" rowspan="3">
                                    <div style="min-width:450px; max-width: 650px;margin:5px;">
                                        <img src="{{asset('/img/logoGaita.png')}}" alt="" style="width: 100%;">
                                    </div>
                                </td>
                                <td colspan="4">Comprobante de Egreso No.</td>
                                <td colspan="2">{{ $egreso->consecutivo }}</td>
                            </tr>
                            <tr>
                                <td>Día</td>
                                <td>Mes</td>
                                <td>Año</td>
                                <td rowspan="2">Valor</td>
                                <td rowspan="2" colspan="2">{{ $egreso->valor }}</td>
                            </tr>
                            <tr>
                                <td>{{ date('d',strtotime($egreso->fecha))}}</td>
                                <td>{{ date('m',strtotime($egreso->fecha))}}</td>
                                <td>{{ date('Y',strtotime($egreso->fecha))}}</td>
                            </tr>
                            <tr>
                                <td>Pagado a:</td>
                                <td colspan="2">{{ $egreso->participante->nombre_completo }}</td>
                                <td>CC/NIT</td>
                                <td colspan="4">{{$egreso->participante->documento}}</td>
                            </tr>
                            <tr>
                                <td>Dirección</td>
                                <td colspan="2">{{$egreso->participante->direccion}}</td>
                                <td>Teléfono</td>
                                <td colspan="4">{{$egreso->participante->telefono}}</td>
                            </tr>
                            <tr>
                                <td>Concepto</td>
                                <td colspan="7">
                                @foreach($egreso->conceptos as $concepto)
                                    <p>
                                       {{ $concepto->descripcion }} 
                                    </p>
                                @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>Valor en letra</td>
                                <td colspan="7">
                                    <p>
                                        UN MILLON TRESCIENTOS CINCUENTA Y SEIS MIL PESOS
                                    </p>
                                </td>
                            </tr>
                        </thead>    
                        <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>