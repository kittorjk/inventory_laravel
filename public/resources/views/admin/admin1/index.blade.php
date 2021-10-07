@extends('theme.lte.layout')
@section('titulo')
    Admin
@endsection

@section('styles')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">

@endsection

@section('header')
    Admin
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
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                                    value="" maxlength="50" required="">
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
            <a href="#" class="btn btn-primary btn-sm scroll-click" data-toggle="modal" data-target="#Medium-modal"
                type="button">
                <i class="fa fa-plus"></i> Nuevo
            </a>
        </div>
    </div>
    <table id="cat" class="data-table table nowrap">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Password</th>
                <th scope="col">Estado</th>
                <th scope="col"></th>


            </tr>
        </thead>
        <tbody>
        </tbody>

    </table>

    <!-- CREATE MODAL-->
    <div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Nuevo Admin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form id="Add">
                    @csrf
                    <div class="modal-body">

                        <div class="input-group custom">
                            <input name="nombre" type="text" class="form-control form-control-lg" placeholder="Nombre">
                            <div class="input-group-append custom">
                                <span class="input-group-text">
                                    <!-- <i class="icon-copy dw dw-user1"></i> -->
                                </span>
                            </div>
                        </div>
                        <div class="input-group custom">
                            <input name="pass" type="text" class="form-control form-control-lg" placeholder="Password">
                        </div>
                        <div class="input-group custom">
                            <input name="estado" type="number" class="form-control form-control-lg"
                                placeholder="Estado = 1,2,3">
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
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Editar Admin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form id="editForm">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">

                        <input type="hidden" name="id" id="id">

                        <div class="input-group custom">
                            <input name="nombre" type="text" class="form-control form-control-lg" id="nombre"
                                placeholder="Nombre">
                            <div class="input-group-append custom">
                                <span class="input-group-text">
                                    <!-- <i class="icon-copy dw dw-user1"></i> -->
                                </span>
                            </div>
                        </div>

                        <div class="input-group custom">
                            <input name="pass" id="pass" type="text" class="form-control form-control-lg"
                                placeholder="Password">
                        </div>
                        <div class="input-group custom">
                            <input name="estado" id="estado" type="number" class="form-control form-control-lg"
                                placeholder="Estado = 1,2,3">
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

    <div id="deleteCategoria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Eliminar Admin</h4>
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

            var table = $('#cat').DataTable({
                responsive: true,
                autoWidth: false,
                serverSide: true,
                // responsive: true,
                ajax: "api/admin",
                columns: [

                    {
                        data: 'id'
                    },
                    {
                        data: 'nombre'
                    },
                    {
                        data: 'pass'
                    },
                    {
                        data: 'estado'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]

            });



            $('#Add').on('submit', function(e) {
                e.preventDefault();
                // console.log(e);

                $.ajax({
                    type: "POST",
                    url: "/admin",
                    data: $('#Add').serialize(),
                    success: function(data) {
                        alert('Admin agregado Exitosamente !!!');

                        console.log('entro');
                        //$('#Medium-modal').hide();
                        // alert(" Categoria CrEADO");
                        /// location.reload();

                    },
                    error: function(error) {
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
            $('body').on('click', '.editCategoria', function() {
                var id = $(this).data('id');
                console.log(id);

                $('#editModal').modal('show');
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                //console.log(data);

                $('#id').val(data[0]);
                $('#nombre').val(data[1]);
                $('#pass').val(data[2]);
                $('#estado').val(data[3]);

            });

            // servicio de edicion
            $('#editForm').on('submit', function(e) {
                e.preventDefault();

                var id = $('#id').val();

                $.ajax({
                    type: "PUT",
                    url: "/admin/" + id,
                    data: $('#editForm').serialize(),
                    success: function(response) {
                        console.log('editando');
                        $('#editModal').modal('hide')
                        alert('Categoria Editada Exitosamente !!!');

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });


                table.clear();
                table.draw();
                $('#editModal').modal('hide');

            });
            // cierre edicion

            /*     $('body').on('click', '.deleteCategoria', function () {

                    var id = $(this).data("id");
                    console.log('---'+id);
                    confirm("Are You sure want to delete !");

                    $.ajax({
                        type: "DELETE",
                        url: "/categoria/"+id,
                        success: function (data) {
                          // table.draw();
                            console.log(data);
                        },
                        error: function (data) {
                             console.log('Error:', data);
                        }
                    });
            }); */


            //  eliminar RECUPERNAR DATO

            $('body').on('click', '.deleteCategoria', function() {
                var id = $(this).data('id');

                $('#deleteCategoria').modal('show');
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();
                $('#id').val(data[0]);

            });

            // ELIMINANDO
            $('#deleteFormCategoria').on('submit', function(e) {
                e.preventDefault();

                var id = $('#id').val();

                $.ajax({
                    type: "DELETE",
                    url: "/admin/" + id,
                    data: $('#deleteFormCategoria').serialize(),
                    success: function(response) {
                        if (response == 'ok') {
                            alert('Elimino  exitosamente !!!');
                        } else {
                            alert('Error al Eliminar ');
                        }


                    },
                    error: function(error) {
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
