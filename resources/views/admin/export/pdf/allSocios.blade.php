<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Lista De Socios</title>

    <style>
        .circle {
            display: block;
            width: 200px;
            height: 70px;
            padding-bottom: .7rem;
        }
        .text-center {
            display: inline-block;
            text-align: center;
            font-size: 1.1em;
        }
        .header-title {
            display: inline-block;
            margin-left: 7rem;
            margin-top: -25;
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
        }
        tr:nth-child(even) {
          background-color: #F4F6F7;
        }
    </style>

</head>
<body>
    <div>
        <div class="header">
            <img src="{{ asset('img/logo.png') }}" alt="Minucipalidad De Castilla" class="circle">
            <span class="text-center header-title font-color">
                <strong >MUNICIPALIDAD DISTRITAL DE CASTILLA <br> SUB GERENCIA DE TRANSPORTES
                </strong>
            </span>
        </div>

        <h4 class="center font-color">LISTADO DE SOCIOS</h4>

        <table class="table">
            <thead>
                <tr bgcolor="#5D6D7E" class="font-color-white">
                        <th scope="col" class="bg-primary text-white">NOMBRES Y APELLIDOS</th>
                        <th scope="col" class="bg-primary text-white">DNI, RUC, CARNET</th>
                        <th scope="col" class="bg-primary text-white">PLACA</th>
                        <th scope="col" class="bg-primary text-white">VEHIVULO</th>
                        <th scope="col" class="bg-primary text-white">ASOCIACIÓN</th>
                        <th scope="col" class="bg-primary text-white"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($socios as $key => $socio)
                    <tr>
                        
                        <td>{{ $socio->nombre_socio }}</td>

                        <td>{{ $socio->dni_socio }}</td>
                        <td>{{ $socio->num_placa ? $socio->num_placa : '-' }}</td>

                        @if ($socio->vehiculo_id == 1)
                            <td class="text-info">{{ $socio->vehiculo->nombre }}</td>
                        @elseif($socio->vehiculo_id === 2)
                            <td class="text-primary">{{ $socio->vehiculo->nombre }}</td>
                        @else
                            <td class="text-secondary">{{ $socio->vehiculo->nombre }}</td>
                        @endif

                        @if (empty($socio->asociacione_id)  && $socio->tipo_documento_id == 3)
                            <td class="text-secondary">Entidad Privada</td>
                        @elseif (empty($socio->asociacione_id))
                            <td class="text-secondary">Persona Natural</td>
                        @else
                            <td>{{ optional($socio->asociacione)->nombre }}</td>
                        @endif

                        @if ($socio->tarjetas()->exists())
                            <td><img src="{{ asset('img/tarjeta.png') }}" alt="Tarjeta"></td>
                        @endif

                        @if ($socio->fotochecks()->exists())
                            <td><img src="{{ asset('img/fotocheck.png') }}" alt="Fotocheck"></td>
                        @endif
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
