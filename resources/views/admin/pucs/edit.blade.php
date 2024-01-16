@extends('adminlte::page')

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h3 class="mb-0">Formulario para editar la cuenta</h3>                    
                </div>
                <div class="card-body">
                    @if(session('info'))
                        <div class="alert alert-success">
                            <strong>{{session('info')}}</strong>
                        </div>
                        <hr>
                    @endif
                    {!! Form::model($puc,['route' => ['admin.pucs.update',$puc],'method'=>'put']) !!}
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('codigo', 'Código de la cuenta') !!}
                            {!! Form::text('codigo', null,['class' => 'form-control col-md-6']) !!}                            
                            @error('codigo')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('nombre', 'Nombre') !!}
                            {!! Form::text('nombre', null,['class' => 'form-control col-md-6']) !!}                            
                            @error('nombre')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('clasificacion', 'Clasificación') !!}
                            {!! Form::text('clasificacion', null,['class' => 'form-control col-md-6']) !!}                            
                            @error('clasificacion')
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