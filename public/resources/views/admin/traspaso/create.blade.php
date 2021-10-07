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
    Nuevo Traspaso Sucursal - Sucursal
@endsection

@section('contenido')
    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-form-label">Sucursal Origen</label>
        <div class="col-sm-12 col-md-10">
            <select class="custom-select col-12" id="id_sucursal1" name="id_sucursal1">
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





    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4" id="lts">Listado Productos</h4>
        </div>
        <div class="pb-20">
            <table id="tproductos" class="data-table table nowrap">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Stock</th>
                    </tr>
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
                    <h4 class="modal-title" id="myLargeModalLabel">Adicionar Sucursal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form id="AddFormSucursal">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_producto" id="id_producto" required>
                        {{-- <input type="hidden" name="id_sucursal" id="id_sucursal" > --}}
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label>Producto</label>
                                    <input class="form-control" type="text" id="nombre" name="nombre" disabled>

                                </div>
                                <p id="stock_p" name="stock_p" style="color:green;">Stock ... </p>
                                <p id="desc" name="desc">Descripcion ...</p>

                            </div>
                            <div class="col-md-4 col-sm-12">
                                <img src="" width="150" height="150" alt="" id="mi_imagen">
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Fecha</label>
                                    <input type="text" class="form-control" name="fecha" id="fecha" disabled>
                                </div>
                            </div>



                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <input type="number" class="form-control" value="0" name="cantidad" id="cantidad">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Precio 1</label>
                                    <input type="text" class="form-control" value="0" name="pre1" id="pre1" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Precio 2</label>
                                    <input type="text" class="form-control" value="0" name="pre2" id="pre2" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Precio 3</label>
                                    <input type="text" class="form-control" value="0" name="pre3" id="pre3" required>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="agregar" class="btn btn-primary">Agregar a Sucursal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MODAL ADDSUCURSAL-->

    <!-- Export Datatable start -->
    <form method="post" action="{{ route('traspaso.traspasar') }}">
        @csrf


        <input type="hidden" name="idorigen" id="idorigen">
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Sucursal Destino</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" id="id_sucursal2" name="id_sucursal2">
                            {{-- <select class="selectpicker" id="sucursal" data-live-search="true"> --}}
                            <option selected="">seleccione sucursal...</option>
                            {{-- @foreach ($sucursales as $sucursal)
                                <option value=" {{ $sucursal->id_sucursal }}">
                                    {{ $sucursal->nombre }}
                                </option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
            </div>

            <div class="pd-20">
                <h4 class="text-blue h4" id="lts1">Listado Productos a Traspasar ... </h4>
            </div>
            <div class="pb-20">
                <table class="table" id="detalles">
                    <thead>
                        <tr>
                            {{-- <th class="table-plus datatable-nosort">Name</th> --}}

                            <th>Eliminar</th>
                            <th>Producto</th>
                            {{-- <th>Precio</th> --}}
                            <th>Cantidad</th>
                            <th>Pre1</th>
                            <th>Pre2</th>
                            <th>Pre3</th>
                            {{-- <th>Sub Total</th> --}}
                        </tr>
                    </thead>
                    <tfoot>
                        {{-- <tr>
                    <th  colspan="4"><p align="right">TOTAL:</p></th>
                    <th><p align="right"><span id="total">Bs. 0.00</span> </p></th>
                </tr> --}}
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
                Traspasar
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

        <script type="text/javascript">
            $(document).ready(function() {
                var f = new Date();
                $("#fecha").val(f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear());



                $("#id_sucursal1").change(function() {

                    var id = $(this).val();
                    $("#idorigen").val(id);
                    var sucursal = $('select[name="id_sucursal1"] option:selected').text();
                    console.log(id);

                    if (id.length <= 10) {

                        // cargando select destino
                        $("#id_sucursal2").empty().append("<option>Seleccione Producto ...</option>");
                        $.ajax({
                            type: "GET",
                            url: "/api/sucursales/" + id,
                            success: function(response) {
                                let select = $("#id_sucursal2")
                                $.each(response, function(key, option) {
                                    select.append($("<option></option>").val(option[
                                        "id_sucursal"]).text(
                                        option["nombre"]));
                                })
                            },
                            error: function(error) {
                                console.log(error)
                            }
                        });
                        $('#lts').text('Listado Productos de -' + sucursal);

                        // cargando en un dataTable tproductosAgregados
                        $('#tproductos').DataTable().destroy();
                        $('#tproductos').DataTable({
                            responsive: true,
                            autoWidth: false,
                            processing: true,
                            retrieve: true,
                            serverSide: true,
                            ajax: "/api/sucursal_productos/" +
                                id, //url: "{{ route('search.productos') }}",
                            columns: [{
                                    data: 'foto',
                                    searchable: false,
                                    "render": function(data, type, JsonResultRow, meta) {
                                        return '<img  width="70" height="70" src="' +
                                            JsonResultRow.foto + '">';
                                    }
                                },
                                {
                                    data: 'nombre',
                                    name: 'p.nombre'
                                },
                                {
                                    data: 'stock',
                                    searchable: false
                                }
                            ]
                        });
                    } else {
                        $("#id_sucursal2").empty().append("<option>Seleccione Producto ...</option>");
                        $('#lts').text('Listado Productos ...');
                        $("#idorigen").val("");
                        $('#tproductos').DataTable().destroy();
                        $('#tproductos').DataTable().clear();
                        $('#tproductos').DataTable().draw();
                        //$('.zonalink').attr('href','');
                    }




                });

                $('#tproductos tbody').on('click', 'tr', function() {
                    var data = $('#tproductos').DataTable().row(this).data();
                    console.log(data);
                    if (data["stock"] > 0) {

                        if ($(this).hasClass('selected')) {
                            $(this).removeClass('selected');
                        } else {
                            $('#tproductos').DataTable().$('tr.selected').removeClass('selected');
                            $(this).addClass('selected');
                        }

                        $("#dProducto").modal('show');
                        var data = $('#tproductos').DataTable().row(this).data();

                        $('#id_producto').val(data["id_producto"]);
                        $('#nombre').val(data['nombre']);
                        $('#desc').text('Descripcion : ' + data['descripcion']);
                        $('#stock_p').text('Stock en Sucursal origen: ' + data['stock']);
                        $("#mi_imagen").attr("src", data['foto']);
                        $("#pre1").val(data['pre1']);
                        $("#pre2").val(data['pre2']);
                        $("#pre3").val(data['pre3']);

                    } else {
                        alert("Stock de producto seleccionado debe ser > 0")
                    }



                    //console.log(data);
                });

                $("#id_sucursal2").change(function() {
                    //console.log($('#detalles tr').length);
                    var id = $(this).val();
                    // console.log(id);
                    if (id.length <= 10 && $('#detalles tr').length > 1) {
                        $("#guardar").show();
                    } else {
                        $("#guardar").hide();
                    }

                });

                $("#agregar").click(function() {
                    agregar();

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

                produ = $("#nombre").val();
                stk = $("#stock_p").text().split(" ")[4];

                pre1 = $("#pre1").val();
                pre2 = $("#pre2").val();
                pre3 = $("#pre3").val();
                //console.log(stk)

                if (id_producto != "" && cantidad != "" && cantidad > 0) {
                    if ((stk - cantidad) >= 0) {
                        var fila = '<tr class="selected" id="fila' + cont +
                            '"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                            ');"><i class="fa fa-times fa-2x"></i></button></td> <td ><input type="hidden" name="id_producto[]" value="' +
                            id_producto + '">' + producto + '</td> <td><input type="hidden" name="cantidad[]" value="' +
                            cantidad + '">' + cantidad + ' </td><td> <input type="hidden" name="pre1[]" value="' +
                            pre1 + '">' + pre1 + '</td><td><input type="hidden" name="pre2[]" value="' + pre2 +
                            '">' + pre2 + '</td><td><input type="hidden" name="pre3[]" value="' + pre3 +
                            '">' + pre3 + '</td></tr>';
                        cont++;
                        limpiar();
                        $('#detalles').append(fila);
                        $('#dProducto').modal('hide');
                        evaluar();
                    } else {
                        alert("La cantidad no debe sobre pasar al Stock Sucursal Origen ");
                    }


                } else {

                    alert("Debe de llenar  todos los campos, cantidad mayores a 0 ");

                }
            }

            function limpiar() {
                $("#cantidad").val("0");
                $("#stock").val("");
                $("#nombre").val("");
                $("#mi_imagen").attr("src", "");
                $('#desc').text('Descripcion : ... ');
                $("#pre1").val(0);
                $("#pre2").val(0);
                $("#pre3").val(0);

            }


            function evaluar() {

                if ($("#id_sucursal2").val().length <= 10 && $('#detalles tr').length > 1) {

                    $("#guardar").show();

                } else {

                    $("#guardar").hide();
                }
            }

            function eliminar(index) {
                $("#fila" + index).remove();
                evaluar();
            }
        </script>
    @endsection
