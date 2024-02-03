<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} - @yield('title')</title>

        <style>
            .company-title1 {
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 17px;
                font-weight: 700;
            }
            .company-title2 {
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 9px;
                font-weight: bold;
                color: #000;
            }
            .company-title3 {
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 12px;
                font-weight: normal;
                color: #000;
                text-transform: normal;
                padding: 3px 7px;
            }
            .company-title3 span {
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 12px;
                font-weight: bold;
                color: #000;
                text-transform: uppercase;
                padding: 3px 0;
            }
            .column-title {
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 13px;
                font-weight: normal;
                color: #000;
                padding: 3px 7px;
            }
            .title-document{
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 12px;
                font-weight: normal;
                color: #000;
                text-transform: uppercase;
                padding: 10px 0;
            }
            .title-document span{
                font-size: 15px;
                font-weight: bold;

            }
            .title-category{
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 13px;
                font-weight: normal;
                color: #000;
                padding: 5px 0;
            }
            .title-paragraph{
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 13px;
                font-weight: normal;
                color: #000;
                line-height: 20px;
                padding: 20px 0;
                text-align: justify;
            }
            .title-table{
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 13px;
                font-weight: 700;
                color: #000;
                line-height: 20px;
                padding: 5px;
            }
            .table-footer {
                margin-top: 20px;

            }
            .table-signature {
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 12px;
                font-weight: normal;
                padding: 5px 7px;
            }
            .data {
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 12px;
                font-weight: normal;
                padding: 5px 7px;
            }
            /*.table-footer {
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 13px;
                font-weight: normal;
                padding: 5px 7px;
            }*/
            @page { margin: 100px 30px 10px 30px; }
            header {
                position: fixed;
                top: -85px;
                left: 0px;
                right: 0px;
                padding: 10px 0;
                height: 50px; 
                vertical-align: middle;
                border-bottom: #999 1px solid;
                margin-bottom: 0 !important;
            }
            /*.header-page { width: 100%; text-align: center; margin: 0; padding: 0;}*/
            p { page-break-after: always; }
            p:last-child { page-break-after: never; }
            .pagenum:before {
                content: counter(page);
            }
            hr { margin: 50px auto; border-color: #ccc; }
            .page-break {
                page-break-after: always;
            }
        </style>

    </head>
    <body>
        <header>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
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
        <main style="width:100%">
            @yield('content')
        </main>
    </body>
</html>