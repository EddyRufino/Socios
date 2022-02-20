<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Socios Filtrados</title>

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
            margin-top: -20;
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
                <strong >MUNICIPALIDAD DISTRITAL DE CASTILLA
                    <br> {{ $area->title }}
                    <br> {{ $area->sub_title }}
                </strong>
            </span>
        </div>

        <h4 class="center font-color">LISTADO DE TARJETAS Y FOTOCHECKS</h4>
        <table class="table table-striped">
            <thead>
                <tr bgcolor="#5D6D7E" class="font-color-white">
                    <th scope="col" class="bg-primary text-white">Nombre y Apellido</th>
                    <th scope="col" class="bg-primary text-white">N. Doc</th>
                    <th scope="col" class="bg-primary text-white">N. Placa</th>
                    <th scope="col" class="bg-primary text-white">Asociación</th>
                    <th scope="col" class="bg-primary text-white">Vehículo</th>
                    <th scope="col" class="bg-primary text-white">Tarjeta</th>
                    <th scope="col" class="bg-primary text-white">Fotocheck</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($datas as $data)
                    <tr>
                        <td>{{ $data->nombre_socio }}</td>
                        <td>{{ $data->dni_socio }}</td>
                        <td>{{ $data->num_placa }}</td>

                        @if (empty($data->asociacione_id)  && $data->tipo_documento_id == 3)
                            <td class="text-secondary">Entidad Privada</td>
                        @elseif (empty($data->asociacione_id))
                            <td class="text-secondary">Persona Natural</td>
                        @else
                            <td>{{ optional($data->asociacione)->nombre }}</td>
                        @endif

                        @if ($data->vehiculo_id == 1)
                            <td class="text-info">{{ $data->vehiculo->nombre }}</td>
                        @elseif($data->vehiculo_id === 2)
                            <td class="text-primary">{{ $data->vehiculo->nombre }}</td>
                        @else
                            <td class="text-secondary">{{ $data->vehiculo->nombre }}</td>
                        @endif

                        @if ($data->tarjetas()->pluck('status')->implode('') == 1)
                            <td><img src="{{ asset('img/printer.png') }}" alt="Impreso"></td>
                        @else
                            <td></td>
                        @endif

                        @if ($data->fotochecks()->pluck('status')->implode('') == 1)
                            <td><img src="{{ asset('img/printer.png') }}" alt="Impreso"></td>
                        @else
                            <td></td>
                        @endif
                        {{-- <td>
                            <div class="d-flex">
                                @if (request()->tarjeta)
                                    <a href="{{ route('tarjetas.show', $data->url) }}"
                                        class="text-decoration-none tooltipw"
                                        target="_blank"
                                    >
                                    <span id="tooltipw" class="tooltiptext">Ver QR</span>
                                        @include('icons.qr')
                                    </a>
                        
                                    <h6><a href="{{ route('tarjeta.anverso', $data->id) }}"
                                        class="ml-3 text-decoration-none tooltipw"
                                        target="_blank"
                                    >
                                        <span id="tooltipw" class="tooltiptext">Ver Tarjeta Circulación</span>
                                        @include('icons.tarjeta')
                                    </a></h6>
                                @endif
                                
                                @if (request()->fotocheck)
                                    <h6><a href="{{ route('fotochecks.show', $data->url) }}"
                                        class="text-decoration-none tooltipw"
                                        target="_blank"
                                    >
                                        <span id="tooltipw" class="tooltiptext">Ver QR</span>
                                        @include('icons.qr')
                                    </a></h6>

                                    <h6><a href="{{ route('fotocheck.anverso', $data->id) }}"
                                        class="ml-3 text-decoration-none tooltipw"
                                        target="_blank"
                                    >
                                        <span id="tooltipw" class="tooltiptext">Ver Fotocheck</span>
                                        @include('icons.fotocheck')
                                    </a></h6>
                                @endif

                            </div>
                        </td> --}}
                    </tr>
                @empty
                    <li class="list-group-item border-0 mb-3 shadow-sm">No hay nada para mostrar</li>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
