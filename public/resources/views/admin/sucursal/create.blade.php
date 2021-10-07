
@extends('theme.lte.layout')
@section('titulo')
Crear Sucursal
@endsection

@section('header')
Crear Sucursal
@endsection

@section('contenido')
<form method="post" action="{{ route('sucursal.store') }}" enctype="multipart/form-data">
@csrf

<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">Nombre</label>
  <div class="col-sm-12 col-md-10">
    <input  name="nombre" class="form-control" type="text" placeholder="Nombre Sucursal">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">Direccion</label>
  <div class="col-sm-12 col-md-10">
    <input  name="direccion" class="form-control" type="text" placeholder="Direccion Sucursal">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">Nit</label>
  <div class="col-sm-12 col-md-10">
    <input name="nit" class="form-control"  type="text" placeholder="Nit Sucursal">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">Telefono Fijo</label>
  <div class="col-sm-12 col-md-10">
    <input name="telefono_fijo" class="form-control"  type="text" placeholder="Telefono Fijo Sucursal">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">Telefono Celular</label>
  <div class="col-sm-12 col-md-10">
    <input name="telefono_celular" class="form-control"  type="text" placeholder="Telefono Celular Sucursal">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">Correo</label>
  <div class="col-sm-12 col-md-10">
    <input name="email" class="form-control"  type="text" placeholder="Correo Sucursal">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">Sitio Web</label>
  <div class="col-sm-12 col-md-10">
    <input name="web" class="form-control"  type="text" placeholder="Sitio Web Sucursal">
  </div>
</div>



<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">
  <i class="fa fa-save"></i>
  Guardar
</button>
<a href="{{ route('sucursal.index') }}"  class="btn btn-secondary waves-effect waves-light">Cancelar</a>

</form>

@endsection
