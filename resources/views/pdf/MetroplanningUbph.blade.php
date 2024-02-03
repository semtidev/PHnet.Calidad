@extends('layouts.pdfbook_metroplanningubph')

@section('title', 'Plan de Calibraci&oacute;n UBPH')

@section('content')
<table width="100%" border="1" cellspacing="0" cellpadding="0">
    @php $count = 0; @endphp
    @foreach ($planningubph as $key => $data)
    @php $count++; @endphp
    <tr>
        <td width="20" class="data" align="center">{{ $count }}</td>
        <td width="50" class="data" align="center">{{ $data['project'] }}</td>
        <td class="data" align="left"><strong>{!! $data['name'] !!}</strong></td>
        <td width="100" class="data" align="center">{{ $data['serie'] }}</td>
        
        @if ($data['ene'] == 0) <td width="20" class="data">&nbsp;</td> @elseif ($data['ene'] == 1)
        <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['ene'] == 2) <td width="20" class="data cell-planning" align="center">PL</td>
        @elseif ($data['ene'] == 3) <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['ene'] == 4) <td width="20" class="data cell-backlog" align="center">P</td> @endif
        
        @if ($data['feb'] == 0) <td width="20" class="data">&nbsp;</td> @elseif ($data['feb'] == 1)
        <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['feb'] == 2) <td width="20" class="data cell-planning" align="center">PL</td>
        @elseif ($data['feb'] == 3) <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['feb'] == 4) <td width="20" class="data cell-backlog" align="center">P</td> @endif

        @if ($data['mar'] == 0) <td width="20" class="data">&nbsp;</td> @elseif ($data['mar'] == 1)
        <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['mar'] == 2) <td width="20" class="data cell-planning" align="center">PL</td>
        @elseif ($data['mar'] == 3) <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['mar'] == 4) <td width="20" class="data cell-backlog" align="center">P</td> @endif

        @if ($data['abr'] == 0) <td width="20" class="data">&nbsp;</td> @elseif ($data['abr'] == 1)
        <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['abr'] == 2) <td width="20" class="data cell-planning" align="center">PL</td>
        @elseif ($data['abr'] == 3) <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['abr'] == 4) <td width="20" class="data cell-backlog" align="center">P</td> @endif

        @if ($data['may'] == 0) <td width="20" class="data">&nbsp;</td> @elseif ($data['may'] == 1)
        <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['may'] == 2) <td width="20" class="data cell-planning" align="center">PL</td>
        @elseif ($data['may'] == 3) <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['may'] == 4) <td width="20" class="data cell-backlog" align="center">P</td> @endif

        @if ($data['jun'] == 0) <td width="20" class="data">&nbsp;</td> @elseif ($data['jun'] == 1)
        <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['jun'] == 2) <td width="20" class="data cell-planning" align="center">PL</td>
        @elseif ($data['jun'] == 3) <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['jun'] == 4) <td width="20" class="data cell-backlog" align="center">P</td> @endif

        @if ($data['jul'] == 0) <td width="20" class="data">&nbsp;</td> @elseif ($data['jul'] == 1)
        <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['jul'] == 2) <td width="20" class="data cell-planning" align="center">PL</td>
        @elseif ($data['jul'] == 3) <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['jul'] == 4) <td width="20" class="data cell-backlog" align="center">P</td> @endif

        @if ($data['ago'] == 0) <td width="20" class="data">&nbsp;</td> @elseif ($data['ago'] == 1)
        <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['ago'] == 2) <td width="20" class="data cell-planning" align="center">PL</td>
        @elseif ($data['ago'] == 3) <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['ago'] == 4) <td width="20" class="data cell-backlog" align="center">P</td> @endif

        @if ($data['sep'] == 0) <td width="20" class="data">&nbsp;</td> @elseif ($data['sep'] == 1)
        <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['sep'] == 2) <td width="20" class="data cell-planning" align="center">PL</td>
        @elseif ($data['sep'] == 3) <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['sep'] == 4) <td width="20" class="data cell-backlog" align="center">P</td> @endif

        @if ($data['oct'] == 0) <td width="20" class="data">&nbsp;</td> @elseif ($data['oct'] == 1)
        <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['oct'] == 2) <td width="20" class="data cell-planning" align="center">PL</td>
        @elseif ($data['oct'] == 3) <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['oct'] == 4) <td width="20" class="data cell-backlog" align="center">P</td> @endif

        @if ($data['nov'] == 0) <td width="20" class="data">&nbsp;</td> @elseif ($data['nov'] == 1)
        <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['nov'] == 2) <td width="20" class="data cell-planning" align="center">PL</td>
        @elseif ($data['nov'] == 3) <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['nov'] == 4) <td width="20" class="data cell-backlog" align="center">P</td> @endif

        @if ($data['dic'] == 0) <td width="20" class="data">&nbsp;</td> @elseif ($data['dic'] == 1)
        <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['dic'] == 2) <td width="20" class="data cell-planning" align="center">PL</td>
        @elseif ($data['dic'] == 3) <td width="20" class="data cell-real" align="center">R</td>
        @elseif ($data['dic'] == 4) <td width="20" class="data cell-backlog" align="center">P</td> @endif
    </tr>
    @endforeach
</table>
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
@stop