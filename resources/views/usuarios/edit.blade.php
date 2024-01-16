@extends('adminlte::page')

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h3 class="mb-0">Formulario para editar usuario</h3>                    
                </div>
                <div class="card-body">
                    @if(session('info'))
                        <div class="alert alert-success">
                            <strong>{{session('info')}}</strong>
                        </div>
                        <hr>
                    @endif
                    {!! Form::model($usuario,['route' => ['usuarios.update',$usuario],'method'=>'put']) !!}
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('name', 'Descripción del usuario') !!}
                            {!! Form::text('name', $usuario->name,['class' => 'form-control col-md-6','rows' =>"4"]) !!}                            
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::email('email', $usuario->email,['class' => 'form-control col-md-6','rows' =>"4"]) !!}                            
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
                            {!! Form::label('confirm-password', 'Confirma la contraseña') !!}<br>
                            {!! Form::password('confirm-password', ['class' => 'form-control col-md-6','rows' =>"4"]) !!}                            
                            @error('confirm-password')
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