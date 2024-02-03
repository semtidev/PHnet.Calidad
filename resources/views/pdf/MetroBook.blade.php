@extends('layouts.pdfbook_metrology')

@section('title', 'Libro de Instrumentos UBPH')

@section('content')
    <div class="cover">
        <div class="logo">
            <img src="{{ public_path('dist/img/icons/ecm4-logo.png') }}" width="130">
        </div>
        <div class="company-title1">Empresa Constructora Militar No 4</div>
        <div class="company-title2">Km 11/2 carretera a Cidra Matanzas</div>
        <div class="company-title2">
            tel&eacute;fono: (45) 292423&nbsp;&nbsp;&nbsp;correo electr&oacute;nico: ecm4@ucm4.co.cu
        </div>
        <div class="reportname">Libro de Instrumentos de Metrolog&iacute;a UBPH Centro Hist&oacute;rico</div>
        <div class="project">Proyecto {{ $work['name'] }}</div>
        <div class="system">Sistema de Calidad</div>
        <div class="year">{{ month_name(intval(date('m'))).' '.date('Y') }}</div>
    </div>
    
    <div class="page-break"></div>

    <!--  WEIGHT  -->
    <header>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="50%" class="company-title3" align="left">
                    @isset($work) {{ $company['name'] }}<br><span>Proyecto {{ $work['name'] }}</span> @endisset
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

    <table width="100%" class="table" border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <td width="10" class="column-title" align="center">No.</td>
                <td class="column-title">Denominaci&oacute;n</td>
                <td width="80" class="column-title">Modelo</td>
                <td width="70" class="column-title" align="center">Serie</td>
                <td width="110" class="column-title" align="center">Precisi&oacute;n</td>
                <td width="110" class="column-title" align="center">L&iacute;mite</td>
                <td width="65" class="column-title" align="center">&Uacute;ltima Verif.</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="7" bgcolor="#C6F1C6" style="padding:5px; text-transform:uppercase; color:#884B0F" class="column-title"><strong>Masa</strong></td>
            </tr>
            @php $count = 0; @endphp
            @if (count($weight) > 0)
            @foreach ($weight as $key => $data)
            @php $count++; @endphp
            <tr>
                <td class="data" style="text-align:center;">
                    {{ $count }}
                </td>
                <td class="data">
                    {{ $data['name'] }}
                </td>
                <td class="data">
                    {{ $data['model'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['serie'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['precision'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['limit'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['last_check'] }}
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    <div class="page-break"></div>

    <header>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="50%" class="company-title3" align="left">
                    @isset($work) {{ $company['name'] }}<br><span>Proyecto {{ $work['name'] }}</span> @endisset
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
    
    <table width="100%" class="table" border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <td width="10" class="column-title" align="center">No.</td>
                <td width="65" class="column-title" align="center">Plazo Verif.</td>
                <td width="65" class="column-title">Fecha Plan</td>
                <td width="65" class="column-title">Fecha Real</td>
                <td width="60" class="column-title" align="center">Resultado</td>
                <td width="65" class="column-title" align="center">Pr&oacute;ximo Plan</td>
                <td class="column-title">Observaciones</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="7" bgcolor="#C6F1C6" style="padding:5px; text-transform:uppercase; color:#884B0F; text-align:right;" class="column-title"><strong>Masa</strong></td>
            </tr>
            @php $count = 0; @endphp
            @if (count($weight) > 0)
            @foreach ($weight as $key => $data)
            @php $count++; @endphp
            <tr>
                <td class="data" style="text-align:center;">
                    {{ $count }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['term_check'] }}
                </td>
                <td class="data">
                    {{ $data['plan_date'] }}
                </td>
                <td class="data">
                    {{ $data['real_date'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['result_check'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['next_plan'] }}
                </td>
                <td class="data">
                    {{ $data['comment'] }}
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    
    <div class="page-break"></div>

    <!--  PRESSURE  -->
    <header>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="50%" class="company-title3" align="left">
                    @isset($work) {{ $company['name'] }}<br><span>Proyecto {{ $work['name'] }}</span> @endisset
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

    <table width="100%" class="table" border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <td width="10" class="column-title" align="center">No.</td>
                <td class="column-title">Denominaci&oacute;n</td>
                <td width="80" class="column-title">Modelo</td>
                <td width="70" class="column-title" align="center">Serie</td>
                <td width="110" class="column-title" align="center">Precisi&oacute;n</td>
                <td width="110" class="column-title" align="center">L&iacute;mite</td>
                <td width="65" class="column-title" align="center">&Uacute;ltima Verif.</td>
                <td width="65" class="column-title" align="center">Plazo Verif.</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="8" bgcolor="#C6F1C6" style="padding:5px; text-transform:uppercase; color:#884B0F;" class="column-title"><strong>Presi&oacute;n</strong></td>
            </tr>
            @php $count = 0; @endphp
            @if (count($pressure) > 0)
            @foreach ($pressure as $key => $data)
            @php $count++; @endphp
            <tr>
                <td class="data" style="text-align:center;">
                    {{ $count }}
                </td>
                <td class="data">
                    {{ $data['name'] }}
                </td>
                <td class="data">
                    {{ $data['model'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['serie'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['precision'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['limit'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['last_check'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['term_check'] }}
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    <div class="page-break"></div>

    <header>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="50%" class="company-title3" align="left">
                    @isset($work) {{ $company['name'] }}<br><span>Proyecto {{ $work['name'] }}</span> @endisset
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
    
    <table width="100%" class="table" border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <td width="10" class="column-title" align="center">No.</td>
                <td width="65" class="column-title">Fecha Plan</td>
                <td width="65" class="column-title">Fecha Real</td>
                <td width="60" class="column-title" align="center">Resultado</td>
                <td width="65" class="column-title" align="center">Pr&oacute;ximo Plan</td>
                <td width="80" class="column-title">&Aacute;rea</td>
                <td width="80" class="column-title">Responsable</td>
                <td class="column-title">Observaciones</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="8" bgcolor="#C6F1C6" style="padding:5px; text-transform:uppercase; color:#884B0F; text-align:right;" class="column-title"><strong>Presi&oacute;n</strong></td>
            </tr>
            @php $count = 0; @endphp
            @if (count($pressure) > 0)
            @foreach ($pressure as $key => $data)
            @php $count++; @endphp
            <tr>
                <td class="data" style="text-align:center;">
                    {{ $count }}
                </td>
                <td class="data">
                    {{ $data['plan_date'] }}
                </td>
                <td class="data">
                    {{ $data['real_date'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['result_check'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['next_plan'] }}
                </td>
                <td class="data">
                    {{ $data['location'] }}
                </td>
                <td class="data">
                    {{ $data['owner'] }}
                </td>
                <td class="data">
                    {{ $data['comment'] }}
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    
    <div class="page-break"></div>

    <!--  ELECTRIC  -->
    <header>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="50%" class="company-title3" align="left">
                    @isset($work) {{ $company['name'] }}<br><span>Proyecto {{ $work['name'] }}</span> @endisset
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

    <table width="100%" class="table" border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <td width="10" class="column-title" align="center">No.</td>
                <td class="column-title">Denominaci&oacute;n</td>
                <td width="80" class="column-title">Modelo</td>
                <td width="70" class="column-title" align="center">Serie</td>
                <td width="110" class="column-title" align="center">Precisi&oacute;n</td>
                <td width="110" class="column-title" align="center">L&iacute;mite</td>
                <td width="65" class="column-title" align="center">&Uacute;ltima Verif.</td>
                <td width="65" class="column-title" align="center">Plazo Verif.</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="8" bgcolor="#C6F1C6" style="padding:5px; text-transform:uppercase; color:#884B0F;" class="column-title"><strong>Magnitudes El&eacute;ctricas</strong></td>
            </tr>
            @php $count = 0; @endphp
            @if (count($elect) > 0)
            @foreach ($elect as $key => $data)
            @php $count++; @endphp
            <tr>
                <td class="data" style="text-align:center;">
                    {{ $count }}
                </td>
                <td class="data">
                    {{ $data['name'] }}
                </td>
                <td class="data">
                    {{ $data['model'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['serie'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['precision'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['limit'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['last_check'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['term_check'] }}
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    <div class="page-break"></div>

    <header>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="50%" class="company-title3" align="left">
                    @isset($work) {{ $company['name'] }}<br><span>Proyecto {{ $work['name'] }}</span> @endisset
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
    
    <table width="100%" class="table" border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <td width="10" class="column-title" align="center">No.</td>
                <td width="65" class="column-title">Fecha Plan</td>
                <td width="65" class="column-title">Fecha Real</td>
                <td width="60" class="column-title" align="center">Resultado</td>
                <td width="65" class="column-title" align="center">Pr&oacute;ximo Plan</td>
                <td width="80" class="column-title">&Aacute;rea</td>
                <td width="80" class="column-title">Responsable</td>
                <td class="column-title">Observaciones</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="8" bgcolor="#C6F1C6" style="padding:5px; text-transform:uppercase; color:#884B0F; text-align:right;" class="column-title"><strong>Magnitudes El&eacute;ctricas</strong></td>
            </tr>
            @php $count = 0; @endphp
            @if (count($elect) > 0)
            @foreach ($elect as $key => $data)
            @php $count++; @endphp
            <tr>
                <td class="data" style="text-align:center;">
                    {{ $count }}
                </td>
                <td class="data">
                    {{ $data['plan_date'] }}
                </td>
                <td class="data">
                    {{ $data['real_date'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['result_check'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['next_plan'] }}
                </td>
                <td class="data">
                    {{ $data['location'] }}
                </td>
                <td class="data">
                    {{ $data['owner'] }}
                </td>
                <td class="data">
                    {{ $data['comment'] }}
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    
    <div class="page-break"></div>

    <!--  TOPOGRAPHY  -->
    <header>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="50%" class="company-title3" align="left">
                    @isset($work) {{ $company['name'] }}<br><span>Proyecto {{ $work['name'] }}</span> @endisset
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

    <table width="100%" class="table" border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <td width="10" class="column-title" align="center">No.</td>
                <td class="column-title">Denominaci&oacute;n</td>
                <td width="80" class="column-title">Modelo</td>
                <td width="70" class="column-title" align="center">Serie</td>
                <td width="110" class="column-title" align="center">Precisi&oacute;n</td>
                <td width="110" class="column-title" align="center">L&iacute;mite</td>
                <td width="65" class="column-title" align="center">&Uacute;ltima Verif.</td>
                <td width="65" class="column-title" align="center">Plazo Verif.</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="8" bgcolor="#C6F1C6" style="padding:5px; text-transform:uppercase; color:#884B0F;" class="column-title"><strong>Topograf&Iacute;a y Geodesia</strong></td>
            </tr>
            @php $count = 0; @endphp
            @if (count($topgeo) > 0)
            @foreach ($topgeo as $key => $data)
            @php $count++; @endphp
            <tr>
                <td class="data" style="text-align:center;">
                    {{ $count }}
                </td>
                <td class="data">
                    {{ $data['name'] }}
                </td>
                <td class="data">
                    {{ $data['model'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['serie'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['precision'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['limit'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['last_check'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['term_check'] }}
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    <div class="page-break"></div>

    <header>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="50%" class="company-title3" align="left">
                    @isset($work) {{ $company['name'] }}<br><span>Proyecto {{ $work['name'] }}</span> @endisset
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
    
    <table width="100%" class="table" border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <td width="10" class="column-title" align="center">No.</td>
                <td width="65" class="column-title">Fecha Plan</td>
                <td width="65" class="column-title">Fecha Real</td>
                <td width="60" class="column-title" align="center">Resultado</td>
                <td width="65" class="column-title" align="center">Pr&oacute;ximo Plan</td>
                <td width="80" class="column-title">&Aacute;rea</td>
                <td width="80" class="column-title">Responsable</td>
                <td class="column-title">Observaciones</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="8" bgcolor="#C6F1C6" style="padding:5px; text-transform:uppercase; color:#884B0F; text-align:right;" class="column-title"><strong>Topograf&Iacute;a y Geodesia</strong></td>
            </tr>
            @php $count = 0; @endphp
            @if (count($topgeo) > 0)
            @foreach ($topgeo as $key => $data)
            @php $count++; @endphp
            <tr>
                <td class="data" style="text-align:center;">
                    {{ $count }}
                </td>
                <td class="data">
                    {{ $data['plan_date'] }}
                </td>
                <td class="data">
                    {{ $data['real_date'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['result_check'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['next_plan'] }}
                </td>
                <td class="data">
                    {{ $data['location'] }}
                </td>
                <td class="data">
                    {{ $data['owner'] }}
                </td>
                <td class="data">
                    {{ $data['comment'] }}
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    
    <div class="page-break"></div>

    <!--  LENGTH  -->
    <header>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="50%" class="company-title3" align="left">
                    @isset($work) {{ $company['name'] }}<br><span>Proyecto {{ $work['name'] }}</span> @endisset
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

    <table width="100%" class="table" border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <td width="10" class="column-title" align="center">No.</td>
                <td class="column-title">Denominaci&oacute;n</td>
                <td width="80" class="column-title">Modelo</td>
                <td width="70" class="column-title" align="center">Serie</td>
                <td width="110" class="column-title" align="center">Precisi&oacute;n</td>
                <td width="110" class="column-title" align="center">L&iacute;mite</td>
                <td width="65" class="column-title" align="center">&Uacute;ltima Verif.</td>
                <td width="65" class="column-title" align="center">Plazo Verif.</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="8" bgcolor="#C6F1C6" style="padding:5px; text-transform:uppercase; color:#884B0F;" class="column-title"><strong>Longitud</strong></td>
            </tr>
            @php $count = 0; @endphp
            @if (count($length) > 0)
            @foreach ($length as $key => $data)
            @php $count++; @endphp
            <tr>
                <td class="data" style="text-align:center;">
                    {{ $count }}
                </td>
                <td class="data">
                    {{ $data['name'] }}
                </td>
                <td class="data">
                    {{ $data['model'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['serie'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['precision'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['limit'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['last_check'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['term_check'] }}
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    <div class="page-break"></div>

    <header>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="50%" class="company-title3" align="left">
                    @isset($work) {{ $company['name'] }}<br><span>Proyecto {{ $work['name'] }}</span> @endisset
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
    
    <table width="100%" class="table" border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <td width="10" class="column-title" align="center">No.</td>
                <td width="65" class="column-title">Fecha Plan</td>
                <td width="65" class="column-title">Fecha Real</td>
                <td width="60" class="column-title" align="center">Resultado</td>
                <td width="65" class="column-title" align="center">Pr&oacute;ximo Plan</td>
                <td width="80" class="column-title">&Aacute;rea</td>
                <td width="80" class="column-title">Responsable</td>
                <td class="column-title">Observaciones</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="8" bgcolor="#C6F1C6" style="padding:5px; text-transform:uppercase; color:#884B0F; text-align:right;" class="column-title"><strong>Longitud</strong></td>
            </tr>
            @php $count = 0; @endphp
            @if (count($length) > 0)
            @foreach ($length as $key => $data)
            @php $count++; @endphp
            <tr>
                <td class="data" style="text-align:center;">
                    {{ $count }}
                </td>
                <td class="data">
                    {{ $data['plan_date'] }}
                </td>
                <td class="data">
                    {{ $data['real_date'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['result_check'] }}
                </td>
                <td class="data" style="text-align:center;">
                    {{ $data['next_plan'] }}
                </td>
                <td class="data">
                    {{ $data['location'] }}
                </td>
                <td class="data">
                    {{ $data['owner'] }}
                </td>
                <td class="data">
                    {{ $data['comment'] }}
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
@stop