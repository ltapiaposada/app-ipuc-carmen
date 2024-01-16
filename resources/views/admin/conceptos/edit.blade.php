@extends('adminlte::page')

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h3 class="mb-0">Formulario para editar el concepto de la cuenta</h3>                    
                </div>
                <div class="card-body">
                    @if(session('info'))
                        <div class="alert alert-success">
                            <strong>{{session('info')}}</strong>
                        </div>
                        <hr>
                    @endif
                    {!! Form::model($concepto,['route' => ['admin.conceptos.update',$concepto],'method'=>'put']) !!}
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('descripcion', 'Descripción del concepto') !!}
                            {!! Form::textarea('descripcion', null,['class' => 'form-control col-md-6','rows' =>"4"]) !!}                            
                            @error('descripcion')
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