<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Lista De Todos Los Fotochecks</title>
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
            margin-left: 30rem;
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
          /* font-size: 1rem; */
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
            <strong >MUNICIPALIDAD DISTRITAL DE CASTILLA <br> SUB GERENCIA DE TRANSPORTES
            </strong>
        </span>
    </div>

    <h4 class="center font-color">LISTADO DE FOTOCHECKS</h4>

    <table class="table">
        <thead>
            <tr bgcolor="#5D6D7E" class="font-color-white">
                <th scope="col" class="bg-primary text-white">SOCIO</th>
                <th scope="col" class="bg-primary text-white">NOMBRE PROPIETARIO</th>
                <th scope="col" class="bg-primary text-white">N° DOCUMENTO</th>
                <th scope="col" class="bg-primary text-white">N° AUTORIZACIÓN</th>
                <th scope="col" class="bg-primary text-white">VEHIVULO</th>
                <th scope="col" class="bg-primary text-white">TRANSPORTADOR</th>
                <th scope="col" class="bg-primary text-white">EXPEDICION</th>
                <th scope="col" class="bg-primary text-white">REVALIDACION</th>
                <th scope="col" class="bg-primary text-white"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fotochecks as $fotocheck)
                <tr>
                    <td>{{ $fotocheck->socio->nombre_socio }}</td>
                    <td>{{ $fotocheck->socio->nombre_propietario }}</td>

                    <td>{{ $fotocheck->socio->dni_socio }}</td>
                    <td>{{ $fotocheck->num_autorizacion }}</td>

                    @if ($fotocheck->vehiculo_id == 1)
                        <td class="text-info">{{ $fotocheck->vehiculo->nombre }}</td>
                    @elseif($fotocheck->vehiculo_id === 2)
                        <td class="text-primary">{{ $fotocheck->vehiculo->nombre }}</td>
                    @else
                        <td class="text-secondary">{{ $fotocheck->vehiculo->nombre }}</td>
                    @endif

                    @if (empty($fotocheck->socio->asociacione_id)  && $fotocheck->socio->tipo_documento_id == 3)
                        <td>Entidad Privada</td>
                    @elseif (empty($fotocheck->socio->asociacione_id))
                        <td>Persona Natural</td>
                    @else
                        <td>{{ optional($fotocheck->socio->asociacione)->nombre }}</td>
                    @endif

                    <td>{{ $fotocheck->expedicion }}</td>
                    <td>{{ $fotocheck->revalidacion }}</td>

                    @if ($fotocheck->status == 1)
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
