<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suministros</title>
</head>
<body>
    <div>
        <table>
            <thead>
                <tr>
                    <th nowrap>Nombre Lote</th>
                    <th nowrap>Monto PVC</th>
                    <th nowrap>Monto Cinta</th>
                    <th nowrap>Monto Holograma</th>
                    <th nowrap>Monto PVC Utilizado</th>
                    <th nowrap>Monto Cinta Utilizado</th>
                    <th nowrap>Monto Holograma Utilizado</th>
                    <th nowrap>Adquirida</th>
                    <th nowrap>Inicio Utilización</th>
                    <th nowrap>Estado</th>
                    <th nowrap>Monto Pruebas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attributes as $suministro)
                    <tr>
                        <td nowrap>{{ $suministro->nombre }}</td>
                        <td nowrap>{{ $suministro->monto_pvc }}</td>
                        <td nowrap>{{ $suministro->monto_cinta }}</td>
                        <td nowrap>{{ $suministro->monto_holograma }}</td>
                        <td nowrap>{{ $suministro->conteo_monto_pvc }}</td>
                        <td nowrap>{{ $suministro->conteo_monto_cinta }}</td>
                        <td nowrap>{{ $suministro->conteo_monto_holograma }}</td>
                        <td nowrap>{{ $suministro->fecha_adquisicion }}</td>
                        <td nowrap>{{ $suministro->fecha_utilizacion }}</td>
                        @if ($suministro->status == 1)
                            <td nowrap>Hábil</td>
                        @else
                            <td nowrap>No Hábil</td>
                        @endif
                        <td nowrap>{{ $suministro->monto_pruebas }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
