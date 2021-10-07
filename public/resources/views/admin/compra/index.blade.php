@extends('theme.lte.layout')
@section('titulo')
    Compra
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/lte/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/lte/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lte/vendors/styles/style.css') }}">
    <style type="text/css">
        #cDetalle td {
            white-space: inherit;
        }

    </style>
@endsection

@section('header')
    Compra
@endsection

@section('contenido')

@section('contenido')
    @if (Session::has('message'))

        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" arial-label="Close"><span
                    aria-hidden="true">x</span></button>
            {{ Session::get('message') }}
        </div>

    @endif

    <div class="clearfix mb-20">
        <div class="pull-right">
            <a href="{{ route('compra.create') }}" class="btn btn-primary btn-sm scroll-click" type="button">
                <i class="fa fa-plus"></i> Nueva Compra
            </a>
            <a href="#" class="btn btn-info btn-sm scroll-click" data-toggle="modal" data-target="#modalSearch"
                type="button">
                <i class="icon-copy fi-magnifying-glass"></i>
            </a>
        </div>
    </div>
    {{-- <div class="clearfix mb-20">

        <div class="pull-right">
            <a href="#" class="btn btn-info btn-sm scroll-click" data-toggle="modal" data-target="#modalSearch"
                type="button">
                <i class="icon-copy fi-magnifying-glass"></i>
            </a>
        </div>
    </div> --}}

    <!-- Export Datatable start -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Listado de Compras</h4>
        </div>
        <div class="pb-20">
            <table class="table hover multiple-select-row data-table-export nowrap" id="tcompra">
                {{-- <table id="tcompra" class="data-table table nowrap"> --}}
                <thead>
                    <tr>
                        {{-- <th class="table-plus datatable-nosort">Name</th> --}}
                        <th class="table-plus datatable-nosort">#</th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Usuario</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Export Datatable End -->

    <!-- Modal detalle de traspaso mdetalletraspaso-->

    {{-- <div class="modal fade" id="mdetalletraspaso" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" > --}}
    <div class="modal fade bs-example-modal-lg" id="modalSearch" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Busqueda por Producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">
                    <!-- Export Datatable start -->
                    <div class="card-box mb-30">
                        <div class="pd-20">
                            {{-- <h4 class="text-blue h4">Detalle de Productos</h4> --}}
                        </div>
                        <div class="pb-20">
                            <table class="table hover multiple-select-row data-table-export nowrap" id="cDetalle">
                                <thead>
                                    <tr>
                                        {{-- <th class="table-plus datatable-nosort">Name</th> --}}
                                        <th>ID</th>
                                        <th>Fecha</th>
                                        <th>Producto</th>
                                        <th>Descripcion</th>

                                        <th>Cantidad</th>
                                        <th>Precio</th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Export Datatable End -->


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                    {{-- <button type="submit" class="btn btn-primary">Guardar</button> --}}
                </div>

            </div>
        </div>
    </div>
    <!-- End modal detalle de traspaso -->




@endsection
@section('sripts')
    <script src="{{ asset('assets/lte/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/lte/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/lte/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/lte/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/lte/src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function() {

            var table = $('#tcompra').DataTable({
                responsive: true,
                autoWidth: false,
                //serverSide: true,
                ajax: "api/compra",
                columns: [

                    {
                        data: 'id_compra',
                        name: 'c.id_compra'
                    },
                    {
                        data: 'f_compra',
                        name: 'c.f_compra',
                        render: function(data) {
                            return moment(data).format('DD/MM/YYYY HH:MM');
                        }
                    },
                    {
                        data: 'nombre',
                        name: 'pr.nombre'
                    },
                    {
                        data: 'name',
                        name: 'u.name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('body').on('click', '.deleteCompra', function() {
                var id = $(this).data('id');
                console.log(id);
                var mensaje = confirm("¿Desea Eliminar la Compra ?");
                if (mensaje) {

                    $.ajax({
                        type: "DELETE",
                        url: "/compra/" + id,
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response == 'ok') {
                                alert('Compra Eliminada');
                            } else {
                                alert('Error al Eliminar Compra');
                            }
                            table.clear();
                            table.draw();


                        },
                        error: function(error) {
                            // console.log(error.responseJSON.message);
                            console.log(error)
                            alert('Error al Eliminar exite dependencias');
                        }
                    });
                }

            });

            // search busqueda por nombre de producto



            $('#cDetalle').DataTable({


                responsive: true,
                autoWidth: false,
                processing: true,
                retrieve: true,
              //  serverSide: true,
                ajax: "api/compra_detalle",
                columns: [

                    {
                        data: 'id_compra',
                        name: 'c.id_compra'
                    },
                    {
                        data: 'f_compra',
                        name: 'c.f_compra',
                        render: function(data) {
                            return moment(data).format('DD/MM/YYYY');
                        }
                    },
                    {
                        data: 'nombre',
                        name: 'p.nombre'
                    },
                    {
                        data: 'descripcion',
                        name: 'p.descripcion',
                        visible: false
                    },
                    {
                        data: 'cantidad',
                        name: 'dc.cantidad'
                    },
                    {
                        data: 'precio',
                        name: 'dc.precio'
                    }
                ]
            });

            $('#cDetalle td').css('white-space', 'initial');

        });

    </script>
@endsection
