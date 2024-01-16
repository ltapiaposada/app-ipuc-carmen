@extends('adminlte::page')

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h3 class="mb-0">Formulario para editar deducción</h3>                    
                </div>
                <div class="card-body">
                    @if(session('info'))
                        <div class="alert alert-success">
                            <strong>{{session('info')}}</strong>
                        </div>
                        <hr>
                    @endif
                    {!! Form::model($deduccion,['route' => ['admin.deducciones.update',$deduccion],'method'=>'put']) !!}
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('descripcion', 'Descripción') !!}
                            {!! Form::text('descripcion', null,['class' => 'form-control col-md-6','rows' =>"4"]) !!}                            
                            @error('descripcion')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('tipo', 'Selecciona el tipo de deducción') !!} <i class="fas fa-info info"></i>
                            {!! Form::select('tipo', ['Porcentaje' => 'Porcentaje', 'Monto' => 'Monto'], null, ['placeholder' => 'Seleccione...','class'=>'form-control col-md-6']) !!}
                            @error('tipo')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('valor', 'Valor de la deducción') !!}
                            {!! Form::number('valor', null,['class' => 'form-control col-md-6','rows' =>"4"]) !!}                            
                            @error('valor')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-success btn-lg']) !!}
                        </div>                        
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop