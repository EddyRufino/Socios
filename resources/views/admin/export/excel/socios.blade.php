<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
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


        <table class="table">
            <thead>
                <tr bgcolor="#5D6D7E" class="font-color-white">
                        <th scope="col" class="bg-primary text-white">NOMBRE SOCIO</th>
                        <th scope="col" class="bg-primary text-white">NOMBRE PROPIETARIO</th>
                        <th scope="col" class="bg-primary text-white">TIPO DOCUMENTO</th>
                        <th scope="col" class="bg-primary text-white">N° DOCUMENTO SOCIO</th>
                        <th scope="col" class="bg-primary text-white">PLACA</th>
                        <th scope="col" class="bg-primary text-white">VEHIVULO</th>
                        <th scope="col" class="bg-primary text-white">TRANSPORTADOR</th>
                        <th scope="col" class="bg-primary text-white">ACTIVIDAD</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attributes as $socio)
                    <tr>
                        <td>{{ $socio->nombre_socio }}</td>
                        <td>{{ $socio->nombre_propietario }}</td>
                        <td>{{ $socio->documento->nombre }}</td>

                        <td>{{ $socio->dni_socio }}</td>
                        <td>{{ $socio->num_placa ? $socio->num_placa : '-' }}</td>

                        @if ($socio->vehiculo_id == 1)
                            <td class="text-info">{{ $socio->vehiculo->nombre }}</td>
                        @elseif($socio->vehiculo_id === 2)
                            <td class="text-primary">{{ $socio->vehiculo->nombre }}</td>
                        @else
                            <td class="text-secondary">{{ $socio->vehiculo->nombre }}</td>
                        @endif

                        <td>{{ optional($socio->asociacione)->nombre }}</td>

                        @if ($socio->tarjetas()->exists())
                            <th>TARJETA CIRCULACION, </th>
                        @endif

                        @if ($socio->fotochecks()->exists())
                            <th>FOTOCHECK</th>
                        @endif

                    </tr>

                @endforeach
                    <tr>
                        @if ($attributes->count() > 0)

                            @if (is_numeric(request()->id))

                                <th>
                                    <span class="countTarjeta mr-1">Tarjetas</span>
                                    <strong class="mr-3">{{$tarjetasCount->count()}}</strong>

                                    <span class="countTarjeta">Fotochecks</span>
                                    <strong class="ml-1">{{$fotochecksCount->count()}}</strong>
                                </th>

                            @endif

                            @if (request()->id == 'natural')

                                <th>
                                <span class="countTarjeta mr-1">Tarjetas</span>
                                <strong class="mr-3">{{$tarjetasCountNatural->count()}}</strong>

                                <span class="countTarjeta">Fotochecks</span>
                                <strong class="ml-1">{{$fotochecksCountNatural->count()}}</strong>
                                </th>

                            @endif

                        @endif
                    </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
