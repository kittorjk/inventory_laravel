<?php
$medidaTicket = 250; ?>
<!DOCTYPE html>
<html>

<head>

    <style>
        .page-break {
            page-break-after: always;
        }

        @page {
            margin: 0.5cm 0.5cm;
            /*    padding-top: 60px; */
            /*  font-family: Arial; */
        }

        body {
            /*  margin: 0cm 0cm 0.5cm; */
            /*  margin-top: 20px; */
            text-align: center;
            /* top: 50px; */
            /*  position: fixed; */
            /*   background-color: aquamarine; */
        }

        * {
            font-size: 10px;
            font-family: 'DejaVu Sans', serif;
        }

        * p {
            padding: 0.1px;
        }

        header {
            /*  position: fixed;
            top: -55px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 10px; */

            /** Extra personal styles **/
            /*   background-color: #03a9f4;
            color: white; */
            /* text-align: right;
            line-height: 35px; */
            text-align: right;
            font-size: 8px
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 60px;
            font-size: 10px;

            /** Extra personal styles **/
            /*   background-color: #03a9f4;
            color: white; */
            text-align: left;
            /*    line-height: 30px; */
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
            margin: 0 auto;
        }

    </style>
</head>

<body>

    <header>
        ALMACEN CENTRAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FECHA/HORA:
        {{ $fecha }}
    </header>

    <footer>
        <b>ENCARGADO: </b>{{ $usuario }}
    </footer>





    <h3>BOLETA DE TRASPASO: {{ $id }} </h3 <table width="100%">


    <tbody>
        <tr>
            <td width="100%" align="center">{{ $sucursal->nombre }}</td>
        </tr>
    </tbody>
    </table>



    <table width="100%">
        <thead>
            <tr>
                <th>CANT.</th>
                <th> PRODUCTO</th>
                <th>P1</th>
                <th>P2</th>
                <th>P3</th>
                {{-- <th class="precio">SUBTOTAL</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles as $det)

                <tr>
                    <td>{{ $det->cantidad }}</td>
                    <td width="50%">{{ $det->nombre }}</td>
                    <td>{{ $det->pre1 }}</td>
                    <td>{{ $det->pre2 }}</td>
                    <td>{{ $det->pre3 }}</td>

                </tr>
            @endforeach
        </tbody>

    </table>

</body>

</html>
