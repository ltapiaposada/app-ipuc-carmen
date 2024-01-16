@extends('adminlte::page')

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h3 class="mb-0">Formulario para editar datos del participante</h3>                    
                </div>
                <div class="card-body">
                    @if(session('info'))
                        <div class="alert alert-success">
                            <strong>{{session('info')}}</strong>
                        </div>
                        <hr>
                    @endif
                    {!! Form::model($participante,['route' => ['admin.participantes.update',$participante],'method'=>'put']) !!}
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('primer_nombre', 'Primer Nombre') !!}
                            {!! Form::text('primer_nombre', null,['class' => 'form-control col-md-6','placeholder' => 'Ingrese el primer nombre del participante','onchange' =>"nombreCompleto()"]) !!}
                            @error('primer_nombre')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('segundo_nombre', 'Segundo Nombre') !!}
                            {!! Form::text('segundo_nombre', null,['class' => 'form-control col-md-6','placeholder' => 'Ingrese el segundo nombre del participante','onchange' =>"nombreCompleto()"]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('primer_apellido', 'Primer Apellido') !!}
                            {!! Form::text('primer_apellido', null,['class' => 'form-control col-md-6','placeholder' => 'Ingrese el primer apellido del participante','onchange' =>"nombreCompleto()"]) !!}
                            @error('primer_apellido')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('segundo_apellido', 'Segundo Apellido') !!}
                            {!! Form::text('segundo_apellido', null,['class' => 'form-control col-md-6','placeholder' => 'Ingrese el segundo apellido del participante','onchange' =>"nombreCompleto()"]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('nombre_completo', 'Nombre completo') !!}
                            {!! Form::text('nombre_completo', null,['class' => 'form-control col-md-6']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('tipo_documento', 'Tipo de documento') !!}
                            {!! Form::select('tipo_documento', ['CC' => 'Cédula de ciudadanía', 'CE' => 'Cédula de extrangería', 'NIT' => 'Nit','RUT' => 'RUT'], null, ['placeholder' => 'Seleccione...','class'=>'form-control col-md-6']) !!}
                            @error('tipo_documento')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('documento', 'Documento') !!}
                            {!! Form::text('documento', null,['class' => 'form-control col-md-6']) !!}
                            @error('documento')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('telefono', 'Teléfono') !!}
                            {!! Form::text('telefono', null,['class' => 'form-control col-md-6']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('direccion', 'Dirección') !!}
                            {!! Form::text('direccion', null,['class' => 'form-control col-md-6']) !!}
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
@section('js')
    <script>
        function nombreCompleto(){
            primerNombre = document.getElementById("primer_nombre").value;
            segundoNombre = "";
            if(document.getElementById("segundo_nombre").value != "")
            {
                segundoNombre = document.getElementById("segundo_nombre").value+" ";
            }
            primerApellido = document.getElementById("primer_apellido").value;
            segundoApellido = "";
            if(document.getElementById("segundo_apellido").value != "")
            {
                segundoApellido = " "+document.getElementById("segundo_apellido").value;
            }
            nombre = primerNombre+" "+segundoNombre+primerApellido+segundoApellido;

            document.getElementById("nombre_completo").value = nombre;
        }
    </script>
@stop