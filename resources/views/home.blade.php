@extends('layouts.admin')
@section('content')
    <div class="card my-3">
        <div class="card-header">
            <div class="card-title">Lista de Compras</div>
        </div>
        <div class="table-responsive-general">
            <table id="hola" class="table table-card table-striped">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Item</th>
                        <th>Item</th>
                        <th>Opción</th>
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
                </tbody>
            </table>
        </div>
    </div>
@endsection