<!DOCTYPE html>
<html>

<head>
    <title>Sucursal</title>
    <style type="text/css">
        body {
            font-size: 16px;
            font-family: "Arial";
        }

        table {
            border-collapse: collapse;
        }

        td {
            padding: 6px 5px;
            font-size: 15px;
        }

        .h1 {
            font-size: 21px;
            font-weight: bold;
        }

        .h2 {
            font-size: 18px;
            font-weight: bold;
        }

        .tabla1 {
            margin-bottom: 20px;
        }

        .tabla2 {
            margin-bottom: 20px;
        }

        .tabla3 {
            margin-top: 15px;
        }

        .tabla3 td {
            border: 1px solid #000;
        }

        .tabla3 .cancelado {
            border-left: 0;
            border-right: 0;
            border-bottom: 0;
            border-top: 1px dotted #000;
            width: 200px;
        }

        .emisor {
            color: red;
        }

        .linea {
            border-bottom: 1px dotted #000;
        }

        .border {
            border: 1px solid #000;
        }

        .fondo {
            background-color: #dfdfdf;
        }

        .fisico {
            color: #fff;
        }

        .fisico td {
            color: #fff;
        }

        .fisico .border {
            border: 1px solid #fff;
        }

        .fisico .tabla3 td {
            border: 1px solid #fff;
        }

        .fisico .linea {
            border-bottom: 1px dotted #fff;
        }

        .fisico .emisor {
            color: #fff;
        }

        .fisico .tabla3 .cancelado {
            border-top: 1px dotted #fff;
        }

        .fisico .text {
            color: #000;
        }

        .fisico .fondo {
            background-color: #fff;
        }

        p {
            font-size: 25px;
            font-weight: bold;
            text-align: center;

        }

    </style>
</head>

<body>
    <div class="digital">
        <p>Reporte de Ventas</p>


        <table width="100%" class="tabla3">
            <tr>
                <td align="center" class="fondo"><strong>ID</strong></td>
                <td align="center" class="fondo"><strong>SUCURSAL</strong></td>
                <td align="center" class="fondo"><strong>FECHA</strong></td>
                <td align="center" class="fondo"><strong>PRODUCTO</strong></td>
                {{-- <td align="center" class="fondo"><strong>DESCRIPCION</strong></td> --}}
                <td align="center" class="fondo"><strong>P_VENTA</strong></td>
                <td align="center" class="fondo"><strong>CANTIDAD</strong></td>
                <td align="center" class="fondo"><strong>SUBTOTAL</strong></td>
            </tr>
            @foreach ($servicee as $ven)

                <tr>
                    <td width="5%" align="center"><span class="text">{{ $ven->id }}</span></td>
                    <td width="10%" align="center"><span class="text">{{ $ven->sucursal }}</span></td>
                    <td width="10%" align="center"><span class="text">{{ $ven->date }}</span></td>
                    <td width="20%" align="center"><span class="text">{{ $ven->nombre }}</span></td>
                    <td width="10%" align="center"><span class="text">{{ $ven->precio_venta }}<< /span>
                    </td>
                    <td width="10%" align="center"><span class="text">{{ $ven->cantidad }}<< /span>
                    </td>
                    <td width="10%" align="center"><span class="text">{{ $ven->subtotal }}<< /span>
                    </td>


                    {{-- <tr>
                <td width="7%">&nbsp;</td>
                <td width="59%">&nbsp;</td>
                <td width="16%">&nbsp;</td>
                <td width="18%" align="left">&nbsp;</td>
            </tr> --}}

            @endforeach
            {{-- <tr>
                <td style="border:0;">&nbsp;</td>
                <td style="border:0;">&nbsp;</td>
                <td style="border:0;">&nbsp;</td>
                <td align="right"><strong>TOTAL Bs/.</strong></td>
                <td align="right"><span class="text">  {{number_format($compra->total,2)}}  </span></td>
            </tr> --}}
            {{-- <tr>
                <td style="border:0;">&nbsp;</td>
                <td align="center" style="border:0;">
                    <table width="200" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center" class="cancelado">{{$compra->f_compra}}</td>
                        </tr>
                    </table>
                </td>
                <td style="border:0;">&nbsp;</td>
                 <td align="center" style="border:0;" class="emisor"><strong></strong></td>
            </tr> --}}
        </table>
    </div>
</body>

</html>
