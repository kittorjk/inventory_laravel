@extends('theme.lte.layout')
@section('titulo')
Traspasos
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/lte/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/lte/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/lte/vendors/styles/style.css')}}">
<style type="text/css">
    p{
        font-size: 18px;
        font-weight: bold;

    }


</style>
@endsection


@section('header')
Traspaso Almacen - Sucursal
@endsection

@section('contenido')


     <div class="form-group row">
		<label class="col-sm-12 col-md-2 col-form-label">Sucursal</label>
		<div class="col-sm-12 col-md-10">
			<select class="custom-select col-12" id="sucursal" name="sucursal" >
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


    <div class="clearfix mb-20">

        <div class="pull-right">

            <a  href="" class="btn btn-info zonalink" target="_blank" >
                <i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i>
             </a>
        </div>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Listado de  Productos Almacen Central</h4>
        </div>
        <div class="pb-20">
            <table id="tproductos" class="data-table table nowrap">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" >Nombre</th>
                        <th scope="col" >Stock</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    	<!-- Export Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4" id="lts">Listado Productos ... </h4>
            </div>
            <div class="pb-20">
                <table class="table hover multiple-select-row data-table-export nowrap" id="tproductosAgregados">
                    <thead>
                        <tr>
                           {{--  <th class="table-plus datatable-nosort">Name</th> --}}
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
 <div class="modal fade bs-example-modal-lg" id="maddSucursal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
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
                <input type="hidden" name="id_sucursal" id="id_sucursal" >

                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div class="form-group">
                            <label>Producto</label>
                            <input class="form-control" type="text"  id="nombre" name="nombre">

                        </div>
                        <p id="stock_p" name="stock_p" style="color:green;">Stock ... </p>
                        <p id="desc" name="desc" >Descripcion ...</p>

                        </div>
                    <div class="col-md-4 col-sm-12">
                        <img src="" width="150" height="150"  alt="" id="mi_imagen">
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Fecha</label>
                            <input type="text" class="form-control" name="fecha" id="fecha" required>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="text" class="form-control" value="0" name="stock" id="stock" required>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Stock Minimo</label>
                            <input type="number" class="form-control" value="0" name="stock_min" id="stock_min" required>
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
<div class="modal fade" id="addStock" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Adiccion de Stock </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
        <form id="AddStockSucursal">
        @csrf
            <div class="modal-body">
                <input type="hidden"  name="id_sucursal_producto" id="id_sucursal_producto">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Producto</label>
                            <input type="text" class="form-control" name="product" id="product" disabled>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Cantidad</label>
                            <input type="number" class="form-control" name="cantidad" id="cantidad" required value="0">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Fecha</label>
                            <input type="text" class="form-control" name="fecha"  id="fecha1" required>
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


@endsection

@section('sripts')

<script src="{{asset('assets/lte/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/lte/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/lte/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/lte/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/lte/src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/lte/src/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/lte/src/plugins/datatables/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/lte/src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/lte/src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/lte/src/plugins/datatables/js/pdfmake.min.js')}}"></script>

<script type="text/javascript">
var cursos = ['laravel','react','flutter','html'];

