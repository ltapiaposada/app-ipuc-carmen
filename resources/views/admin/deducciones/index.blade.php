@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Listado de deducciones</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @can('crear-deducciones')
                        <a href="{{route('admin.deducciones.create')}}" class="btn btn-primary btn-sm"><i class="fas fa-plus"> Nuevo</i></a>
                    @endcan
                    @if(session('info'))
                        <div class="alert alert-success mt-2">
                            <strong>{{session('info')}}</strong>
                        </div>
                        <hr>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Descripción</th>
                                <th>Tipo</th>
                                <th>Valor</th>
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deducciones as $deduccion)
                            <tr>
                                <td>{{$deduccion->id}}</td>
                                <td>{{$deduccion->descripcion}}</td>
                                <td>{{$deduccion->tipo}}</td>
                                <td>{{$deduccion->valor}}</td>
                                <td width="10px">
                                @can('editar-deducciones')
                                    <a href="{{route('admin.deducciones.edit',$deduccion)}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                @endcan
                                </td>
                                <td width="10px">
                                @can('eliminar-deducciones')
                                    <form action="{{route('admin.deducciones.destroy',$deduccion)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop