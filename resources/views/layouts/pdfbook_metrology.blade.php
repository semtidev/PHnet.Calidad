<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} - @yield('title')</title>

        <style>
            @page { margin: 30px 30px 0 30px; }
            .cover { width: 100%; margin-top: 50px; }
            .cover .logo { width: 100%; margin-bottom: 10px; text-align: center; }
            .cover .company-title1 {
                width: 100%;
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 24px;
                font-weight: 700;
                text-align: center;
            }
            .cover .company-title2 {
                width: 100%;
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 14px;
                font-weight: bold;
                color: #000;
                text-align: center;
            }
            .cover .system { 
                width: 100%; 
                margin-top: 150px;
                margin-bottom: 0px; 
                text-align: center; 
                text-transform: uppercase;
                font-size: 18px;  
            }
            .cover .reportname { 
                width: 100%;
                margin-top: 120px; 
                text-align: center; 
                text-transform: uppercase;
                font-size: 36px; 
                line-height: 50px; 
            }
            .cover .project { 
                width: 100%; 
                margin-top: 20px;
                margin-bottom: 20px; 
                text-align: center; 
                text-transform: uppercase;
                font-size: 20px;
                font-weight: bold;  
            }
            .cover .year { 
                width: 100%; 
                text-align: center;
                text-transform: uppercase;
                font-size: 18px; 
                line-height: 30px; 
            }
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
                font-weight: 700;
                color: #000;
                padding: 5px 7px;
            }
            .table {
                margin-top: 100px;
            }
            .table-title1 {
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 14px;
                font-weight: normal;
                padding: 3px 7px;
                text-align: right;
                text-transform: uppercase;
            }
            .table-title2 {
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 14px;
                font-weight: bold;
                padding: 3px 7px;
                text-align: center;
            }
            .table-title3 {
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 13px;
                font-weight: normal;
                padding: 5px 7px;
                text-align: center;
            }
            .data {
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 12px;
                font-weight: normal;
                padding: 5px 7px;
            }
            .table-footer {
                font-family: Verdana, Arial, Helvetica, sans-serif; 
                font-size: 13px;
                font-weight: normal;
                padding: 5px 7px;
            }
            header { position: fixed; top: -10px; left: 0px; right: 0px; padding: 10px; height: 50px; vertical-align: middle; margin-bottom: 30px !important; }
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
        <main style="width:100%">
            @yield('content')
        </main>
    </body>
</html>