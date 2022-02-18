<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suministros</title>

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

        <h4 class="center font-color">LISTA DE SUMINISTROS ADQUIRIDOS</h4>

        <table class="table">
            <thead>
                <tr bgcolor="#5D6D7E" class="font-color-white">
                        <th scope="col" class="bg-primary text-white">Nombre Lote</th>
                        <th scope="col" class="bg-primary text-white">Monto PVC</th>
                        <th scope="col" class="bg-primary text-white">Monto Cinta</th>
                        <th scope="col" class="bg-primary text-white">Monto Holograma</th>
                        <th scope="col" class="bg-primary text-white">PVC Utilizado</th>
                        <th scope="col" class="bg-primary text-white">Cinta Utilizado</th>
                        <th scope="col" class="bg-primary text-white">Holograma Utilizado</th>
                        <th scope="col" class="bg-primary text-white">Adquirida</th>
                        <th scope="col" class="bg-primary text-white">Inicio Utilización</th>
                        <th scope="col" class="bg-primary text-white">Estado</th>
                        <th scope="col" class="bg-primary text-white">Monto Pruebas</th>
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

                            @if (request()->id == 'juridica')

                                <th>
                                <span class="countTarjeta mr-1">Tarjetas</span>
                                <strong class="mr-3">{{$tarjetasCountJuridica->count()}}</strong>

                                <span class="countTarjeta">Fotochecks</span>
                                <strong class="ml-1">{{$fotochecksCountJuridica->count()}}</strong>
                                </th>

                            @endif

                        @endif
                    </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
