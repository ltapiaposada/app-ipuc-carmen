@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Listado de bancos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @can('crear-bancos')
                        <a href="{{route('admin.bancos.create')}}" class="btn btn-primary btn-sm"><i class="fas fa-plus"> Nuevo</i></a>
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
                                <th>Nombre</th>
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bancos as $banco)
                            <tr>
                                <td>{{$banco->id}}</td>
                                <td>{{$banco->nombre}}</td>
                                <td width="10px">
                                    @can('editar-bancos')
                                    <a href="{{route('admin.bancos.edit',$banco)}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('eliminar-bancos')
                                    <form action="{{route('admin.bancos.destroy',$banco)}}" method="post">
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