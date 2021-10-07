@extends('theme.lte.layout')
@section('titulo')
Traspasos
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/lte/vendors/jquery-ui/jquery-ui.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/lte/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/lte/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}">

 {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css"> --}}

@endsection


@section('header')
Traspasos
@endsection

@section('contenido')

    <div class="input-group custom">
        <input type="text" id="search" class="form-control form-control-lg" placeholder="Buscar Producto">


        <div class="input-group-append custom">
                <span class="input-group-text"><!-- <i class="icon-copy dw dw-user1"></i> --></span>
            </div>
     </div>

     <div class="form-group row">
		<label class="col-sm-12 col-md-2 col-form-label">Sucursal</label>
		<div class="col-sm-12 col-md-10">
			<select class="custom-select col-12" id="sucursal" >
                {{-- <select class="selectpicker" id="sucursal" data-live-search="true"> --}}
				<option selected="">seleccione sucursal...</option>
                @foreach($sucursales as $sucursal)
                <option  value=" {{ $sucursal->id_sucursal }}">
                {{ $sucursal->nombre }}
                </option>
                 @endforeach
            </select>
		</div>
	</div>
<h3>Listado de Productos</h3>
<br>
     <table id="tproductos" class="data-table table nowrap">
						<thead>
							<tr>
								<th scope="col">#</th>
                                <th scope="col" >Nombre</th>

                                <th scope="col" >Stock</th>
                                <th scope="col" >Stock Minimo</th>
                                <th scope="col" ></th>


							</tr>
                        </thead>
                        <tbody>
                        </tbody>

                    </table>

                    <br><br><br><br>

                    <h3>Listado de Adicion Productos</h3>
<br>
     <table id="tproductosAgregados" class="data-table table nowrap">
						<thead>
							<tr>
								<th scope="col">#</th>
                                <th scope="col" >Producto</th>

                                <th scope="col" >Fecha</th>
                                <th scope="col" >Stock</th>
                                <th scope="col" >Stock Minimo</th>
                                <th scope="col" ></th>



							</tr>
                        </thead>
                        <tbody>
                        </tbody>

                    </table>

 <!-- MODAL ADDSUCURSAL-->
 <div class="modal fade" id="maddSucursal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Adicionar Sucursal</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                    <form id="AddFormSucursal">
                                    @csrf
										<div class="modal-body">
                                        <input type="hidden" name="id_producto" id="id_producto">
                                        <input type="hidden" name="id_sucursal" id="id_sucursal">

    <div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="form-group">
				<label>Producto</label>
				<input type="text" class="form-control" name="producto" id="producto" require>
			</div>
		</div>
	</div>


    <div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="form-group">
				<label>Fecha</label>
				<input type="date" class="form-control" name="fecha">
			</div>
		</div>
		<div class="col-md-6 col-sm-12">
        <label class="weight-600">Estado</label>
				<div class="custom-control custom-checkbox mb-5">
					<input type="checkbox" class="custom-control-input" id="customCheck1-1" name="estado">
					<label class="custom-control-label" for="customCheck1-1"></label>
				</div>
		</div>
    </div>

    <div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="form-group">
				<label>Stock</label>
				<input type="text" class="form-control" name="stock">
			</div>
		</div>
		<div class="col-md-6 col-sm-12">
			<div class="form-group">
				<label>Stock Minimo</label>
				<input type="text" class="form-control" name="stock_min">
			</div>
		</div>
    </div>

    <div class="row">
		<div class="col-md-4 col-sm-12">
			<div class="form-group">
				<label>Precio 1</label>
				<input type="text" class="form-control" name="pre1">
			</div>
		</div>
		<div class="col-md-4 col-sm-12">
			<div class="form-group">
				<label>Precio 2</label>
				<input type="text" class="form-control" name="pre2">
			</div>
		</div>
		<div class="col-md-4 col-sm-12">
			<div class="form-group">
				<label>Precio 3</label>
				<input type="text" class="form-control" name="pre3">
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

							<div class="modal fade bs-example-modal-lg" id="mmaddSucursal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
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
<div id="deleteProducto" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Eliminar Categoria</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                    <form id="deleteFormProducto">
                                    @csrf
	                                @method('DELETE')
										<div class="modal-body">

                                            <input type="text" name="id" id="id">


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

@endsection

@section('sripts')
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
 -->
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

 <script src="{{asset('assets/lte/vendors/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

<script type="text/javascript">
var cursos = ['laravel','react','flutter','html'];

$('#search').autocomplete({

    source: function (request, response){
        $.ajax({
            url: "{{route('search.productos')}}",
            dataType: 'json',
            data: {
                term: request.term
            },
            success: function(data){
                response(data)
                //console.log(data.id);
            },


        });
    },
    select: function(event, ui) {
                event.preventDefault();
                console.log(ui.item);
            }
});

$(document).ready(function() {
    // OTRO OPCION DE BUSQUEESA



    // listado de productos
    var table = $('#tproductos').DataTable({
        responsive: true,
        autoWidth: false,
        serverSide: true,
       // select: false,
        ajax: "api/productos", //url: "{{route('search.productos')}}",
        columns: [

            {data: 'id_producto'},
            {data: 'descripcion'},
            {data: 'stock'},
            {data: 'stock_minimo'},

            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]
    });

    // cargando a select sucursales



    // obteviendo valor  select  Sucursales
    $("#sucursal").change(function(){
        var cursos = $("#sucursal");
        var id = $(this).val();
        console.log(id);
        if(id.length <= 10){
            $('#id_sucursal').val(id);
        // cargando en un dataTable tproductosAgregados
        $('#tproductosAgregados').DataTable().destroy();
        $('#tproductosAgregados').DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        retrieve: true,
        serverSide: true,

        ajax: "api/sucursal_productos/"+id, //url: "{{route('search.productos')}}",

        columns: [

            {data: 'id'},
            {data: 'descripcion'},
            {data: 'fecha'},
            {data: 'stock'},
            {data: 'stock_min'},

            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]
    });

        }
        else{
            console.log('no');
           $('#tproductosAgregados').DataTable().clear();
            $('#tproductosAgregados').DataTable().draw();
        }





    });

    $('#sucursalZZZZ').change( function() {

        var id = $(this).val();
        var month = $(this).find('option:selected').val();
        console.log(id);
        $('#id_sucursal').val(id);

        $.ajax({
        type: 'GET', //'POST'
        url: "api/sucursal_productos/"+id,
     //   data: { id: descripcion: fecha: stock :stock_min},
        success: function (data) {
                console.log(data.data);
            //drawing your datatable here....



             $('#tproductosAgregados').DataTable({
                // destroy: true,
                 responsive:true,
                 data: data.data,
               //  rerverSide: true,
                 retrieve: true,
                 columns : [
                    {data: 'id'},
                    {data: 'descripcion'},
                    {data: 'fecha'},
                    {data: 'stock'},
                    {data: 'stock_min'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},]
             });

             // table.clear();

          }
      });
    });

    // Modal Add a sucursal -> recupernado datos

    $('body').on('click', '.addSucursal', function () {
        var id = $(this).data('id');
         console.log(id);
       $('#maddSucursal').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map( function(){
            return $(this).text();
        }).get();

        console.log(data);
        $('#id_producto').val(data[0]);
        $('#producto').val(data[1]);

    });

    // Add Producto a sucursal DB AddFormSucursal

    $('#AddFormSucursal').on('submit', function(e){
    e.preventDefault();

    $.ajax({
        type:"POST",
        url:"/sucursal_producto",
        data: $('#AddFormSucursal').serialize(),
        succes: function( response){
            //console.log(response);
            $('#maddSucursal').modal('hide')
            //alert('Categoria CrEADO');
            location.reload();
        },
        error: function(error){
            //console.log(error);
        }
    });

    $('#maddSucursal').modal('hide');
    //$('#tproductosAgregados').DataTable().destroy();
    $('#tproductosAgregados').DataTable().draw();

    //$('#tproductos').DataTable().clear();
   //  $('#tproductos').DataTable().draw();

    table.destroy();
    table.draw();

    });

    //  eliminar RECUPERNAR DATO

$('body').on('click', '.deleteSucursalProducto', function () {
        var id = $(this).data('id');
        $('#deleteProducto').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map( function(){
            return $(this).text();
        }).get();
        $('#id').val(data[0]);
    });


   // ELIMINANDO
   $('#deleteFormProducto').on('submit', function(e){
    e.preventDefault();

    var id=$('#id').val();

    $.ajax({
        type:"DELETE",
        url:"/sucursal_producto/"+id,
        data: $('#deleteFormProducto').serialize(),
        succes: function( response){
            console.log(response);

        },
        error: function(error){
            // console.log(error.responseJSON.message);
            alert('Error al Eliminar Producto en la Sucursal');
        }
        });

        $('#deleteProducto').modal('hide');
        $('#tproductosAgregados').DataTable().clear();
        $('#tproductosAgregados').DataTable().draw();
    });


});



</script>
@endsection
