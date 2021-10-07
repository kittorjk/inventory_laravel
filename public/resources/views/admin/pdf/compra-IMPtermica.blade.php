<?php
$medidaTicket = 250;

?>
<!DOCTYPE html>
<html>

<head>

    <style>
        * {
            font-size: 12px;
            font-family: 'DejaVu Sans', serif;
        }

        h1 {
            font-size: 18px;
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
            width: <?php echo $medidaTicket ?>px;
            max-width: <?php echo $medidaTicket ?>px;
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
        <h1>{{$compra->nombre}}</h1>
        <h4>{{$compra->direccion}}</h4>
        <h4>{{$compra->f_compra}}</h4>
        <h4>Usurio: {{$compra->usuario}}</h4>


        <table>
            <thead>
                <tr class="centrado">
                    <th class="cantidad">CANT</th>
                    <th class="producto">PRODUCTO</th>
                    <th class="precio">SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detalles as $det)

                    <tr>
                        <td class="cantidad">{{$det->cantidad}}</td>
                        <td class="producto">{{$det->producto}}</td>
                        <td class="precio">{{number_format($det->cantidad*$det->precio,2)}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tr>
                <td class="cantidad"></td>
                <td class="producto">
                    <strong>TOTAL</strong>
                </td>
                <td class="precio">
                    {{number_format($compra->total,2)}}
                </td>
            </tr>
        </table>
        <p class="centrado">¡GRACIAS POR SU COMPRA!
            <br> </p>
    </div>
</body>

</html>
