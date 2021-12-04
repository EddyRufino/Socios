<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista De Todos Los Fotochecks</title>

</head>
<body>
    <table class="table">
        <thead>
            <tr bgcolor="#5D6D7E" class="font-color-white">
                <th scope="col" class="bg-primary text-white">NOMBRE Y APELLIDO</th>
                <th scope="col" class="bg-primary text-white">NOMBRE PROPIETARIO</th>
                <th scope="col" class="bg-primary text-white">TIPO DOCUMENTO</th>
                <th scope="col" class="bg-primary text-white">N° DOCUMENTO</th>
                <th scope="col" class="bg-primary text-white">N° AUTORIZACIÓN</th>
                <th scope="col" class="bg-primary text-white">VEHIVULO</th>
                <th scope="col" class="bg-primary text-white">TRANSPORTADOR</th>
                <th scope="col" class="bg-primary text-white">EXPEDICION</th>
                <th scope="col" class="bg-primary text-white">REVALIDACION</th>
                <th scope="col" class="bg-primary text-white">IMPRESO</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attributes as $fotocheck)
                <tr>
                    <td>{{ $fotocheck->socio->nombre_socio }}</td>
                    <td>{{ $fotocheck->socio->nombre_propietario }}</td>
                    <td>{{ $fotocheck->socio->documento->nombre }}</td>

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
