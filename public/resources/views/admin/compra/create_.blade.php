@extends('theme.lte.layout')
@section('titulo')
    Crear Compra
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/lte/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/lte/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lte/vendors/styles/style.css') }}">
@endsection

@section('header')
    Crear Compra
@endsection


@section('contenido')
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4" id="lts">Listado Productos ... </h4>
        </div>
        <div class="pb-20">
            <table id="producto" class="data-table table nowrap">
                <thead>
                    <th>#</th>
                    <th>ID</th>
                    {{-- <th>Cod Barra</th> --}}
                    <th>Producto</th>
                    <th>Descripcion</th>
                    <th scope="col">Stock</th>

                </thead>

                <tbody>
                </tbody>

            </table>
        </div>
    </div>

    <!-- MODAL ADDSUCURSAL-->
    <div class="modal fade bs-example-modal-lg" id="dProducto" name="dProducto" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Datos de Producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">


                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="form-group">
                                <label>Producto</label>
                                <input class="form-control" type="text" id="nombre" name="nombre" disabled>
                                <input class="form-control" type="hidden" id="id_producto" name="id_producto">
                            </div>
                            <p id="desc" name="desc">Descripcion ...</p>

                        </div>
                        <div class="col-md-4 col-sm-12">
                            <img src="" width="150" height="150" alt="" id="mi_imagen">
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="number" class="form-control" name="stock" id="stock" disabled>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Precio Compra</label>
                                <input type="text" class="form-control" name="precio_compra" id="precio_compra" required>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Cantidad</label>
                                <input type="number" class="form-control" value="0" name="cantidad" id="cantidad" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Precio 1</label>
                                <input type="number" class="form-control" value="0" name="pre1" id="pre1" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Precio 2</label>
                                <input type="number" class="form-control" value="0" name="pre2" id="pre2" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Precio 3</label>
                                <input type="number" class="form-control" value="0" name="pre3" id="pre3" required>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="agregar" class="btn btn-primary"><i class="icon-copy fa fa-cart-arrow-down"
                            aria-hidden="true"></i> Adicionar a compra</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MODAL ADDSUCURSAL-->



    <!-- Export Datatable start -->
    <form method="post" action="{{ route('compra.store') }}">
        @csrf

        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="form-group">
                    <label>Proveedor</label>
                    <select class="form-control" name="id_proveedor" id="id_proveedor" required>
                        <option selected="">Seleccione Proveeedor...</option>
                        @foreach ($proveedores as $proveedor)
                            <option value=" {{ $proveedor->id_proveedor }}">
                                {{ $proveedor->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="pd-20">
                <h4 class="text-blue h4">Listado de Compras a Proveedores</h4>
            </div>
            <div class="pb-20">
                <table class="table" id="detalles">
                    <thead>
                        <tr>
                            {{-- <th class="table-plus datatable-nosort">Name</th> --}}

                            <th>Eliminar</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="4">
                                <p align="right">TOTAL:</p>
                            </th>
                            <th>
                                <p align="right"><span id="total">Bs. 0.00</span> </p>
                            </th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Export Datatable End -->
        <div id="guardar">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">
                <i class="fa fa-save"></i>
                Comprar
            </button>
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
        {{-- <script src="{{asset('assets/lte/src/plugins/datatables/js/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/lte/vendors/scripts/datatable-setting.js')}}"></script> --}}

        <script type="text/javascript">
            $(document).ready(function() {

                var table = $('#producto').DataTable({
                    responsive: true,
                    autoWidth: false,
                    serverSide: true,
                    responsive: true,
                    ajax: "/api/productodt",
                    columns: [

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
                            data: 'nombre'
                        },
                        {
                            data: 'descripcion',
                            visible: false
                        },
                        {
                            data: 'stock'
                        },
                    ]
                });



                $('#producto tbody').on('click', 'tr', function() {

                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected');
                    } else {
                        table.$('tr.selected').removeClass('selected');
                        $(this).addClass('selected');
                    }
                    var data = table.row(this).data();
                    // console.log(data);

                    $.ajax({
                        type: "GET",
                        url: "/api/producto/" + data["id_producto"],
                        success: function(response) {
                            $('#dProducto').modal('show');
                            $('#id_producto').val(data["id_producto"]);
                            $('#nombre').val(response['nombre']);
                            $('#desc').text('Descripcion : ' + response['descripcion']);
                            $('#stock').val(response['stock']);
                            $('#precio_compra').val(response['precio_compra']);
                            $("#mi_imagen").attr("src", response['foto']);
                        },
                        error: function(error) {
                            console.log(error)
                        }
                    });
                    //$('#nombre').val(data["descripcion"]);
                    //alert( 'You clicked on '+data[1]+'\'s row' );
                });

                $("#id_proveedor").change(function() {
                    var id = $(this).val();
                     //console.log($("#detalles tr").length);
                    // console.log(id)
                    //console.log($("#total").html().split(" ")[1]);
                   // if (id.length <= 10 && $("#total").html().split(" ")[1] !== "0.00") {
                    if (id.length <= 10 && $("#detalles tr").length > 2) {
                        $("#guardar").show();
                    } else {
                        $("#guardar").hide();
                    }

                });

                $("#agregar").click(function() {
                    agregar();
                    //$('#producto').DataTable().search('').draw();
                });
            });

            var cont = 0;
            total = 0;
            subtotal = [];
            $("#guardar").hide();

            function agregar() {

                id_producto = $("#id_producto").val();
                // producto= $("#id_producto option:selected").text();
                producto = $("#nombre").val();
                cantidad = $("#cantidad").val();
                precio_compra = $("#precio_compra").val();
                pre1 = $("#pre1").val();
                pre2 = $("#pre2").val();
                pre3 = $("#pre3").val();
                produ = $("#nombre").val();

                if (id_producto != "" && cantidad != "" && cantidad >= 0 && precio_compra != "" && produ.length > 4 &&
                    pre1 != "" && pre1 > 0 && pre2 != "" && pre2 > 0 && pre3 != "" && pre3 > 0) {


                    subtotal[cont] = cantidad * precio_compra;
                    total = total + subtotal[cont];

                    var fila = '<tr class="selected" id="fila' + cont +
                        '"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                        ');"><i class="fa fa-times fa-2x"></i></button></td> <td><input type="hidden" name="pre1[]" value="' +
                        pre1 + '"><input type="hidden" name="pre2[]" value="' + pre2 +
                        '"><input type="hidden" name="pre3[]" value="' + pre3 +
                        '"><input type="hidden" name="id_producto[]" value="' + id_producto + '">' + producto +
                        '</td>  <td><input  type="hidden" id="precio_compra[]" name="precio_compra[]"  value="' +
                        precio_compra + '">' +
                        precio_compra + ' </td>  <td><input  type="hidden" name="cantidad[]" value="' + cantidad +
                        '">' +
                        cantidad + ' </td> <td>Bs.' + subtotal[cont] + ' </td></tr>';
                    cont++;
                    limpiar();
                    totales();
    
                    evaluar();
                    $('#detalles').append(fila);
                    $('#dProducto').modal('hide');
                    $('#producto').DataTable().search('').draw();
                } else {

                   // alert("Debe de llenar  todos los campos, precios y cantidad mayores a 0 ");
                    alert("Debe de llenar  todos los campos, precios mayores  a 0 ");
                    /*  Swal.fire({
                               type: 'error',
                               title: 'Oops...',
                               text: 'Rellene todos los campos del detalle de la compras',
                               });
                     */
                }
            }

            function limpiar() {
                $("#cantidad").val("0");
                $("#precio_compra").val("");
                $("#stock").val("");
                $("#nombre").val("");
                $("#pre1").val("0");
                $("#pre2").val("0");
                $("#pre3").val("0");

                $("#mi_imagen").attr("src", "");
                $('#desc').text('Descripcion : ... ');
            }

            function totales() {
                $("#total").html("Bs. " + total.toFixed(2));
            }

            function evaluar() {

                if (total >= 0 && $("#id_proveedor").val().length <= 10) {
                    console.log($("#id_proveedor").val());
                    $("#guardar").show();

                } else {

                    $("#guardar").hide();
                }
            }

            function eliminar(index) {
                total = total - subtotal[index];
                $("#total").html("Bs." + total);
                $("#fila" + index).remove();
                evaluar();
            }

        </script>
    @endsection
