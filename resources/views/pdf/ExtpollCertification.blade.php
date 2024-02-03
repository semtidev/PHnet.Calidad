@extends('layouts.pdfbook_certification')

@section('title', 'Certificación de Calidad')

@section('content')
    <table width="100%" class="table" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category">
               Fecha: {{ month_name(intval($month)).' '.$year }}
            </td>
            <td class="title-category" align="right">
                 &nbsp;
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <h2>Certifico de Calidad UBPH Centro Hist&oacute;rico</h2>
            </td>
        </tr>
        <tr>
            <td class="title-paragraph" colspan="2" align="justify">
                @if ($ubph_prom >= 4)
                    Durante el mes de {{ month_name(intval($month)) }} las encuestas de satisfacci&oacute;n al Cliente Externo se comportaron de manera positiva, promediando una calificaci&oacute;n general de {!! $ubph_prom !!}, por lo que se puede comprobar un &iacute;ndice de calidad {{ $ubph_eval }}.
                @elseif (3 <= $ubph_prom && $ubph_prom < 4)
                    Durante el mes de {{ month_name(intval($month)) }} las encuestas de satisfacci&oacute;n al Cliente Externo se comportaron de manera regular, promediando una calificaci&oacute;n general de {!! $ubph_prom !!}, por lo que se puede comprobar un &iacute;ndice de calidad {{ $ubph_eval }}.
                @elseif ($ubph_prom < 3)
                    Durante el mes de {{ month_name(intval($month)) }} las encuestas de satisfacci&oacute;n al Cliente Externo se comportaron de manera negativa, promediando una calificaci&oacute;n general de {!! $ubph_prom !!}, por lo que se puede comprobar un &iacute;ndice de calidad {{ $ubph_eval }}.
                @endif
            </td>
        </tr>
    </table>
    <span class="title-category"><strong>CLIENTE EXTERNO:</strong></span>
    <br>
    @foreach ($works_eval as $key => $data)
    <br>
    <span class="title-category"><strong>{{ $data['project'] }}:</strong></span>
    <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td width="200" bgcolor="#E9ECF1" class="title-table" align="center">Cliente</td>
            <td width="200" bgcolor="#E9ECF1" class="title-table" align="center">Calificaci&oacute;n</td>
            <td class="title-table" bgcolor="#E9ECF1" align="center">Evaluaci&oacute;n</td>
        </tr>
        <tr>
            <td class="data" align="center">Externo</td>
            <td class="data" align="center">{{ $data['total_prom'] }}</td>
            <td class="data" align="center">{{ $data['evaluation'] }}</td>
        </tr>
    </table>
    @endforeach
    <br>
    @if ($ubph_prom >= 3)
    <span class="title-paragraph">
        Demostrando que no existe penalización por el incumplimiento de este indicador.
    </span>
    @endif
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin:40px 0 0 0;">
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