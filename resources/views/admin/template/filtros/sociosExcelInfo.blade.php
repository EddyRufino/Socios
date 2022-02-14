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
        {{-- <div class="header">
            <img src="{{ asset('img/logo.png') }}" alt="Minucipalidad De Castilla" class="circle">
            <span class="text-center header-title font-color">
                <strong >MUNICIPALIDAD DISTRITAL DE CASTILLA
                    <br> {{ $area->title }}
                    <br> {{ $area->sub_title }}
                </strong>
            </span>
        </div> --}}

        <h4 class="center font-color">LISTADO DE {{ $isModelo == 1 ? 'TARJETAS' : 'FOTOCHECKS' }}</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre y Apellido</th>
                    <th scope="col">N. Doc</th>
                    <th scope="col">N. Placa</th>
                    <th scope="col">Asociación</th>
                    <th scope="col">Vehículo</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($datas as $data)
                    <tr>
                        <td>{{ $data->socio->nombre_socio }}</td>
                        <td>{{ $data->socio->dni_socio }}</td>
                        <td>{{ $data->num_placa }}</td>

                        @if (empty($data->socio->asociacione_id)  && $data->socio->tipo_documento_id == 3)
                            <td class="text-secondary">Entidad Privada</td>
                        @elseif (empty($data->socio->asociacione_id))
                            <td class="text-secondary">Persona Natural</td>
                        @else
                            <td>{{ optional($data->socio->asociacione)->nombre }}</td>
                        @endif

                        @if ($data->socio->vehiculo_id == 1)
                            <td class="text-info">{{ $data->socio->vehiculo->nombre }}</td>
                        @elseif($data->socio->vehiculo_id === 2)
                            <td class="text-primary">{{ $data->socio->vehiculo->nombre }}</td>
                        @else
                            <td class="text-secondary">{{ $data->socio->vehiculo->nombre }}</td>
                        @endif

                        @if ($data->status == 1)
                            <td>Impreso</td>
                        @else
                            <td>No Impreso</td>
                        @endif
                    </tr>
                @empty
                    <li class="list-group-item border-0 mb-3 shadow-sm">No hay nada para mostrar</li>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
