@extends('layouts.pdfbook_intpoll')

@section('title', 'Análisis de Satisfacción Cliente Interno')

@section('content')
    <!-- FEED -->
    <header>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="60%" class="title-document" align="left">
                    {{ $company['name'] }}
                </td>
                <td width="10%"></td>
                <td align="right" valign="top">
                    <div class="company-title1">Empresa Constructora Militar No 4</div>
                    <div class="company-title2">Km 11/2 carretera a Cidra Matanzas</div>
                    <div class="company-title2">
                        tel&eacute;fono: (45) 292423&nbsp;&nbsp;&nbsp;correo electr&oacute;nico: ecm4@ucm4.co.cu
                    </div>
                </td>
                <td align="right" width="70" valign="top">
                    <img src="{{ public_path('/dist/img/icons/logo.png') }}"/>
                </td>
            </tr>
        </table>
    </header>
    <table width="100%" class="table" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="2" class="title-document" valign="top">
                <span>An&aacute;lisis de Satisfacci&oacute;n de Cliente Interno</span>
            </td>
        </tr>
        <tr>
            <td class="title-category">
                Evaluaci&oacute;n del Servicio: Alimentaci&oacute;n
            </td>
            <td class="title-category" align="right">
                Fecha: {{ month_name(intval($month)).' '.$year }}
            </td>
        </tr>
        <tr>
            <td class="title-category">
                Tipo de Cliente: Cliente Interno (UB Atenci&oacute;n al Hombre)
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
    
    @php
    $pollfeed_count = count($pollfeed);
    @endphp

    @if ($pollfeed_count > 0)

    @php
    $divisor = (intval($pollfeed_count / 2) <= 30) ? intval($pollfeed_count / 2) : 30;
    $division = intval($pollfeed_count / $divisor);
    $module = $pollfeed_count % $divisor;
    @endphp

    @for ($i = 0; $i < ($division / 2); $i++)
            
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="49%">

                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="22" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="22" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="20" class="title-table" align="center">1</td>
                        <td width="20" class="title-table" align="center">2</td>
                        <td width="20" class="title-table" align="center">3</td>
                        <td width="20" class="title-table" align="center">4</td>
                        <td width="20" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; @endphp
                    @isset($pollfeed)
                    
                    @foreach ($pollfeed as $key => $data)
                    
                    @php $count++; @endphp
                    @if ($count > ($i * $divisor) && $count < (($i + 1) * $divisor) + 1)
                    
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>

            </td>
            <td width="2%">&nbsp;</td>
            <td width="49%">
                
                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="25" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="25" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="22" class="title-table" align="center">1</td>
                        <td width="22" class="title-table" align="center">2</td>
                        <td width="22" class="title-table" align="center">3</td>
                        <td width="22" class="title-table" align="center">4</td>
                        <td width="22" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; @endphp
                    @isset($pollfeed)
                    
                    @foreach ($pollfeed as $key => $data)
                    
                    @php $count++; @endphp
                    @if ($count > ($i + 1) * $divisor && $count < (($i + 2) * $divisor) + 1)
                    
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>

            </td>
        </tr>
    </table>
    <br>&nbsp;

    @endfor
    @if ($module > 0)
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="49%">

                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="22" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="22" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="20" class="title-table" align="center">1</td>
                        <td width="20" class="title-table" align="center">2</td>
                        <td width="20" class="title-table" align="center">3</td>
                        <td width="20" class="title-table" align="center">4</td>
                        <td width="20" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; $table_count = 0; @endphp
                    @isset($pollfeed)
                    
                    @foreach ($pollfeed as $key => $data)

                    @php $count++; @endphp
                    @if ($count > ($i + 1) * $divisor && $count < (($i + 2) * $divisor) + 1)
                        @php $table_count = $count; @endphp
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>

            </td>
            <td width="2%">&nbsp;</td>
            <td width="49%" valign="top">
                @if ($table_count < $pollfeed_count)
                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="25" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="25" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="22" class="title-table" align="center">1</td>
                        <td width="22" class="title-table" align="center">2</td>
                        <td width="22" class="title-table" align="center">3</td>
                        <td width="22" class="title-table" align="center">4</td>
                        <td width="22" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; @endphp
                    @isset($pollfeed)
                    
                    @foreach ($pollfeed as $key => $data)
                    
                    @php $count++; $table_count = 0; @endphp
                    @if ($count > ($i + 2) * $divisor)
                        @php $table_count++; @endphp
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>
                @endif
            </td>
        </tr>
    </table>
    <br>&nbsp;

    @endif

    <table width="100%" class="table-footer" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" width="150">
                PROMEDIO TOTAL:&nbsp; <strong>{{ $feed_total_prom }}</strong>
            </td>
            <td class="title-category">
                CALIFICACI&Oacute;N OBTENIDA:&nbsp; <strong>{{ $feed_eval }}</strong>
            </td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" colspan="2">
                <strong>Aspectos Evaluados:</strong><br>
                @php $no_quest = 0; @endphp
                @foreach ($feed_questions as $question)
                    @php $no_quest++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_quest . '. ' . $question->question . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>
    @if (count($feed_issues) > 0)
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" colspan="2">
                <strong>Aspectos a Mejorar:</strong><br>
                @php $no_quest = 0; @endphp
                @foreach ($feed_issues as $key => $value)
                    @php $no_quest++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_quest . '. ' . $value . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>
    @endif
    
    @if (count($feed_comments) > 0)
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" colspan="2">
                <strong>Observaciones:</strong><br>
                @php $no_quest = 0; @endphp
                @foreach ($feed_comments as $row)
                    @php $no_quest++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_quest . '. ' . $row->comment . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>
    @endif
    <br>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:30px">
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

    <div class="page-break"></div>
    @endif

    <!-- HOST -->
    <header>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="60%" class="title-document" align="left">
                    {{ $company['name'] }}
                </td>
                <td width="10%"></td>
                <td align="right" valign="top">
                    <div class="company-title1">Empresa Constructora Militar No 4</div>
                    <div class="company-title2">Km 11/2 carretera a Cidra Matanzas</div>
                    <div class="company-title2">
                        tel&eacute;fono: (45) 292423&nbsp;&nbsp;&nbsp;correo electr&oacute;nico: ecm4@ucm4.co.cu
                    </div>    
                </td>
                <td align="right" width="70" valign="top">
                    <img src="{{ public_path('/dist/img/icons/logo.png') }}"/>
                </td>
            </tr>
        </table>
    </header>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="2" class="title-document" valign="top">
                <span>An&aacute;lisis de Satisfacci&oacute;n de Cliente Interno</span>
            </td>
        </tr>
        <tr>
            <td class="title-category">
                Evaluaci&oacute;n del Servicio: Alojamiento y Recreaci&oacute;n
            </td>
            <td class="title-category" align="right">
                Fecha: {{ month_name(intval($month)).'/'.$year }}
            </td>
        </tr>
        <tr>
            <td class="title-category">
                Cliente: Interno (UB Atenci&oacute;n al Hombre)
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
    
    @php
    $pollhost_count = count($pollhost);
    @endphp

    @if ($pollhost_count > 0)
    
    @php
    $divisor = (intval($pollhost_count / 2) <= 30) ? intval($pollhost_count / 2) : 30;
    $division = intval($pollhost_count / $divisor);
    $module = $pollhost_count % $divisor;
    @endphp
    
    @for ($i = 0; $i < ($division / 2); $i++)
            
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="47%">
                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="22" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="22" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="12" class="title-table" align="center">1</td>
                        <td width="12" class="title-table" align="center">2</td>
                        <td width="12" class="title-table" align="center">3</td>
                        <td width="12" class="title-table" align="center">4</td>
                        <td width="12" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; @endphp                    
                    @isset($pollhost)

                    @foreach ($pollhost as $key => $data)                    
                    @php $count++; @endphp

                    @if ($count > ($i * $divisor) && $count < (($i + 1) * $divisor) + 1)

                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>
            </td>
            <td width="2%"></td>
            <td width="51%">
                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="25" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="25" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="17" class="title-table" align="center">1</td>
                        <td width="17" class="title-table" align="center">2</td>
                        <td width="17" class="title-table" align="center">3</td>
                        <td width="17" class="title-table" align="center">4</td>
                        <td width="17" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; @endphp
                    @isset($pollhost)
                    
                    @foreach ($pollhost as $key => $data)
                    @php $count++; @endphp

                    @if ($count > ($i + 1) * $divisor && $count < (($i + 2) * $divisor) + 1)
                    
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>
            </td>
        </tr>
    </table>

    @endfor
    @if ($module > 0)
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="48%">
                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="25" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="25" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="17" class="title-table" align="center">1</td>
                        <td width="17" class="title-table" align="center">2</td>
                        <td width="17" class="title-table" align="center">3</td>
                        <td width="17" class="title-table" align="center">4</td>
                        <td width="17" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; $table_count = 0; @endphp
                    @isset($pollhost)
                    
                    @foreach ($pollhost as $key => $data)
                    @php $count++; @endphp

                    @if ($count > ($i + 1) * $divisor)
                        @php $table_count = $count; @endphp
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>
            </td>
            <td width="4%">&nbsp;</td>
            <td width="48%">
                @if ($table_count < $pollhost_count)
                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="25" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="25" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="17" class="title-table" align="center">1</td>
                        <td width="17" class="title-table" align="center">2</td>
                        <td width="17" class="title-table" align="center">3</td>
                        <td width="17" class="title-table" align="center">4</td>
                        <td width="17" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; $table_count = 0; @endphp
                    @isset($pollhost)
                    
                    @foreach ($pollhost as $key => $data)
                    @php $count++; @endphp

                    @if ($count > ($i + 1) * $divisor)
                        @php $table_count = $count; @endphp
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>
                @endif
            </td>
        </tr>
    </table>   
    @endif

    <table width="100%" class="table-footer" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" width="150">
                PROMEDIO TOTAL:&nbsp; <strong>{{ $host_total_prom }}</strong>
            </td>
            <td class="title-category">
                CALIFICACI&Oacute;N OBTENIDA:&nbsp; <strong>{{ $host_eval }}</strong>
            </td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" colspan="2">
                <strong>Aspectos Evaluados:</strong><br>
                @php $no_quest = 0; @endphp
                @foreach ($host_questions as $question)
                    @php $no_quest++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_quest . '. ' . $question->question . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>
    @if (count($host_issues) > 0)
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" colspan="2">
                <strong>Aspectos a Mejorar:</strong><br>
                @php $no_quest = 0; @endphp
                @foreach ($host_issues as $key => $value)
                    @php $no_quest++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_quest . '. ' . $value . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>    
    @endif
    @if (count($host_comments) > 0)
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" colspan="2">
                <strong>Observaciones:</strong><br>
                @php $no_quest = 0; @endphp
                @foreach ($host_comments as $row)
                    @php $no_quest++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_quest . '. ' . $row->comment . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>
    @endif
    <br>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:30px">
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

    <div class="page-break"></div>
    @endif

    <!-- EQUIP -->
    <header>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="60%" class="title-document" align="left">
                    {{ $company['name'] }}
                </td>
                <td width="10%"></td>
                <td align="right" valign="top">
                    <div class="company-title1">Empresa Constructora Militar No 4</div>
                    <div class="company-title2">Km 11/2 carretera a Cidra Matanzas</div>
                    <div class="company-title2">
                        tel&eacute;fono: (45) 292423&nbsp;&nbsp;&nbsp;correo electr&oacute;nico: ecm4@ucm4.co.cu
                    </div>    
                </td>
                <td align="right" width="70" valign="top">
                    <img src="{{ public_path('/dist/img/icons/logo.png') }}"/>
                </td>
            </tr>
        </table>
    </header>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="2" class="title-document" valign="top">
                <span>An&aacute;lisis de Satisfacci&oacute;n de Cliente Interno</span>
            </td>
        </tr>
        <tr>
            <td class="title-category">
                Evaluaci&oacute;n del Servicio: Choferes u Operadores de Equipos
            </td>
            <td class="title-category" align="right">
                Fecha: {{ month_name(intval($month)).'/'.$year }}
            </td>
        </tr>
        <tr>
            <td class="title-category">
                Cliente: Interno (UB Equipos)
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
            <td width="60" class="title-table" rowspan="2" align="center">No. Encuesta</td>
            <td colspan="5" class="title-table" align="center">No. Pregunta</td>
            <td rowspan="2" class="title-table" align="center">Total</td>
            <td width="60" rowspan="2" class="title-table" align="center">Promedio</td>
        </tr>
        <tr>
            <td width="40" class="title-table" align="center">1</td>
            <td width="40" class="title-table" align="center">2</td>
            <td width="40" class="title-table" align="center">3</td>
            <td width="40" class="title-table" align="center">4</td>
            <td width="40" class="title-table" align="center">5</td>
        </tr>
        @php $count = 0; @endphp
        @isset($pollequip)
        @foreach ($pollequip as $key => $data)
        @php $count++; @endphp
        @if ($data['number'] != null)
        <tr>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                {!! $data['number'] !!}
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                {!! $data['q1'] !!}
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                {!! $data['q2'] !!}
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                {!! $data['q3'] !!}
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                {!! $data['q4'] !!}
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                {!! $data['q5'] !!}
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                {!! $data['sum'] !!}
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                {!! $data['prom'] !!}
            </td>
        </tr>
        @else
        <tr>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                <strong>PROMEDIO</strong>
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                <strong>{!! $data['q1'] !!}</strong>
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                <strong>{!! $data['q2'] !!}</strong>
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                <strong>{!! $data['q3'] !!}</strong>
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                <strong>{!! $data['q4'] !!}</strong>
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                <strong>{!! $data['q5'] !!}</strong>
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                <strong>{!! $data['sum'] !!}</strong>
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                <strong>{!! $data['prom'] !!}</strong>
            </td>
        </tr>
        @endif
        @endforeach
        @endisset
    </table>
    <table width="100%" class="table-footer" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" width="150">
                PROMEDIO TOTAL:&nbsp; <strong>{{ $equip_total_prom }}</strong>
            </td>
            <td class="title-category">
                CALIFICACI&Oacute;N OBTENIDA:&nbsp; <strong>{{ $equip_eval }}</strong>
            </td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" colspan="2">
                <strong>Aspectos Evaluados:</strong><br>
                @php $no_quest = 0; @endphp
                @foreach ($equip_questions as $question)
                    @php $no_quest++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_quest . '. ' . $question->question . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>
    @if (count($equip_issues) > 0)
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" colspan="2">
                <strong>Aspectos a Mejorar:</strong><br>
                @php $no_quest = 0; @endphp
                @foreach ($equip_issues as $key => $value)
                    @php $no_quest++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_quest . '. ' . $value . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>
    @endif
    @if (count($equip_comments) > 0)
    <table width="100%" border="0" cellpadding="0" cellspacing="0">    
        <tr>
            <td class="title-category" colspan="2">
                <strong>Observaciones:</strong><br>
                @php $no_quest = 0; @endphp
                @foreach ($equip_comments as $row)
                    @php $no_quest++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_quest . '. ' . $row->comment . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>
    @endif
    <br>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:30px">
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

    <div class="page-break"></div>

    <!-- BRIGADES -->
    <header>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="60%" class="title-document" align="left">
                    {{ $company['name'] }}
                </td>
                <td width="10%"></td>
                <td align="right" valign="top">
                    <div class="company-title1">Empresa Constructora Militar No 4</div>
                    <div class="company-title2">Km 11/2 carretera a Cidra Matanzas</div>
                    <div class="company-title2">
                        tel&eacute;fono: (45) 292423&nbsp;&nbsp;&nbsp;correo electr&oacute;nico: ecm4@ucm4.co.cu
                    </div>
                </td>
                <td align="right" width="70" valign="top">
                    <img src="{{ public_path('/dist/img/icons/logo.png') }}"/>
                </td>
            </tr>
        </table>
    </header>
    <table width="100%" class="table" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="2" class="title-document" valign="top">
                <span>An&aacute;lisis de Satisfacci&oacute;n de Cliente Interno</span>
            </td>
        </tr>
        <tr>
            <td class="title-category">
                Evaluaci&oacute;n del Servicio a: Brigadas Constructoras
            </td>
            <td class="title-category" align="right">
                Fecha: {{ month_name(intval($month)).' '.$year }}
            </td>
        </tr>
        <tr>
            <td class="title-category">
                Tipo de Cliente: Cliente Interno (UB Atenci&oacute;n al Hombre)
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
    
    @php
    $pollbrigades_count = count($pollbrigades);
    @endphp

    @if ($pollbrigades_count > 0)

    @php
    $divisor = (intval($pollbrigades_count / 2) <= 30) ? intval($pollbrigades_count / 2) : 30;
    $division = intval($pollbrigades_count / $divisor);
    $module = $pollbrigades_count % $divisor;
    @endphp

    @for ($i = 0; $i < ($division / 2); $i++)
            
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="49%">

                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="22" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="22" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="20" class="title-table" align="center">1</td>
                        <td width="20" class="title-table" align="center">2</td>
                        <td width="20" class="title-table" align="center">3</td>
                        <td width="20" class="title-table" align="center">4</td>
                        <td width="20" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; @endphp
                    @isset($pollbrigades)
                    
                    @foreach ($pollbrigades as $key => $data)
                    
                    @php $count++; @endphp
                    @if ($count > ($i * $divisor) && $count < (($i + 1) * $divisor) + 1)
                    
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>

            </td>
            <td width="2%">&nbsp;</td>
            <td width="49%">
                
                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="25" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="25" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="22" class="title-table" align="center">1</td>
                        <td width="22" class="title-table" align="center">2</td>
                        <td width="22" class="title-table" align="center">3</td>
                        <td width="22" class="title-table" align="center">4</td>
                        <td width="22" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; @endphp
                    @isset($pollbrigades)
                    
                    @foreach ($pollbrigades as $key => $data)
                    
                    @php $count++; @endphp
                    @if ($count > ($i + 1) * $divisor && $count < (($i + 2) * $divisor) + 1)
                    
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>

            </td>
        </tr>
    </table>
    <br>&nbsp;

    @endfor
    @if ($module > 0)
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="49%">

                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="22" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="22" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="20" class="title-table" align="center">1</td>
                        <td width="20" class="title-table" align="center">2</td>
                        <td width="20" class="title-table" align="center">3</td>
                        <td width="20" class="title-table" align="center">4</td>
                        <td width="20" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; $table_count = 0; @endphp
                    @isset($pollbrigades)
                    
                    @foreach ($pollbrigades as $key => $data)

                    @php $count++; @endphp
                    @if ($count > ($i + 1) * $divisor && $count < (($i + 2) * $divisor) + 1)
                        @php $table_count = $count; @endphp
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>

            </td>
            <td width="2%">&nbsp;</td>
            <td width="49%" valign="top">
                @if ($table_count < $pollbrigades_count)
                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="25" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="25" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="22" class="title-table" align="center">1</td>
                        <td width="22" class="title-table" align="center">2</td>
                        <td width="22" class="title-table" align="center">3</td>
                        <td width="22" class="title-table" align="center">4</td>
                        <td width="22" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; @endphp
                    @isset($pollbrigades)
                    
                    @foreach ($pollbrigades as $key => $data)
                    
                    @php $count++; $table_count = 0; @endphp
                    @if ($count > ($i + 2) * $divisor)
                        @php $table_count++; @endphp
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>
                @endif
            </td>
        </tr>
    </table>
    <br>&nbsp;

    @endif

    <table width="100%" class="table-footer" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" width="150">
                PROMEDIO TOTAL:&nbsp; <strong>{{ $brigades_total_prom }}</strong>
            </td>
            <td class="title-category">
                CALIFICACI&Oacute;N OBTENIDA:&nbsp; <strong>{{ $brigades_eval }}</strong>
            </td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" colspan="2">
                <strong>Aspectos Evaluados:</strong><br>
                @php $no_quest = 0; @endphp
                @foreach ($brigades_questions as $question)
                    @php $no_quest++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_quest . '. ' . $question->question . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>
    @if (count($brigades_issues) > 0)
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" colspan="2">
                <strong>Aspectos a Mejorar:</strong><br>
                @php $no_quest = 0; @endphp
                @foreach ($feed_issues as $key => $value)
                    @php $no_quest++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_quest . '. ' . $value . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>
    @endif
    
    @if (count($brigades_comments) > 0)
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" colspan="2">
                <strong>Observaciones:</strong><br>
                @php $no_quest = 0; @endphp
                @foreach ($brigades_comments as $row)
                    @php $no_quest++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_quest . '. ' . $row->comment . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>
    @endif
    <br>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:30px">
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

    <div class="page-break"></div>
    @endif

    <!-- PERSONAL TRANSPORT -->
    <header>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="60%" class="title-document" align="left">
                    {{ $company['name'] }}
                </td>
                <td width="10%"></td>
                <td align="right" valign="top">
                    <div class="company-title1">Empresa Constructora Militar No 4</div>
                    <div class="company-title2">Km 11/2 carretera a Cidra Matanzas</div>
                    <div class="company-title2">
                        tel&eacute;fono: (45) 292423&nbsp;&nbsp;&nbsp;correo electr&oacute;nico: ecm4@ucm4.co.cu
                    </div>
                </td>
                <td align="right" width="70" valign="top">
                    <img src="{{ public_path('/dist/img/icons/logo.png') }}"/>
                </td>
            </tr>
        </table>
    </header>
    <table width="100%" class="table" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="2" class="title-document" valign="top">
                <span>An&aacute;lisis de Satisfacci&oacute;n de Cliente Interno</span>
            </td>
        </tr>
        <tr>
            <td class="title-category">
                Evaluaci&oacute;n del Servicio a: Transporte de Personal
            </td>
            <td class="title-category" align="right">
                Fecha: {{ month_name(intval($month)).' '.$year }}
            </td>
        </tr>
        <tr>
            <td class="title-category">
                Tipo de Cliente: Cliente Interno (UB Atenci&oacute;n al Hombre)
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
    
    @php
    $pollpersonaltransp_count = count($pollpersonaltransp);
    @endphp

    @if ($pollpersonaltransp_count > 0)

    @php
    $divisor = (intval($pollpersonaltransp_count / 2) <= 30) ? intval($pollpersonaltransp_count / 2) : 30;
    $division = intval($pollpersonaltransp_count / $divisor);
    $module = $pollpersonaltransp_count % $divisor;
    @endphp

    @for ($i = 0; $i < ($division / 2); $i++)
            
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="49%">

                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="22" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="22" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="20" class="title-table" align="center">1</td>
                        <td width="20" class="title-table" align="center">2</td>
                        <td width="20" class="title-table" align="center">3</td>
                        <td width="20" class="title-table" align="center">4</td>
                        <td width="20" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; @endphp
                    @isset($pollpersonaltransp)
                    
                    @foreach ($pollpersonaltransp as $key => $data)
                    
                    @php $count++; @endphp
                    @if ($count > ($i * $divisor) && $count < (($i + 1) * $divisor) + 1)
                    
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>

            </td>
            <td width="2%">&nbsp;</td>
            <td width="49%">
                
                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="25" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="25" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="22" class="title-table" align="center">1</td>
                        <td width="22" class="title-table" align="center">2</td>
                        <td width="22" class="title-table" align="center">3</td>
                        <td width="22" class="title-table" align="center">4</td>
                        <td width="22" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; @endphp
                    @isset($pollpersonaltransp)
                    
                    @foreach ($pollpersonaltransp as $key => $data)
                    
                    @php $count++; @endphp
                    @if ($count > ($i + 1) * $divisor && $count < (($i + 2) * $divisor) + 1)
                    
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>

            </td>
        </tr>
    </table>
    <br>&nbsp;

    @endfor
    @if ($module > 0)
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="49%">

                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="22" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="22" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="20" class="title-table" align="center">1</td>
                        <td width="20" class="title-table" align="center">2</td>
                        <td width="20" class="title-table" align="center">3</td>
                        <td width="20" class="title-table" align="center">4</td>
                        <td width="20" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; $table_count = 0; @endphp
                    @isset($pollpersonaltransp)
                    
                    @foreach ($pollpersonaltransp as $key => $data)

                    @php $count++; @endphp
                    @if ($count > ($i + 1) * $divisor && $count < (($i + 2) * $divisor) + 1)
                        @php $table_count = $count; @endphp
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>

            </td>
            <td width="2%">&nbsp;</td>
            <td width="49%" valign="top">
                @if ($table_count < $pollpersonaltransp_count)
                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="25" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="25" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="22" class="title-table" align="center">1</td>
                        <td width="22" class="title-table" align="center">2</td>
                        <td width="22" class="title-table" align="center">3</td>
                        <td width="22" class="title-table" align="center">4</td>
                        <td width="22" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; @endphp
                    @isset($pollpersonaltransp)
                    
                    @foreach ($pollpersonaltransp as $key => $data)
                    
                    @php $count++; $table_count = 0; @endphp
                    @if ($count > ($i + 2) * $divisor)
                        @php $table_count++; @endphp
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>
                @endif
            </td>
        </tr>
    </table>
    <br>&nbsp;

    @endif

    <table width="100%" class="table-footer" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" width="150">
                PROMEDIO TOTAL:&nbsp; <strong>{{ $personaltransp_total_prom }}</strong>
            </td>
            <td class="title-category">
                CALIFICACI&Oacute;N OBTENIDA:&nbsp; <strong>{{ $personaltransp_eval }}</strong>
            </td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" colspan="2">
                <strong>Aspectos Evaluados:</strong><br>
                @php $no_quest = 0; @endphp
                @foreach ($personaltransp_questions as $question)
                    @php $no_quest++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_quest . '. ' . $question->question . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>
    @if (count($personaltransp_issues) > 0)
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" colspan="2">
                <strong>Aspectos a Mejorar:</strong><br>
                @php $no_quest = 0; @endphp
                @foreach ($personaltransp_issues as $key => $value)
                    @php $no_quest++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_quest . '. ' . $value . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>
    @endif
    
    @if (count($personaltransp_comments) > 0)
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" colspan="2">
                <strong>Observaciones:</strong><br>
                @php $no_quest = 0; @endphp
                @foreach ($personaltransp_comments as $row)
                    @php $no_quest++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_quest . '. ' . $row->comment . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>
    @endif
    <br>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:30px">
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

    <div class="page-break"></div>
    @endif

    <!-- FREIGHT TRANSPORT -->
    <header>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="60%" class="title-document" align="left">
                    {{ $company['name'] }}
                </td>
                <td width="10%"></td>
                <td align="right" valign="top">
                    <div class="company-title1">Empresa Constructora Militar No 4</div>
                    <div class="company-title2">Km 11/2 carretera a Cidra Matanzas</div>
                    <div class="company-title2">
                        tel&eacute;fono: (45) 292423&nbsp;&nbsp;&nbsp;correo electr&oacute;nico: ecm4@ucm4.co.cu
                    </div>
                </td>
                <td align="right" width="70" valign="top">
                    <img src="{{ public_path('/dist/img/icons/logo.png') }}"/>
                </td>
            </tr>
        </table>
    </header>
    <table width="100%" class="table" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="2" class="title-document" valign="top">
                <span>An&aacute;lisis de Satisfacci&oacute;n de Cliente Interno</span>
            </td>
        </tr>
        <tr>
            <td class="title-category">
                Evaluaci&oacute;n del Servicio a: Transporte de Carga
            </td>
            <td class="title-category" align="right">
                Fecha: {{ month_name(intval($month)).' '.$year }}
            </td>
        </tr>
        <tr>
            <td class="title-category">
                Tipo de Cliente: Cliente Interno (UB Atenci&oacute;n al Hombre)
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
    
    @php
    $pollfreightransp_count = count($pollfreightransp);
    @endphp

    @if ($pollfreightransp_count > 0)

    @php
    $divisor = (intval($pollfreightransp_count / 2) <= 30) ? intval($pollfreightransp_count / 2) : 30;
    $division = intval($pollfreightransp_count / $divisor);
    $module = $pollfreightransp_count % $divisor;
    @endphp

    @for ($i = 0; $i < ($division / 2); $i++)
            
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="49%">

                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="22" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="22" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="20" class="title-table" align="center">1</td>
                        <td width="20" class="title-table" align="center">2</td>
                        <td width="20" class="title-table" align="center">3</td>
                        <td width="20" class="title-table" align="center">4</td>
                        <td width="20" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; @endphp
                    @isset($pollfreightransp)
                    
                    @foreach ($pollfreightransp as $key => $data)
                    
                    @php $count++; @endphp
                    @if ($count > ($i * $divisor) && $count < (($i + 1) * $divisor) + 1)
                    
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>

            </td>
            <td width="2%">&nbsp;</td>
            <td width="49%">
                
                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="25" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="25" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="22" class="title-table" align="center">1</td>
                        <td width="22" class="title-table" align="center">2</td>
                        <td width="22" class="title-table" align="center">3</td>
                        <td width="22" class="title-table" align="center">4</td>
                        <td width="22" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; @endphp
                    @isset($pollfreightransp)
                    
                    @foreach ($pollfreightransp as $key => $data)
                    
                    @php $count++; @endphp
                    @if ($count > ($i + 1) * $divisor && $count < (($i + 2) * $divisor) + 1)
                    
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>

            </td>
        </tr>
    </table>
    <br>&nbsp;

    @endfor
    @if ($module > 0)
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="49%">

                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="22" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="22" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="20" class="title-table" align="center">1</td>
                        <td width="20" class="title-table" align="center">2</td>
                        <td width="20" class="title-table" align="center">3</td>
                        <td width="20" class="title-table" align="center">4</td>
                        <td width="20" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; $table_count = 0; @endphp
                    @isset($pollfreightransp)
                    
                    @foreach ($pollfreightransp as $key => $data)

                    @php $count++; @endphp
                    @if ($count > ($i + 1) * $divisor && $count < (($i + 2) * $divisor) + 1)
                        @php $table_count = $count; @endphp
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>

            </td>
            <td width="2%">&nbsp;</td>
            <td width="49%" valign="top">
                @if ($table_count < $pollfreightransp_count)
                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="25" class="title-table" rowspan="2" align="center">No.</td>
                        <td colspan="5" class="title-table" align="center">No. Pregunta</td>
                        <td width="25" rowspan="2" class="title-table" align="center">Total</td>
                        <td rowspan="2" class="title-table" align="center">Prom</td>
                    </tr>
                    <tr>
                        <td width="22" class="title-table" align="center">1</td>
                        <td width="22" class="title-table" align="center">2</td>
                        <td width="22" class="title-table" align="center">3</td>
                        <td width="22" class="title-table" align="center">4</td>
                        <td width="22" class="title-table" align="center">5</td>
                    </tr>
                    @php $count = 0; @endphp
                    @isset($pollfreightransp)
                    
                    @foreach ($pollfreightransp as $key => $data)
                    
                    @php $count++; $table_count = 0; @endphp
                    @if ($count > ($i + 2) * $divisor)
                        @php $table_count++; @endphp
                        @if ($data['number'] != null)
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['number'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q1'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q2'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q3'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q4'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['q5'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['sum'] !!}
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                {!! $data['prom'] !!}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>Prom</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q1'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q2'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q3'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q4'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['q5'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['sum'] !!}</strong>
                            </td>
                            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                                <strong>{!! $data['prom'] !!}</strong>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    @endisset
                </table>
                @endif
            </td>
        </tr>
    </table>
    <br>&nbsp;

    @endif

    <table width="100%" class="table-footer" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" width="150">
                PROMEDIO TOTAL:&nbsp; <strong>{{ $freightransp_total_prom }}</strong>
            </td>
            <td class="title-category">
                CALIFICACI&Oacute;N OBTENIDA:&nbsp; <strong>{{ $freightransp_eval }}</strong>
            </td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" colspan="2">
                <strong>Aspectos Evaluados:</strong><br>
                @php $no_quest = 0; @endphp
                @foreach ($freightransp_questions as $question)
                    @php $no_quest++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_quest . '. ' . $question->question . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>
    @if (count($freightransp_issues) > 0)
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" colspan="2">
                <strong>Aspectos a Mejorar:</strong><br>
                @php $no_quest = 0; @endphp
                @foreach ($freightransp_issues as $key => $value)
                    @php $no_quest++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_quest . '. ' . $value . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>
    @endif
    
    @if (count($freightransp_comments) > 0)
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="title-category" colspan="2">
                <strong>Observaciones:</strong><br>
                @php $no_quest = 0; @endphp
                @foreach ($freightransp_comments as $row)
                    @php $no_quest++; @endphp
                    {!! '&nbsp;&nbsp;&nbsp;' . $no_quest . '. ' . $row->comment . '<br>' !!}  
                @endforeach
            </td>
        </tr>
    </table>
    @endif
    <br>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:30px">
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

    @endif
@stop