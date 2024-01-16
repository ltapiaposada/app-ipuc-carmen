@extends('adminlte::page')

@section('content_header')
<div style="display: flex; justify-content:space-between;">
    <h1 class="m-0 text-dark">Detalle de la cuenta</h1>
    <a href="{{route('admin.egresos.index')}}" class="btn btn-info"><i class="fas fa-arrow-left"> Volver</i></a>
</div>
@stop

@section('content')   
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div style="display:flex; justify-content: flex-end; width:100%; margin-bottom: 20px;">
                            <div style="min-width:450px; max-width: 650px; margin:5px;">
                                <img src="{{asset('/img/logoGaita.png')}}" alt="" style="width: 100%;">
                            </div>
                        </div>
                        <hr>
                        <h3 style="text-align: center; margin: 50px 0px 70px 0px;">ORDEN DE PAGO</h3>                        
                        <div  style="text-align: left; line-height: 1em; font-size: 1.3em; ">
                        <?php $meses = ["",'Enero',	'Febrero',	'Marzo',	'Abril',	'Mayo',	'Junio',	'Julio',	'Agosto',	'Septiembre',	'Octubre',	'Noviembre',	'Diciembre']; ?>
                            <p>
                               Ovejas sucre {{ date('d',strtotime($egreso->fecha))}} de <?php echo $meses[date('m',strtotime($egreso->fecha))] ?> de
                                {{ date('Y',strtotime($egreso->fecha))}}
                            </p>
                            <br><br>
                            <p>
                                SEÑOR:<br>
                                <strong>GILBERTO GRACIA BLANCO</strong><br>
                                Tesorero Festival de Gaitas XXXIX edición<br><br>
                                La ciudad
                            </p>
                        </div>
                        <div  style="text-align: left; margin-bottom: 15px;line-height: 2.5em; font-size: 1.3em; ">
                            <p>
                                Sirvase cancelar al(a) señor(a): <u><i><strong style="text-transform:uppercase;">{{ $egreso->participante->nombre_completo }}</strong></i></u>  identificado(a) con CC/NIT No. <u> {{$egreso->participante->documento}}</u>
                                La suma de {{ $valorEnLetras }} ($ {{ number_format($egresoValorNeto,0,',','.') }})por concepto de 
                                @foreach($egreso->conceptos as $concepto)
                                    {{ $concepto->descripcion }},&nbsp; 
                                @endforeach
                            </p>
                            <p>Atentamente,</p>
                        </div>
                        <div  style="text-align: left; margin-top: 50px;font-size: 1.3em; ">
                            <p>
                                <strong>DILSON HERNANDEZ ARRIETA</strong><br>
                                Presidente
                            </p>
                        </div>
                        <div class="row bloq-pie">
                            <div>
                                <h3 class="titulo-pie">
                                    Gaita: Pasión musical de nuestra historia
                                </h3>
                                <p style="text-align: left;">
                                    Personería juridica No. 508 de julio 8 de 1986<br>
                                    Registro Cámara de comercio de sincelejo No. 500.872 de julio 31 1998<br>
                                    Patrimonio Cultural y Folclorico de ovejas(Acuerdo 018 H.C.M noviembre 23/2002)<br>
                                    Patrimonio e Interés Cultural del Departamento de Sucre (Ord. 08, julio 29/2004)<br>
                                    Orden del Congreso de Colombia en el Grado de Comendador (Resol. 033, de 2009)<br>
                                    Patrimonio Cultural e Inmaterial de la Nación (Ley 1756, julio 2/2015)
                                </p>
                            </div>
                            <div>
                                <p style="text-align: right;">
                                    Calle 15 No. 21-11 * Celular 320 610 97 39 - 323 471 07 83<br>
                                    NIT 800.022.352-4 * Ovejas, Sucre, Colombia<br>
                                    festivaldegaitas@hotmail.com<br>
                                    festivaldegaitas@gmail.com<br>
                                    www.festigaitasovejas.org.co<br>
                                    http://festivaldegaitas.blogspot.com<br>
                                    http://revistadelfestivaldeovejas.blogspot.com<br>
                                    http://picasaweb.google.es/festivaldegaitas<br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
<style>
    @font-face {
        font-family: 'Carattere-Regular';
        src: url('fonts/Carattere-Regular.ttf');
    }
    .bloq-pie{
        display: flex; 
        justify-content: space-between; 
        width: 100%;  
        bottom: 0px; 
        padding:10; 
        gap: 20px; 
        margin-top:35%;
    }
    .titulo-pie{
        font-size: 2.5em;
        font-family: 'Carattere-Regular', cursive;
    }
</style>
@stop