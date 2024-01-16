@extends('adminlte::page')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header bg-info">
                    <h3 class="mb-0">Formulario para registro de pagos</h3>
                </div>
                    @if(session('info'))
                        <div class="alert alert-success">
                            <strong>{{session('info')}}</strong>
                        </div>
                        <hr>
                    @endif
                <div class="card-body">                    
                    {!! Form::open(['route' => 'admin.egresos.store']) !!}
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6">
                            {!! Form::label('fecha', 'Fecha') !!}
                            {!! Form::date('fecha', \Carbon\Carbon::now(),['class' => 'form-control col-md-6']) !!}                            
                            @error('consecutivo')
                                <span class="text-danger">Ingresa el número o consecutivo del egreso, no puede quedar en blanco</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6">
                            {!! Form::label('consecutivo', 'No. del Egreso(consecutivo)') !!}
                            {!! Form::text('consecutivo', null,['class' => 'form-control col-md-6']) !!}                            
                            @error('consecutivo')
                                <span class="text-danger">Ingresa el número o consecutivo del egreso, no puede quedar en blanco</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            
                            {!! Form::label('participante_id', 'Pagado a') !!}<br>
                            {!! Form::select('participante_id', $participantes, null, ['placeholder' => 'Seleccione...','class'=>'form-control col-md-6 select2-single']) !!}
                                                
                            @error('participante_id')
                                <span class="text-danger">El campo pagado a no puede quedar vacío por favor ingresa el dato</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('conceptos', 'Concepto del pago') !!}<br>
                            
                            {!! Form::select('conceptos[]', $conceptos, null, ['multiple'=>'multiple','id'=>'conceptos','class'=>'form-control col-md-6 select2-single']) !!}                     
                            @error('conceptos')
                                <span class="text-danger">El campo con el concepto no puede quedar sin diligenciar</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('valor', 'Monto/Valor') !!}
                            {!! Form::number('valor', null,['class' => 'form-control col-md-6']) !!}                            
                            @error('valor')
                                <span class="text-danger">El valor del egreso no puede estar en cero(0) o vácio</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('forma_pago', 'Forma de pago') !!}
                            {!! Form::select('forma_pago', ['EF' => 'Efectivo', 'CH' => 'Cheque', 'TF' => 'Transferencia'], null, ['placeholder' => 'Seleccione...','class'=>'form-control col-md-6']) !!}
                            @error('forma_pago')
                                <span class="text-danger">Por favor selecciona la forma de pago para el egreso</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('cheque_numero', 'Numero cheque') !!}
                            {!! Form::number('cheque_numero', null, ['placeholder' => 'por favor ingrese el número del cheque en caso de que haya seleccionado esa forma de pago','class'=>'form-control col-md-6']) !!}
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('banco_id', 'Banco') !!}<br>
                            {!! Form::select('banco_id', $bancos, null, ['placeholder' => 'Seleccione...','id'=>'bancos','class'=>'form-control col-md-6 select2-single']) !!}
                            @error('banco_id')
                                <span class="text-danger">Por favor selecciona la forma de pago para el egreso</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('deduccions','Deducciones') !!}<br>
                            {!! Form::select('deduccions[]', $deducciones, null, ['multiple'=>'multiple', 'id'=>'deduccions','class'=>'form-control col-md-6 select2-single']) !!}
                           
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::submit('Pagar', ['class' => 'btn btn-success btn-lg']) !!}
                        </div>                        
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-single').select2({
                theme: "classic"
            });
        });        
    </script>

@stop