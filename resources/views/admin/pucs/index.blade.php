@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Plan único de cuentas PUC</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('admin.pucs.create')}}" class="btn btn-primary btn-sm"><i class="fas fa-plus"> Nuevo</i></a>
                    @if(session('info'))
                        <div class="alert alert-success mt-2">
                            <strong>{{session('info')}}</strong>
                        </div>
                        <hr>
                    @endif
                </div>
                <div class="card-body">
                <x-adminlte-datatable id="table1" :heads="$heads">
                    @foreach($pucs as $puc)
                    <tr>
                        <td>{{$puc->id}}</td>
                        <td>{{$puc->codigo}}</td>
                        <td>{{$puc->nombre}}</td>
                        <td>{{$puc->clasificacion}}</td>
                        <td width="10px">
                            <a href="{{route('admin.pucs.edit',$puc)}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        </td>
                        <td width="10px">
                            <form action="{{route('admin.pucs.destroy',$puc)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </x-adminlte-datatable>

                    <!-- <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Clasificación</th>
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pucs as $puc)
                            <tr>
                                <td>{{$puc->id}}</td>
                                <td>{{$puc->codigo}}</td>
                                <td>{{$puc->nombre}}</td>
                                <td>{{$puc->clasificacion}}</td>
                                <td width="10px">
                                    <a href="{{route('admin.pucs.edit',$puc)}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                </td>
                                <td width="10px">
                                    <form action="{{route('admin.pucs.destroy',$puc)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table> -->
                </div>
            </div>
        </div>
    </div>
@stop