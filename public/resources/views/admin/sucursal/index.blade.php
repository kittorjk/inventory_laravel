@extends('theme.lte.layout')
@section('titulo')
Sucursal
@endsection

@section('header')
Sucursal
@endsection

@section('contenido')

@if(Session::has('message'))

   <div class="alert alert-info alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" arial-label="Close"><span aria-hidden="true">x</span></button>
         {{ Session::get('message') }}
    </div>

@endif

					<div class="clearfix mb-20">

						<div class="pull-right">
							<a href="{{ route('sucursal.create') }}"  class="btn btn-primary btn-sm scroll-click" ><i class="fa fa-plus"></i> Nueva Sucursal</a>
                            <!--  <a href="#" class="btn btn-primary btn-sm scroll-click" data-toggle="modal" data-target="#Medium-modal" type="button">
                            <i class="fa fa-plus"></i> Nueva Sucursal
                            </a> -->
                        </div>
					</div>
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Nombre</th>
								<th scope="col">Direccion</th>
                                <th scope="col">Nit</th>
                                <th scope="col">Telefonos</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Sitio Web</th>
                                <th scope="col"></th>

							</tr>
						</thead>
						<tbody>
                        @foreach($sucursales as $sucursal)
							<tr>
                                <td> {{ $sucursal->nombre }} </td>
                                <td> {{ $sucursal->direccion }} </td>
                                <td> {{ $sucursal->nit }} </td>
                                <td> {{ $sucursal->telefono_fijo }} - {{ $sucursal->telefono_celular }} </td>
                                <td> {{ $sucursal->email }} </td>
                                <td> {{ $sucursal->web }} </td>
                                <!-- <td>
                                <input class="form-control" type="text" name="descripcion">
                                </td> -->
                                <td>
                                <form action="{{ route('sucursal.destroy', $sucursal) }}" method="post">
                                <a  href="{{ route('sucursal.edit', $sucursal) }}" class="btn btn-primary">
                                   <!--  <i class="icon-copy fa fa-save" aria-hidden="true"></i> -->
                                   <i class="icon-copy fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <a  href="{{ route('pdfSucursal', $sucursal->id_sucursal) }}" class="btn btn-info">
                                    <i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i>
                                 </a>
                                @csrf
					            @method('DELETE')
                                <button type="submit"  class="btn btn-danger">
                                    <i class="icon-copy fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
						</tbody>
					</table>



<!-- CREATE MODAL-->
                    <div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Nueva Sucursal</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                    <form id="AddSucursal">
                                    @csrf
										<div class="modal-body">

                                            <div class="input-group custom">
                                                <input type="text" class="form-control form-control-lg" placeholder="Nombre">
                                                    <div class="input-group-append custom">
                                                        <span class="input-group-text"><!-- <i class="icon-copy dw dw-user1"></i> --></span>
                                                    </div>
                                            </div>

                                            <div class="input-group custom">
                                                <input type="text" class="form-control form-control-lg" placeholder="Direccion">
                                                    <div class="input-group-append custom">
                                                        <span class="input-group-text"><!-- <i class="icon-copy dw dw-user1"></i> --></span>
                                                    </div>
                                            </div>

                                            <div class="input-group custom">
                                                <input type="text" class="form-control form-control-lg" placeholder="Nit">
                                                    <div class="input-group-append custom">
                                                        <span class="input-group-text"><!-- <i class="icon-copy dw dw-user1"></i> --></span>
                                                    </div>
                                            </div>

                                            <div class="input-group custom">
                                                <input type="text" class="form-control form-control-lg" placeholder="Telefono Fijo">
                                                    <div class="input-group-append custom">
                                                        <span class="input-group-text"><!-- <i class="icon-copy dw dw-user1"></i> --></span>
                                                    </div>
                                            </div>

                                            <div class="input-group custom">
                                                <input type="text" class="form-control form-control-lg" placeholder="Telefono Celular">
                                                    <div class="input-group-append custom">
                                                        <span class="input-group-text"><!-- <i class="icon-copy dw dw-user1"></i> --></span>
                                                    </div>
                                            </div>

                                            <div class="input-group custom">
                                                <input type="text" class="form-control form-control-lg" placeholder="Correo">
                                                    <div class="input-group-append custom">
                                                        <span class="input-group-text"><!-- <i class="icon-copy dw dw-user1"></i> --></span>
                                                    </div>
                                            </div>

                                            <div class="input-group custom">
                                                <input type="text" class="form-control form-control-lg" placeholder="Sitio Web">
                                                    <div class="input-group-append custom">
                                                        <span class="input-group-text"><!-- <i class="icon-copy dw dw-user1"></i> --></span>
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



                    @endsection




<!--
<script type="text/javascript">
$(document).ready(function (){

$('#AddSucursal').on('submit', function(e){
    e.preventDefault();

    $.ajax({
        type:"POST",
        url:"sucursal",
        //data: $('#AddSucursal').serialize(),
        succes: function( response){
            console.log(response);
        },
        error: function(error){
            console.log(error);
        }
    });

});

});
</script> -->


