@extends('layouts.admin')
@section('content')
<div class="container">
    
    <div class="card-table my-3">
        <div class="card-header">
            <div class="card-title">Lista de Vehículos</div>
        </div>
        <div class="table-responsive-general">
            <table id="hola" class="table table-card dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th >Recorrido</th>
                        <th >Meta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehiculos as $vehiculo)
                        <tr>
                            <td>{{$vehiculo->placa}}</td>
                            <td>{{$vehiculo->odometro}}</td>
                            @if ($vehiculo->kilometraje!='0')
                                <td>{{$vehiculo->kilometraje}}</td>
                            @else
                                <td >
                                    <form action="{{ route('cambioaceite.store',$vehiculo->id) }}" method="post" >
                                                @csrf
                                        <input type="text" name="recorrido" id="recorrido" class=" form-control-sm" value="{{old('recorrido')}}">
                                        <button type="submit" class="btn-primary btn-sm"><i class="icon-check"></i></button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{asset('js/datatable.js')}}"></script>

@endsection