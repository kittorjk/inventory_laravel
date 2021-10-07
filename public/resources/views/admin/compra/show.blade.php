@extends('theme.lte.layout')
@section('titulo')
Detalle de Compra
@endsection

@section('styles')
@endsection

@section('header')
Detalle de Compra
@endsection



@section('contenido')
<div class="invoice-wrap">
    <div class="invoice-box">
        <div class="invoice-header">
            <div class="logo text-center">
                <img src="vendors/images/deskapp-logo.png" alt="">
            </div>
        </div>
        <h4 class="text-center mb-30 weight-600">Detalle de Compra</h4>
        <div class="row pb-30">
            <div class="col-md-6">
                <h5 class="mb-15">Datos Usuario</h5>
                <p class="font-14 mb-5">Nombre: <strong class="weight-600">{{$compra->usuario}}</strong></p>
                <p class="font-14 mb-5">Fecha: <strong class="weight-600">{{$compra->f_compra}}</strong></p>

            </div>
            <div class="col-md-6">
                <div class="text-right">
                    <h5 class="mb-15">Datos Proveedor</h5>
                    <p class="font-14 mb-5">Nombre: <strong class="weight-600">{{$compra->nombre}}</strong></p>
                    <p class="font-14 mb-5">NIT: <strong class="weight-600">{{$compra->ruc_nit}}</strong></p>
                    <p class="font-14 mb-5">Direccion: <strong class="weight-600">{{$compra->direccion}}</strong></p>

                </div>
            </div>
        </div>
        <div class="invoice-desc pb-30">
            <div class="invoice-desc-head clearfix">
                <div class="invoice-sub">Producto</div>
                <div class="invoice-rate">Precio</div>
                <div class="invoice-hours">Cantidad</div>
                <div class="invoice-subtotal">Subtotal</div>
            </div>
            <div class="invoice-desc-body">
                <ul>
                    @foreach($detalles as $det)
                    <li class="clearfix">
                        <div class="invoice-sub">{{$det->producto}}</div>
                        <div class="invoice-rate">Bs. {{$det->precio}}</div>
                        <div class="invoice-hours">{{$det->cantidad}}</div>
                        <div class="invoice-subtotal"><span class="weight-600">Bs. {{number_format($det->cantidad*$det->precio,2)}}</span></div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="invoice-desc-footer">
                <div class="invoice-desc-head clearfix">
                    <div class="invoice-sub"></div>
                    <div class="invoice-rate"></div>
                    <div class="invoice-subtotal">Total Bs</div>
                </div>
                <div class="invoice-desc-body">
                    <ul>
                        <li class="clearfix">
                            <div class="invoice-sub">
                                {{-- <p class="font-14 mb-5">Account No: <strong class="weight-600">123 456 789</strong></p>
                                <p class="font-14 mb-5">Code: <strong class="weight-600">4556</strong></p> --}}
                            </div>
                           {{--  <div class="invoice-rate font-20 weight-600">10 Jan 2018</div> --}}
                            <div class="invoice-subtotal"><span class="weight-600 font-22 text-danger">Bs. {{number_format($compra->total,2)}}</span></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
   {{--      <h4 class="text-center pb-20">Thank You!!</h4> --}}
    </div>
</div>
@endsection

@section('sripts')

    <script type="text/javascript">
    $(document).ready(function() {

    });
    </script>

@endsection
