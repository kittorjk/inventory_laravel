@extends('theme.lte.layout')
@section('titulo')
    Traspasos
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/lte/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/lte/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lte/vendors/styles/style.css') }}">
    <style type="text/css">
        p {
            font-size: 18px;
            font-weight: bold;

        }

    </style>
@endsection


@section('header')
    Reporte - Ventas
@endsection

@section('contenido')


    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-form-label">Sucursal</label>
        <div class="col-sm-12 col-md-10">
            <select class="custom-select col-12" id="sucursal" name="sucursal">
                {{-- <select class="selectpicker" id="sucursal" data-live-search="true"> --}}
                <option selected="">seleccione sucursal...</option>
                @foreach ($sucursales as $sucursal)
                    <option value=" {{ $sucursal->id_sucursal }}">
                        {{ $sucursal->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <label>Fecha Inicio</label>
                {{-- <input class="form-control date-picker" placeholder="Fecha Inicio" type="text"> --}}
                <input type="date" class="form-control" name="fechaIni" id="fechaIni">
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <label>Fecha Fin</label>
                {{-- <input class="form-control date-picker" placeholder="Fecha Fin" type="text"> --}}
                <input type="date" class="form-control" name="fechaFin" id="fechaFin">
            </div>
        </div>
    </div>


    <div class="clearfix mb-20">

        <div class="pull-right">

            <a href="" class="btn btn-info zonalink" target="_blank">
                <i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i>
            </a>
        </div>
    </div>



@endsection

@section('sripts')

    <script src="{{ asset('assets/lte/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/lte/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/lte/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/lte/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/lte/src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/lte/src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/lte/src/plugins/datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/lte/src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/lte/src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/lte/src/plugins/datatables/js/pdfmake.min.js') }}"></script>

    <script type="text/javascript">
        $('.zonalink').attr('href', 'pdfVentaMaster/0/0/0');
        var cursos = ['laravel', 'react', 'flutter', 'html'];

        $(document).ready(function() {
            // obteviendo valor  select  Sucursales
            $("#sucursal").change(function() {
                var id = $(this).val();

                var fini = $('#fechaIni').val() == "" ? 0 : $('#fechaIni').val();
                var ffin = $('#fechaFin').val() == "" ? 0 : $('#fechaFin').val();
                console.log(fini);
                console.log(ffin);
                console.log(id);
                // para el reporte
                if (id.length <= 10) {

                    $('.zonalink').attr('href', 'pdfVentaMaster/' + id.trim() + '/' + fini + '/' + ffin);
                } else {
                    $('.zonalink').attr('href', 'pdfVentaMaster/0/' + fini + '/' + ffin);
                }

                //  $('.zonalink').attr('href', '');
            });

            $("#fechaIni").change(function() {
                var id = $(this).val();
                var suc = $('#sucursal').val() == "seleccione sucursal..." ? 0 : $('#sucursal').val();
                var ffin = $('#fechaFin').val() == "" ? 0 : $('#fechaFin').val();
                $('.zonalink').attr('href', 'pdfVentaMaster/' + suc + '/' + id + '/' + ffin);
                console.log(suc);
            });

            $("#fechaFin").change(function() {
                var id = $(this).val();
                var suc = $('#sucursal').val() == "seleccione sucursal..." ? 0 : $('#sucursal').val();
                var fini = $('#fechaIni').val() == "" ? 0 : $('#fechaIni').val();
                $('.zonalink').attr('href', 'pdfVentaMaster/' + suc + '/' + fini + '/' + id);
                console.log(suc);
            });


        });

    </script>
@endsection
