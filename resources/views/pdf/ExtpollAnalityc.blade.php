@extends('layouts.pdfbook_extpoll')

@section('title', 'Satisfacción Cliente Externo')

@section('content')
    <table width="100%" class="table" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="2" class="title-document" valign="top">
                <span>An&aacute;lisis de Satisfacci&oacute;n del Cliente Externo</span>
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
            <td width="150" class="title-table" rowspan="2">Actividad</td>
            <td width="50" class="title-table" rowspan="2" align="center">Nivel</td>
            <td colspan="5" class="title-table" align="center">Evaluaci&oacute;n por N&uacute;mero de Encuesta</td>
            <td rowspan="2" class="title-table" align="center">Total</td>
            <td width="40" rowspan="2" class="title-table" align="center">Prom.</td>
        </tr>
        <tr>
            <td width="30" class="title-table" align="center">1</td>
            <td width="30" class="title-table" align="center">2</td>
            <td width="30" class="title-table" align="center">3</td>
            <td width="30" class="title-table" align="center">4</td>
            <td width="30" class="title-table" align="center">5</td>
        </tr>
        @php $department = ''; @endphp
        @foreach ($extpolls as $key => $data)
        
        @if ($department != $data['department'])
        @php $department = $data['department']; @endphp
        <tr>
            <td colspan="10" bgcolor="#97F098" class="data">
                <strong>{!! strtoupper($data['department']) !!}</strong>
            </td>
        </tr>
        <tr>
            <td></td>
            <td bgcolor="#F8C99B" class="data">
                <strong>{!! $data['description'] !!}</strong>
            </td>
            <td colspan="8"></td>
        </tr>
        @else
        
            @if ($data['number'] == null)
            <tr>
                <td></td>
                <td bgcolor="#F8C99B" class="data">
                    <strong>{!! $data['description'] !!}</strong>
                </td>
                <td colspan="8"></td>
            </tr>
            @elseif ($data['number'] == -1)
            <tr>
                <td>&nbsp;</td>
                <td colspan="2" class="data">
                    <strong>{!! $data['description'] !!}</strong>
                </td>
                <td class="data" style="text-align:center;">
                    <strong>{!! $data['p1'] !!}</strong>
                </td>
                <td class="data" style="text-align:center;">
                    <strong>{!! $data['p2'] !!}</strong>
                </td>
                <td class="data" style="text-align:center;">
                    <strong>{!! $data['p3'] !!}</strong>
                </td>
                <td class="data" style="text-align:center;">
                    <strong>{!! $data['p4'] !!}</strong>
                </td>
                <td class="data" style="text-align:center;">
                    <strong>{!! $data['p5'] !!}</strong>
                </td>
                <td class="data" style="text-align:center;">
                    <strong>{!! $data['sum'] !!}</strong>
                </td>
                <td class="data" style="text-align:center;">
                    <strong>{!! $data['prom'] !!}</strong>
                </td>
            </tr>
            @else
            <tr>
                <td class="data" style="text-align:center;">
                    {!! $data['number'] !!}
                </td>
                <td class="data">
                    {!! $data['description'] !!}
                </td>
                <td class="data" style="text-align:center;">
                    {!! $data['act_level'] !!}
                </td>
                <td class="data" style="text-align:center;">
                    {!! $data['p1'] !!}
                </td>
                <td class="data" style="text-align:center;">
                    {!! $data['p2'] !!}
                </td>
                <td class="data" style="text-align:center;">
                    {!! $data['p3'] !!}
                </td>
                <td class="data" style="text-align:center;">
                    {!! $data['p4'] !!}
                </td>
                <td class="data" style="text-align:center;">
                    {!! $data['p5'] !!}
                </td>
                <td class="data" style="text-align:center;">
                    {!! $data['sum'] !!}
                </td>
                <td class="data" style="text-align:center;">
                    {!! $data['prom'] !!}
                </td>
            </tr>
            @endif

        @endif
        @endforeach
    </table>
    <table width="100%" class="table-footer" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" width="150">
                PROMEDIO TOTAL:&nbsp; <strong>{{ $total_prom }}</strong>
            </td>
            <td class="title-category">
                CALIFICI&Oacute;N OBTENIDA:&nbsp; <strong>{{ $extpoll_eval }}</strong>
            </td>
        </tr>
    </table>
    @if (count($extpolls_issues) > 0)
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" colspan="2">
                <strong>Aspectos a Mejorar:</strong><br>
                @php $no_act = 0; @endphp
                @foreach ($extpolls_issues as $key => $value)
                    @php $no_act++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_act . '. ' . $value . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>
    @endif
    <br>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td valign="top" class="table-signature" width="160">
                <strong>Elabora:</strong> ________________________<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Especialista Calidad
            </td>
            <td class="table-signature">
                ___________<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma
            </td>
            <td valign="top" class="table-signature" width="130">
                <strong>Aprueba:</strong> {{ $company['director'] }}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Director UBPH
            </td>
            <td class="table-signature" width="60">
                ___________<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma
            </td>
        </tr>
    </table>
@stop