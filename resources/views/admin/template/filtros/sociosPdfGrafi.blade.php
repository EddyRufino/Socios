<!DOCTYPE html>
<html lang="en">
<head>
    {{-- <meta charset="UTF-8"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Tarjetas Eliminadas</title>

    <style>
        html {
            margin: 3pt;
        }
        .circle {
            display: block;
            width: 200px;
            height: 70px;
            margin-top: 1rem;
            margin-left: 1.5rem;
        }
        .text-center {
            display: inline-block;
            text-align: center;
            font-size: 1.1em;
        }
        .header-title {
            display: inline-block;
            margin-left: 27rem;
            margin-top: 0;
        }
        .font-color {
            color: #1F2937;
        }
        .center {
            text-align: center;
        }
        .font-color-white {
            color: white;
        }
        table {
          /*font-family: arial, sans-serif;*/
          border-collapse: collapse;
          width: 100%;
        }
        td, th {
          text-align: left;
          padding: 8px 0;
          font-size: .7rem;
        }
        tr:nth-child(even) {
          background-color: #F4F6F7;
        }
    </style>

    
</head>
<body>

    <div class="header">
        <img src="{{ asset('img/logo.png') }}" alt="Minucipalidad De Castilla" class="circle">
        <span class="text-center header-title font-color">
            <strong >MUNICIPALIDAD DISTRITAL DE CASTILLA
                <br> {{ $area->title }}
                <br> {{ $area->sub_title }}
            </strong>
        </span>
    </div>

    <h4 class="center font-color">GRAFICOS DE TARJETAS DE CIRCULACIÓN</h4>

    <div class="container">

        {{-- {{ dd($datas->count()) }} --}}

        <img src="https://quickchart.io/chart?width=400&height=300&c={type:'bar',data:{labels:[2012,2013,2014,2015,2016],datasets:[{label:'Users',data:[120,60,50,180,120]}]},options:{title:{display:true,text:'Charts XD'}}}">
        {{-- <img src="https://quickchart.io/chart?width=300&height=200&c={type:'bar',data:{labels:[2012,2013,2014,2015,2016],datasets:[{label:'Tarjetas',data:{{$dataTarjetas}}}, {label:'Fotochecks',data:{{$dataFotochecks}}}]},options:{title:{display:true,text:'Charts XD'}}}" alt=""> --}}
        {{-- <img src="https://quickchart.io/chart?width=300&height=200&c={type:'doughnut',data:{labels:[2012,2013,2014,2015,2016],datasets:[{label:'Tarjetas',data:{{$dataTarjetas}}}, {label:'Fotochecks',data:{{$dataFotochecks}}}]}}" alt=""> --}}
        {{-- <img src="https://quickchart.io/chart?width=300&height=200&c={!!$myChart!!}" alt=""> --}}
    </div>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8" type="text/javascript"></script> --}}
    
</body>
</html>
