@extends('theme.lte.layout')
@section('titulo')
    Adicion
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/lte/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/lte/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lte/vendors/styles/style.css') }}">
    <style type="text/css">
        p {
            font-size: 16px;
            font-weight: bold;

        }

        #mSucursalProducto td {
            white-space: inherit;
        }

        #mAddSucursalProducto td {
            white-space: inherit;
        }

    </style>
@endsection


@section('header')
    Adicion Stock a Sucursal
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


    <div class="clearfix mb-20">

        <div class="pull-right">
            {{-- <a href="" class="btn btn-danger rptFecha" target="_blank">
                <i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i>
            </a> --}}

            <a href="" class="btn btn-info zonalink" target="_blank">
                <i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i>
            </a>
            {{-- <a href="#" class="btn btn-info busc" data-toggle="modal" data-target="#modalSearchpProducto" type="button">
                <i class="icon-copy fi-magnifying-glass"></i>
            </a> --}}
        </div>
    </div>

    {{-- <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Listado de Productos Almacen Central</h4>
        </div>
        <div class="pb-20">
            <table id="tproductos" class="data-table table nowrap">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col"> Descripcion</th>
                        <th scope="col">Stock</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div> --}}

    <!-- Export Datatable start -->
    <div class="card-box mb-30">

        <div class="pd-20">
            <h4 class="text-blue h4" id="lts">Listado Productos ... </h4>
            <div class="pull-right">

                {{-- <a href="" class="btn btn-info zonalink" target="_blank">
                    <i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i>
                </a> --}}
                {{-- <a href="#" class="btn btn-info buscAdd" data-toggle="modal" data-target="#modalSearchpAddProducto"
                    type="button"> --}}

                {{-- <a href="" class="btn btn-danger rptFecha" target="_blank">
                    <i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i>
                </a> --}}
                <a href="#" class="btn btn-info buscAdd" data-toggle="modal" data-target="#" type="button">
                    <i class="icon-copy fi-magnifying-glass"></i>
                </a>
            </div>
        </div>
        <div class="pb-20">
            <table class="table hover multiple-select-row data-table-export nowrap" id="tproductosAgregados">
                <thead>
                    <tr>
                        {{-- <th class="table-plus datatable-nosort">Name</th> --}}
                        <th class="table-plus datatable-nosort">Producto</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Stock</th>
                        <th>Stock Min</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Export Datatable End -->

    <!-- MODAL ADDSUCURSAL-->
    <div class="modal fade bs-example-modal-lg" id="maddSucursal" tabindex="-1" role="dialog"
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
                        <input type="hidden" name="id_sucursal" id="id_sucursal">

                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label>Producto</label>
                                    <input class="form-control" type="text" id="nombre" name="nombre" disabled>

                                </div>
                                <p id="stock_p" name="stock_p" style="color:green;">Stock ... </p>
                                <p id="desc" name="desc">Descripcion ...</p>
                                <p id="pre" name="pre">Precio ...</p>

                            </div>
                            <div class="col-md-4 col-sm-12">
                                <img src="" width="150" height="150" alt="" id="mi_imagen">
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Fecha</label>
                                    <input type="text" class="form-control" name="fecha" id="fecha" disabled>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Stock Minimo</label>
                                    <input type="number" class="form-control" value="0" name="stock_min" id="stock_min"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input type="text" class="form-control" value="0" name="stock" id="stock" required>
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
                        <button type="submit" class="btn btn-primary">Agregar a Sucursal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MODAL ADDSUCURSAL-->

    <!-- -->

    <div class="modal fade bs-example-modal-lg" id="mmaddSucursal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Agregar a Sucusal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="input-group custom">
                        <input type="text" class="form-control" placeholder="Username">
                        <div class="input-group-append custom">
                            <span class="input-group-text"></i></span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- -->


    <!-- Modal Deelete Producto en sucursal -->
    <div id="deleteProducto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Eliminar Adicion</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form id="deleteFormProducto">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Ok</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Delete -->

    <!-- Modal  Addicion Stock a sucursal-->
    <div class="modal fade" id="addStock" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Adiccion de Stock </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form id="AddStockSucursal">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_sucursal_producto" id="id_sucursal_producto">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Producto</label>
                                    <input type="text" class="form-control" name="product" id="product" disabled>
                                    <p id="stockal">
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <input type="number" class="form-control" name="cantidad" id="cantidad" required
                                        value="0">
                                </div>
                            </div>
                        </div>


                        {{-- <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Fecha</label>
                                    <input type="text" class="form-control" name="fecha" id="fecha1" required>
                                </div>
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Precio 1</label>
                                    <input type="number" class="form-control" value="0" name="pre11" id="pre11" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Precio 2</label>
                                    <input type="number" class="form-control" value="0" name="pre22" id="pre22" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md- col-sm-12">
                                <div class="form-group">
                                    <label>Precio 3</label>
                                    <input type="number" class="form-control" value="0" name="pre33" id="pre33" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md- col-sm-12">
                                <div class="form-group">
                                    <label>Precio de Compra</label>
                                    <input type="number" class="form-control" value="0" name="precioc" id="precioc"
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

    <!--end modal -->


    <!-- MODAL BUSQUEDA PRODUCTO -->
    <div class="modal fade bs-example-modal-lg" id="modalSearchpProducto" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Buscar Sucursal Producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <!-- Export Datatable start -->
                    <div class="card-box mb-30">
                        <div class="pd-20">
                            {{-- <h4 class="text-blue h4">Detalle de Productos</h4> --}}
                        </div>
                        <div class="pb-20">
                            <table class="table hover multiple-select-row data-table-export nowrap" id="mSucursalProducto">
                                <thead>
                                    <tr>
                                        {{-- <th class="table-plus datatable-nosort">Name</th> --}}
                                        <th>ID</th>
                                        <th>Fecha</th>
                                        <th>Sucursal</th>
                                        <th>Producto</th>
                                        <th>Descripcion</th>
                                        <th>Pre1</th>
                                        <th>Pre2</th>
                                        <th>Pre3</th>
                                        {{-- <th>Precio</th> --}}

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

    <!--end modal -->

    <!-- MODAL BUSQUEDA ADDICION SUCURSAL PRODUCTO -->
    <div class="modal fade bs-example-modal-lg" id="modalSearchpAddProducto" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Buscar Adicion Sucursal Producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <!-- Export Datatable start -->
                    <div class="card-box mb-30">
                        <div class="pd-20">
                            {{-- <h4 class="text-blue h4">Detalle de Productos</h4> --}}
                        </div>
                        <div class="pb-20">
                            <table class="table hover multiple-select-row data-table-export nowrap"
                                id="mAddSucursalProducto">
                                <thead>
                                    <tr>
                                        {{-- <th class="table-plus datatable-nosort">Name</th> --}}
                                        <th>ID</th>
                                        <th>Fecha</th>
                                        <th>Sucursal</th>
                                        <th>Producto</th>
                                        <th>Descripcion</th>
                                        <th>Cantidad</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

    <!--end modal -->
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
        var cursos = ['laravel', 'react', 'flutter', 'html'];

        $(document).ready(function() {


            var f = new Date();
            $("#fecha").val(f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear());
            $("#fecha1").val(f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear());

            // listado de productos
            var table = $('#tproductos').DataTable({
                responsive: true,
                autoWidth: false,
                serverSide: true,
                // select: false,
                ajax: "api/productos", //url: "{{ route('search.productos') }}",
                columns: [{
                        data: 'foto',
                        searchable: false,
                        "render": function(data, type, JsonResultRow, meta) {
                            return '<img id="idimg" width="70" height="70" src="' + JsonResultRow
                                .foto + '">';
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
                    //{data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            // cargando a select sucursales


            // obteviendo valor  select  Sucursales
            $("#sucursal").change(function() {
                var id = $(this).val();
                var sucursal = $('select[name="sucursal"] option:selected').text();
                console.log(sucursal);

                if (id.length <= 10) {
                    $('#lts').text('Listado Productos de -' + sucursal);
                    $('#id_sucursal').val(id);

                    // cargando en un dataTable tproductosAgregados
                    $('#tproductosAgregados').DataTable().destroy();
                    $('#tproductosAgregados').DataTable({
                        /*   dom: 'Bfrtip',
                          buttons: [{

                                  extend: 'colvis',
                                  extend: 'pdfHtml5',

                                  header: true,
                                  title: 'SUCURSAL  - ' + sucursal.trim(),
                              },
                              'copyHtml5',
                              'excelHtml5',
                              'csvHtml5',
                              'pdfHtml5'
                          ], */
                        responsive: true,
                        autoWidth: false,
                        processing: true,
                        retrieve: true,
                        serverSide: true,

                        ajax: "api/sucursal_productos/" +
                            id, //url: "{{ route('search.productos') }}",

                        columns: [

                            // {data: 'id',searchable: false},
                            {
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
                                data: 'fecha',
                                name: 'sp.fecha',
                                render: function(data) {
                                    return moment(data).format('DD/MM/YYYY HH:MM');
                                }
                            },
                            {
                                data: 'stock',
                                searchable: false
                            },
                            {
                                data: 'stock_min',
                                searchable: false
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            },

                        ]
                    });
                    // para el reporte
                    $('.zonalink').attr('href', 'pdfSucursal/' + id.trim());
                    $('.rptFecha').attr('href', 'pdfSucursalFecha/' + id.trim());

                } else {
                    $('#lts').text('Listado Productos ...');
                    $('#id_sucursal').val('');
                    $('#tproductosAgregados').DataTable().destroy();
                    $('#tproductosAgregados').DataTable().clear();
                    $('#tproductosAgregados').DataTable().draw();
                    $('.zonalink').attr('href', '');
                    $('.rptFecha').attr('href', '');
                }


            });
            //  $('#tproductosAgregados td').css('white-space', 'initial');

            // DATOS EN EL MODAL
            $('#tproductos tbody').on('click', 'tr', function() {
                var data = table.row(this).data();

                if (data["stock"] >= 0) {

                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected');
                    } else {
                        table.$('tr.selected').removeClass('selected');
                        $(this).addClass('selected');
                    }

                    $("#maddSucursal").modal('show');
                    $('#id_producto').val(data["id_producto"]);
                    $('#nombre').val(data['nombre']);
                    $('#stock_min').val(data['stock_minimo']);
                    $('#desc').text('Descripcion : ' + data['descripcion']);
                    $('#pre').text('Precio Compra : ' + data['precio_compra']);
                    $('#stock_p').text('Stock en Almacen Central: ' + data['stock']);
                    $("#mi_imagen").attr("src", data['foto']);

                    console.log(data);
                } else {
                    alert("Stok de producto debe ser mayor a cero !!!")
                }
            });


            // Modal Add a sucursal -> recupernado datos

            $('body').on('click', '.addSucursal', function() {
                var id = $(this).data('id');
                console.log(id);
                $('#maddSucursal').modal('show');
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#id_producto').val(data[1]);
                $('#producto').val(data[2]);

            });

            // Add Producto a sucursal DB AddFormSucursal

            $('#AddFormSucursal').on('submit', function(e) {
                e.preventDefault();

                if ($("#id_sucursal").val() == "") {
                    alert("Debe Seleccionar una Sucursal !!!! ");
                    $("#maddSucursal").modal("hide");
                    $('#stock').val('0');
                    $('#stock_min').val('0');
                    $('#pre1').val('0');
                    $('#pre2').val('0');
                    $('#pre3').val('0');

                    $('#desc').text('');
                    $('#pre').text('');
                    $('#stock_p').text('');

                    $("#mi_imagen").attr("src", "");
                    $('#nombre').val('');
                } else {
                    st = $("#stock").val();
                    stm = $("#stock_min").val();
                    p1 = $("#pre1").val();
                    p2 = $("#pre2").val();
                    p3 = $("#pre3").val();
                    if (st >= 0 && stm >= 0 && p1 >= 0 && p2 >= 0 && p3 >= 0) {
                        $.ajax({
                            type: "POST",
                            url: "/sucursal_producto",
                            data: $('#AddFormSucursal').serialize(),
                            success: function(response) {
                                if (response == 'ok') {
                                    // alert('Producto agregado a sucursal correctamente !!!');
                                    $("#maddSucursal").modal("hide");
                                    $('#stock').val('0');
                                    $('#stock_min').val('0');
                                    $('#pre1').val('0');
                                    $('#pre2').val('0');
                                    $('#pre3').val('0');
                                    $('#stockal').text('');

                                    $("#mi_imagen").attr("src", "");
                                    $('#nombre').val('');

                                    $('#tproductos').DataTable().draw();
                                    $('#tproductosAgregados').DataTable().draw();
                                    alert('Producto se traspaso correctamente a sucursal');
                                } else {
                                    if (response == 'false') {

                                        alert(
                                            'Stock agregado no debe ser mayor, al stock de producto en Almacen Central '
                                        );
                                    } else {

                                        alert(response);
                                        $("#maddSucursal").modal("hide");
                                        $('#stock').val('0');
                                        $('#stock_min').val('0');
                                        $('#pre1').val('0');
                                        $('#pre2').val('0');
                                        $('#pre3').val('0');

                                        $('#desc').text('');
                                        $('#pre').text('');
                                        $('#stock_p').text('');

                                        $("#mi_imagen").attr("src", "");
                                        $('#nombre').val('');
                                    }
                                }

                            },
                            error: function(error) {
                                //console.log(error);
                            }
                        });

                    } else {
                        alert("Stocks y precios deben ser mayores a 0  !!!! ")
                    }

                }

            });

            //  eliminar RECUPERNAR DATO

            $('body').on('click', '.deleteSucursalProducto', function() {
                var id = $(this).data('id');
                $('#deleteProducto').modal('show');
                $('#id').val(id);
            });


            // ELIMINANDO
            $('#deleteFormProducto').on('submit', function(e) {
                e.preventDefault();
                var id = $('#id').val();
                $.ajax({
                    type: "DELETE",
                    url: "/sucursal_producto/" + id,
                    data: $('#deleteFormProducto').serialize(),
                    success: function(response) {
                        console.log(response);
                        $('#deleteProducto').modal('hide');
                        $('#tproductosAgregados').DataTable().draw();
                        $('#tproductos').DataTable().draw();

                    },
                    error: function(error) {
                        // console.log(error.responseJSON.message);
                        alert('Error al Eliminar Producto en la Sucursal');
                        $('#deleteProducto').modal('hide');
                    }
                });
            });

            // RECUPERANDO DATOS STOCK A PRODUCTO EN LA SUCURSAL
            $('#addStock').on('show.bs.modal', function(event) {
                console.log('modal abierto');
                var button = $(event.relatedTarget)
                var producto = button.data('producto')
                var id_suc_prod = button.data('id')
                var pre1 = button.data('pre1')
                var pre2 = button.data('pre2')
                var pre3 = button.data('pre3')
                var precio_compra = button.data('precio_compra')
                var stckal = button.data('stockal')
                console.log(stckal)
                var modal = $(this)
                // modal.find('.modal-title').text('New message to ' + recipient)
                modal.find('.modal-body #product').val(producto);
                modal.find('.modal-body #id_sucursal_producto').val(id_suc_prod);
                modal.find('.modal-body #pre11').val(pre1);
                modal.find('.modal-body #pre22').val(pre2);
                modal.find('.modal-body #pre33').val(pre3);
                modal.find('.modal-body #stockal').text("Stock en Almacen Central: " + stckal);
                modal.find('.modal-body #precioc').val(precio_compra);
            });

            // ADICIONANDO STOCK A PRODUCTO EN LA SUCURSAL
            $('#AddStockSucursal').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/sucursal_adicion",
                    data: $('#AddStockSucursal').serialize(),
                    success: function(response) {
                        console.log(response);
                        if (response == 'ok') {
                            alert('Producto Agregado correctamente');
                            $('#addStock').modal('hide');
                            $('#cantidad').val('0');
                            $('#pre11').val('0');
                            $('#pre22').val('0');
                            $('#pre33').val('0');
                            $('#precioc').val('0');
                            $('#tproductosAgregados').DataTable().draw();
                            // $('#table').DataTable().destroy();
                            //$('#table').DataTable().clear();
                            $('#tproductos').DataTable().draw();
                        } else {
                            alert(
                                'Error datos mayor a "0" o cantidad debe ser menor a stock Almacen central'
                            );
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            });

            $(".busc").click(function() {
                //console.log('entroo')
                $('#mSucursalProducto').DataTable().destroy();
                $('#mSucursalProducto').DataTable({
                    responsive: true,
                    autoWidth: false,
                    processing: true,
                    retrieve: true,
                    serverSide: true,
                    ajax: "api/sucursal_producto_search",
                    columns: [

                        {
                            data: 'id',
                            name: 'sp.id'
                        },
                        {
                            data: 'fecha',
                            name: 'sp.fecha',
                            /*  render: function(data) {
                                 return moment(data).format('DD/MM/YYYY');
                             } */
                        },
                        {
                            data: 'sucursal',
                            name: 's.nombre'
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
                            data: 'pre1',
                            name: 'sp.pre1'
                        },
                        {
                            data: 'pre2',
                            name: 'sp.pre2'
                        },
                        {
                            data: 'pre3',
                            name: 'sp.pre3'
                        },

                    ]
                });

                $('#mSucursalProducto td').css('white-space', 'initial');
            });

            // SEARCH ADICION SUCURSAL PRODUCTO
            $(".buscAdd").click(function() {
                //$('#mAddSucursalProducto').DataTable().clear();
                $('#mAddSucursalProducto').DataTable().destroy();
                //console.log('entroo')

                $('#modalSearchpAddProducto').modal('show');
                $('#mAddSucursalProducto').DataTable({
                    responsive: true,
                    autoWidth: false,
                    processing: true,
                    retrieve: true,
                    serverSide: true,
                    ajax: "api/adicion_sucursal_producto_search",
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
                            data: 'sucursal',
                            name: 's.nombre'
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
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },


                    ]
                });

                $('#mAddSucursalProducto td').css('white-space', 'initial');
            });
            // ELIMINANDO ADICION SUCURSAL PRODUCTO

            $('body').on('click', '.deleteAdicion', function() {
                var id = $(this).data('id');
                //console.log(id);
                ///sucursal_adicion
                var mensaje = confirm("¿Desea Eliminar la Adicion ?");
                if (mensaje) {

                    $.ajax({
                        type: "DELETE",
                        url: "/sucursal_adicion/" + id,
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response == 'ok') {
                                alert('Adicion eliminada correctamente !!!!! ');
                            } else {
                                alert('Error al eliminar la adicion de producto');
                            }
                            $('#mAddSucursalProducto').DataTable().clear();
                            $('#mAddSucursalProducto').DataTable().draw();

                            $('#tproductosAgregados').DataTable().draw();

                            $('#tproductos').DataTable().draw();


                        },
                        error: function(error) {
                            // console.log(error.responseJSON.message);
                            console.log(error)
                            alert('Error al Eliminar exite dependencias');
                        }
                    });
                }
            });

        });
    </script>
@endsection
