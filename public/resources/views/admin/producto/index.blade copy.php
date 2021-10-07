@extends('theme.lte.layout')
@section('titulo')
Producto
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/lte/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/lte/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}">
@endsection

@section('header')
Producto
@endsection



@section('contenido')
<div class="card-box mb-30">
                <h2 class="h4 pd-20">Listado de Productos</h2>
                <div class="clearfix mb-20">

						<div class="pull-right">
							<a href="{{ route('producto.create') }}"  class="btn btn-primary btn-sm scroll-click" ><i class="fa fa-plus"></i> Producto</a>
						</div>
                </div>

				<table class="data-table table nowrap">
					<thead>
						<tr>

                            <th class="table-plus datatable-nosort">Producto</th>
                            <th >Nombre</th>
							<th>Descripcion</th>
							<th>Stock</th>
							<th>Stock Minimo</th>
							<th>Precio</th>
                            <th>Stock Inicial</th>
							<th class="datatable-nosort">Action</th>
						</tr>
					</thead>
					<tbody>
                    @foreach($productos as $producto)
						<tr>

							<td class="table-plus">
								<img src="{{ $producto->foto }}" width="70" height="70" alt="">
							</td>
							<td>
								{{ $producto->nombre }}
							</td>
							<td> {{ $producto->descripcion }}</td>
							<td> {{ $producto->stock }} </td>
							<td>{{ $producto->stock_minimo }}</td>
                            <td>Bs. {{ $producto->precio_compra }} </td>
                            <td> {{ $producto->stock_inicial }} </td>
                            <td style="display:none;"> {{ $producto->foto }} </td>
							<td>

                            <form action="{{ route('producto.destroy', $producto->id_producto) }}" method="post">
								<div class="dropdown">
									<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"  role="button" data-toggle="dropdown">
										<i class="dw dw-more"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list" >
									<a class="dropdown-item verProducto"  href="javascript:void(0)"><i class="dw dw-eye"></i> View</a>
                                    @csrf
					                @method('DELETE')
                                    <a class="dropdown-item" href="{{ route('producto.edit', $producto) }}"><i class="dw dw-edit2"></i> Edit</a>
									<button type="submit" class="dropdown-item"><i class="dw dw-delete-3"></i> Delete</button>
									</div>
                                </div>
                                </form>
							</td>
                        </tr>
                    @endforeach
						<!-- <tr>
							<td class="table-plus">
								<img src="vendors/images/product-2.jpg" width="70" height="70" alt="">
							</td>
							<td>
								<h5 class="font-16">Boots</h5>
								by Lea R. Frith
							</td>
							<td>brown</td>
							<td>9UK</td>
							<td>$900</td>
							<td>1</td>
							<td>
								<div class="dropdown">
									<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
										<i class="dw dw-more"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
										<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
										<a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
										<a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td class="table-plus">
								<img src="vendors/images/product-3.jpg" width="70" height="70" alt="">
							</td>
							<td>
								<h5 class="font-16">Hat</h5>
								by Erik L. Richards
							</td>
							<td>Orange</td>
							<td>M</td>
							<td>$100</td>
							<td>4</td>
							<td>
								<div class="dropdown">
									<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
										<i class="dw dw-more"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
										<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
										<a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
										<a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td class="table-plus">
								<img src="vendors/images/product-4.jpg" width="70" height="70" alt="">
							</td>
							<td>
								<h5 class="font-16">Long Dress</h5>
								by Renee I. Hansen
							</td>
							<td>Gray</td>
							<td>L</td>
							<td>$1000</td>
							<td>1</td>
							<td>
								<div class="dropdown">
									<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
										<i class="dw dw-more"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
										<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
										<a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
										<a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td class="table-plus">
								<img src="vendors/images/product-5.jpg" width="70" height="70" alt="">
							</td>
							<td>
								<h5 class="font-16">Blazer</h5>
								by Vicki M. Coleman
							</td>
							<td>Blue</td>
							<td>M</td>
							<td>$1000</td>
							<td>1</td>
							<td>
								<div class="dropdown">
									<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
										<i class="dw dw-more"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
										<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
										<a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
										<a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
									</div>
								</div>
							</td>
						</tr> -->
					</tbody>
                </table>
               {{--  {{ $productos->render()}} --}}
            </div>

            <div class="modal fade" id="Medium-modall" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<!-- <div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel" >Nueva Sucursal</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
 -->
										<div class="modal-body">
                                        <div class="row">

                                            <div class="input-group custom">
                                                <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Nombre">
                                                    <div class="input-group-append custom">
                                                        <span class="input-group-text"><!-- <i class="icon-copy dw dw-user1"></i> --></span>
                                                    </div>
                                            </div>


                                        </div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
											<!-- <button type="submit" class="btn btn-primary">Guardar</button> -->
                                        </div>
</div>

									</div>
								</div>
                            </div>


                            <div class="modal fade bs-example-modal-lg" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel"></h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
                                        <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                                <p><B>NOMBRE</B></p>
                                                <p id="uno" name="uno" ></p>

                                                <p><b>DESCRIPCION</b></p>
                                                <p id="dos" name="dos" ></p>

                                                <p><b>STOCK</b></p>
                                                <p id="tres" name="tres" ></p>

                                                <p><b>STOCK MINIMO</b></p>
                                                <p id="cuatro" name="cuatro" ></p>

                                                <p> <b>STOCK COMPRA</b></p>
                                                <p id="cinco" name="cinco" ></p>

                                                <p><b>STOCK MINIMO</b></p>
                                                <p id="seis" name="seis" ></p>

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
@endsection

@section('sripts')
    <script src="{{asset('assets/lte/src/plugins/apexcharts/apexcharts.min.js')}}"></script>
	<script src="{{asset('assets/lte/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/lte/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('assets/lte/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('assets/lte/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>



    <script type="text/javascript">
    $(document).ready(function() {
        $('body').on('click', '.verProducto', function () {


            $tr = $(this).closest('tr');
            var data = $tr.children("td").map( function(){
                return $(this).text();
            }).get();

          //  $('#id').val(data[0]);
           $('#uno').text(data[1].trim());
           $('#dos').text(data[2].trim());
           $('#tres').text(data[3].trim());
           $('#cuatro').text(data[4].trim());
           $('#cinco').text(data[5].trim());
           $('#seis').text(data[6].trim());
           $('#siete').text(data[7].trim());
           $("#mi_imagen").attr("src",data[7].trim());
           $('#Medium-modal').modal('show');
        });
    });
    </script>

@endsection
