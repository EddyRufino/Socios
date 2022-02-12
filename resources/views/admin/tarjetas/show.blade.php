<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muni Castilla</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .marca-de-agua {
            /*background-image: url("/img/escudo.png");*/
            background-repeat: no-repeat;
            background-position: center;
            background-size: 100px 100px !important;
            width: 100%;
            height: auto;
            margin: auto;
            position: absolute;
            margin-top: 4rem;
        }
        .marca-de-agua img {
            padding: 0;
            width: 100%;
            height: auto;
            opacity: 0.1;
        }
        .bg-segundo {
            background-color: #6366F1 !important;
        }
    </style>
</head>
<body>
    <div class="marca-de-agua d-flex justify-content-center">
        <img class="" alt="Muni Castilla" src="{{ asset('/img/escudo.png') }}" style="height: 100vh; width: 100%" />
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
      {{-- <a class="navbar-brand" href="#">Muni Castilla</a> --}}
      <img class="navbar-brand" alt="" src="{{ asset('/img/logo.png') }}" style="width: 120px;" />
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      </div>
    </nav>

    <div class="container py-4">
        <div class="col-sm d-flex justify-content-center flex-column align-items-center ">
            <li class="list-group-item border-0 m-0 pt-0 text-center bg-transparent">
                <strong><h5 class="font-weight-bold">TARJETA DE CIRCULACIÓN VEHICULAR</h5></strong>
            </li>
        </div>

        @canPrint
            <div class="d-flex justify-content-center align-items-center mb-3">
                <div class="form-check">
                    <form  method="POST" action="{{ route('check.tarjeta', $socio) }}">
                        @csrf
                            <input class="form-check-input"
                                name="status"
                                type="checkbox"
                                value="1"
                                {{ old('status', $socio->status) == 1 ? 'checked' : '' }}
                                id="defaultCheck1"
                                onchange="this.form.submit()"
                            >
                            <label class="form-check-label" for="defaultCheck1">
                                Ya Está Impreso
                            </label>
                    </form>
                </div>

                <div class="form-check ml-2">
                    <form  method="POST" action="{{ route('renovar.tarjeta', $socio) }}">
                        @csrf
                            <input class="form-check-input"
                                name="status"
                                type="checkbox"
                                value="1"
                                {{ old('status', $socio->status) == 0 ? 'checked' : '' }}
                                id="defaultCheck1"
                                onchange="this.form.submit()"
                            >
                            <label class="form-check-label" for="defaultCheck1">
                                Renovar Tarjeta
                            </label>
                    </form>
                </div>
            </div>
        @endcanPrint

        <div class="d-flex justify-content-center flex-column align-items-center">
            <ul class="list-group col-md-3">
                <li class="list-group-item color-box-header">
                    @if (empty($socio->socio->asociacione_id)  && $socio->socio->tipo_documento_id == 3)
                        <strong class="font-weight-bold">ENTIDAD PRIVADA</strong>
                    @elseif (empty($socio->socio->asociacione_id))
                        <strong class="font-weight-bold">PERSONA NATURAL</strong>
                    @else
                        <strong class="font-weight-bold">SOCIO</strong>
                    @endif

                </li>
                <li class="list-group-item ">
                    <strong>Nombre:</strong> {{ Illuminate\Support\Str::title($socio->socio->nombre_socio) }}
                </li>
                <li class="list-group-item ">
                    <strong>{{ $socio->socio->documento->nombre }}:</strong> {{ $socio->socio->dni_socio }}
                </li>
            </ul>


            <ul class='list-group col-md-3 mt-3'>
                <li class="list-group-item color-box-header">
                    <strong>VEHÍCULO</strong>
                </li>
                <li class="list-group-item ">
                    <strong>Tipo:</strong> {{ $socio->vehiculo->nombre }}
                </li>
                <li class="list-group-item ">
                    <strong>N. Placa:</strong> {{ $socio->num_placa }}
                </li>
                <li class="list-group-item ">
                    <strong>Expedición:</strong> {{ $socio->expedicion }}
                </li>
                <li class="list-group-item ">
                    <strong>Revalidación:</strong> {{ $socio->revalidacion }}
                </li>
            </ul>

            @if (!empty($socio->socio->asociacione_id))
                <ul class='list-group col-md-3 mt-3'>
                    <li class="list-group-item color-box-header">
                        <strong class="font-weight-bold">TRANSPORTADOR AUTORIZADO</strong>
                    </li>
                    <li class="list-group-item ">
                        <strong>Asociación:</strong> {{ Illuminate\Support\Str::title(optional($socio->socio->asociacione)->nombre) }}
                    </li>
                    <li class="list-group-item ">
                        <strong>N. Operación:</strong> {{ Illuminate\Support\Str::title($socio->num_operacion) }}
                    </li>
                    <li class="list-group-item ">
                        <strong>Vigencia:</strong> {{ Illuminate\Support\Str::title($socio->vigencia_operacion) }}
                    </li>
                </ul>
            @endif



            @if (empty($socio->socio->asociacione_id))
                <ul class='list-group col-md-3 mt-3'>
                    <li class="list-group-item color-box-header">
                        <strong>PERSONAL E INTRANSFERIBLE</strong>
                    </li>
                    <li class="list-group-item ">
                        <strong>N. Autorización:</strong> {{ Illuminate\Support\Str::title($socio->num_autorizacion) }}
                    </li>
                    <li class="list-group-item ">
                        <strong>Vigencia:</strong> {{ Illuminate\Support\Str::title($socio->vigencia_autorizacion) }}
                    </li>
                </ul>
            @endif
        </div>

        <span class="d-flex justify-content-center mt-1 font-weight-light">N. {{ $socio->num_correlativo }}</span>

    </div>
    <div>
    </div>
    <footer class="bg-primary pt-4 pb-2 text-white">
        <div class="text-center">
            <h5 class="font-weight-bold mb-3">Muni Castilla</h5>
            <div>
                <p>
                    <a class="text-white" href="https://municastilla.gob.pe/wp/ordenanzas-municipales/">Normal Legal</a> |
                    <a class="text-white" href="https://municastilla.gob.pe/legal/">Política de Privacidad</a>
                </p>
            </div>
            <p>© 2019 - {{ date('Y') }} <strong>·</strong> <a class="text-white" href="https://municastilla.gob.pe/wp/">Municastilla.gob.pe</a>
            </p>
        </div>
        <div class="col-md-4 m-auto" style="width: 150px;">
            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 472.03 182.07" class="p-0 xs:pl-0 origin-left transform scale-75"><defs><style>.cls-1{fill:#fff;}</style></defs><path class="cls-1" d="M118.22,94.28l7.64,2.91h0a2.33,2.33,0,0,0,.94.32,2.29,2.29,0,1,0,.46-4.56,2.25,2.25,0,0,0-.69,0h0Z" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M129.51,103.71a2.5,2.5,0,0,0-1.61-3.16,2.32,2.32,0,0,0-.9-.11h0l-9.91-.78,8.46,5.23h0a2.46,2.46,0,0,0,.81.45,2.51,2.51,0,0,0,3.15-1.61" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M128.09,112.39a2.72,2.72,0,0,0-1-3.71,2.4,2.4,0,0,0-.72-.26h0l-11.5-3.75,8.85,8.22h0a2.81,2.81,0,0,0,.67.56,2.73,2.73,0,0,0,3.71-1" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M125.06,121.24a2.93,2.93,0,0,0-.19-4.15,2.86,2.86,0,0,0-.66-.45h0l-12.59-7.55,8.8,11.77h0a3.23,3.23,0,0,0,.48.57,2.94,2.94,0,0,0,4.15-.19" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M120.28,125.19h0l-12.73-12.43,7.69,16h0a2.8,2.8,0,0,0,.35.63,3.16,3.16,0,1,0,4.68-4.19" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M114.25,133.47l-.11-.16-10.61-16.16,4.76,18.75a2.44,2.44,0,0,0,.06.26l0,.07h0a2.83,2.83,0,0,0,.14.41,3.29,3.29,0,1,0,6-2.7,3.41,3.41,0,0,0-.21-.38h0Z" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M99.37,142.16v.09h0c0,.14,0,.29.05.44a3.38,3.38,0,1,0,6.47-1.84h0l0-.1a.76.76,0,0,0-.06-.16l-7.45-19.81,1,21.16c0,.07,0,.15,0,.22" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M92.05,150.32a3.59,3.59,0,0,0,3.58-3.6,3.73,3.73,0,0,0,0-.47h0l0-.11c0-.06,0-.13,0-.19l-3.42-22.3-3.59,22.29a1.57,1.57,0,0,1,0,.23v.09h0a3.73,3.73,0,0,0,0,.47,3.59,3.59,0,0,0,3.6,3.59" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M76.5,147.05a3.77,3.77,0,0,0-.28.84,3.81,3.81,0,1,0,7.45,1.58,3.66,3.66,0,0,0,.08-.87L85,125.17Z" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M70.6,149.59a4.17,4.17,0,0,0,.28-.89l6.3-23.57L63.74,145.49a3.64,3.64,0,0,0-.49.81,4,4,0,1,0,7.35,3.29" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M49.84,142.41a4.25,4.25,0,1,0,6.85,5,4,4,0,0,0,.48-.85l12-23.39L50.5,141.71a4.4,4.4,0,0,0-.66.7" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M19.56,138.31l34.67-24.89-39,17.28a4,4,0,0,0-.79.36A4.46,4.46,0,0,0,19,138.74a4.35,4.35,0,0,0,.6-.43" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M36.6,135.48a4.46,4.46,0,0,0,6,6.6,4.09,4.09,0,0,0,.65-.73l18.23-22.21-24,15.75a4.2,4.2,0,0,0-.83.59" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M8.13,113.93a4.68,4.68,0,0,0,2.93,8.89,4.41,4.41,0,0,0,.8-.35L47.66,106,9,113.73a5.69,5.69,0,0,0-.91.2" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M6.51,105.41a5.38,5.38,0,0,0,1-.21l34.63-8.4L6.52,95.67a5.16,5.16,0,0,0-1,0,4.9,4.9,0,0,0,1,9.74" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M5.22,87a4.77,4.77,0,0,0,1,0l32.17-1.1L7.18,78a4.86,4.86,0,0,0-.95-.21,4.61,4.61,0,1,0-1,9.17" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M8.41,69.72A4.94,4.94,0,0,0,9.72,70L36.9,73.6l-24.13-13A5,5,0,0,0,11.56,60a5.11,5.11,0,0,0-3.15,9.73" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M14.62,52.48A4.86,4.86,0,0,0,16,53L38.4,60.52,20.55,45a4.83,4.83,0,1,0-5.93,7.5" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M53.41,16.22h0l8.73,7.94L61.87,12.6a4.93,4.93,0,0,0-.42-2,5,5,0,1,0-8,5.63" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M38.69,27.18h0l12.65,8.23L47.33,21a5.76,5.76,0,1,0-8.64,6.15" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M26.08,39.29l17.19,8.26-9.9-15.88A5.56,5.56,0,0,0,32.09,30a5.63,5.63,0,0,0-7.56,8.35,5.83,5.83,0,0,0,1.55,1" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M71,9.42l4.74,5L77.9,7.77A4.28,4.28,0,1,0,71,9.42" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M81.46,67.58,79.78,58.5h0a2.07,2.07,0,0,0-.16-.52,2.29,2.29,0,1,0-4.17,1.89,2.48,2.48,0,0,0,.33.51Z" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M81.76,55.35a3.16,3.16,0,0,0,.17.52h0l4.75,10,0-11v-.15h0a1.72,1.72,0,0,0,0-.39,2.51,2.51,0,1,0-4.9,1.05" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M92.08,48.91a2.73,2.73,0,0,0-2.71,2.74,2.47,2.47,0,0,0,.1.67h0l2.67,13,2.64-13.14h0v0h0a2.69,2.69,0,0,0-2.69-3.21" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M97.59,65.88l6-14.82a3,3,0,0,0,.21-.6A2.94,2.94,0,0,0,98,49.2a2.83,2.83,0,0,0-.06.64h0Z" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M112,46.85a3.16,3.16,0,0,0-4.17,1.61,2.62,2.62,0,0,0-.19.58h0L102.8,67.57l10.47-16h0a2.51,2.51,0,0,0,.29-.51,3.16,3.16,0,0,0-1.6-4.17" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M122.94,49a3.28,3.28,0,0,0-4.59.74,3.6,3.6,0,0,0-.22.37h0l0,.07-.1.21-8.6,17.36,13.79-13.61.16-.16.06-.06h0a2.14,2.14,0,0,0,.28-.32,3.28,3.28,0,0,0-.74-4.6" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M129.16,53.59a3.18,3.18,0,0,0-.3.33h0l-.06.08-.13.15-13.32,16.5L133.09,59l.17-.11.08,0h0a3,3,0,0,0,.36-.26,3.37,3.37,0,1,0-4.53-5" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M144.08,61.5a3.59,3.59,0,0,0-4.91-1.3,3.48,3.48,0,0,0-.39.28h0l-.08.07-.16.13L121,74.9l21.1-8.17.2-.08.09,0h0a4.14,4.14,0,0,0,.43-.2,3.6,3.6,0,0,0,1.3-4.91" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M150,76.72a3.81,3.81,0,1,0-2.37-7.24,4.09,4.09,0,0,0-.79.37L125.91,80.57,149.1,76.9a3.66,3.66,0,0,0,.86-.18" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M154.94,89a4,4,0,0,0-.84-8,3.62,3.62,0,0,0-.92.21l-23.53,6.39L154,89a4.2,4.2,0,0,0,.94,0" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M158,102.76a4.24,4.24,0,0,0,.91-8.44,4,4,0,0,0-1,0l-26.24,1.38,25.37,6.83a4.16,4.16,0,0,0,.94.22" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M171.18,137.24a4.47,4.47,0,0,0-1.7-6.08,4.54,4.54,0,0,0-.68-.3l-38.47-17.27,34.07,24.86a4.38,4.38,0,0,0,.7.49,4.46,4.46,0,0,0,6.08-1.7" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M158.45,117.76a4.46,4.46,0,1,0,2.71-8.5,4.66,4.66,0,0,0-1-.19l-28.36-4.63,25.68,12.9a4.34,4.34,0,0,0,.93.42" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M159.51,146.1a4.8,4.8,0,0,0-.69-.52l-31.88-22.7,25.69,29.48a4.16,4.16,0,0,0,.63.7,4.68,4.68,0,1,0,6.25-7" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M146.79,158.53a5,5,0,0,0-.69-.76l-24.54-25.72,16.8,31.34a4.5,4.5,0,0,0,.51.9,4.9,4.9,0,1,0,7.92-5.76" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M123.2,172.66a4.61,4.61,0,0,0,8.43-3.75,4.75,4.75,0,0,0-.5-.85L114,140.6l8.93,31.13a5.3,5.3,0,0,0,.3.93" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M105,177a5.12,5.12,0,0,0,10-2.17,5.27,5.27,0,0,0-.43-1.19l-10.5-25.84.82,27.84A5.25,5.25,0,0,0,105,177" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M92.15,182.23A4.84,4.84,0,0,0,97,177.38a5,5,0,0,0-.2-1.35l-4.62-23.34L87.51,176a5,5,0,0,0-.21,1.46,4.83,4.83,0,0,0,4.85,4.81" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M38.3,165.48a5,5,0,0,0,7.82-2.86h0l3.33-12.32-10.7,6.82h0a4.9,4.9,0,0,0-1.53,1.38,5,5,0,0,0,1.08,7" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M62.51,172.07a5.61,5.61,0,0,0,.49-2.2h0l1.37-16-11,11.59h0a5.76,5.76,0,1,0,9.15,6.6" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M79.83,176.62a5.52,5.52,0,0,0,.09-1.76l-1.24-20-9,17.5a5.63,5.63,0,1,0,10.19,4.3" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M24.11,152.67a4.29,4.29,0,0,0,7.23-1.39l3-7.67-7.84,2a4.35,4.35,0,0,0-2,1,4.28,4.28,0,0,0-.36,6" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M70,118a2.29,2.29,0,0,0,3.72,2.66,2.42,2.42,0,0,0,.26-.47h0l2.72-7.38-6,4.57A2.19,2.19,0,0,0,70,118" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M64.06,113.54a2.32,2.32,0,0,0-.64.41,2.5,2.5,0,0,0,3.35,3.72,2.22,2.22,0,0,0,.4-.47h0l5.46-8.12-8.59,4.44Z" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M56.37,112.15a2.66,2.66,0,0,0,4.36.45h0l8.67-8-11.3,3.47h0a2.83,2.83,0,0,0-.76.29,2.72,2.72,0,0,0-1,3.72" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M53.74,107.12a3.5,3.5,0,0,0,.62-.29h0l12.82-7.18-14.49,1.74h0a2.81,2.81,0,0,0-.75.13,2.94,2.94,0,1,0,1.8,5.6" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M48.9,99.15h0l17.15-4.88L48.3,93.07h0a3.11,3.11,0,0,0-.81,0,3.16,3.16,0,0,0,.67,6.28,3.48,3.48,0,0,0,.74-.18" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M43.83,89.79h.5l.24,0,19.16-1.22L45.24,83.4,45,83.34l-.08,0h0a2.84,2.84,0,0,0-.42-.08,3.29,3.29,0,1,0-.68,6.55" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M39.27,74.39a3.38,3.38,0,0,0,2.17,4.25,3.48,3.48,0,0,0,.44.1h0l.09,0,.2,0L63,82.07,44.2,72.53,44,72.44l-.08,0h0a3.89,3.89,0,0,0-.41-.18,3.38,3.38,0,0,0-4.25,2.17" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M40.49,61.8a3.58,3.58,0,0,0,1.32,4.9,4.14,4.14,0,0,0,.43.2h0l.09,0,.2.08,21,8L46,60.94l-.16-.13-.08-.06h0c-.13-.09-.25-.19-.39-.27a3.58,3.58,0,0,0-4.9,1.32" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M50.79,49.34l-.06-.08h0c-.11-.12-.21-.25-.34-.37a3.81,3.81,0,0,0-5.09,5.67c.13.11.27.2.4.29h0l.08,0L46,55l19.8,12.77L50.94,49.52l-.15-.18" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M58.66,38.86l0-.1h0A4,4,0,1,0,51.81,43a3.34,3.34,0,0,0,.35.4h0l.06.07.21.2L69.78,60.78l-11-21.71a2.12,2.12,0,0,0-.11-.21" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M61,32a4.06,4.06,0,0,0,.49.81L75.68,54.59,69,29.46a4.42,4.42,0,0,0-.3-1A4.25,4.25,0,0,0,61,32" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M92.13,46.52l4.39-41.1a5.29,5.29,0,0,0,.07-.8,4.46,4.46,0,1,0-8.92,0,4.92,4.92,0,0,0,.07.78Z" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M76.15,16.75a4.46,4.46,0,0,0-3.42,5.3,4.17,4.17,0,0,0,.32.94L83.28,49.87,81.55,21.16a3.7,3.7,0,0,0-.1-1,4.46,4.46,0,0,0-5.3-3.42" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M114.38,8.53a4.79,4.79,0,0,0,.27-.86,4.68,4.68,0,1,0-9.15-1.95,5,5,0,0,0-.11.94l-3.27,37.91Z" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M113,44.64,131.18,15.4a5.28,5.28,0,0,0,.52-.9,4.89,4.89,0,0,0-8.94-4,4.77,4.77,0,0,0-.33,1Z" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M124.44,47.07l21.68-22.3a4.68,4.68,0,0,0,.67-.73,4.61,4.61,0,0,0-7.46-5.43,4.84,4.84,0,0,0-.5.88Z" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M135.81,52.22l22.66-13.81a5.45,5.45,0,0,0,1.19-.81A5.11,5.11,0,1,0,152.78,30a5,5,0,0,0-.87,1Z" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M146.24,60.3,168.07,53a4.89,4.89,0,0,0,1.38-.54,4.84,4.84,0,0,0-4.85-8.37,5,5,0,0,0-1.15.93Z" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M170.23,60.5,154.72,71.2l18.48-.59a5.32,5.32,0,0,0,2.15-.26,5.63,5.63,0,1,0-5.12-9.85" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M183.14,101.1a5,5,0,0,0-4.43-5.52,5.09,5.09,0,0,0-2,.17h0l-11.65,3.46,10.55,5.68h0a5.15,5.15,0,0,0,2,.64,5,5,0,0,0,5.52-4.43" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M176.62,76.85a5.53,5.53,0,0,0-2.15.67h0l-13.54,6.79,14.54,3.76h0a5.76,5.76,0,1,0,1.16-11.22" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M176.21,114.4a4.24,4.24,0,0,0-2.17-.13l-7.42,1.5,5,5.46a4.15,4.15,0,0,0,1.93,1.3,4.28,4.28,0,1,0,2.65-8.13" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M229.33,73.3A4.77,4.77,0,0,0,232,68.9,4.43,4.43,0,0,0,230,65.1a9.58,9.58,0,0,0-5.61-1.4h-9.77v20H225a10.44,10.44,0,0,0,5.95-1.41,4.63,4.63,0,0,0,2-4,5,5,0,0,0-1-3.13,5.21,5.21,0,0,0-2.68-1.81m-10.08-6.11h4.6a4.75,4.75,0,0,1,2.6.58,2,2,0,0,1,.88,1.76,2,2,0,0,1-.88,1.77,4.65,4.65,0,0,1-2.6.6h-4.6Zm8.15,12.42a5.1,5.1,0,0,1-2.75.6h-5.4V75.27h5.4c2.45,0,3.68.82,3.68,2.48a2.06,2.06,0,0,1-.93,1.86" transform="translate(-1.1 -0.17)"></path><rect class="cls-1" x="238.25" y="63.54" width="4.62" height="19.99"></rect><path class="cls-1" d="M265.85,83.12a9.34,9.34,0,0,0,3.54-2.66l-3-2.74a6.36,6.36,0,0,1-5,2.37,6.68,6.68,0,0,1-3.31-.81A5.76,5.76,0,0,1,255.81,77a7.19,7.19,0,0,1,0-6.63,5.83,5.83,0,0,1,2.27-2.27,6.68,6.68,0,0,1,3.31-.81,6.39,6.39,0,0,1,5,2.34l3-2.74a9.52,9.52,0,0,0-3.53-2.63,11.62,11.62,0,0,0-4.7-.91,11.5,11.5,0,0,0-5.55,1.33,9.82,9.82,0,0,0-3.88,3.68,10.69,10.69,0,0,0,0,10.65,9.82,9.82,0,0,0,3.88,3.68A11.45,11.45,0,0,0,261.14,84a11.74,11.74,0,0,0,4.71-.91" transform="translate(-1.1 -0.17)"></path><polygon class="cls-1" points="289.73 79.81 278.85 79.81 278.85 75.19 288.13 75.19 288.13 71.59 278.85 71.59 278.85 67.25 289.36 67.25 289.36 63.54 274.25 63.54 274.25 83.52 289.73 83.52 289.73 79.81"></polygon><polygon class="cls-1" points="310.03 75.67 300.09 63.54 296.27 63.54 296.27 83.52 300.83 83.52 300.83 71.39 310.8 83.52 314.6 83.52 314.6 63.54 310.03 63.54 310.03 75.67"></polygon><polygon class="cls-1" points="319.94 67.31 326.33 67.31 326.33 83.52 330.96 83.52 330.96 67.31 337.35 67.31 337.35 63.54 319.94 63.54 319.94 67.31"></polygon><polygon class="cls-1" points="347.29 75.19 356.57 75.19 356.57 71.59 347.29 71.59 347.29 67.25 357.8 67.25 357.8 63.54 342.69 63.54 342.69 83.52 358.17 83.52 358.17 79.81 347.29 79.81 347.29 75.19"></polygon><polygon class="cls-1" points="369.27 71.39 379.24 83.52 383.04 83.52 383.04 63.54 378.47 63.54 378.47 75.67 368.53 63.54 364.71 63.54 364.71 83.52 369.27 83.52 369.27 71.39"></polygon><path class="cls-1" d="M398,63.7l-8.91,20h4.74l1.77-4.28h9.28l1.77,4.28h4.86l-8.94-20Zm-.91,12.19,3.17-7.65,3.17,7.65Z" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M432.72,74.79A6.78,6.78,0,0,0,433.79,71a7,7,0,0,0-1.06-3.86,6.87,6.87,0,0,0-3-2.51,11.09,11.09,0,0,0-4.61-.89h-8.65v20h4.62V78.12h4.26l3.85,5.57h5l-4.48-6.43a6.8,6.8,0,0,0,3-2.47M428,73.52a4.79,4.79,0,0,1-3.17.92h-3.77v-7h3.77a4.85,4.85,0,0,1,3.17.9,3.59,3.59,0,0,1,0,5.15" transform="translate(-1.1 -0.17)"></path><rect class="cls-1" x="439.2" y="63.54" width="4.63" height="19.99"></rect><path class="cls-1" d="M467.79,64.7a12.37,12.37,0,0,0-11.2,0,10.19,10.19,0,0,0,0,18,12.37,12.37,0,0,0,11.2,0A10.09,10.09,0,0,0,471.7,79a10.52,10.52,0,0,0,0-10.59,10.09,10.09,0,0,0-3.91-3.7M467.63,77a5.89,5.89,0,0,1-2.24,2.27,6.71,6.71,0,0,1-6.39,0A5.89,5.89,0,0,1,456.76,77a7.11,7.11,0,0,1,0-6.63A5.89,5.89,0,0,1,459,68.11a6.71,6.71,0,0,1,6.39,0,5.89,5.89,0,0,1,2.24,2.27,7.11,7.11,0,0,1,0,6.63" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M227.92,99.62a11.17,11.17,0,0,0-4.62-.89h-8.65v20h4.63v-5.51h4a11.34,11.34,0,0,0,4.62-.87,6.79,6.79,0,0,0,3-2.51,7.58,7.58,0,0,0,0-7.7,6.93,6.93,0,0,0-3-2.51m-1.7,8.92a4.87,4.87,0,0,1-3.17.9h-3.77V102.5h3.77a4.87,4.87,0,0,1,3.17.9A3.18,3.18,0,0,1,227.3,106a3.13,3.13,0,0,1-1.08,2.55" transform="translate(-1.1 -0.17)"></path><polygon class="cls-1" points="241.62 110.22 250.9 110.22 250.9 106.62 241.62 106.62 241.62 102.28 252.13 102.28 252.13 98.57 237.02 98.57 237.02 118.55 252.5 118.55 252.5 114.84 241.62 114.84 241.62 110.22"></polygon><path class="cls-1" d="M276.4,109.83a6.83,6.83,0,0,0,1.07-3.84,7,7,0,0,0-1.06-3.86,6.87,6.87,0,0,0-3-2.51,11.12,11.12,0,0,0-4.61-.89h-8.65v20h4.62v-5.57H269l3.85,5.57h5l-4.48-6.42a6.87,6.87,0,0,0,3-2.47m-4.7-1.27a4.79,4.79,0,0,1-3.17.91h-3.77v-7h3.77a4.85,4.85,0,0,1,3.17.9,3.62,3.62,0,0,1,0,5.16" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M297.34,109.76a6,6,0,0,1-1.14,4.06,4.19,4.19,0,0,1-3.32,1.3q-4.45,0-4.45-5.36v-11h-4.62v11.2q0,4.39,2.38,6.76a9.07,9.07,0,0,0,15.72-6.76V98.73h-4.57Z" transform="translate(-1.1 -0.17)"></path><polygon class="cls-1" points="297.84 92.83 293.04 92.83 289.19 96.94 292.67 96.94 297.84 92.83"></polygon><path class="cls-1" d="M330,110.61a11.89,11.89,0,0,0,2.65-3.25,6.93,6.93,0,0,0,.69-3.06,5.28,5.28,0,0,0-.93-3.12,6,6,0,0,0-2.6-2.06,9.59,9.59,0,0,0-3.9-.73,10.72,10.72,0,0,0-4.71,1,7.77,7.77,0,0,0-3.22,2.72l3.36,2.17a4.72,4.72,0,0,1,1.77-1.5,5.55,5.55,0,0,1,2.37-.49,3.78,3.78,0,0,1,2.39.64,2.21,2.21,0,0,1,.81,1.84,3.61,3.61,0,0,1-.43,1.67,8,8,0,0,1-1.65,2l-7.71,7.28v3h15.1V115h-8.59Z" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M351.64,99.62a8.57,8.57,0,0,0-8.85,0,8.25,8.25,0,0,0-3,3.55,14.58,14.58,0,0,0,0,11.11,8.28,8.28,0,0,0,3,3.56,8.63,8.63,0,0,0,8.85,0,8.3,8.3,0,0,0,3.05-3.56,14.7,14.7,0,0,0,0-11.11,8.27,8.27,0,0,0-3.05-3.55m-1.55,14a3.27,3.27,0,0,1-2.87,1.57,3.23,3.23,0,0,1-2.84-1.57,8.87,8.87,0,0,1-1-4.85,8.91,8.91,0,0,1,1-4.86,3.25,3.25,0,0,1,2.84-1.57,3.29,3.29,0,0,1,2.87,1.57,9,9,0,0,1,1,4.86,9,9,0,0,1-1,4.85" transform="translate(-1.1 -0.17)"></path><path class="cls-1" d="M371.66,110.61a11.7,11.7,0,0,0,2.65-3.25,6.93,6.93,0,0,0,.69-3.06,5.28,5.28,0,0,0-.93-3.12,6,6,0,0,0-2.6-2.06,9.57,9.57,0,0,0-3.89-.73,10.77,10.77,0,0,0-4.72,1,7.83,7.83,0,0,0-3.22,2.72l3.37,2.17a4.57,4.57,0,0,1,1.77-1.5,5.49,5.49,0,0,1,2.37-.49,3.77,3.77,0,0,1,2.38.64,2.19,2.19,0,0,1,.82,1.84,3.74,3.74,0,0,1-.43,1.67,8.31,8.31,0,0,1-1.66,2l-7.71,7.28v3h15.11V115h-8.6Z" transform="translate(-1.1 -0.17)"></path><polygon class="cls-1" points="378.41 102.28 382.41 102.28 382.41 118.55 387.03 118.55 387.03 98.57 378.41 98.57 378.41 102.28"></polygon></svg>
        </div>
    </footer>
</body>
</html>
