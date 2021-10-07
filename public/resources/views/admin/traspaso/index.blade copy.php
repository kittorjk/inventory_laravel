@extends('theme.lte.layout')
@section('titulo')
Sucursal - Sucursal
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/lte/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/lte/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
@endsection


@section('header')
Sucursal - Sucursal
@endsection

@section('contenido')


<div class="clearfix mb-20">
    <div class="pull-right">
        <a href="#" class="btn btn-primary btn-sm scroll-click" data-toggle="modal" data-target="#mtraspaso" type="button">
            <i class="fa fa-plus"></i> Nueva Traspaso
        </a>
    </div>
</div>
<!-- datatable -->
<table id="traspaso" class="data-table table nowrap">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">sc</th>
            <th scope="col" >Sucursal Origen</th>
            <th scope="col" >Sucursal Destino</th>
            <th scope="col" >Fecha</th>
            <th scope="col" ></th>
        </tr>
    </thead>
    <tbody>
    </tbody>

</table>
<!--end data table -->
<!-- Modal  tRASPASO-->
<div class="modal fade" id="mtraspaso" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
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
                                                            @foreach($sucursales as $sucursal)
                                                            <option  value=" {{ $sucursal->id_sucursal }}">
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
                                                            @foreach($sucursales as $sucursal)
                                                            <option  value=" {{ $sucursal->id_sucursal }}">
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

<!-- Modal AddProducto -->
<div class="modal fade bs-example-modal-lg" id="mAddProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel"></h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
                                        <div class="row">
		<div class="col-md-12 col-sm-12">
            <table id="sucursal" class="data-table table nowrap">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" >Producto</th>
                        <th scope="col" >Stock</th>
                       <!--  <th scope="col" >Stock Minimo</th> -->

                        <th scope="col" ></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>

            </table>
        </div>
</div>

<form id="AddFormProducto">
                                    @csrf
										<div class="modal-body">
                                            <!--hidden -->
                                        <input type="hidden" name="id_producto" id="id_producto">
                                        <input type="hidden" name="id_traspaso" id="id_traspaso">

                                        <div class="form-group row">
		<label class="col-sm-12 col-md-2 col-form-label">Producto</label>
		<div class="col-sm-12 col-md-10">
			<input class="form-control" type="text" name="producto" id="producto">
		</div>
    </div>
    <div class="form-group row">
		<label class="col-sm-12 col-md-2 col-form-label">Cantidad</label>
		<div class="col-sm-12 col-md-10">
			<input class="form-control" type="number" value="0" placeholder="Cantidad" name="cantidad">
		</div>
	</div>

										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Agregar Progucto</button>
                                        </div>
                                        </form>
									</div>
								</div>
							</div>
<!-- End Modal AddProducto -->


@endsection

@section('sripts')

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {

    var table=$('#traspaso').DataTable({
        responsive: true,
        autoWidth: false,
        serverSide: true,

        ajax: "api/traspasos",
        columns: [

            {data: 'id'},
            {data: 'id_sucursal1'},
            {data: 'origen'},
            {data: 'destino'},
            {data: 'fecha'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // add traspaso
    $('#AddTraspaso').on('submit', function(e){
    e.preventDefault();
    // console.log(e);
    $.ajax({
        type:"POST",
        url:"/traspaso",
        data: $('#AddTraspaso').serialize(),
        succes: function( data ){
            respose(data)
        },
        error: function(error){
            console.log(error);
        }
    });

    $('#mtraspaso').modal('hide');
    table.clear();
    table.draw();
    });

    // add Producto tipo x modal

    $('body').on('click', '.addProductos', function () {
        var id = $(this).data('id');
        console.log(id);
        $('#id_traspaso').val(id);
        $('#mAddProducto').modal('show');
        // mostrando datos de productos de sucursal origen
        $('#sucursal').DataTable().destroy();
        $('#sucursal').DataTable({
            responsive: true,
        autoWidth: false,
        serverSide: true,
        processing: true,
        retrieve: true,


        ajax: "api/productos_sucursal/"+id, //url: "{{route('search.productos')}}",

        columns: [

            {data: 'id_producto'},
            {data: 'descripcion'},
         //   {data: 'fecha'},
            {data: 'stock'},
         //   {data: 'stock_min'},

            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]
    });

    });

    // recuperando y asignado dato de producto origen

    $('body').on('click', '.AddProductoSucursal', function () {
        var id = $(this).data('id');
        console.log(id);
        $('#id_producto').val(id);

        $tr = $(this).closest('tr');
        var data = $tr.children("td").map( function(){
            return $(this).text();
        }).get();
        //console.log(data);
        $('#producto').val(data[1].trim())
    });

    // adregando producto de sucursal (origen a destino )  -AddFormProducto

    $('#AddFormProducto').on('submit', function(e){
    e.preventDefault();
    // console.log(e);
    $.ajax({
        type:"POST",
        url:"/detalle_traspaso",
        data: $('#AddFormProducto').serialize(),
        succes: function( data ){
            respose(data)
        },
        error: function(error){
            console.log(error);
        }
    });

    $('#mAddProducto').modal('hide');

    });


});
</script>
@endsection
