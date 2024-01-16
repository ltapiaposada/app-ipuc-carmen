@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Administrar Conceptos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if(session('info'))
                    <div class="alert alert-success">
                        <strong>{{session('info')}}</strong>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <h3 class="mb-0">Formulario para registro de usuarios</h3>
                    <hr>
                    {!! Form::open(['route' => 'usuarios.store']) !!}
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name', null,['class' => 'form-control col-md-6','rows' =>"4"]) !!}                            
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::email('email', null,['class' => 'form-control col-md-6','rows' =>"4"]) !!}                            
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('password', 'Contraseña') !!}<br>
                            {!! Form::password('password', ['class' => 'form-control col-md-6','rows' =>"4"]) !!}                            
                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('config-password', 'Confirma la contraseña') !!}<br>
                            {!! Form::password('config-password', ['class' => 'form-control col-md-6','rows' =>"4"]) !!}                            
                            @error('config-password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            
                            {!! Form::label('roles', 'Roles') !!}<br>
                            {!! Form::select('roles[]', $roles, null, ['multiple' => 'multiple','class'=>'form-control col-md-6 select2-single']) !!}
                                                
                            @error('roles')
                                <span class="text-danger">El campo roles a no puede quedar vacío por favor selecciona el dato</span>
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