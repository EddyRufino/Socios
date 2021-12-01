<!DOCTYPE html>
<html lang="en">
<head>
    {{-- <meta charset="UTF-8"> --}}
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    <title>Tarjeta Circulación</title>

</head>

<style type="text/css">

.contenedor{
    position: relative;
    display: inline-block;
    /*margin-top: 3rem;*/
}
.container {
    position: relative;
    display: block;
    z-index: 2;
}
.anverso {
    position: relative;
    display: block;
}

.foto-encima{
    position: absolute;
    top: 212px;
    left: 142px;
}

.texto-encima-nombre {
    position: absolute;
    top: 40%;
    left: 6.5%;
    font-size: 1.8rem;
    font-weight: 900;
    text-transform: uppercase;
    line-height: 30px;
    font-family: sans-serif;
}

.texto-encima-nombre-socio {
    position: absolute;
    top: 31%;
    left: 6.5%;
    font-size: 1.1rem;
    font-weight: 900;
    text-transform: uppercase;
    font-family: sans-serif;
    z-index: 999;
}
.texto-encima-nombre-socio-dos {
    position: absolute;
    top: -35% !important;
    left: 6.5%;
    font-size: 1.1rem;
    font-weight: 900;
    text-transform: uppercase;
    font-family: sans-serif;
    z-index: 999;
}
.texto-encima-dni {
    position: absolute;
    top: 50%;
    left: 6.5%;
    font-size: 1.1rem;
    font-weight: 900;
}

