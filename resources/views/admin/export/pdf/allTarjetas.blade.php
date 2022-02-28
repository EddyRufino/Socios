<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Lista De Todas Las Tarjetas</title>
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
        <thead>
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
                    <th scope="col" class="bg-primary text-white"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tarjetas as $tarjeta)
                <tr>
                    <td>{{ $tarjeta->socio ? $tarjeta->socio->nombre_socio : '' }}</td>
                    <td>{{ $tarjeta->socio ? $tarjeta->socio->nombre_propietario : '' }}</td>

                    <td>{{ $tarjeta->socio ? $tarjeta->socio->dni_socio : '' }}</td>
                    <td>{{ $tarjeta->num_placa }}</td>

                    <td>{{ $tarjeta->vehiculo->nombre }}</td>

                    <td>{{ $tarjeta->getAsociacionDewlete($tarjeta->socio_id) }}</td>

                    <td>{{ $tarjeta->expedicion }}</td>
                    <td>{{ $tarjeta->revalidacion }}</td>

                    <td>{{ $tarjeta->num_operacion }}</td>
                    <td>{{ $tarjeta->vigencia_operacion }}</td>

                    <td>{{ $tarjeta->num_autorizacion }}</td>
                    <td>{{ $tarjeta->vigencia_autorizacion }}</td>

                    <td>{{ $tarjeta->num_correlativo }}</td>

                    @if ($tarjeta->status == 1)
                        <td><img src="{{ asset('img/printer.png') }}" alt="Impreso"></td>
                    @else
                        <td></td>
                    @endif

                </tr>

            @endforeach

        </tbody>
    </table>
</body>
</html>
