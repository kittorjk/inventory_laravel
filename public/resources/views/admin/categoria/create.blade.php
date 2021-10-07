@extends('theme.lte.layout')
@section('titulo')
Categoria
@endsection

@section('header')
Categoria
@endsection

@section('contenido')
<form method="post" action="{{ route('categoria.store') }}" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label class="col-md-4 text-right">Descripcion</label>
		<div class="col-md-8">
			<input type="text" name="descripcion" class="form-control input-lg" />
		</div>
	</div>

	<br />
	<div class="form-group text-center">
		<input type="submit" name="crear" class="btn btn-primary input-lg" value="Nuevo" />
	</div>
</form>
@endsection
