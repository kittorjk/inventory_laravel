@extends('theme.lte.layout')
@section('titulo')
    Crear Producto
@endsection

@section('header')
    Crear Producto
@endsection

@section('contenido')
    <form method="post" action="{{ route('producto.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Codigo Barras</label>
            <div class="col-sm-12 col-md-10">
                <input name="codigo_barras" class="form-control" type="text" placeholder="Codigo de barras">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Nombre</label>
            <div class="col-sm-12 col-md-10">
                <input name="nombre" class="form-control" type="text" placeholder="Nombre Producto">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Descripcion</label>
            <div class="col-sm-12 col-md-10">
                <input name="descripcion" class="form-control" type="text" placeholder="Descripcion Producto">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Stock Inicial</label>
            <div class="col-sm-12 col-md-10">
                <input name="stock_inicial" class="form-control" value="0" type="number">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Stock</label>
            <div class="col-sm-12 col-md-10">
                <input name="stock" class="form-control" value="0" type="number" disabled>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Stock Minimo</label>
            <div class="col-sm-12 col-md-10">
                <input name="stock_minimo" class="form-control" value="0" type="number">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Precio Compra</label>
            <div class="col-sm-12 col-md-10">
                <input name="precio_compra" class="form-control" type="text">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Categoria</label>
            <div class="col-sm-12 col-md-10">
                <select name="id_categoria" class="custom-select col-12">
                    <option selected="">Seleccione Categoria...</option>
                    @foreach ($categorias as $categoria)
                        <option value=" {{ $categoria->id_categoria }}">
                            {{ $categoria->descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Seleccione Imagen</label>
            <div class="col-sm-12 col-md-10">
                <input name="foto" type="file" class="form-control-file form-control height-auto">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Precio 1</label>
                    <input type="text" class="form-control" value="0" name="pre1" id="pre1" required>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Precio 2</label>
                    <input type="text" class="form-control" value="0" name="pre2" id="pre2" required>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Precio 3</label>
                    <input type="text" class="form-control" value="0" name="pre3" id="pre3" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">
            <i class="fa fa-save"></i>
            Guardar
        </button>
        <a href="{{ route('producto.index') }}" class="btn btn-secondary waves-effect waves-light">Cancelar</a>

    </form>

@endsection
