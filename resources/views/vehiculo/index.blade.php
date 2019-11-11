@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row card-btn">
       <div class="col-12 col-sm-6">
            <a href="{{ route('vehiculo.create') }}" class="btn btn-primary">Registrar Vehículo</a>
        </div> 
       {{-- <div class="col-12 col-sm-6 text-right">
            <a href="" class="btn btn-primary">Conductores Anteriores</a>
        </div>  --}}
    </div>
    <div class="card-table my-3">
        <div class="card-header">
            <div class="card-title">Lista de Vehículos</div>
        </div>
        <div class="table-responsive-general">
            <table id="hola" class="table table-card dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>Unidad</th>
                        <th>Placa</th>
                        <th class="text-center">Detalles</th>
                        <th class="text-center">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehiculos as $vehiculo)
                        <tr>
                            <td>{{$vehiculo->unidad}}</td>
                            <td>{{$vehiculo->placa}}</td>
                            <td class="text-center">
                                <a href="{{ route('vehiculo.show',$vehiculo->id) }}" class=""><i class="icon-detalles text-primary"></i></a>
                            </td>
                            <td class="text-center">
                                <a  class="text-primary estado" id="{{$vehiculo->id}}" data-nombre="{{$vehiculo->placa}}">
                                    <i class="icon-eliminar text-primary"></i>
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
    <script src="{{asset('js/datatable.js')}}"></script>

    <script>
       
       $('body').on('click', '.estado', function(event) {
            let vehiculo =$(this).attr('data-nombre');
            let title='¿Está seguro de eliminar  a '+vehiculo+' ?';
            let vehiculo_id=this.id;
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
                    var url="{{route('vehiculo.estado','_id_')}}";
                    var url_update= url.replace('_id_',vehiculo_id);
                    $.ajax({
                        url:url_update, 
                        method:"post",
                        data:{
                            _token:csrf_token,
                            _method:"PUT",
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