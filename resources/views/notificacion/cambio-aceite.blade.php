@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="card-table mt-5">
        <div class="card-header">
            <div class="card-title"> Cambio de Aceite</div>
        </div>
        <div class="table-responsive-general">
            <table id="hola" class="table table-card dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Fecha</th>
                        <th>Recorrido</th>
                        <th>Realizado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reporte as $item)
                        <tr>
                            <td>{{$item->placa}}</td>
                            <td>{{\Carbon\Carbon::parse($item->fecha)->format('d-m-Y') }}</td>
                            <td></td>
                            <td class="text-center" width="114px">
                                <a  class="text-primary estado">
                                    <i class="icon-estado text-primary"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{asset('js/datatable-noticacion.js')}}"></script>
@endsection