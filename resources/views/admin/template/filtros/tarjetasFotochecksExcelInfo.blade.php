<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Socios Filtrados</title>
</head>
<body>
    <div>
        <h4 class="center font-color">LISTADO DE TARJETAS Y FOTOCHECKS</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre y Apellido</th>
                    <th>N. Doc</th>
                    <th>N. Placa</th>
                    <th>Asociación</th>
                    <th>Vehículo</th>
                    <th>Tarjeta</th>
                    <th>Fotocheck</th>
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
                            <td>Impreso</td>
                        @else
                            <td>No Impreso</td>
                        @endif

                        @if ($data->fotochecks()->pluck('status')->implode('') == 1)
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
