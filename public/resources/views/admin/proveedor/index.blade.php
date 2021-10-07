@extends('theme.lte.layout')
@section('titulo')
Provedor
@endsection

@section('styles')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">

 @endsection

@section('header')
Provedor
@endsection

@section('contenido')

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>



                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


					<div class="clearfix mb-20">

						<div class="pull-right">
							{{-- <a href="{{ route('categoria.create') }}"  class="btn btn-primary btn-sm scroll-click" ><i class="fa fa-plus"></i> Nueva Categoria</a> --}}
                            <a href="#" class="btn btn-primary btn-sm scroll-click" data-toggle="modal" data-target="#Medium-modal" type="button">
                            <i class="fa fa-plus"></i> Nueva Proveedor
                            </a>
                        </div>
					</div>
					<table id="cat" class="data-table table nowrap">
						<thead>
							<tr>
								<th scope="col">#</th>
                                <th scope="col" >Nombre</th>
                                <th scope="col" >Ruc/Nit</th>
                                <th scope="col" >Direccio</th>
                                <th scope="col" >Celular</th>
                                <th scope="col" >Telefono</th>
                                <th scope="col" ></th>


							</tr>
                        </thead>
                        <tbody>
                        </tbody>

                    </table>

<!-- CREATE MODAL-->
<div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Nuevo Provedor</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                    <form id="AddSucursal">
                                     @csrf
										<div class="modal-body">

                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Nombre (*)</label>
                                                    <input type="text" class="form-control" name="nombre"  required>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Ci / Nit (*)</label>
                                                    <input type="text" class="form-control" name="ruc_nit"  required>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Direccion (*)</label>
                                                    <input type="text" class="form-control" name="direccion"  required>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Celular</label>
                                                    <input type="text" class="form-control" name="celular" >
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Telefono</label>
                                                    <input type="text" class="form-control" name="telefono" required>
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


<!-- modal Edit -->
<div id="editarCategoria" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Editar Proveedor</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                    <form id="editFormCategoria">
                                    @csrf
	                                @method('PATCH')
										<div class="modal-body">

                                            <input type="hidden" name="id" id="id">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Nombre (*)</label>
                                                    <input type="text" class="form-control" name="nombre" id="nombre" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Ci / Nit (*)</label>
                                                    <input type="text" class="form-control" name="ruc_nit" id="ruc_nit" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Direccion (*)</label>
                                                    <input type="text" class="form-control" name="direccion" id="direccion" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Celular</label>
                                                    <input type="text" class="form-control" name="celular" id="celular" >
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Telefono</label>
                                                    <input type="text" class="form-control" name="telefono" id="telefono" required>
                                                </div>
                                            </div>




										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
											<button type="submit" class="btn btn-primary">Editar</button>
                                        </div>
                                    </form>
									</div>
								</div>
                            </div>
<!-- end edit-->

<div id="deleteCategoria" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Eliminar Proveedor</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                    <form id="deleteFormCategoria">
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


@endsection
@section('sripts')
{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {

    var table=$('#cat').DataTable({
        responsive: true,
        autoWidth: false,
        serverSide: true,
       // responsive: true,
        ajax: "api/proveedor",
        columns: [

            {data: 'id_proveedor'},
            {data: 'nombre'},
            {data: 'ruc_nit'},
            {data: 'direccion'},
            {data: 'celular'},
            {data: 'telefono'},
            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]

    });



   $('#AddSucursal').on('submit', function(e){
    e.preventDefault();
    // console.log(e);

    $.ajax({
        type:"POST",
        url:"/proveedor",
        data: $('#AddSucursal').serialize(),
        success: function( data ){

            console.log('entro');
            alert('Agrego Proveedor exitosamente !!!' );
           //$('#Medium-modal').hide();
            // alert(" Categoria CrEADO");
           /// location.reload();

        },
        error: function(error){
            //
console.log(error);
        }

    });

    $('#Medium-modal').modal('hide');
    table.clear();
    table.draw();

    });

    //$(".editCategoria").on('click', function(){

// recupenda datos para la edicion
    $('body').on('click', '.editCategoria', function () {
        var id = $(this).data('id');
        console.log(id);

        $('#editarCategoria').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map( function(){
            return $(this).text();
        }).get();

        console.log(data);
        $('#id').val(data[0]);
        $('#nombre').val(data[1]);
        $('#ruc_nit').val(data[2]);
        $('#direccion').val(data[3]);
        $('#celular').val(data[4]);
        $('#telefono').val(data[5]);

    });

// servicio de edicion
$('#editFormCategoria').on('submit', function(e){
    e.preventDefault();

    var id=$('#id').val();

    $.ajax({
        type:"PUT",
        url:"/proveedor/"+id,
        data: $('#editFormCategoria').serialize(),
        success: function( response){
            console.log('editando');
           $('#editarCategoria').modal('hide')
           alert('Edicion de  Proveedor exitosamente !!!' );
            //alert('Categoria Eliminada');
           // window.location.reload();
        },
        error: function(error){
            console.log(error);
        }
        });


        table.clear();
        table.draw();
        $('#editarCategoria').modal('hide');

    });
// cierre edicion



//  eliminar RECUPERNAR DATO

$('body').on('click', '.deleteCategoria', function () {
        var id = $(this).data('id');

        $('#deleteCategoria').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map( function(){
            return $(this).text();
        }).get();
        $('#id').val(data[0]);

    });

    // ELIMINANDO
    $('#deleteFormCategoria').on('submit', function(e){
    e.preventDefault();

    var id=$('#id').val();

    $.ajax({
        type:"DELETE",
        url:"/proveedor/"+id,
        data: $('#deleteFormCategoria').serialize(),
        success: function( response){
            if(response=='ok'){
                alert('Elimino Proveedor exitosamente !!!' );
            }
            else{
                alert('Error al Eliminar Proveedor');
            }


        },
        error: function(error){
            // console.log(error.responseJSON.message);
            console.log(error)
            alert('Error al Eliminar exite dependencias');
        }
        });

        $('#deleteCategoria').modal('hide');
        table.clear();
        table.draw();

    });


});
</script>
@endsection
