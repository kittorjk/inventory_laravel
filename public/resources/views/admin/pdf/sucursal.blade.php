<!DOCTYPE html>
<html>
<head>
    <title>Sucursal</title>
    <style type="text/css">
    body{
        font-size: 16px;
        font-family: "Arial";
    }
    table{
        border-collapse: collapse;
    }
    td{
        padding: 6px 5px;
        font-size: 15px;
    }
    .h1{
        font-size: 21px;
        font-weight: bold;
    }
    .h2{
        font-size: 18px;
        font-weight: bold;
    }
    .tabla1{
        margin-bottom: 20px;
    }
    .tabla2 {
        margin-bottom: 20px;
    }
    .tabla3{
        margin-top: 15px;
    }
    .tabla3 td{
        border: 1px solid #000;
    }
    .tabla3 .cancelado{
        border-left: 0;
        border-right: 0;
        border-bottom: 0;
        border-top: 1px dotted #000;
        width: 200px;
    }
    .emisor{
        color: red;
    }
    .linea{
        border-bottom: 1px dotted #000;
    }
    .border{
        border: 1px solid #000;
    }
    .fondo{
        background-color: #dfdfdf;
    }
    .fisico{
        color: #fff;
    }
    .fisico td{
        color: #fff;
    }
    .fisico .border{
        border: 1px solid #fff;
    }
    .fisico .tabla3 td{
        border: 1px solid #fff;
    }
    .fisico .linea{
        border-bottom: 1px dotted #fff;
    }
    .fisico .emisor{
        color: #fff;
    }
    .fisico .tabla3 .cancelado{
        border-top: 1px dotted #fff;
    }
    .fisico .text{
        color: #000;
    }
    .fisico .fondo{
        background-color: #fff;
    }

</style>
</head>
<body>
    <div class="digital">
        <table width="100%" class="tabla1">
            <tr>
                <td width="73%" align="center"><img id="logo" src="" alt="" width="255" height="57"><span class="h2"> Sucursal: {{$sucursal->nombre}}</span></td>
                <td width="27%" rowspan="3" align="center" style="padding-right:0">
                    <table width="100%">
                        <tr>
                            <td height="50" align="center" class="border"><span class="h2">NIT: {{$sucursal->nit}} </span></td>
                        </tr>
                        {{-- <tr>
                            <td height="40" align="center" class="border fondo"><span class="h1">BOLETA DE VENTA</span></td>
                        </tr>
                        <tr>
                            <td height="50" align="center" class="border">001- Nº <span class="text"></span></td>
                        </tr> --}}
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center"> <b>Direccion:</b> {{$sucursal->direccion}}</td>
            </tr>
            <tr>
                <td align="center"><b>Telf.:</b> {{$sucursal->telefono_fijo}} (-) {{$sucursal->telefono_celular}} </td>
            </tr>
        </table>

        <table width="100%" class="tabla3">
            <tr>
                <td align="center" class="fondo"><strong>PRODUCTO</strong></td>
                <td align="center" class="fondo"><strong>P_COMPRA</strong></td>
                <td align="center" class="fondo"><strong>P.1</strong></td>
                <td align="center" class="fondo"><strong>P.2</strong></td>
                <td align="center" class="fondo"><strong>P.3</strong></td>
            </tr>
            @foreach($detalles as $det)

            <tr>
                <td width="60%"><span class="text">{{$det->nombre}}</span></td>
                <td width="10%" align="center"><span class="text">{{$det->p_compra}}</span></td>
                <td width="10%" align="center"><span class="text">{{$det->pre1}}</span></td>
                <td width="10%" align="center"><span class="text">{{$det->pre2}}</span></td>
                <td width="10%" align="center"><span class="text">{{$det->pre3}}</span></td>
               </tr>

             {{-- <tr>
                <td width="7%">&nbsp;</td>
                <td width="59%">&nbsp;</td>
                <td width="16%">&nbsp;</td>
                <td width="18%" align="left">&nbsp;</td>
            </tr>  --}}

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
