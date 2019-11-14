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
                        <th>Recorrido(GPS)</th>
                        <th>KM-cambio de aceite</th>
                        <th>Realizado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reporte as $item)
                        <tr>
                            <td>{{$item->vehiculo->placa}}</td>
                            <td>{{\Carbon\Carbon::parse($item->fecha)->format('d-m-Y') }}</td>
                            <td>{{$item->vehiculo->odometro}}</td>
                            <td>{{$item->recorrido}}</td>
                            <td class="text-center" width="114px">
                                <a  class="text-primary estado" id="{{$item->id}}" data-placa="{{$item->vehiculo->placa}}">
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
    
    <script>
       
       $('body').on('click', '.estado', function(event) {
            let placa =$(this).attr('data-placa');
            let title='¿Está seguro de realizar el cambio de aceite de la placa: '+placa;
            let cambio_aceite=this.id;
            let fila=$(this).parents('tr');
            let fila2=$(this).parents('tr.child').prev();
           
           
            swal({
                title: title,
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    var url="{{route('cambioaceite.update','_id_')}}";
                    var url_update= url.replace('_id_',cambio_aceite);
                    $.ajax({
                        url:url_update, 
                        method:"post",
                        data:{
                            _token:csrf_token,
                            _method:"PUT",
                            placa:placa,
                        },
                        success:function(data){
                            if(data.status=='OK'){
                                swal(data.data, {
                                    icon: "success",
                                });
                                fila.remove();
                                fila2.remove();
                            }else{
                                swal(data.data);
                            }
                        }
                    });
                } 
            });
       })
    </script>
@endsection