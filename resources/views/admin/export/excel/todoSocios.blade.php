<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista De Todos Los Socios</title>

</head>
<body>
    <table class="table">
        <thead>
            <tr bgcolor="#5D6D7E" class="font-color-white">
                    <th scope="col" class="bg-primary text-white">NOMBRE SOCIO</th>
                    <th scope="col" class="bg-primary text-white">TIPO DOCUMENTO</th>
                    <th scope="col" class="bg-primary text-white">N° DOCUMENTO SOCIO</th>
                    <th scope="col" class="bg-primary text-white">PLACA</th>
                    <th scope="col" class="bg-primary text-white">VEHIVULO</th>
                    <th scope="col" class="bg-primary text-white">TRANSPORTADOR</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attributes as $socio)
                <tr>
                    <td>{{ $socio->nombre_socio }}</td>
                    <td>{{ $socio->documento->nombre }}</td>

                    <td>{{ $socio->dni_socio }}</td>
                    <td>{{ $socio->num_placa ? $socio->num_placa : '-' }}</td>

                    @if ($socio->vehiculo_id == 1)
                        <td>{{ $socio->vehiculo->nombre }}</td>
                    @elseif($socio->vehiculo_id === 2)
                        <td>{{ $socio->vehiculo->nombre }}</td>
                    @else
                        <td>{{ $socio->vehiculo->nombre }}</td>
                    @endif

                    @if (empty($socio->asociacione_id)  && $socio->tipo_documento_id == 3)
                        <td class="text-secondary">Entidad Privada</td>
                    @elseif (empty($socio->asociacione_id))
                        <td class="text-secondary">Persona Natural</td>
                    @else
                        <td>{{ optional($socio->asociacione)->nombre }}</td>
                    @endif

                </tr>

            @endforeach

        </tbody>
    </table>
</body>
</html>
