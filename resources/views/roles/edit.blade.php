@extends('adminlte::page')

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h3 class="mb-0">Formulario para editar roles y permisos</h3>                    
                </div>
                <div class="card-body">
                    @if(session('info'))
                        <div class="alert alert-success">
                            <strong>{{session('info')}}</strong>
                        </div>
                        <hr>
                    @endif
                    {!! Form::model($rol,['route' => ['roles.update',$rol],'method'=>'put']) !!}
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('name', 'Nombre del rol') !!}
                            {!! Form::text('name', null,['class' => 'form-control col-md-6','rows' =>"4"]) !!}                            
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">Permisos para este rol</label>
                            <br>
                            @foreach($permisos as $permiso)
                            <label for="">
                                {!! Form::checkbox('permission[]',$permiso->name, in_array($permiso->id,$rolePermissions) ? true : false) !!} 
                                {{ $permiso->name }}
                            </label>
                            <br>
                            @endforeach     
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