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

.texto-encima-nombre-juridica-propietario {
    position: absolute;
    top: 36%;
    left: 6.5%;
    font-size: 1.4rem;
    font-weight: 900;
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
    top: 43%;
    left: 6.5%;
    font-size: 1.1rem;
    font-weight: 900;
}

.texto-encima-dni-natural {
    position: absolute;
    top: 43%;
    left: 6.5%;
    font-size: 1.2rem;
    font-weight: 900;
}

.texto-encima-dni-juridica-propietario {
    position: absolute;
    top: 48%;
    left: 6.5%;
    font-size: 1.1rem;
    font-weight: 900;
}

.texto-encima-placa {
    position: absolute;
    top: 48%;
    left: 6.5%;
    font-size: 1.1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-placa-natural {
    position: absolute;
    top: 48%;
    left: 6.5%;
    font-size: 1.2rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-placa-juridica-propietario {
    position: absolute;
    top: 53%;
    left: 6.5%;
    font-size: 1.1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-asociacion {
    position: absolute;
    top: 67%;
    left: 6.5%;
    font-size: 1.4rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-asociacion-socio-propietario {
    position: absolute;
    top: 59%;
    left: 6.5%;
    font-size: 1.4rem;
    font-weight: 900;
    text-transform: uppercase;
}
.texto-encima-asociacion-name {
    position: absolute;
    top: 63%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-asociacion-name-socio-propietario {
    position: absolute;
    top: 55%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-propietario-name {
    position: absolute;
    top: 52%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
    line-height: 30px;
    font-family: sans-serif;
}

.texto-encima-propietario-name-juridica-propietario {
    position: absolute;
    top: 56%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
    line-height: 30px;
    font-family: sans-serif;
}

.texto-encima-propietario {
    position: absolute;
    top: 56%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
    line-height: 30px;
    font-family: sans-serif;
}

.texto-encima-propietario-juridica-propietario {
    position: absolute;
    top: 60%;
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

.texto-encima-expedicion-anverso-socio-propietario {
    position: absolute;
    top: 71%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-expedicion-anverso-natural-propietario {
    position: absolute;
    top: 64%;
    left: 6.5%;
    font-size: 1.1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-expedicion-anverso-juridica-propietario {
    position: absolute;
    top: 72%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-expedicion-anverso-juridica-propietario-oficial {
    position: absolute;
    top: 64%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-expedicion-anverso-juridica {
    position: absolute;
    top: 53%;
    left: 6.5%;
    font-size: 1.1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-revalidacion-anverso {
    position: absolute;
    top: 85%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-revalidacion-anverso-socio-propietario {
    position: absolute;
    top: 76%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-revalidacion-anverso-natural-propietario {
    position: absolute;
    top: 69%;
    left: 6.5%;
    font-size: 1.1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-revalidacion-anverso-juridica-propietario {
    position: absolute;
    top: 77%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-revalidacion-anverso-juridica-propietario-oficial {
    position: absolute;
    top: 70%;
    left: 6.5%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-revalidacion-anverso-juridica {
    position: absolute;
    top: 58%;
    left: 6.5%;
    font-size: 1.1rem;
    font-weight: 900;
    text-transform: uppercase;
}

.texto-encima-correlativo {
    position: absolute;
    top: 85%;
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

.texto-encima-footer-reverso {
    position: absolute;
    top: 103%;
    left: 30%;
    height: 30%;
    width: 45%;
    margin: -17% 0 0 -25%;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
    text-align: center;
    font-family: monospace !important;
}

.nombre-jefe-footer-reverso {
    position: absolute;
    top: 107%;
    left: 81%;
    height: 30%;
    width: 45%;
    margin: -17% 0 0 -25%;
    font-size: 1rem;
    font-weight: 900;
    text-align: center;
}

.nombre-jefe-firma-footer-reverso {
    position: absolute;
    top: 86%;
    left: 81%;
    height: 30%;
    width: 45%;
    margin: -17% 0 0 -25%;
    font-size: 1rem;
    font-weight: 900;
    text-align: center;
}

.nombre-area-footer-reverso {
    position: absolute;
    top: 110%;
    left: 81%;
    height: 30%;
    width: 45%;
    margin: -17% 0 0 -25%;
    font-size: 1rem;
    font-weight: 900;
    text-align: center;
}

.qr-encima {
    position: absolute;
    top: 23px;
    left: 75%;
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
</style>

<body>
    <div class="anverso">

        @if (isset($tarjeta[0]->disenio->anverso))
            <img src="{{ asset('disenios/' . $tarjeta[0]->disenio->anverso) }}"
                style="display: block; width: 100%; height: 472px;"
            >
        @else
            <img src="{{ asset('img/anverso2.jpg') }}"
                style="display: block; width: 100%; height: 472px;"
            >
        @endif

        {{-- SOCIOS CON PROPIETARIOS --}}
        @if ($tarjeta[0]->socio->nombre_propietario && $tarjeta[0]->socio->asociacione_id)
            <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DEL SOCIO</span>

            <span class="texto-encima-nombre">{{ $tarjeta[0]->socio->nombre_socio }}</span>

            <span class="texto-encima-dni">
                {{ strtoupper($tarjeta[0]->socio->documento->nombre) }}: {{ $tarjeta[0]->socio->dni_socio }}
            </span>

            <span class="texto-encima-placa">N° PLACA: {{ $tarjeta[0]->num_placa }}</span>

            @if ($tarjeta[0]->socio->nombre_propietario)
                <span class="texto-encima-propietario-name">PROPIETARIO</span>
                <span class="texto-encima-propietario"> {{ $tarjeta[0]->socio->nombre_propietario }}</span>
            @endif

            <span class="texto-encima-asociacion-name">NOMBRE DEL TRANSPORTADOR AUTORIZADO</span>
            <span class="texto-encima-asociacion">
                ASOCIACIÓN DE TRANSPORTADORES "{{ optional($tarjeta[0]->socio->asociacione)->nombre }}"
            </span>

            <span class="texto-encima-expedicion-anverso">EXPEDICIÓN DE LA TCV: {{ now()->format('d-m-Y') }}</span>

            <span class="texto-encima-revalidacion-anverso">REVALIDACIÓN DE LA TCV: {{ date('d-m-Y', strtotime("+1 years")) }}</span>

        {{-- SOCIOS SIN PROPIETARIOS --}}
        @elseif(empty($tarjeta[0]->socio->nombre_propietario) && $tarjeta[0]->socio->asociacione_id)
            <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DEL SOCIO - PROPIETARIO</span>

            <span class="texto-encima-nombre">{{ $tarjeta[0]->socio->nombre_socio }}</span>

            <span class="texto-encima-dni">
                {{ strtoupper($tarjeta[0]->socio->documento->nombre) }}: {{ $tarjeta[0]->socio->dni_socio }}
            </span>

            <span class="texto-encima-placa">N° PLACA: {{ $tarjeta[0]->num_placa }}</span>

            <span class="texto-encima-asociacion-name-socio-propietario">NOMBRE DEL TRANSPORTADOR AUTORIZADO</span>
            <span class="texto-encima-asociacion-socio-propietario">
                ASOCIACIÓN DE TRANSPORTADORES "{{ optional($tarjeta[0]->socio->asociacione)->nombre }}"
            </span>

            <span class="texto-encima-expedicion-anverso-socio-propietario">
                EXPEDICIÓN DE LA TCV: {{ now()->format('d-m-Y') }}
            </span>

            <span class="texto-encima-revalidacion-anverso-socio-propietario">
                REVALIDACIÓN DE LA TCV: {{ date('d-m-Y', strtotime("+1 years")) }}
            </span>

        {{-- JURIDICA CON PROPIETARIO --}}
        @elseif($tarjeta[0]->socio->nombre_propietario && is_null($tarjeta[0]->socio->asociacione_id) && $tarjeta[0]->socio->tipo_documento_id == 3)
            <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DE LA PERSONA JURIDICA</span>

            <span class="texto-encima-nombre-juridica-propietario">{{ $tarjeta[0]->socio->nombre_socio }}</span>

            <span class="texto-encima-dni-juridica-propietario">
                {{ strtoupper($tarjeta[0]->socio->documento->nombre) }}: {{ $tarjeta[0]->socio->dni_socio }}
            </span>

            <span class="texto-encima-placa-juridica-propietario">N° PLACA: {{ $tarjeta[0]->num_placa }}</span>

            <span class="texto-encima-propietario-name-juridica-propietario">PROPIETARIO</span>
            <span class="texto-encima-propietario-juridica-propietario"> {{ $tarjeta[0]->socio->nombre_propietario }}</span>

             <span class="texto-encima-expedicion-anverso-juridica-propietario">
                EXPEDICIÓN DE LA TCV: {{ now()->format('d-m-Y') }}
            </span>

           <span class="texto-encima-revalidacion-anverso-juridica-propietario">
                REVALIDACIÓN DE LA TCV: {{ date('d-m-Y', strtotime("+1 years")) }}
            </span>

        {{-- JURIDICA SIN PROPIETARIOS --}}
        @elseif(empty($tarjeta[0]->socio->nombre_propietario) && is_null($tarjeta[0]->socio->asociacione_id) && $tarjeta[0]->socio->tipo_documento_id == 3)
            <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DEL PROPIETARIO</span>

            <span class="texto-encima-nombre-juridica-propietario">{{ $tarjeta[0]->socio->nombre_socio }}</span>

            <span class="texto-encima-dni-juridica-propietario">
                {{ strtoupper($tarjeta[0]->socio->documento->nombre) }}: {{ $tarjeta[0]->socio->dni_socio }}
            </span>

            <span class="texto-encima-placa-juridica-propietario">N° PLACA: {{ $tarjeta[0]->num_placa }}</span>

             <span class="texto-encima-expedicion-anverso-juridica-propietario-oficial">
                EXPEDICIÓN DE LA TCV: {{ now()->format('d-m-Y') }}
            </span>

           <span class="texto-encima-revalidacion-anverso-juridica-propietario-oficial">
                REVALIDACIÓN DE LA TCV: {{ date('d-m-Y', strtotime("+1 years")) }}
            </span>

        {{-- NATURAL CON PROPIETARIOS --}}
        @elseif($tarjeta[0]->socio->nombre_propietario && is_null($tarjeta[0]->socio->asociacione_id))
            <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DE LA PERSONA NATURAL</span>

            <span class="texto-encima-nombre">{{ $tarjeta[0]->socio->nombre_socio }}</span>

            <span class="texto-encima-dni-natural">
                {{ strtoupper($tarjeta[0]->socio->documento->nombre) }}: {{ $tarjeta[0]->socio->dni_socio }}
            </span>

            <span class="texto-encima-placa-natural">N° PLACA: {{ $tarjeta[0]->num_placa }}</span>

            <span class="texto-encima-propietario-name">PROPIETARIO</span>
            <span class="texto-encima-propietario"> {{ $tarjeta[0]->socio->nombre_propietario }}</span>

            <span class="texto-encima-expedicion-anverso-natural-propietario">
                EXPEDICIÓN DE LA TCV: {{ now()->format('d-m-Y') }}
            </span>

            <span class="texto-encima-revalidacion-anverso-natural-propietario">
                REVALIDACIÓN DE LA TCV: {{ date('d-m-Y', strtotime("+1 years")) }}
            </span>

        {{-- NATURAL SIN PROPIETARIOS --}}
        @elseif(empty($tarjeta[0]->socio->nombre_propietario) && is_null($tarjeta[0]->socio->asociacione_id))
            <span class="texto-encima-nombre-socio">APELLIDOS Y NOMBRES DEL PROPIETARIO</span>

            <span class="texto-encima-nombre">{{ $tarjeta[0]->socio->nombre_socio }}</span>

            <span class="texto-encima-dni-natural">
                {{ strtoupper($tarjeta[0]->socio->documento->nombre) }}: {{ $tarjeta[0]->socio->dni_socio }}
            </span>

            <span class="texto-encima-placa-natural">N° PLACA: {{ $tarjeta[0]->num_placa }}</span>

            <span class="texto-encima-expedicion-anverso-juridica">
                EXPEDICIÓN DE LA TCV: {{ now()->format('d-m-Y') }}
            </span>

            <span class="texto-encima-revalidacion-anverso-juridica">
                REVALIDACIÓN DE LA TCV: {{ date('d-m-Y', strtotime("+1 years")) }}
            </span>
        @endif

        <span class="texto-encima-correlativo">N° {{ $tarjeta[0]->num_correlativo }}</span>
        <span class="texto-encima-correlativo">N° {{ $tarjeta[0]->num_correlativo }}</span>
    </div>

    <div class="contenedor">

        @if (isset($tarjeta[0]->disenio->reverso))
            <img src="{{ asset('disenios/' . $tarjeta[0]->disenio->reverso) }}"
                style="display: block; width: 100%; height: 472px;"
            >
        @else
            <img src="{{ asset('img/reverso2.jpg') }}"
                style="display: block; width: 100%; height: 472px;"
            >
        @endif

        <img src="{{ asset('tarjetasQR/' . $tarjeta[0]->url . '.svg') }}"
            width="160"
            class="qr-encima"
        > 
        {{-- src="{{ asset('public/tarjetasQR/' . $tarjeta[0]->url . '.svg') }}" --}}

        @if (empty($tarjeta[0]->socio->asociacione_id))
            <p class="texto-encima-expedicion-reverso">N° AUTORIZACIÓN: {{ $tarjeta[0]->num_autorizacion }}</p>
            <p class="texto-encima-revalidacion-reverso">VIGENCIA AUTORIZACIÓN: {{ $tarjeta[0]->vigencia_autorizacion }}</p>
        @else
            <p class="texto-encima-expedicion-reverso">PERMISO OPERACIÓN: {{ $tarjeta[0]->num_operacion }}</p>
            <p class="texto-encima-revalidacion-reverso">VIGENCIA OPERACIÓN: {{ $tarjeta[0]->vigencia_operacion }}</p>
        @endif

        <p class="texto-encima-footer-reverso">
            EL TRANSPORTADOR DEBE DE PORTAR ESTE DOCUMENTO AL MOMENTO DE SER SOLICITADO POR LA AUTORIDAD COMPETENTE
        </p>

        {{-- @if (isset($tarjeta[0]->disenio->firma))            
            <p class="nombre-jefe-firma-footer-reverso">
                <img src="{{ asset('disenios/' . $tarjeta[0]->disenio->firma) }}" alt="firma" style="width: 250px" height="150px">
            </p>
        @endif --}}
        @if ($tarjeta[0]->disenio->id != 1)            
            <p class="nombre-jefe-firma-footer-reverso">
                <img src="{{ asset('disenios/' . $tarjeta[0]->disenio->firma) }}" alt="firma" style="width: 250px" height="150px">
            </p>
        @endif

        <p class="nombre-jefe-footer-reverso" style="border-top: 1px solid black; width: 43%"></p>
        
        {{-- @if (isset($tarjeta[0]->disenio->nombre_jefe))
            <p class="nombre-jefe-footer-reverso">{{ $tarjeta[0]->disenio->nombre_jefe }}</p>
            <p class="nombre-area-footer-reverso">SUB GERENTE DE TRANSPORTE</p>
        @endif --}}

        @if ($tarjeta[0]->disenio->id != 1)
            <p class="nombre-jefe-footer-reverso">{{ $tarjeta[0]->disenio->nombre_jefe }}</p>
            <p class="nombre-area-footer-reverso">SUB GERENTE DE TRANSPORTE</p>
        @endif
    </div>
</body>
</html>
