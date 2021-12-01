<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista De Todas Las Tarjetas</title>

</head>
<body>
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
                    <th scope="col" class="bg-primary text-white">EXPEDICION</th>
                    <th scope="col" class="bg-primary text-white">REVALIDACION</th>
                    <th scope="col" class="bg-primary text-white">N° OPERACION</th>
                    <th scope="col" class="bg-primary text-white">VIGENCIA OPERACION</th>
                    <th scope="col" class="bg-primary text-white">N° AUTORIZACION</th>
                    <th scope="col" class="bg-primary text-white">VIGENCIA AUTORIZACION</th>
                    <th scope="col" class="bg-primary text-white">N° CORRELATIVO</th>
                    <th scope="col" class="bg-primary text-white">IMPRESO</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attributes as $tarjeta)
                <tr>
                    <td>{{ $tarjeta->socio->nombre_socio }}</td>
                    <td>{{ $tarjeta->socio->nombre_propietario }}</td>
                    <td>{{ $tarjeta->socio->documento->nombre }}</td>

                    <td>{{ $tarjeta->socio->dni_socio }}</td>
                    <td>{{ $tarjeta->num_placa ? $tarjeta->num_placa : '-' }}</td>

                    @if ($tarjeta->vehiculo_id == 1)
                        <td class="text-info">{{ $tarjeta->vehiculo->nombre }}</td>
                    @elseif($tarjeta->vehiculo_id === 2)
                        <td class="text-primary">{{ $tarjeta->vehiculo->nombre }}</td>
                    @else
                        <td class="text-secondary">{{ $tarjeta->vehiculo->nombre }}</td>
                    @endif

                    <td>{{ optional($tarjeta->socio->asociacione)->nombre }}</td>

                    <td>{{ $tarjeta->expedicion }}</td>
                    <td>{{ $tarjeta->revalidacion }}</td>

                    <td>{{ $tarjeta->num_operacion }}</td>
                    <td>{{ $tarjeta->vigencia_operacion }}</td>

                    <td>{{ $tarjeta->num_autorizacion }}</td>
                    <td>{{ $tarjeta->vigencia_autorizacion }}</td>

                    <td>{{ $tarjeta->num_correlativo }}</td>

                   @if ($tarjeta->status == 1)
                        <td>IMPRESO</td>
                    @else
                        <td>NO IMPRESO</td>
                    @endif

                </tr>

            @endforeach

        </tbody>
    </table>
</body>
</html>
