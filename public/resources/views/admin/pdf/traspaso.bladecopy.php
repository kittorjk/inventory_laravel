<!DOCTYPE html>
<html>

<head>
    <title>REPORTE</title>

    <style>
        .page-break {
            page-break-after: always;
        }

        @page {
            margin: 0.3in 0.3in 0.1in 0.3in;
        }

        @font-face {
            font-family: 'Helvetica';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url("font url");
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Helvetica, sans-serif;
            font-size: 12px;
        }

        hr {
            page-break-after: always;
            border: 0;
            margin: 0;
            padding: 0;
        }

        table {

            border: 0.5px solid #999;
            text-align: left;
            border-collapse: collapse;
            margin: 0 0 1em 0;
            caption-side: top;
        }
        .center {
  margin-left: auto;
  margin-right: auto;
}

        caption,
        td,
        th {
            padding: 0.4em;
        }

        th,
        td {
            border-bottom: 1px solid #999;
            width: 25%;
        }

        th {
            background: #eee;
        }

        caption {
            font-weight: bold;
            font-style: italic;
        }
    </style>

</head>

<body>


    @foreach ($traspaso as $tp)
    <p align="right"> <i><b>{{$tp->fecha}}</b></i></p>

    <table  width=75% class="center">
        <tbody>
            <tr>

                     <td  align="center"> <h2>TRASPASO ENTRE SUCURSALES</h2> </td>

            </tr>
        </tbody>
    </table>

    <table  width=75% class="center">
            <tbody>
                <tr>
                        <td colspan="3">Sucursal Origen:  <b> {{$tp->origen}} </b></td>
                </tr>
                <tr>
                        <td colspan="3"> Sucursal Destino: <b>{{$tp->destino}}</b> </td>
                </tr>
                <tr>
                    <td colspan="3"> Usuario: <b>{{$tp->usuario}}</b> </td>
            </tr>
            </tbody>
        </table>
        @endforeach

<br>
<table  width=90% class="center">
    <thead>
        <tr>
            <th >Producto</th>
            <th >cantidad</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($detalletraspaso as $dtr)
        <tr>
            <td width="70%">{{ $dtr->producto}} </td>
            <td width="30%"  align="center">{{ $dtr->cantidad}}</td>
        </tr>
        @endforeach

    </tbody>
</table>



</body>

</html>
