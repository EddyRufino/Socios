<!DOCTYPE html>
<html lang="en">
<head>
    {{-- <meta charset="UTF-8"> --}}
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    <title>Carnet Animal</title>

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
    top: 44%;
    left: 6.5%;
    font-size: 1.8rem;
    font-weight: 900;
    text-transform: uppercase;
    line-height: 30px;
    font-family: sans-serif;
}

.texto-encima-nombre-socio {
    position: absolute;
    top: 34%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
    line-height: 30px;
    font-family: sans-serif;
}

.texto-encima-dni {
    position: absolute;
    top: 54%;
    left: 15%;
    font-size: 1.2rem;
    font-weight: 900;
}

.texto-encima-placa {
    position: absolute;
    top: 61%;
    left: 31.54%;
    font-size: 1.2rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-asociacion {
    position: absolute;
    top: 73%;
    left: 6.5%;
    font-size: 1.6rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-asociacion-name {
    position: absolute;
    top: 68%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-expedicion-anverso {
    position: absolute;
    top: 81%;
    left: 33%;
    font-size: 1.2rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-revalidacion-anverso {
    position: absolute;
    top: 88%;
    left: 37%;
    font-size: 1.2rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-correlativo {
    position: absolute;
    top: 92%;
    left: 77%;
    font-size: 1.5rem;
    font-weight: 900;
    text-transform: uppercase;
    color: tomato;
}

.texto-encima-expedicion-reverso {
    position: absolute;
    top: 60.54%;
    left: 36%;
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
    left: 46%;
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
    top: 10px;
    left: 81%;
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

        @if ($tarjeta[0]->nombre_propietario)
            <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DEL SOCIO</span>
        @else
            <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DEL SOCIO - PROPIETARIO</span>
        @endif

        <span class="texto-encima-nombre">{{ $tarjeta[0]->nombre_socio }}</span>
        <span class="texto-encima-dni">{{ $tarjeta[0]->dni_socio }}</span>
        <span class="texto-encima-placa">{{ $tarjeta[0]->num_placa }}</span>

        @if ($tarjeta[0]->asociacione_id > 1)
            <span class="texto-encima-asociacion-name">NOMBRE DEL TRANSPORTADOR AUTORIZADO</span>
            <span class="texto-encima-asociacion"> {{ optional($tarjeta[0]->asociacione)->nombre }}</span>
            <span class="texto-encima-asociacion"> {{ optional($tarjeta[0]->asociacione)->nombre }}</span>
        @else
            <span class="texto-encima-asociacion-name">SIN TRANSPORTADOR AUTORIZADO</span>
            <span class="texto-encima-asociacion"> ES PERSONA NATURAL</span>
            <span class="texto-encima-asociacion"> ES PERSONA NATURAL</span>
        @endif

        <span class="texto-encima-expedicion-anverso">{{ $tarjeta[0]->expedicion }}</span>
        <span class="texto-encima-expedicion-anverso">{{ $tarjeta[0]->expedicion }}</span>

        <span class="texto-encima-revalidacion-anverso">{{ $tarjeta[0]->revalidacion }}</span>
        <span class="texto-encima-revalidacion-anverso">{{ $tarjeta[0]->revalidacion }}</span>

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
            width="125"
            class="qr-encima"
        >

        @if ($tarjeta[0]->asociacione_id > 1)
            <p class="texto-encima-expedicion-reverso">{{ $tarjeta[0]->num_operacion }}</p>
            <p class="texto-encima-revalidacion-reverso">{{ $tarjeta[0]->vigencia_operacion }}</p>
        @else
            <p class="texto-encima-expedicion-reverso">{{ $tarjeta[0]->num_autorizacion }}</p>
            <p class="texto-encima-revalidacion-reverso">{{ $tarjeta[0]->vigencia_autorizacion }}</p>
        @endif
    </div>
</body>
</html>
