@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Lista de pagos realizados</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">                    
                    @can('crear-egreso')
                    <a href="{{route('admin.egresos.create')}}" class="btn btn-primary btn-sm"><i class="fas fa-plus"> Nuevo</i></a>
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
                        @foreach($egresos as $egreso)
                        <tr>
                            <td>{{$egreso->id}}</td>
                            <td>{{$egreso->consecutivo}}</td>
                            <td>{{$egreso->fecha}}</td>
                            <td>{{$egreso->participante->nombre_completo}}</td>
                            <td style="text-align: right;">
                                <?php 
                                    foreach($egreso->deduccions as $deduccion){
                                        $valor = 0;
                                        if($deduccion->tipo == 'Porcentaje'){ 
                                            $valor = ($egreso->valor * $deduccion->valor) /100;
                                        } elseif ($deduccion->tipo == 'Monto'){ 
                                            $valor = $deduccion->valor;
                                        }
                                        $egreso->valor -= $valor;
                                    }
                                    echo "$ ".number_format($egreso->valor,0,',','.');
                                ?> 
                            </td>
                            <td width="30%">
                                @foreach($egreso->conceptos as $concepto)
                                <p>
                                    {{ $concepto->descripcion }} 
                                </p>
                                @endforeach
                            </td>
                            @can('ver-egreso')
                            <td width="10px">
                                <a href="{{route('admin.egresos.show',$egreso)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                
                            </td>
                            <td width="10px">
                                <a href="{{route('admin.egresos.cuenta',$egreso)}}" class="btn btn-primary btn-sm"><i class="fas fa-file"></i></a>                                
                            </td>
                            <td width="10px">
                                <a href="{{route('admin.egresos.orden',$egreso)}}" class="btn btn-secondary btn-sm"><i class="fas fa-file"></i></a>                                
                            </td>
                            @endcan
                            <td width="10px">                                
                                @can('eliminar-egreso')
                                    <form action="{{route('admin.egresos.destroy',$egreso)}}" method="post">
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