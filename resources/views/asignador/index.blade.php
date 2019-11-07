@extends('layouts.admin')
@section('content')
<div class="container">
    
    <div class="card-table my-3">
        <div class="card-header">
            <div class="card-title">Lista de Asignaciones</div>
        </div>
        <div class="table-responsive-general">
            <table id="asignar" class="table table-card ">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Conductor</th>
                        <th>Co-Conductor</th>
                        {{-- <th>Eliminar</th> --}}
                        {{-- <th>Guardar</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehiculos as $vehiculo)
                        <tr>
                            <td>{{$vehiculo->placa}}</td>
                            @if(count($vehiculo->conductor)==0)
                                <td>
                                    <form class="form-new" id="{{$vehiculo->id}}">
                                        <select  class="form-control-sm conductores" style="" name="conductores" id="conductores">
                                            <option value="1">...</option>
                                            @foreach($conductores as $conductor)
                                                <option value="{{$conductor->id}}">{{$conductor->nombre.' '.$conductor->apellido}}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn-primary btn-sm"></button>
                                    </form>
                                </td>
                                <td>
                                    <form class="form-new" id="{{$vehiculo->id}}">
                                        <select  class="form-control-sm conductores" style="" name="conductores" id="conductores">
                                            <option value="1">...</option>
                                            
                                        </select>
                                        <button type="submit" class="btn-primary btn-sm"></button>
                                    </form>
                                </td>
                            @elseif(count($vehiculo->conductor)==1)
                                <td>
                                    {{$vehiculo->conductor[0]->nombre.' '.$vehiculo->conductor[0]->apellido}} 
                                    <i class="fa fa-minus-circle text-primary asignado" id="{{$vehiculo->conductor[0]->id}}"></i>
                                </td>
                                <td>
                                    <form class="form-new" id="{{$vehiculo->id}}">
                                        <select  class="form-control-sm conductores" style="" name="conductores" id="conductores">
                                            <option value="1">...</option>
                                            
                                        </select>
                                        <button type="submit" class="btn-primary btn-sm"></button>
                                    </form>

                                </td>
                            @else
                                <td>
                                    {{$vehiculo->conductor[0]->nombre.' '.$vehiculo->conductor[0]->apellido}} 
                                    <i class="fa fa-minus-circle text-primary asignado" id="{{$vehiculo->conductor[0]->id}}" ></i>
                                </td>
                                <td>
                                    {{$vehiculo->conductor[1]->nombre.' '.$vehiculo->conductor[1]->apellido}} 
                                    <i class="fa fa-minus-circle text-primary asignado" id="{{$vehiculo->conductor[1]->id}}"></i>
                                </td>  
                            @endif

                            {{-- <td class="text-center">
                                <a  class=""><i class="fa fa-file-text text-primary"></i></a>
                            </td> --}}
                            {{-- <td class="text-center">
                                <a  class="text-primary estado">
                                        <i class="fa fa-dot-circle-o text-primary"></i>
                                </a>
                            </td> --}}
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
       $('body').on('click', '.asignado', function(event) {

            var url="{{route('asignador.update.conductor','_id_')}}";
            var url_update= url.replace('_id_',this.id);
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
                    }else{
                        swal(data.data);
                    }
                }
            });
       });

       $('body').on('click', '.estado', function(event) {
            let vehiculo =$(this).attr('data-nombre');
            // let estado=$(this).children('i').attr('class')=='fa fa-dot-circle-o text-primary' ? 'Desactivar':'Activar';
            let title='¿Está seguro de eliminar  a '+vehiculo+' ?';
            let vehiculo_id=this.id;
        
            swal({
                title: title,
                // text: "Once deleted, you will not be able to recover this imaginary file!",
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

                    // swal("Poof! Your imaginary file has been deleted!", {
                    // icon: "success",
                    // });
                } /* else {
                    swal("Your imaginary file is safe!");
                } */
            });
       })

       $('body').on('click', 'select', function(event) {
            $.ajax({
                method: "GET",
                url: "{{ route('asignador.ajax') }}",
                contentType: 'json',
                success: function (data) {
                    console.log(data);
                    var datos=JSON.parse(data);
                }
            });
       })

       $('body').on('submit','.form-new',function (e){
            e.preventDefault();
            var conductor_id=$(".conductores option:selected").val();
            var vehiculo_id=this.id;
            
            $.ajax({
                method: "POST",
                url: "{{ route('asignador.store.conductor') }}",
                data: {
                    _token:csrf_token,
                    conductor_id:conductor_id,
                    vehiculo_id:vehiculo_id,
                },
                success: function (data) {
                    console.log(data);
                    swal({ title: "Conductor Asignado" , icon: "success",timer:2000 });
                }
            }); 
        });
    </script>
@endsection