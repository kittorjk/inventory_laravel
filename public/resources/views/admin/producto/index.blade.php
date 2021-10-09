@extends('theme.lte.layout')
@section('titulo')
    Producto
@endsection
@section('styles')

    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/lte/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/lte/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('header')
    Producto
@endsection



@section('contenido')

    {{-- <div class="card-box mb-30">
        <h2 class="h4 pd-20">Listado de Productos</h2>
    </div> --}}

    <div class="clearfix mb-20">
        <div class="pull-right">
            <a href="{{ route('producto.create') }}" class="btn btn-primary btn-sm scroll-click" type="button">
                <i class="fa fa-plus"></i> Nuevo producto
            </a>
        </div>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Listado de Productos</h4>
        </div>
        <div class="pb-20">
            <table id="producto" class="data-table table nowrap">
                <thead>
                    <tr>
                        {{-- <th scope="col" >#</th> --}}
                        <th>Producto</th>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Stock Minimo</th>
                        <th scope="col">Precio compra</th>
                        <th scope="col">Stock Inicial</th>
                        <th scope="col" title="Precio de venta 1">PV1</th>
                        <th scope="col" title="Precio de venta 2">PV2</th>
                        <th scope="col" title="Precio de venta 3">PV3</th>
                        <th class="datatable-nosort">Accion</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL DETALLE DE PRODUCTO -->
    <div class="modal fade bs-example-modal-lg" id="Medium-modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <p><B>ID PRODUCTO</B></p>
                            <p id="uno1" name="uno1"></p>
                            <p><B>NOMBRE</B></p>
                            <p id="uno" name="uno"></p>

                            <p><b>DESCRIPCION</b></p>
                            <p id="dos" name="dos"></p>

                            <p><b>STOCK</b></p>
                            <p id="tres" name="tres"></p>

                            <p><b>STOCK MINIMO</b></p>
                            <p id="cuatro" name="cuatro"></p>

                            <p> <b>PRECIO COMPRA</b></p>
                            <p id="cinco" name="cinco"></p>

                            <p><b>STOCK INICIAL</b></p>
                            <p id="seis" name="seis"></p>
                            <p><b>PRE_1</b></p>
                            <p id="siete" name="siete"></p>
                            <p><b>PRE_2</b></p>
                            <p id="ocho" name="ocho"></p>
                            <p><b>PRE_3</b></p>
                            <p id="nueve" name="nueve"></p>

                        </div>
                        <div class="col-md-6 col-sm-12">
                            <img src="" alt="" id="mi_imagen">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- -->

    <!-- The Modal -->
    <!-- MODAL DETALLE -->
    <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h4 class="modal-title" id="myLargeModalLabel"></h4> --}}
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" align="center">
                    <img src="" alt="" id="mi_imagen1" height="50%" width="50%">

                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> --}}
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- -->

    <div id="myModal1" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body"><img
                        src="http://static.batanga.com/sites/default/files/styles/full/public/universo-observable-en-una-imagen-3.png?itok=sBpiT7gx"
                        class="img-rounded" alt="Cinque Terre" width="304" height="236" /> </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    @endsection

    @section('sripts')

        <script src="{{ asset('assets/lte/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/lte/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/lte/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/lte/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {

                var table = $('#producto').DataTable({
                    responsive: true,
                    autoWidth: false,
                    serverSide: true,
                    ajax: "/api/productodt",
                    columns: [
                        /*    {data: 'id_producto'},  onmouseover="this.src='/ico/view.hover.png'" onmouseout="this.src='/ico/view.png'"*/
                        {
                            data: 'foto',
                            searchable: false,
                            "render": function(data, type, JsonResultRow, meta) {
                                return '<img id="idimg" width="70" height="70" src="' +
                                    JsonResultRow.foto + '">';
                            }
                        },
                        {
                            data: 'id_producto'
                        },
                        {
                            data: 'nombre',
                            //  width: "40px",
                        },
                        {
                            data: 'descripcion',
                            //width: "20%",
                            visible: false
                        },
                        {
                            data: 'stock',
                            //width: "20%",
                        },
                        {
                            data: 'stock_minimo',
                            visible: false
                        },
                        {
                            data: 'precio_compra'
                        },
                        {
                            data: 'stock_inicial',
                            visible: false
                        },
                        {
                            data: 'pre1'
                        },
                        {
                            data: 'pre2'
                        },
                        {
                            data: 'pre3'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
                table.columns.adjust().draw();

                // DETALLE MODAL DE PRODUCTO

                $('body').on('click', '.verProducto', function() {
                    var id = $(this).data('id_producto');
                    console.log(id);

                    $.ajax({
                        type: "GET",
                        url: "/api/producto/" + id,
                        success: function(response) {
                            // console.log(response);
                            $('#Medium-modal').modal('show');
                            $('#uno1').text(response['id_producto']);
                            $('#uno').text(response['nombre']);
                            $('#dos').text(response['descripcion']);
                            $('#tres').text(response['stock']);
                            $('#cuatro').text(response['stock_minimo']);
                            $('#cinco').text(response['precio_compra']);
                            $('#seis').text(response['stock_inicial']);
                            $('#siete').text(response['pre1']);
                            $('#ocho').text(response['pre2']);
                            $('#nueve').text(response['pre3']);
                            $("#mi_imagen").attr("src", response['foto']);
                        },
                        error: function(error) {
                            console.log(error)
                        }
                    });
                });

                $('body').on('click', '.deleteProducto', function() {
                    var id = $(this).data('id_producto');
                    console.log(id);
                    var mensaje = confirm("¿Desea Eliminar Producto?");
                    if (mensaje) {
                        $.ajax({
                            type: "DELETE",
                            url: "producto/" + id,
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                if (response == 'ok') {
                                    alert('Eliminado corecctamente');
                                } else {
                                    alert('Error al Eliminar exite dependencias');
                                }

                                table.clear();
                                table.draw();

                            },
                            error: function(error) {
                                // console.log(error.responseJSON.message);
                                console.log(error)
                                alert('Error al Eliminar Producto, exite dependencias');
                            }
                        });
                    }
                });

                // mostrar imagen en modal
                $('body').on('mouseover', '#idimg', function() {
                    $("#mi_imagen1").attr("src", $(this).attr("src"));
                    //console.log($(this).attr("src"));
                    $("#myModal").modal('show');
                });

                $('body').on('mouseover', '#myModal', function() {
                    //$("#mi_imagen1").attr("src",$(this).attr("src"));
                    //console.log($(this).attr("src"));
                    $("#myModal").modal('hide');
                });

            });
        </script>
    @endsection
