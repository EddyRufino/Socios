<!DOCTYPE html>
<html lang="en">
<head>
    {{-- <meta charset="UTF-8"> --}}
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    <title>Fotocheck</title>

</head>

<style type="text/css">

.contenedor{
    position: relative;
    display: inline-block;
    /*margin-top: 3rem;*/
}
.foto-encima{
    position: absolute;
    top: 212px;
    left: 143px;
}

.texto-encima-nombre {
    position: absolute;
    top: 80%;
    left: 50%;
    height: 30%;
    width: 95%;
    margin: -17% 0 0 -48%;
    font-size: 2rem;
    font-weight: 900;
    text-transform: uppercase;
    text-align: center;
    line-height: 30px;
    font-family: sans-serif;
}
.texto-encima-dni-tipo {
    position: absolute;
    top: 89%;
    left: 50%;
    height: 30%;
    width: 95%;
    margin: -17% 0 0 -48%;
    font-size: 1.5rem;
    font-weight: 900;
    text-transform: uppercase;
    text-align: center;
    line-height: 30px;
    font-family: sans-serif;
}
.texto-encima-dni {
    position: absolute;
    top: 93%;
    left: 50%;
    height: 30%;
    width: 95%;
    margin: -17% 0 0 -48%;
    font-size: 1.5rem;
    font-weight: 900;
    text-transform: uppercase;
    text-align: center;
    line-height: 30px;
    font-family: sans-serif;
}
.texto-encima-asociacion-text {
    position: absolute;
    top: 100%;
    left: 50%;
    height: 30%;
    width: 95%;
    margin: -17% 0 0 -48%;
    font-size: 1.5rem;
    font-weight: 900;
    text-transform: uppercase;
    text-align: center;
    line-height: 30px;
    font-family: sans-serif;
}

.texto-encima-asociacion {
    position: absolute;
    top: 105%;
    left: 50%;
    height: 30%;
    width: 95%;
    margin: -17% 0 0 -48%;
    font-size: 2rem;
    font-weight: 900;
    text-transform: uppercase;
    text-align: center;
    line-height: 30px;
    font-family: sans-serif;
}
.texto-encima-expedicion {
    position: absolute;
    top: 78%;
    left: 28%;
    height: 30%;
    width: 95%;
    margin: -17% 0 0 -25%;
    font-size: 1.8rem;
    font-weight: 900;
    text-transform: uppercase;
    text-align: center;
    line-height: 30px;
}

.texto-encima-revalidacion {
    position: absolute;
    top: 84%;
    left: 28%;
    height: 30%;
    width: 95%;
    margin: -17% 0 0 -25%;
    font-size: 1.8rem;
    font-weight: 900;
    text-transform: uppercase;
    text-align: center;
    line-height: 30px;
    font-family: monospace !important;
}

.qr-encima {
    position: absolute;
    top: 210px;
    left: 165px;
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
    <div class="contenedor">
        <img src="{{ asset('img/anverso.jpg') }}"
            style="display: block; width: 100%; height: 793px;"
        >


        <div class="foto-encima">
            <img src="{{ asset($fotocheck[0]->image) }}" style="width: 220px; height: 274.58px;">
        </div>
        <span id="ter" class="texto-encima-nombre">{{ $fotocheck[0]->socio->nombre_socio }}</span>
        <span class="texto-encima-dni-tipo">{{ $fotocheck[0]->socio->documento->nombre }}</span>
        <span class="texto-encima-dni">{{ $fotocheck[0]->socio->dni_socio }}</span>

        @if (!empty($fotocheck[0]->socio->asociacione_id))
            <span class="texto-encima-asociacion-text">TRANSPORTADOR</span>
            <span class="texto-encima-asociacion">"{{ optional($fotocheck[0]->socio->asociacione)->nombre }}"</span>
        @else
            <span class="texto-encima-asociacion-text">N° AUTORIZACIÓN</span>
            <span class="texto-encima-asociacion">{{ $fotocheck[0]->num_autorizacion }}</span>
        @endif



        <img src="{{ asset('img/reverso.jpg') }}"
            style="display: block; width: 100%; height: 793px;"
        >
        <img src="{{ asset('fotochecksQR/' . $fotocheck[0]->url . '.svg') }}"
            width="180"
            class="qr-encima"
        >

        <p class="texto-encima-expedicion">F.EXPEDICIÓN: {{ now()->format('d/m/Y') }}</p>
        {{-- date('d/m/Y', strtotime("+1 years")) --}}
        <p class="texto-encima-revalidacion">F.REVALIDACIÓN: {{ date('d/m/Y', strtotime($fotocheck[0]->revalidacion)) }}</p>
    </div>
</body>
</html>
