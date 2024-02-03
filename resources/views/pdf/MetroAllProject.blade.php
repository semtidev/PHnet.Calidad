@extends('layouts.pdfbook')

@section('title', 'Plantilla IM UBPH')

@section('content')
    <!------------------------------------------
    -------------    PAGE WEIGHT    ------------
    ------------------------------------------->
    <table class="table" border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th colspan="9">
                    <div class="table-title1">Ordinario</div>
                    <div class="table-title2">
                        Plantilla de Instrumentos de Medici&oacute;n, U/B Proyecto Hotelero
                    </div>
                    <table width="70%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="table-title3">Especialidad: Masa</td>
                            <td class="table-title3">Plantilla No: 1</td>
                        </tr>
                    </table>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="10" class="column-title" rowspan="2" align="center">No.</td>
                <td width="40" class="column-title" rowspan="2" align="center">C&oacute;digo</td>
                <td width="90" class="column-title" rowspan="2">Denominaci&oacute;n</td>
                <td width="60" class="column-title" rowspan="2">Modelo</td>
                <td width="60" class="column-title" rowspan="2" align="center">
                    Rango de Medici&oacute;n
                </td>
                <td width="50" class="column-title" rowspan="2" align="center">Exactitud</td>
                <td class="column-title" colspan="2" align="center">Cantidad</td>
                <td width="80" class="column-title" rowspan="2">Observaciones</td>
            </tr>
            <tr>
                <td width="20" class="column-title" align="center">Lleva</td>
                <td width="20" class="column-title" align="center">Real</td>
            </tr>
            @php $count = 0; @endphp
            @foreach ($weight as $key => $data)
                @php $count++; @endphp
                <tr>
                    <td class="data" style="text-align:center;">
                        {{ $count }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $weight_code }}
                    </td>
                    <td class="data">
                        {{ $data['name'] }}
                    </td>
                    <td class="data">
                        {{ $data['model'] }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $data['limit'] }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $data['precision'] }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $data['demand'] }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $data['ctdad'] }}
                    </td>
                    <td class="data">
                        {{ $data['comment'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" rules="rows">
        <tr>
            <td valign="top" class="table-footer">Fecha de Elaboraci&oacute;n: {{ date('d/m/Y') }}</td>
            <td valign="top" class="table-footer" align="right">Aprobada: {{ $company['director'] }}<br>Director {{ $company['name'] }}</td>
        </tr>
    </table>
    <!------------------------------------------
    ----------    END PAGE WEIGHT    -----------
    ------------------------------------------->

    <div class="page-break"></div>

    <!------------------------------------------
    ----------    PAGE TOPOGRAPHY    -----------
    ------------------------------------------->
    <table class="table" border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th colspan="9">
                    <div class="table-title1">Ordinario</div>
                    <div class="table-title2">
                        Plantilla de Instrumentos de Medici&oacute;n, U/B Proyecto Hotelero
                    </div>
                    <table width="70%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="table-title3">Especialidad: Topograf&iacute;a y Geodesia</td>
                            <td class="table-title3">Plantilla No: 2</td>
                        </tr>
                    </table>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="10" class="column-title" rowspan="2" align="center">No.</td>
                <td width="40" class="column-title" rowspan="2" align="center">C&oacute;digo</td>
                <td width="90" class="column-title" rowspan="2">Denominaci&oacute;n</td>
                <td width="60" class="column-title" rowspan="2">Modelo</td>
                <td width="60" class="column-title" rowspan="2" align="center">
                    Rango de Medici&oacute;n
                </td>
                <td width="50" class="column-title" rowspan="2" align="center">Exactitud</td>
                <td class="column-title" colspan="2" align="center">Cantidad</td>
                <td width="80" class="column-title" rowspan="2">Observaciones</td>
            </tr>
            <tr>
                <td width="20" class="column-title" align="center">Lleva</td>
                <td width="20" class="column-title" align="center">Real</td>
            </tr>
            @php $count = 0; @endphp
            @foreach ($topgeo as $key => $data)
                @php $count++; @endphp
                <tr>
                    <td class="data" style="text-align:center;">
                        {{ $count }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $topgeo_code }}
                    </td>
                    <td class="data">
                        {{ $data['name'] }}
                    </td>
                    <td class="data">
                        {{ $data['model'] }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $data['limit'] }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $data['precision'] }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $data['demand'] }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $data['ctdad'] }}
                    </td>
                    <td class="data">
                        {{ $data['comment'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" rules="rows">
        <tr>
            <td valign="top" class="table-footer">Fecha de Elaboraci&oacute;n: {{ date('d/m/Y') }}</td>
            <td valign="top" class="table-footer" align="right">Aprobada: {{ $company['director'] }}<br>Director {{ $company['name'] }}</td>
        </tr>
    </table>
    <!------------------------------------------
    --------    END PAGE TOPOGRAPHY    ---------
    ------------------------------------------->

    <div class="page-break"></div>

    <!------------------------------------------
    -----------    PAGE ELECTRIC    ------------
    ------------------------------------------->
    <table class="table" border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th colspan="9">
                    <div class="table-title1">Ordinario</div>
                    <div class="table-title2">
                        Plantilla de Instrumentos de Medici&oacute;n, U/B Proyecto Hotelero
                    </div>
                    <table width="70%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="table-title3">Especialidad: Magnitudes El&eacute;ctricas</td>
                            <td class="table-title3">Plantilla No: 3</td>
                        </tr>
                    </table>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="10" class="column-title" rowspan="2" align="center">No.</td>
                <td width="40" class="column-title" rowspan="2" align="center">C&oacute;digo</td>
                <td width="90" class="column-title" rowspan="2">Denominaci&oacute;n</td>
                <td width="60" class="column-title" rowspan="2">Modelo</td>
                <td width="60" class="column-title" rowspan="2" align="center">
                    Rango de Medici&oacute;n
                </td>
                <td width="50" class="column-title" rowspan="2" align="center">Exactitud</td>
                <td class="column-title" colspan="2" align="center">Cantidad</td>
                <td width="80" class="column-title" rowspan="2">Observaciones</td>
            </tr>
            <tr>
                <td width="20" class="column-title" align="center">Lleva</td>
                <td width="20" class="column-title" align="center">Real</td>
            </tr>
            @php $count = 0; @endphp
            @foreach ($elect as $key => $data)
                @php $count++; @endphp
                <tr>
                    <td class="data" style="text-align:center;">
                        {{ $count }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $elect_code }}
                    </td>
                    <td class="data">
                        {{ $data['name'] }}
                    </td>
                    <td class="data">
                        {{ $data['model'] }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $data['limit'] }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $data['precision'] }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $data['demand'] }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $data['ctdad'] }}
                    </td>
                    <td class="data">
                        {{ $data['comment'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" rules="rows">
        <tr>
            <td valign="top" class="table-footer">Fecha de Elaboraci&oacute;n: {{ date('d/m/Y') }}</td>
            <td valign="top" class="table-footer" align="right">Aprobada: {{ $company['director'] }}<br>Director {{ $company['name'] }}</td>
        </tr>
    </table>
    <!------------------------------------------
    ---------    END PAGE ELECTRIC    ----------
    ------------------------------------------->

    <div class="page-break"></div>

    <!------------------------------------------
    -----------    PAGE PRESSURE    ------------
    ------------------------------------------->
    <table class="table" border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th colspan="9">
                    <div class="table-title1">Ordinario</div>
                    <div class="table-title2">
                        Plantilla de Instrumentos de Medici&oacute;n, U/B Proyecto Hotelero
                    </div>
                    <table width="70%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="table-title3">Especialidad: Presi&oacute;n</td>
                            <td class="table-title3">Plantilla No: 4</td>
                        </tr>
                    </table>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="10" class="column-title" rowspan="2" align="center">No.</td>
                <td width="40" class="column-title" rowspan="2" align="center">C&oacute;digo</td>
                <td width="90" class="column-title" rowspan="2">Denominaci&oacute;n</td>
                <td width="60" class="column-title" rowspan="2">Modelo</td>
                <td width="60" class="column-title" rowspan="2" align="center">
                    Rango de Medici&oacute;n
                </td>
                <td width="50" class="column-title" rowspan="2" align="center">Exactitud</td>
                <td class="column-title" colspan="2" align="center">Cantidad</td>
                <td width="80" class="column-title" rowspan="2">Observaciones</td>
            </tr>
            <tr>
                <td width="20" class="column-title" align="center">Lleva</td>
                <td width="20" class="column-title" align="center">Real</td>
            </tr>
            @php $count = 0; @endphp
            @foreach ($pressure as $key => $data)
                @php $count++; @endphp
                <tr>
                    <td class="data" style="text-align:center;">
                        {{ $count }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $pressure_code }}
                    </td>
                    <td class="data">
                        {{ $data['name'] }}
                    </td>
                    <td class="data">
                        {{ $data['model'] }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $data['limit'] }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $data['precision'] }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $data['demand'] }}
                    </td>
                    <td class="data" style="text-align:center;">
                        {{ $data['ctdad'] }}
                    </td>
                    <td class="data">
                        {{ $data['comment'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" rules="rows">
        <tr>
            <td valign="top" class="table-footer">Fecha de Elaboraci&oacute;n: {{ date('d/m/Y') }}</td>
            <td valign="top" class="table-footer" align="right">Aprobada: {{ $company['director'] }}<br>Director {{ $company['name'] }}</td>
        </tr>
    </table>
    <!------------------------------------------
    ---------    END PAGE PRESSURE    ----------
    ------------------------------------------->
@stop