.texto-encima-placa {
    position: absolute;
    top: 57%;
    left: 6.5%;
    font-size: 1.1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-asociacion {
    position: absolute;
    top: 70%;
    left: 6.5%;
    font-size: 1.6rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-asociacion-name {
    position: absolute;
    top: 64%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-expedicion-anverso {
    position: absolute;
    top: 81%;
    left: 6.5%;
    font-size: 1.005rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-revalidacion-anverso {
    position: absolute;
    top: 88%;
    left: 6.5%;
    font-size: 1.005rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-correlativo {
    position: absolute;
    top: 87%;
    left: 82%;
    font-size: 1.1rem;
    font-weight: 900;
    text-transform: uppercase;
    color: black;
}

.texto-encima-expedicion-reverso {
    position: absolute;
    top: 60.54%;
    left: 3%;
    height: 30%;
    width: 95%;
    margin: -17% 0 0 -25%;
    font-size: 1.2rem;
    font-weight: 900;
    text-transform: uppercase;
    text-align: center;
    line-height: 30px;
}

.texto-encima-revalidacion-reverso {
    position: absolute;
    top: 69%;
    left: 13%;
    height: 30%;
    width: 95%;
    margin: -17% 0 0 -25%;
    font-size: 1.2rem;
    font-weight: 900;
    text-transform: uppercase;
    text-align: center;
    font-family: monospace !important;
}

.qr-encima {
    position: absolute;
    top: 35px;
    left: 76%;
}
/*.centrado{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}*/

html {
    margin: 0pt;
}
@font-face {
    font-family: "source_sans_proregular";
    src: local("Source Sans Pro"), url("fonts/sourcesans/sourcesanspro-regular-webfont.ttf") format("truetype");
    font-weight: normal;
    font-style: normal;

}
body{
    font-family: "source_sans_proregular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
}


</style>

<body>
    {{-- {{dd($attributes)}} --}}
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

                        <td>{{ optional($tarjeta->asociacione)->nombre }}</td>

                    </tr>

                @endforeach

            </tbody>
        </table>
{{--         <img src="{{ asset('img/anverso2.jpg') }}"
            style="display: block; width: 100%; height: 426px;"
        >

        @if ($tarjeta->socio->nombre_propietario)
            <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DEL SOCIO</span>
        @else
            <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DEL SOCIO - PROPIETARIO</span>
        @endif

        <span class="texto-encima-nombre">{{ $tarjeta->socio->nombre_socio }}</span>

        <span style="display: flex;">
            <span style="display: inline-block;">1</span>
            <span style="display: inline-block;">10</span>
        </span>


        <img src="{{ asset('img/reverso2.jpg') }}"
            style="display: block; width: 100%; height: 426px;"
        >
            <img src="{{ asset('tarjetasQR/' . $tarjeta->url . '.svg') }}"
                width="130"
                class="qr-encima"
            >

            @if (empty($tarjeta->socio->asociacione_id))
                <p class="texto-encima-expedicion-reverso">N° AUTORIZACIÓN: {{ $tarjeta->num_autorizacion }}</p>
                <p class="texto-encima-revalidacion-reverso">VIGENCIA AUTORIZACIÓN: {{ $tarjeta->vigencia_autorizacion }}</p>
            @else
                <p class="texto-encima-expedicion-reverso">PERMISO OPERACIÓN: {{ $tarjeta->num_operacion }}</p>
                <p class="texto-encima-revalidacion-reverso">VIGENCIA OPERACIÓN: {{ $tarjeta->vigencia_operacion }}</p>
            @endif --}}

{{--         <div class="anverso">
            <img src="{{ asset('img/anverso2.jpg') }}"
                style="display: block; width: 100%; height: 426px;"
            >

            @if ($tarjeta->socio->nombre_propietario)
                <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DEL SOCIO</span>
            @else
                <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DEL SOCIO - PROPIETARIO</span>
            @endif

            <span class="texto-encima-nombre">{{ $tarjeta->socio->nombre_socio }}</span>
            <span class="texto-encima-dni">{{ strtoupper($tarjeta->socio->documento->nombre) }}: {{ $tarjeta->socio->dni_socio }}</span>
            <span class="texto-encima-placa">N° Placa: {{ $tarjeta->num_placa }}</span>

            @if (empty($tarjeta->socio->asociacione_id))
                <span class="texto-encima-asociacion-name">SIN TRANSPORTADOR AUTORIZADO</span>
                <span class="texto-encima-asociacion"> ES PERSONA NATURAL</span>
                <span class="texto-encima-asociacion"> ES PERSONA NATURAL</span>
            @else
                <span class="texto-encima-asociacion-name">NOMBRE DEL TRANSPORTADOR AUTORIZADO</span>
                <span class="texto-encima-asociacion"> {{ optional($tarjeta->socio->asociacione)->nombre }}</span>
                <span class="texto-encima-asociacion"> {{ optional($tarjeta->socio->asociacione)->nombre }}</span>
            @endif

            <span class="texto-encima-expedicion-anverso">EXPEDICIÓN DE LA TCV: {{ now()->format('d-m-Y') }}</span>
            <span class="texto-encima-expedicion-anverso">EXPEDICIÓN DE LA TCV: {{ now()->format('d-m-Y') }}</span>

            <span class="texto-encima-revalidacion-anverso">REVALIDACIÓN DE LA TCV: {{ date('d-m-Y', strtotime("+1 years")) }}</span>
            <span class="texto-encima-revalidacion-anverso">REVALIDACIÓN DE LA TCV: {{ date('d-m-Y', strtotime("+1 years")) }}</span>

            <span class="texto-encima-correlativo">N° {{ $tarjeta->num_correlativo }}</span>
            <span class="texto-encima-correlativo">N° {{ $tarjeta->num_correlativo }}</span>
        </div>

        <div class="contenedor">
            <img src="{{ asset('img/reverso2.jpg') }}"
                style="display: block; width: 100%; height: 426px;"
            >

            <img src="{{ asset('tarjetasQR/' . $tarjeta->url . '.svg') }}"
                width="130"
                class="qr-encima"
            >

            @if (empty($tarjeta->socio->asociacione_id))
                <p class="texto-encima-expedicion-reverso">N° AUTORIZACIÓN: {{ $tarjeta->num_autorizacion }}</p>
                <p class="texto-encima-revalidacion-reverso">VIGENCIA AUTORIZACIÓN: {{ $tarjeta->vigencia_autorizacion }}</p>
            @else
                <p class="texto-encima-expedicion-reverso">PERMISO OPERACIÓN: {{ $tarjeta->num_operacion }}</p>
                <p class="texto-encima-revalidacion-reverso">VIGENCIA OPERACIÓN: {{ $tarjeta->vigencia_operacion }}</p>
            @endif
        </div> --}}
</body>
</html>
