@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row card-btn">
       <div class="col-12 col-sm-6">
            <a href="" class="btn btn-primary">Registrar Conductor</a>
        </div> 
       <div class="col-12 col-sm-6 text-right">
            <a href="" class="btn btn-primary">Conductores Anteriores</a>
        </div> 
    </div>
    <div class="card-table my-3">
        <div class="card-header">
            <div class="card-title">Lista de Conductores</div>
        </div>
        <div class="table-responsive-general">
            <table id="hola" class="table table-card ">
                <thead>
                    <tr>
                        <th>Nombres y Apellidos</th>
                        <th>Celular</th>
                        <th>Detalles</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01</td>
                        <td>Producto 01</td>
                        <td>Producto 01</td>
                        <td>
                            <button class="btn-link-primary">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>02</td>
                        <td>Producto 02</td>
                        <td>Producto 02</td>
                        <td>
                            <button class="btn-link-primary">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>01</td>
                        <td>Producto 01</td>
                        <td>Producto 01</td>
                        <td>
                            <button class="btn-link-primary">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>02</td>
                        <td>Producto 02</td>
                        <td>Producto 02</td>
                        <td>
                            <button class="btn-link-primary">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection