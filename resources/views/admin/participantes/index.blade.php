@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Listado de beneficiarios</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @can('crear-participantes')
                    <a href="{{route('admin.participantes.create')}}" class="btn btn-primary btn-sm"><i class="fas fa-plus"> Nuevo</i></a>
                    @endcan
                    @if(session('info'))
                        <div class="alert alert-success mt-2">
                            <strong>{{session('info')}}</strong>
                        </div>
                        <hr>
                    @endif
                </div>
                <div class="card-body">
                    <x-adminlte-datatable id="table1" :heads="$heads" striped head-theme="dark" with-buttons>
                    @foreach($participantes as $participante)
                            <tr>
                                <td  width="10px">{{$participante->id}}</td>
                                <td>{{$participante->nombre_completo}}</td>
                                <td>{{$participante->telefono}}</td>
                                <td>{{$participante->direccion}}</td>
                                <td width="10px">
                                @can('editar-participantes')
                                    <a href="{{route('admin.participantes.edit',$participante)}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                @endcan
                                </td>
                                <td width="10px">
                                @can('eliminar-participantes')
                                    <form action="{{route('admin.participantes.destroy',$participante)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                @endcan
                                </td>
                            </tr>
                            @endforeach
                    </x-adminlte-datatable>
                </div>
            </div>
        </div>
    </div>
@stop