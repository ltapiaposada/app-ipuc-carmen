@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Listado de roles</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @can('crear-rol')
                    <a href="{{route('roles.create')}}" class="btn btn-primary btn-sm"><i class="fas fa-plus"> Nuevo</i></a>
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
                            @foreach($roles as $rol)
                            <tr>
                                <td>{{$rol->id}}</td>
                                <td>{{$rol->name}}</td>
                                <td width="10px">
                                    @can('editar-rol')
                                        <a href="{{route('roles.edit',$rol)}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('eliminar-rol')
                                        <form action="{{route('roles.destroy',$rol)}}" method="post">
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