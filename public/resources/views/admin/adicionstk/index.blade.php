@extends('theme.lte.layout')
@section('titulo')
    Adicion Stock
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lte/vendors/jquery-ui/jquery-ui.min.css') }}">
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

        #cDetalle td {
            white-space: inherit;
        }

    </style>
@endsection


@section('header')
    Adicion Stock
@endsection

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
            {{-- <a href="#" class="btn btn-primary btn-sm scroll-click" data-toggle="modal" data-target="#mtraspaso" type="button">
            <i class="fa fa-plus"></i> Nueva Traspaso
        </a> --}}
            <a href="{{ route('sucursal_adicion.create') }}" class="btn btn-primary btn-sm scroll-click"><i
                    class="fa fa-plus"></i>
                Adicion Stock</a>
            <a href="#" class="btn btn-info btn-sm busc" data-toggle="modal" data-target="#modalSearch" type="button">
                <i class="icon-copy fi-magnifying-glass"></i>
            </a>
        </div>
    </div>
    <!-- datatable -->
    <table id="traspaso" class="data-table table nowrap">
        <thead>
            <tr>
                {{-- <th scope="col">#</th> --}}
                {{-- <th scope="col">sc</th> --}}
                <th scope="col">Sucursal</th>
                {{-- <th scope="col">Sucursal Destino</th> --}}
                <th scope="col">Fecha</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        </tbody>

    </table>
    <!--end data table -->
    <!-- Modal  tRASPASO-->
    <div class="modal fade" id="mtraspaso" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Traspaso</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form id="AddTraspaso">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Sucursal Origen</label>
                                    <select class="custom-select col-12" name="id_sucursal1">
                                        <option selected="">seleccione sucursal...</option>
                                        @foreach ($sucursales as $sucursal)
                                            <option value=" {{ $sucursal->id_sucursal }}">
                                                {{ $sucursal->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Sucursal Destino</label>
                                    <select class="custom-select col-12" name="id_sucursal2">
                                        <option selected="">seleccione sucursal...</option>
                                        @foreach ($sucursales as $sucursal)
                                            <option value=" {{ $sucursal->id_sucursal }}">
                                                {{ $sucursal->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Fecha</label>
                                    <input type="date" class="form-control" name="fecha">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--end modal -->

    <!-- Modal AddProducto  (mAddProducto  AddFormProducto) -->
    <div class="modal fade bs-example-modal-lg" id="mAddProducto" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Traspaso de Producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form id="AddFormProducto">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_traspaso" id="id_traspaso">
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label>Productos de Sucursal Origen</label>
                                    {{-- <select class="custom-select col-12" name="id_producto" id="id_producto">
                                <option selected="">seleccione sucursal...</option>
                            </select> --}}
                                    <input class="form-control" type="text" placeholder="ID - NOMBRE PRODUCTO" id="search"
                                        name="search">
                                </div>
                                <p id="stock_p" name="stock_p">Stock ...</p>
                                <p id="desc" name="desc">Descripcion ...</p>
                                <input type="hidden" id="id_producto" name="id_producto">
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <img src="" width="150" height="150" alt="" id="mi_imagen">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-11 col-sm-12">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <input type="number" class="form-control" name="cantidad" id="cantidad" value="0"
                                        required>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal AddProducto -->

    <!-- Modal detalle de traspaso mdetalletraspaso-->

    {{-- <div class="modal fade" id="mdetalletraspaso" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" > --}}
    <div class="modal fade bs-example-modal-lg" id="mdetalletraspaso" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Detalle Adicion</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">
                    <!-- Export Datatable start -->
                    <div class="card-box mb-30">
                        <div class="pd-20">
                            {{-- <h4 class="text-blue h4">Detalle de Productos</h4> --}}
                        </div>
                        <div class="pb-20">
                            <table class="table hover multiple-select-row data-table-export nowrap" id="tDetalleTraspaso">
                                <thead>
                                    <tr>
                                        {{-- <th class="table-plus datatable-nosort">Name</th> --}}
                                        <th class="table-plus datatable-nosort">#</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th></th>
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


    <div class="modal fade" id="mDeleteTraspaso" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h5 class="padding-top-30 mb-30 weight-500">Desea Eliminar Producto?</h5>
                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                        <div class="col-6">
                            <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal"><i class="fa fa-times"></i></button>
                            NO
                        </div>

                        <div class="col-6">
                            <form id="deleteFormDetalleTraspaso">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" id="id" disabled>
                                <button type="submit"
                                    class="btn btn-primary border-radius-100 btn-block confirmation-btn"><i
                                        class="fa fa-check"></i></button>
                                SI
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- -->
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
                                        {{-- <th>Precio</th> --}}

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

    {{-- <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script> --}}
    <script src="{{ asset('assets/lte/vendors/jquery-ui/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('assets/lte/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/lte/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/lte/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/lte/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    {{-- <script src="{{asset('assets/lte/src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/lte/src/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/lte/src/plugins/datatables/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/lte/src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/lte/src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/lte/src/plugins/datatables/js/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/lte/src/plugins/datatables/js/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/lte/vendors/scripts/datatable-setting.js')}}"></script> --}}

    <script type="text/javascript">
        $(document).ready(function() {

            var table = $('#traspaso').DataTable({
                responsive: true,
                autoWidth: false,
                serverSide: true,

                ajax: "api/adicion",
                columns: [


                    {
                        data: 'nombre',
                        name: 'nombre'
                    },

                    {
                        data: 'date',
                        name: 'date',
                        /*  render: function(data) {
                             return moment(data).format('DD/MM/YYYY');
                         } */
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // add traspaso
            $('#AddTraspaso').on('submit', function(e) {
                e.preventDefault();
                // console.log(e);
                $.ajax({
                    type: "POST",
                    url: "/traspaso",
                    data: $('#AddTraspaso').serialize(),
                    succes: function(data) {
                        respose(data)
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

                $('#mtraspaso').modal('hide');
                table.clear();
                table.draw();
            });

            // add Producto tipo x modal // select Dinamico

            $('body').on('click', '.addProductos', function() {
                var id = $(this).data('id');
                console.log(id);
                $('#id_traspaso').val(id);
                $('#mAddProducto').modal('show');

                //$("#id_producto").empty().append("<option>Seleccione Producto ...</option>");
                // Select dinamico  cargando productos por sucursal origen
                /*  $.ajax({
                     type:"GET",
                     url:"api/productos_sucursal/"+id,
                     success: function( response){
                         let select = $("#id_producto")
                         $.each(response, function(key, option){
                         select.append($("<option></option>").val(option["id_producto"]).text(option["nombre"]) );
                         })
                     },
                     error: function(error){
                         console.log(error)
                     }
                  }); */



                $('#search').autocomplete({

                    source: function(request, response) {
                        $.ajax({
                            // type:'Get',
                            url: "/search/productoSucursal/" +
                                id, //"{{ route('search.productoSucursal', 'id') }}",
                            dataType: 'json',
                            data: {
                                term: request.term,
                            },
                            success: function(data) {
                                response(data)
                                //console.log(data.id);
                            },
                        });
                    },
                    appendTo: "#mAddProducto",
                    select: function(event, ui) {
                        event.preventDefault();
                        console.log(ui.item);
                        $('#stock_p').text('Stock: ' + ui.item.stock);
                        $('#id_producto').val(ui.item.id);
                        $('#desc').text('Descripción: ' + ui.item.descripcion);
                        $("#mi_imagen").attr("src", ui.item.foto);


                    }
                });

            });



            $('#AddFormProducto').on('submit', function(e) {
                e.preventDefault();
                // console.log(e);
                $.ajax({
                    type: "POST",
                    url: "/detalle_traspaso",
                    data: $('#AddFormProducto').serialize(),
                    success: function(response) {
                        // $('#mAddProducto').modal('hide');

                        if (response == 'ok') {
                            alert('Traspaso realizado correctamente');
                            $('#cantidad').val('0');
                            $('#stock_p').text('Stock.');
                            $('#desc').text('Descripcion .');
                            $('#search').val('');
                            $("#mi_imagen").attr("src", "");
                        } else {
                            if (response == 'stock') {
                                alert('La cantidad supera al Stock ');
                            } else {
                                alert('La cantidad debe ser mayor a 0');
                            }

                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            });

            // RECUPERANDO DATOS DEtalle de traspaso
            $('#mdetalletraspaso').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var fecha = button.data('fecha');
                var suc = button.data('suc');
                console.log(fecha);
                console.log(suc);
                $('#tDetalleTraspaso').DataTable().destroy();
                $('#tDetalleTraspaso').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ],
                    responsive: true,
                    autoWidth: false,
                    processing: true,
                    retrieve: true,
                    serverSide: true,
                    ajax: "api/adicion_detalle/" +
                        fecha + "/" + suc, //url: "{{ route('search.productos') }}",
                    columns: [
                        //{data: 'id'},
                        {
                            data: 'foto',
                            searchable: false,
                            "render": function(data, type, JsonResultRow, meta) {
                                return '<img  width="70" height="70" src="' + JsonResultRow
                                    .foto + '">';
                            }
                        },
                        {
                            data: 'nombre',
                            name: 'p.nombre'
                        },
                        {
                            data: 'cantidad',
                            name: 'spa.cantidad'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },

                    ]
                });

            });


            // RECUPERANDO DATOS MODAL PARA ELIMINAR PRODUCTO DEL DETALLE
            $('body').on('click', '.deleteDetalleTraspado', function() {
                var id = $(this).data('id');
                console.log(id)
                $('#mDeleteTraspaso').modal('show');
                $('#id').val(id);
            });

            //ELIMINANDO PRODUCTO DEL DETALLE
            $('#deleteFormDetalleTraspaso').on('submit', function(e) {
                e.preventDefault();
                var id = $('#id').val();

                $.ajax({
                    type: "DELETE",
                    url: "/sucursal_adicion/" + id,
                    data: $('#deleteFormDetalleTraspaso').serialize(),
                    success: function(response) {
                        if (response == 'ok') {
                            //  console.log(response);
                            $('#mDeleteTraspaso').modal('hide');
                            $('#tDetalleTraspaso').DataTable().draw();
                        }


                    },
                    error: function(error) {

                        alert('Error al Eliminar Producto en la Sucursal');
                    }
                });
            });

            // ELIMINANDO TODO EL TRASPASO
            $('body').on('click', '.deleteTrasp', function() {
                var id = $(this).data('id');
                console.log(id);
                var mensaje = confirm("¿Desea Eliminar el Traspaso ?");
                if (mensaje) {

                    $.ajax({
                        type: "DELETE",
                        url: "/traspaso/" + id,
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            console.log(response);
                            if (response == 'ok') {
                                alert('Traspaso Eliminada');
                            } else {
                                alert('Error al Eliminar Traspaso');
                            }
                            table.clear();
                            table.draw();

                            $('#cDetalle').DataTable().clear();
                            $('#cDetalle').DataTable().draw();



                        },
                        error: function(error) {
                            // console.log(error.responseJSON.message);
                            console.log(error)
                            alert('Error al Eliminar exite dependencias');
                        }
                    });
                }

            });
            $(".busc").click(function() {


                $('#cDetalle').DataTable({


                    responsive: true,
                    autoWidth: false,
                    processing: true,
                    retrieve: true,
                    serverSide: true,
                    ajax: "api/adicion_search",
                    columns: [

                        {
                            data: 'id',
                            name: 'spa.id'
                        },
                        {
                            data: 'fecha',
                            name: 'spa.fecha',
                            /*  render: function(data) {
                                 return moment(data).format('DD/MM/YYYY');
                             } */
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
                            name: 'spa.cantidad'
                        },

                    ]
                });

                $('#cDetalle td').css('white-space', 'initial');
            });



        });
    </script>
@endsection
