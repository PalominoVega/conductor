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
            <table id="hola" class="table table-card ">
                <thead>
                    <tr>
                        <th>Unidad</th>
                        <th>Placa</th>
                        <th>Detalles</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehiculos as $vehiculo)
                        <tr>
                            <td>{{$vehiculo->unidad}}</td>
                            <td>{{$vehiculo->placa}}</td>
                            <td class="text-center">
                                <a href="{{ route('vehiculo.show',$vehiculo->id) }}" class=""><i class="fa fa-file-text text-primary"></i></a>
                            </td>
                            <td class="text-center">
                                <a  class="text-primary estado" id="{{$vehiculo->id}}" data-nombre="{{$vehiculo->placa}}">
                                    <i class="fa fa-dot-circle-o text-primary"></i>
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
    <script>
       
       $('body').on('click', '.estado', function(event) {
            let conductor =$(this).attr('data-nombre');
            // let estado=$(this).children('i').attr('class')=='fa fa-dot-circle-o text-primary' ? 'Desactivar':'Activar';
            let title='¿Está seguro de deshabilitar  a '+conductor+' ?';
            let conductor_id=this.id;
        
            swal({
                title: title,
                // text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    var url="{{route('conductor.estado','_id_')}}";
                    var url_update= url.replace('_id_',conductor_id);
                    $.ajax({
                        url:url_update, 
                        method:"post",
                        data:{
                            _token:csrf_token,
                            _method:"PUT",
                        },
                        success:function(data){
                            console.log(data);
                            if(data.status=='OK'){
                                swal(data.data, {
                                    icon: "success",
                                });
                            }else{
                                swal(data.data);
                            }
                        }
                    });

                    swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                    });
                } /* else {
                    swal("Your imaginary file is safe!");
                } */
            });
       })


    </script>
@endsection