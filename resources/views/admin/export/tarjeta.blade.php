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
    top: 36%;
    left: 6.5%;
    font-size: 1.4rem;
    font-weight: 900;
    text-transform: uppercase;
    line-height: 30px;
    font-family: sans-serif;
}

.texto-encima-nombre-socio {
    position: absolute;
    top: 30%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
    line-height: 30px;
    font-family: sans-serif;
}

.texto-encima-dni {
    position: absolute;
    top: 44%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
}

.texto-encima-placa {
    position: absolute;
    top: 61%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-asociacion {
    position: absolute;
    top: 72%;
    left: 6.5%;
    font-size: 1.4rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-asociacion-name {
    position: absolute;
    top: 67%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-propietario-name {
    position: absolute;
    top: 48%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
    line-height: 30px;
    font-family: sans-serif;
}

.texto-encima-propietario {
    position: absolute;
    top: 53%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
    line-height: 30px;
    font-family: sans-serif;
}

.texto-encima-expedicion-anverso {
    position: absolute;
    top: 80%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-revalidacion-anverso {
    position: absolute;
    top: 86%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.expedicion-tiene-propietario {
    position: absolute;
    top: 67%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.revalidacion-tiene-propietario {
    position: absolute;
    top: 73%;
    left: 6.5%;
    font-size: 1rem;
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
    left: 4%;
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
    /*line-height: 30px;*/
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
    <div class="anverso">
        <img src="{{ asset('img/anverso2.jpg') }}"
            style="display: block; width: 100%; height: 426px;"
        >
{{-- {{dd(empty($tarjeta[0]->socio->nombre_propietario))}} --}}
        @if ($tarjeta[0]->socio->nombre_propietario && $tarjeta[0]->socio->asociacione_id)
            <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DEL SOCIO</span>
        @elseif(empty($tarjeta[0]->socio->nombre_propietario) && $tarjeta[0]->socio->asociacione_id)
            <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DEL SOCIO - PROPIETARIO</span>

        @elseif($tarjeta[0]->socio->nombre_propietario && is_null($tarjeta[0]->socio->asociacione_id) && $tarjeta[0]->socio->tipo_documento_id == 3)
            <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DE LA PERSONA JURíDICA</span>
        @elseif(empty($tarjeta[0]->socio->nombre_propietario) && is_null($tarjeta[0]->socio->asociacione_id) && $tarjeta[0]->socio->tipo_documento_id == 3)
            <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DEL PROPIETARIO</span>

        @elseif($tarjeta[0]->socio->nombre_propietario && is_null($tarjeta[0]->socio->asociacione_id))
            <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DE LA PERSONA NATURAL</span>
        @elseif(empty($tarjeta[0]->socio->nombre_propietario) && is_null($tarjeta[0]->socio->asociacione_id))
            <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DEL PROPIETARIO</span>

        @endif

       {{--  @if ($tarjeta[0]->socio->nombre_propietario && is_null($tarjeta[0]->socio->asociacione_id))
            <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DEL PROPIETARIO</span>
        @else
            <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DE LA PERSONA NATURAL</span>
        @endif --}}

        <span class="texto-encima-nombre">{{ $tarjeta[0]->socio->nombre_socio }}</span>
        <span class="texto-encima-dni">
            {{ strtoupper($tarjeta[0]->socio->documento->nombre) }}: {{ $tarjeta[0]->socio->dni_socio }}
        </span>

        @if ($tarjeta[0]->socio->nombre_propietario)
            <span class="texto-encima-propietario-name">PROPIETARIO</span>
            <span class="texto-encima-propietario"> {{ $tarjeta[0]->socio->nombre_propietario }}</span>
        @else
            <span class="texto-encima-propietario-name">PROPIETARIO</span>
            <span class="texto-encima-propietario"> -</span>
        @endif

        <span class="texto-encima-placa">N° Placa: {{ $tarjeta[0]->num_placa }}</span>

        @if (empty($tarjeta[0]->socio->asociacione_id))
            <span class="texto-encima-asociacion-name">NOMBRE DEL TRANSPORTADOR</span>
            <span class="texto-encima-asociacion"> -</span>
            <span class="texto-encima-asociacion"> -</span>
        @else
            <span class="texto-encima-asociacion-name">NOMBRE DEL TRANSPORTADOR</span>
            <span class="texto-encima-asociacion"> {{ optional($tarjeta[0]->socio->asociacione)->nombre }}</span>
            <span class="texto-encima-asociacion"> {{ optional($tarjeta[0]->socio->asociacione)->nombre }}</span>
        @endif

        <span class="texto-encima-expedicion-anverso">EXPEDICIÓN DE LA TCV: {{ now()->format('d-m-Y') }}</span>
        <span class="texto-encima-expedicion-anverso">EXPEDICIÓN DE LA TCV: {{ now()->format('d-m-Y') }}</span>

        <span class="texto-encima-revalidacion-anverso">REVALIDACIÓN DE LA TCV: {{ date('d-m-Y', strtotime("+1 years")) }}</span>
        <span class="texto-encima-revalidacion-anverso">REVALIDACIÓN DE LA TCV: {{ date('d-m-Y', strtotime("+1 years")) }}</span>

{{--         @if ($tarjeta[0]->socio->asociacione_id)
            <span class="texto-encima-asociacion-name">NOMBRE DEL TRANSPORTADOR AUTORIZADO</span>
            <span class="texto-encima-asociacion"> {{ optional($tarjeta[0]->socio->asociacione)->nombre }}</span>
            <span class="texto-encima-asociacion"> {{ optional($tarjeta[0]->socio->asociacione)->nombre }}</span>

            @php
                $hasAsociacion = true;
            @endphp
        @endif --}}

        {{-- TIENEN SOLO PROPIETARIO --}}
{{--         @if (empty($tarjeta[0]->socio->nombre_propietario) && is_null($tarjeta[0]->socio->asociacione_id))
            <span class="expedicion-tiene-propietario">EXPEDICIÓN DE LA TCV: {{ now()->format('d-m-Y') }}</span>
            <span class="expedicion-tiene-propietario">EXPEDICIÓN DE LA TCV: {{ now()->format('d-m-Y') }}</span>

            <span class="revalidacion-tiene-propietario">REVALIDACIÓN DE LA TCV: {{ date('d-m-Y', strtotime("+1 years")) }}</span>
            <span class="revalidacion-tiene-propietario">REVALIDACIÓN DE LA TCV: {{ date('d-m-Y', strtotime("+1 years")) }}</span>
        @endif

        @if (!empty($tarjeta[0]->socio->nombre_propietario) && is_null($tarjeta[0]->socio->asociacione_id))
            <span class="expedicion-tiene-propietario">EXPEDICIÓN DE LA TCV: {{ now()->format('d-m-Y') }}</span>
            <span class="expedicion-tiene-propietario">EXPEDICIÓN DE LA TCV: {{ now()->format('d-m-Y') }}</span>

            <span class="revalidacion-tiene-propietario">REVALIDACIÓN DE LA TCV: {{ date('d-m-Y', strtotime("+1 years")) }}</span>
            <span class="revalidacion-tiene-propietario">REVALIDACIÓN DE LA TCV: {{ date('d-m-Y', strtotime("+1 years")) }}</span>
        @endif

        @if (!empty($tarjeta[0]->socio->nombre_propietario) && $tarjeta[0]->socio->asociacione_id)
            <span class="texto-encima-expedicion-anverso">EXPEDICIÓN DE LA TCV: {{ now()->format('d-m-Y') }}</span>
            <span class="texto-encima-expedicion-anverso">EXPEDICIÓN DE LA TCV: {{ now()->format('d-m-Y') }}</span>

            <span class="texto-encima-revalidacion-anverso">REVALIDACIÓN DE LA TCV: {{ date('d-m-Y', strtotime("+1 years")) }}</span>
            <span class="texto-encima-revalidacion-anverso">REVALIDACIÓN DE LA TCV: {{ date('d-m-Y', strtotime("+1 years")) }}</span>
        @endif
 --}}
        {{-- NO TIENEN PROPIETARIO NI ASOCIACION --}}

        <span class="texto-encima-correlativo">N° {{ $tarjeta[0]->num_correlativo }}</span>
        <span class="texto-encima-correlativo">N° {{ $tarjeta[0]->num_correlativo }}</span>
{{--         <span class="texto-encima-correlativo">{{ $tarjeta[0]->num_correlativo }}</span>
        <span class="texto-encima-correlativo">{{ $tarjeta[0]->num_correlativo }}</span> --}}
        {{-- {{dd()}} --}}
        {{-- <span class="texto-encima-correlativo">{{ $tarjeta[0]->num_correlativom }}</span> --}}
    </div>

    <div class="contenedor">
        <img src="{{ asset('img/reverso2.jpg') }}"
            style="display: block; width: 100%; height: 426px;"
        >

        <img src="{{ asset('tarjetasQR/' . $tarjeta[0]->url . '.svg') }}"
            width="130"
            class="qr-encima"
        >

        @if (empty($tarjeta[0]->socio->asociacione_id))
            <p class="texto-encima-expedicion-reverso">N° AUTORIZACIÓN: {{ $tarjeta[0]->num_autorizacion }}</p>
            <p class="texto-encima-revalidacion-reverso">VIGENCIA AUTORIZACIÓN: {{ $tarjeta[0]->vigencia_autorizacion }}</p>
        @else
            <p class="texto-encima-expedicion-reverso">PERMISO OPERACIÓN: {{ $tarjeta[0]->num_operacion }}</p>
            <p class="texto-encima-revalidacion-reverso">VIGENCIA OPERACIÓN: {{ $tarjeta[0]->vigencia_operacion }}</p>
        @endif
    </div>
</body>
</html>
