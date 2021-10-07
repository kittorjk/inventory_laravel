<?php
$medidaTicket = 250; ?>
<!DOCTYPE html>
<html>

<head>

    <style>
        p {
            padding: 0.1px;
        }

        * {
            font-size: 10px;
            font-family: 'DejaVu Sans', serif;
        }

        h1 {
            font-size: 14px;
        }

        .ticket {
            margin: 2px;
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
            margin: 0 auto;
        }

        td.precio {
            text-align: right;
            font-size: 11px;
        }

        td.cantidad {
            font-size: 11px;
            text-align: center;
        }

        td.producto {
            text-align: center;
        }

        th {
            text-align: center;
        }


        .centrado {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width:
                <?php
                echo $medidaTicket;
            ?>
            px;
            max-width:
                <?php
                echo $medidaTicket;
            ?>
            px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        * {
            margin: 2;
            padding: 0;
        }

        .ticket {
            margin: 2;
            padding: 0;
        }

        body {
            text-align: center;
        }

    </style>
</head>

<body>
    <div class="ticket centrado">
        <h3>Movimiento de Stock en Productos</h3>

        {{-- @foreach ($traspaso as $trasp) --}}
        <p> <b>Producto:</b> {{ $producto->nombre }}</p>
        <p><b>Descripcion:</b>{{ $producto->descripcion }}</p>
        {{-- <p>Fecha: {{$trasp->fecha}}</p> --}}
        {{-- <p>Usuario:{{$trasp->usuario}}</p> --}}
        {{-- @endforeach --}}

        <table width="100%">
            <thead>
                <tr class="centrado">
                    <th class="precio">FECHA</th>
                    <th class="cantidad">CANT.
                    </th>
                    <th class="precio"> USUARIO</th>
                    {{-- <th class="precio">SUBTOTAL</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($detalles as $det)

                    <tr>
                        <td class="precio">{{ $det->date }}</td>
                        <td class="cantidad">{{ $det->cantidad }}</td>
                        <td class="precio">{{ $det->name }}</td>
                    </tr>
                @endforeach
            </tbody>
            {{-- <tr>
                <td class="cantidad"></td>
                <td class="producto">
                    <strong>TOTAL</strong>
                </td>
                <td class="precio">
                    {{number_format($compra->total,2)}}
                </td>
            </tr> --}}
        </table>
        <br>
        <p class="centrado">¡GRACIAS !!!
        </p>
    </div>
</body>

</html>