$(document).ready(function() {


    var f = new Date();
        $("#fecha").val(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
        $("#fecha1").val(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());

    // listado de productos
    var table = $('#tproductos').DataTable({
        responsive: true,
        autoWidth: false,
        serverSide: true,
       // select: false,
        ajax: "api/productos", //url: "{{route('search.productos')}}",
        columns: [
          {data: 'foto',searchable: false,"render": function (data, type, JsonResultRow, meta) {
                                return '<img id="idimg" width="70" height="70" src="'+JsonResultRow.foto+'">';
            }},
           // {data: 'id_producto'},
            {data: 'nombre'},
            {data: 'stock'},
           //{data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // cargando a select sucursales


    // obteviendo valor  select  Sucursales
    $("#sucursal").change(function(){
        var id = $(this).val();
        var sucursal = $('select[name="sucursal"] option:selected').text();
        console.log(sucursal);

        if(id.length <= 10){
            $('#lts').text('Listado Productos de -' + sucursal);
            $('#id_sucursal').val(id);

        // cargando en un dataTable tproductosAgregados
        $('#tproductosAgregados').DataTable().destroy();
        $('#tproductosAgregados').DataTable({
            dom: 'Bfrtip',
        buttons: [{

            extend: 'colvis',
            extend: 'pdfHtml5',

            header: true,
            title: 'SUCURSAL  - ' + sucursal.trim(),
        },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            //'pdfHtml5'
        ],
        responsive: true,
        autoWidth: false,
        processing: true,
        retrieve: true,
        serverSide: true,

        ajax: "api/sucursal_productos/"+id, //url: "{{route('search.productos')}}",

        columns: [

           // {data: 'id',searchable: false},
           {data: 'foto',searchable: false,"render": function (data, type, JsonResultRow, meta) {
                               return '<img  width="70" height="70" src="'+JsonResultRow.foto+'">';
            }},
            {data: 'nombre',name:'p.nombre'},
            {data: 'fecha',name: 'sp.fecha'},
            {data: 'stock',searchable: false},
            {data: 'stock_min',searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]
     });
            // para el reporte
            $('.zonalink').attr('href','pdfSucursal/'+id.trim());

        }
        else{
            $('#lts').text('Listado Productos ...');
            $('#id_sucursal').val('');
        $('#tproductosAgregados').DataTable().destroy();
        $('#tproductosAgregados').DataTable().clear();
        $('#tproductosAgregados').DataTable().draw();
                $('.zonalink').attr('href','');
        }


    });

    // DATOS EN EL MODAL
    $('#tproductos tbody').on( 'click', 'tr', function () {
        var data = table.row( this ).data();

        if(data["stock"]> 0 ){

            if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
            }
            else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            }

            $("#maddSucursal").modal('show');
            $('#id_producto').val(data["id_producto"]);
            $('#nombre').val(data['nombre']);
            $('#stock_min').val(data['stock_minimo']);
            $('#desc').text('Descripcion : '+data['descripcion']);
            $('#stock_p').text('Stock en Almacen Central: '+data['stock']);
            $("#mi_imagen").attr("src",data['foto']);

            console.log(data);
        }else{
            alert("Stok de producto debe ser mayor a cero !!!")
        }
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
        $('#id_producto').val(data[1]);
        $('#producto').val(data[2]);

    });

    // Add Producto a sucursal DB AddFormSucursal

    $('#AddFormSucursal').on('submit', function(e){
    e.preventDefault();

        if($("#id_sucursal").val() ==""){
            alert("Debe Seleccionar una Sucursal !!!! ");
            $("#maddSucursal").modal("hide");
                            $('#stock').val('0');
                            $('#stock_min').val('0');
                            $('#pre1').val('0');
                            $('#pre2').val('0');
                            $('#pre3').val('0');

                            $('#desc').text('');
                            $('#stock_p').text('');

                            $("#mi_imagen").attr("src","");
                            $('#nombre').val('');
        }
        else{
            st = $("#stock").val();
            stm = $("#stock_min").val();
            p1 = $("#pre1").val();
            p2 = $("#pre2").val();
            p3 = $("#pre3").val();
            if(st > 0  && stm > 0 && p1 > 0 && p2 > 0 && p3 > 0){
                $.ajax({
                    type:"POST",
                    url:"/sucursal_producto",
                    data: $('#AddFormSucursal').serialize(),
                    success: function( response){
                        if(response =='ok'){
                           // alert('Producto agregado a sucursal correctamente !!!');
                            $("#maddSucursal").modal("hide");
                            $('#stock').val('0');
                            $('#stock_min').val('0');
                            $('#pre1').val('0');
                            $('#pre2').val('0');
                            $('#pre3').val('0');

                            $("#mi_imagen").attr("src","");
                            $('#nombre').val('');

                            $('#tproductos').DataTable().draw();
                            $('#tproductosAgregados').DataTable().draw();
                            alert('Producto se traspaso correctamente a sucursal');
                        }
                        else{
                            if(response =='false'){

                            alert('Stock agregado no debe ser mayor, al stock de producto en Almacen Central ');
                            }
                            else{

                                alert(response);
                                $("#maddSucursal").modal("hide");
                            $('#stock').val('0');
                            $('#stock_min').val('0');
                            $('#pre1').val('0');
                            $('#pre2').val('0');
                            $('#pre3').val('0');

                            $('#desc').text('');
                            $('#stock_p').text('');

                            $("#mi_imagen").attr("src","");
                            $('#nombre').val('');
                                }
                        }

                    },
                    error: function(error){
                        //console.log(error);
                    }
                });

            }else{
                alert("Stocks y precios deben ser mayores a 0  !!!! ")
            }

        }

    });

     //  eliminar RECUPERNAR DATO

     $('body').on('click', '.deleteSucursalProducto', function () {
        var id = $(this).data('id');
        $('#deleteProducto').modal('show');
        $('#id').val(id);
    });


   // ELIMINANDO
   $('#deleteFormProducto').on('submit', function(e){
    e.preventDefault();
    var id=$('#id').val();
    $.ajax({
        type:"DELETE",
        url:"/sucursal_producto/"+id,
        data: $('#deleteFormProducto').serialize(),
        success: function( response){
            console.log(response);
            $('#deleteProducto').modal('hide');
            $('#tproductosAgregados').DataTable().draw();

        },
        error: function(error){
            // console.log(error.responseJSON.message);
            alert('Error al Eliminar Producto en la Sucursal');
            $('#deleteProducto').modal('hide');
        }
        });
    });

     // RECUPERANDO DATOS STOCK A PRODUCTO EN LA SUCURSAL
     $('#addStock').on('show.bs.modal', function (event) {
        //console.log('modal abierto');
        var button = $(event.relatedTarget)
        var producto = button.data('producto')
        var id_suc_prod = button.data('id')
        var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body #product').val(producto);
        modal.find('.modal-body #id_sucursal_producto').val(id_suc_prod);
    });

       // ADICIONANDO STOCK A PRODUCTO EN LA SUCURSAL
    $('#AddStockSucursal').on('submit', function(e){
    e.preventDefault();

    $.ajax({
        type:"POST",
        url:"/sucursal_adicion",
        data: $('#AddStockSucursal').serialize(),
        success: function( response){
            console.log(response);
            if(response =='ok'){
                alert('Producto Agregado correctamente');
                $('#addStock').modal('hide');
                $('#cantidad').val('0');
                $('#tproductosAgregados').DataTable().draw();
            }
            else{
                alert('Error al Adicionar Stock cantidad > 0');
            }
        },
        error: function(error){
            console.log(error);
        }
    });

   });


});



</script>
@endsection
