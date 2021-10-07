<!DOCTYPE html>
<html>

<head>
    <title>DETALLE DE COMPRA</title>
    <style type="text/css">
        @page {
            margin: 0.5cm 0.5cm;
            /*    padding-top: 60px; */
            /*  font-family: Arial; */
        }

        header {

            font-size: 10px;
            text-align: right;
        }

        footer {
            position: fixed;
            bottom: -50px;
            left: 0px;
            right: 0px;
            height: 60px;
            font-size: 10px;
            text-align: left;

        }

        * p {
            padding: 0.1px;
            text-align: center
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
            margin: 0 auto;
        }

        * {
            font-size: 12px;
            font-family: 'DejaVu Sans', serif;
        }

    </style>
</head>

<body>

    <header>
        FECHA / HORA: {{ $compra->f_compra }}
    </header>

    <footer>
        ENCARGADO: {{ $compra->usuario }}
    </footer>

    <p>NRO BOLETA {{ $compra->id_compra }}</p>
    <p><b>ALMACEN CENTRAL</b></p>
    <table width=100%>
        <thead>
            <tr>
                <th>CODIGO</th>
                <th>CANT.</th>
                <th>DETALLE PRODUCTO</th>
                <th>PRECIO COMPRA</th>
                <th>SUBTOTAL</th>
                {{-- <th>P2</th>
                <th>P3</th> --}}
                {{-- <th class="precio">SUBTOTAL</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles as $det)

                <tr>
                    <td width=11% align="CENTER">{{ $det->id_detalle_c }}</td>
                    <td width=11% align="CENTER">{{ $det->cantidad }}</td>
                    <td width=33%>{{ $det->producto }}</td>
                    <td align="CENTER">{{ $det->precio }}</td>
                    <td width="18%" align="right"><span
                            class="text">{{ number_format($det->cantidad * $det->precio, 2) }}</span></td>
                    {{-- <td>{{ $det->pre2 }}</td>
                    <td>{{ $det->pre3 }}</td> --}}

                </tr>
            @endforeach
        </tbody>
        tr>
        <td style="border:0;">&nbsp;</td>
        <td style="border:0;">&nbsp;</td>
        <td style="border:0;">&nbsp;</td>
        <td align="right"><strong>TOTAL Bs/.</strong></td>
        <td align="right"><span class="text"> {{ number_format($compra->total, 2) }} </span></td>
        </tr>

    </table>


</body>

</html>
