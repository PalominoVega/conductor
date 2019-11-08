@extends('layouts.admin')
@section('content')
<div class="container">
    
    <div class="card-table mt-5">
        <div class="card-header">
            <div class="card-title"> SOAT</div>
        </div>
        <div class="table-responsive-general">
            <table id="hola" class="table table-card ">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Fecha</th>
                        <th>Días</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($docs_soat as $item)
                        <tr>
                            <td>{{$item->placa}}</td>
                            <td>{{\Carbon\Carbon::parse($item->fecha)->format('d-m-Y') }}</td>
                            <td>
                                @if ($item->dias <-1)
                                    Vencido hace {{ -$item->dias}} días
                                @elseif($item->dias ==-1)
                                    Se venció ayer
                                @elseif($item->dias ==0)
                                    Se vence hoy
                                @elseif($item->dias ==1)
                                    Se vence mañana
                                @elseif($item->dias >1)
                                    Por vencer en {{ $item->dias}} días
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-table mt-5">
        <div class="card-header">
            <div class="card-title"> REVISIÓN TÉCNICA</div>
        </div>
        <div class="table-responsive-general">
            <table id="hola" class="table table-card ">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Fecha</th>
                        <th>Días</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doc_revicion_tecnica as $item)
                        <tr>
                            <td>{{$item->placa}}</td>
                            <td>{{\Carbon\Carbon::parse($item->fecha)->format('d-m-Y') }}</td>
                            <td>
                                @if ($item->dias <-1)
                                    Vencido hace {{ -$item->dias}} días
                                @elseif($item->dias ==-1)
                                    Se venció ayer
                                @elseif($item->dias ==0)
                                    Se vence hoy
                                @elseif($item->dias ==1)
                                    Se vence mañana
                                @elseif($item->dias >1)
                                    Por vencer en {{ $item->dias}} días
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-table mt-5  ">
        <div class="card-header">
            <div class="card-title">Lista LICENCIA</div>
        </div>
        <div class="table-responsive-general">
            <table id="hola" class="table table-card ">
                <thead>
                    <tr>
                        <th>Nombres y Apellidos</th>
                        <th>Celular</th>
                        <th>Fecha</th>
                        <th>Días</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($docs_licencia as $item)
                        <tr>
                            <td>{{$item->nombre.' '.$item->apellido}}</td>
                            <td>{{$item->celular}}</td>
                            <td>{{\Carbon\Carbon::parse($item->fecha)->format('d-m-Y') }}</td>
                            <td>
                                @if ($item->dias <-1)
                                    Vencido hace {{ -$item->dias}} días
                                @elseif($item->dias ==-1)
                                    Se venció ayer
                                @elseif($item->dias ==0)
                                    Se vence hoy
                                @elseif($item->dias ==1)
                                    Se vence mañana
                                @elseif($item->dias >1)
                                    Por vencer en {{ $item->dias}} días
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
</div>
@endsection
