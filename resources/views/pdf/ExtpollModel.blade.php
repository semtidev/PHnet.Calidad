@extends('layouts.pdfbook_extpoll')

@section('title', 'Encuesta Cliente Externo')

@section('content')
    
    @php 
        $order_extpoll = array();
        $speciality    = '';
        $counter_poll  = 0;
    @endphp
    @foreach ($extpolls as $key => $data)
        @if ($speciality != $data['speciality'] && $data['speciality'] != null)
            @php
                $speciality = $data['speciality'];
                $counter_poll += 1;
                $order_extpoll[$counter_poll][] = $data;
            @endphp
        @elseif ($speciality == $data['speciality'] && $data['description'] != 'Promedio')
            @php
                $order_extpoll[$counter_poll][] = $data;
            @endphp
        @endif
    @endforeach
    
    @for ($i = 1; $i <= $counter_poll; $i++)

    <table width="100%" class="table" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="2" class="title-document" valign="top">
                <span>Satisfacci&oacute;n del Cliente Externo</span>
            </td>
        </tr>
        <tr>
            <td class="title-category">
                Unidad B&aacute;sica: Proyecto Hotelero Centro Hist&oacute;rico
            </td>
            <td class="title-category" align="right">
                Fecha: {{ month_name(intval($month)).' '.$year }}
            </td>
        </tr>
        <tr>
            <td class="title-category">
                Tipo de Cliente: Cliente Externo (ALMEST)
            </td>
            <td class="title-category" align="right">
                Lugar: {{ $work['name'] }}
            </td>
        </tr>
        <tr>
            <td class="title-paragraph" colspan="2" align="justify">
                Para corresponder a las exigencias del perfeccionamiento continuo de nuestro  Sistema  de Gesti&oacute;n de la Calidad, en aras de brindar un mejor servicio, le solicitamos  acceda a responder con honestidad como calificar&iacute;a usted, seg&uacute;n su percepci&oacute;n, el servicio prestado: En una escala del 1 al  5 (1= Muy Mal,  5= Muy Bueno).
            </td>
        </tr>
    </table>
    <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td width="25" class="title-table" rowspan="2" align="center">No.</td>
            <td class="title-table" rowspan="2">Actividad</td>
            <td width="45" class="title-table" rowspan="2" align="center">Nivel</td>
            <td colspan="5" class="title-table" align="center">Puntuaci&oacute;n</td>
        </tr>
        <tr>
            <td width="25" class="title-table" align="center">1</td>
            <td width="25" class="title-table" align="center">2</td>
            <td width="25" class="title-table" align="center">3</td>
            <td width="25" class="title-table" align="center">4</td>
            <td width="25" class="title-table" align="center">5</td>
        </tr>
        <tr bgcolor="#E1EFB5">
            <td colspan="8" class="title-table" style="font-size:13px">
                {{ $order_extpoll[$i][0]['speciality'] }}
            </td>
        </tr>
        @php  $item = 0;  @endphp
        @foreach ($order_extpoll as $key1 =>$expoll_speciality)
            @foreach ($expoll_speciality as $key2 => $data)
                @if ($key1 == $i)
                    @php $item++; @endphp
                    <tr>
                        <td class="data" style="text-align:center;">
                            {!! $item !!}
                        </td>
                        <td class="data">
                            {!! $data['description'] !!}
                        </td>
                        <td class="data" style="text-align:center;">
                            {!! $data['act_level'] !!}
                        </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:50px">
        <tr>
            <td class="table-signature" width="220">
                ______________________________________<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre(s) y Apellidos
            </td>
            <td class="table-signature" width="220">
                ______________________________________<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cargo
            </td>
            <td class="table-signature" width="100">
                ________________<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma
            </td>
        </tr>
    </table>

    @if ($i < $counter_poll)
    <div class="page-break"></div>
    @endif

    @endfor
    
@stop