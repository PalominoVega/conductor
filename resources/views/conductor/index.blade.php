@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row card-btn">
       <div class="col-12 col-sm-6">
            <a href="{{ route('conductor.create') }}" class="btn btn-primary">Registrar Conductor</a>
        </div> 
       <div class="col-12 col-sm-6 text-right">
            <a href="{{ route('conductor.deshabilitado') }}" class="btn btn-primary">Conductores Anteriores</a>
        </div> 
    </div>
    <div class="card-table my-3">
        <div class="card-header">
            <div class="card-title">Lista de Conductores</div>
        </div>
        <div class="table-responsive-general">
            <table id="hola" class="table table-card dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>Nombres y Apellidos</th>
                        <th>Celular</th>
                        <th class="text-center">Detalles</th>
                        <th class="text-center">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($conductores as $conductor)
                        <tr>
                            <td>{{$conductor->nombre.' '.$conductor->apellido}}</td>
                            <td>{{$conductor->celular}}</td>
                            <td class="text-center" width="114px">
                                <a href="{{ route('conductor.show',$conductor->id) }}" class=""><i class="fa fa-file-text text-primary"></i></a>
                            </td>
                            <td class="text-center" width="114px">
                                <a  class="text-primary estado" id="{{$conductor->id}}" data-nombre="{{$conductor->nombre.' '.$conductor->apellido}}">
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

    <script src="{{asset('js/datatable.js')}}"></script>
    <script>
       
       $('body').on('click', '.estado', function(event) {
            let conductor =$(this).attr('data-nombre');
            // let estado=$(this).children('i').attr('class')=='fa fa-dot-circle-o text-primary' ? 'Desactivar':'Activar';
            let title='¿Está seguro de deshabilitar  a '+conductor+' ?';
            let conductor_id=this.id;
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