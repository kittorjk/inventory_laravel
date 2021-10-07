
@extends('theme.lte.layout')
@section('titulo')
Editar Sucursal
@endsection

@section('header')
Editar Sucursal
@endsection

@section('contenido')
<form method="post" action="{{ route('sucursal.update', $sucursal) }}"enctype="multipart/form-data">
@csrf
@method('PATCH')

<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">Nombre</label>
  <div class="col-sm-12 col-md-10">
    <input  name="nombre" class="form-control" type="text" value="{{$sucursal->nombre}}" placeholder="Nombre Sucursal">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">Direccion</label>
  <div class="col-sm-12 col-md-10">
    <input  name="direccion" class="form-control" type="text" value="{{$sucursal->direccion}}" placeholder="Direccion Sucursal">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">Nit</label>
  <div class="col-sm-12 col-md-10">
    <input name="nit" class="form-control"  type="text" value="{{$sucursal->nit}}" placeholder="Nit Sucursal">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">Telefono Fijo</label>
  <div class="col-sm-12 col-md-10">
    <input name="telefono_fijo" class="form-control"  type="text" value="{{$sucursal->telefono_fijo}}" placeholder="Telefono Fijo Sucursal">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">Telefono Celular</label>
  <div class="col-sm-12 col-md-10">
    <input name="telefono_celular" class="form-control"  type="text" value="{{$sucursal->telefono_celular}}" placeholder="Telefono Celular Sucursal">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">Correo</label>
  <div class="col-sm-12 col-md-10">
    <input name="email" class="form-control"  type="text" value="{{$sucursal->email}}" placeholder="Correo Sucursal">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">Sitio Web</label>
  <div class="col-sm-12 col-md-10">
    <input name="web" class="form-control"  type="text" value="{{$sucursal->web}}" placeholder="Sitio Web Sucursal">
  </div>
</div>


<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">
<i class="icon-copy fa fa-pencil" aria-hidden="true"></i>
  Editar
</button>
<a href="{{ route('sucursal.index') }}"  class="btn btn-secondary waves-effect waves-light">Cancelar</a>

</form>

@endsection
