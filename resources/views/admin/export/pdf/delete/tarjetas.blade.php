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

    <h4 class="center font-color">LISTADO DE TARJETAS DE CIRCULACIÓN</h4>

    <table class="table">
        {{-- <thead>
            <tr bgcolor="#5D6D7E" class="font-color-white">
                    <th scope="col" class="bg-primary text-white">SOCIO</th>
                    <th scope="col" class="bg-primary text-white">NOM. PROP.</th>
                    <th scope="col" class="bg-primary text-white">N° DOC.</th>
                    <th scope="col" class="bg-primary text-white">PLACA</th>
                    <th scope="col" class="bg-primary text-white">VEHIVULO</th>
                    <th scope="col" class="bg-primary text-white">ASOCIACION</th>
                    <th scope="col" class="bg-primary text-white">EXPEDI.</th>
                    <th scope="col" class="bg-primary text-white">REVALIDA.</th>
                    <th scope="col" class="bg-primary text-white">N° OPERAC.</th>
                    <th scope="col" class="bg-primary text-white">V. OPERAC.</th>
                    <th scope="col" class="bg-primary text-white">N° AUTORIZAC.</th>
                    <th scope="col" class="bg-primary text-white">V. AUTORIZAC.</th>
                    <th scope="col" class="bg-primary text-white">N° CORREL.</th>
                    <th scope="col" class="bg-primary text-white">ELIMINADO</th>
                    <th scope="col" class="bg-primary text-white"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tarjetas as $tarjeta)
            <tr>
                <td>{{ optional($tarjeta->socio)->nombre_socio }}</td>
                <td>{{ $tarjeta->socio->nombre_propietario }}</td>

                <td>{{ optional($tarjeta->socio)->dni_socio }}</td>
                <td>{{ $tarjeta->num_placa ? $tarjeta->num_placa : '-' }}</td>

                @if ($tarjeta->vehiculo_id == 1)
                    <td class="text-info">{{ optional($tarjeta->vehiculo)->nombre }}</td>
                @elseif($tarjeta->vehiculo_id === 2)
                    <td class="text-primary">{{ optional($tarjeta->vehiculo)->nombre }}</td>
                @else
                    <td class="text-secondary">{{ optional($tarjeta->vehiculo)->nombre }}</td>
                @endif

                @if (empty(optional($tarjeta->socio)->asociacione_id)  && optional($tarjeta->socio)->tipo_documento_id == 3)
                    <td class="text-secondary">Entidad Privada</td>
                @elseif (empty(optional($tarjeta->socio)->asociacione_id))
                    <td class="text-secondary">Persona Natural</td>
                @else
                    <td>{{ optional(optional($tarjeta->socio)->asociacione)->nombre }}</td>
                @endif

                <td>{{ $tarjeta->expedicion }}</td>
                <td>{{ $tarjeta->revalidacion }}</td>

                <td>{{ $tarjeta->num_operacion }}</td>
                <td>{{ $tarjeta->vigencia_operacion }}</td>

                <td>{{ $tarjeta->num_autorizacion }}</td>
                <td>{{ $tarjeta->vigencia_autorizacion }}</td>

                <td>{{ $tarjeta->num_correlativo }}</td>


                <td>{{ \Carbon\Carbon::parse($tarjeta->deleted_at)->format('Y-m-d') }}</td>

                @if ($tarjeta->status == 1)
                    <td><img src="{{ asset('img/printer.png') }}" alt="Impreso"></td>
                @else
                    <td></td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table> --}}

    <div class="row">
        {{-- <div class="col-md-12">
            {!! $chart->container() !!}

            {!! $chart->script() !!}
        </div> --}}
        <img src="https://quickchart.io/chart?width=300&height=200&c={type:'bar',data:{labels:[2012,2013,2014,2015,2016],datasets:[{label:'Tarjetas',data:{{$dataTarjetas}}}, {label:'Fotochecks',data:{{$dataFotochecks}}}]},options:{title:{display:true,text:'Charts XD'}}}" alt="">
        {{-- <img src="https://quickchart.io/chart?width=300&height=200&c={type:'doughnut',data:{labels:[2012,2013,2014,2015,2016],datasets:[{label:'Tarjetas',data:{{$dataTarjetas}}}, {label:'Fotochecks',data:{{$dataFotochecks}}}]}}" alt=""> --}}
        {{-- <img src="https://quickchart.io/chart?width=300&height=200&c={!!$myChart!!}" alt=""> --}}
    </div>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8" type="text/javascript"></script> --}}
    
</body>
</html>
