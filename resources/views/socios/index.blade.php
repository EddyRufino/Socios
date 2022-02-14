@extends('layouts.app')

@section('content')
<div class="container">
{{--     <h4 class="text-dark font-weight-bold mb-4"><a href="{{ route('tarjetas.index') }}" class="text-dark item text-decoration-none">Socios Oficiales</a></h4> --}}

    <div class="d-flex align-items-center justify-content-between">
        <h4 class="text-dark font-weight-bold mb-4">
            <a href="{{ route('tarjetas.index') }}"
                class="text-dark item text-decoration-none"
            >
                Socios Oficiales
            </a>
        </h4>

        <div>
            @canExport
                <span class="flex-1">Exportar:</span>

                <span id="contenidoSocio" style="display: none;">
                    <a href="{{ route('todo.socio.pdf') }}" class="ml-1 text-danger text-decoration-none tooltipw" target="_blank">
                        <span id="tooltipw" class="tooltiptext">Descarga Socios</span>
                        @include('icons.pdf')
                    </a>
                    <a href="{{ route('todo.socio.excel') }}" class="ml-1 text-success text-decoration-none tooltipw">
                        <span id="tooltipw" class="tooltiptext">Descarga Socios</span>
                        @include('icons.excel')
                    </a>
                </span>
                <span class="ml-1 text-dark tooltipw" style='cursor: pointer;' onClick="showHidden_socio()">
                    <span id="tooltipw" class="tooltiptext">Ver más</span>
                    @include('icons.users')
                </span>

                <span id="contenidoTarjeta" style="display: none;">
                    <a href="{{ route('todo.tarjeta.pdf') }}" class="ml-1 text-danger text-decoration-none tooltipw" target="_blank">
                        <span id="tooltipw" class="tooltiptext">Descarga Tarjetas Circulación</span>
                        @include('icons.pdf')
                    </a>
                    <a href="{{ route('todo.tarjeta.excel') }}" class="ml-1 text-success text-decoration-none tooltipw">
                        <span id="tooltipw" class="tooltiptext">Descarga Tarjetas Circulación</span>
                        @include('icons.excel')
                    </a>
                </span>
                <span class="ml-1 text-dark text-decoration-none tooltipw" style='cursor: pointer;' onClick="showHidden_tarjeta()">
                    <span id="tooltipw" class="tooltiptext">Ver más</span>
                    @include('icons.tarjeta')
                </span>

                <span id="contenidoFotocheck" style="display: none;">
                    <a href="{{ route('todo.fotocheck.pdf') }}" class="ml-1 text-danger text-decoration-none tooltipw" target="_blank">
                        <span id="tooltipw" class="tooltiptext">Descarga Fotochecks</span>
                        @include('icons.pdf')
                    </a>
                    <a href="{{ route('todo.fotocheck.excel') }}" class="ml-1 text-success text-decoration-none tooltipw">
                        <span id="tooltipw" class="tooltiptext">Descarga Fotochecks</span>
                        @include('icons.excel')
                    </a>
                </span>
                <span class="ml-1 text-dark text-decoration-none tooltipw" style='cursor: pointer;' onClick="showHidden_fotocheck()">
                    <span id="tooltipw" class="tooltiptext">Ver más</span>
                    @include('icons.fotocheck')
                </span>
            @endcanExport
        </div>

    </div>
    {{-- Search Basico --}}
    @include('partials.searchBasico', ['link' => 'search.socio'])

    {{-- Search Advanced --}}
    <div id="searchAdvanced" class="d-flex justify-content-center" style="display: none !important;">
        @include('admin.search.advanced')
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-between align-items-center">
            <h6><a href="{{ route('tarjetas.index') }}" class="text-dark ml-3 tooltipw">
                <span id="tooltipw" class="tooltiptext">Listar Tarjetas</span>
                @include('icons.tarjeta')
            </a></h6>
            <h6><a href="{{ route('fotochecks.index') }}" class="text-dark ml-3 tooltipw">
                <span id="tooltipw" class="tooltiptext">Listar Fotochecks</span>
                @include('icons.fotocheck')
            </a></h6>
        </div>

        @include('partials.checkbox')

    </div>

    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="bg-primary text-white">Nombre y Apellido</th>
                        <th scope="col" class="bg-primary text-white">dni, ruc, carnet</th>
                        <th scope="col" class="bg-primary text-white">Placa</th>
                        <th scope="col" class="bg-primary text-white">Asociación</th>
                        <th scope="col" class="bg-primary text-white">Vehículo</th>
                        <th scope="col" class="bg-primary text-white">Actividad</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($socios as $socio)
                        <tr>
                            <td>{{ $socio->nombre_socio }}</td>
                            <td>{{ $socio->dni_socio }}</td>
                            <td>{{ $socio->num_placa }}</td>

                            @if (empty($socio->asociacione_id)  && $socio->tipo_documento_id == 3)
                                <td class="text-secondary">Entidad Privada</td>
                            @elseif (empty($socio->asociacione_id))
                                <td class="text-secondary">Persona Natural</td>
                            @else
                                <td>{{ optional($socio->asociacione)->nombre }}</td>
                            @endif

                            {{-- {{ dd($socio->vehiculo) }} --}}
                            @if ($socio->vehiculo_id == 1)
                                <td class="text-info">{{ $socio->vehiculo->nombre }}</td>
                            @elseif($socio->vehiculo_id == 2)
                                <td class="text-primary">{{ $socio->vehiculo->nombre }}</td>
                            @else
                                <td class="text-secondary">{{ $socio->vehiculo->nombre }}</td>
                            @endif

                            <td>
                                <div class="d-flex">

                                    @if ($socio->tarjetas()->exists())
                                        <h6><a href="{{ route('tarjetas.show', $socio->url) }}"
                                            class="text-decoration-none tooltipw text-dark"
                                            target="_blank"
                                        >
                                            <span id="tooltipw" class="tooltiptext">Ver QR Tarjeta</span>
                                            @include('icons.qr-left')
                                        </a></h6>
                                    @endif

                                    @canPrint
                                        @if ($socio->tarjetas()->exists() && optional($socio->tarjetas[0])->status == 0)
                                            <h6><a href="{{ route('tarjeta.anverso', $socio->tarjetas[0]->id) }}"
                                                class="ml-3 text-decoration-none text-dark tooltipw"
                                                target="_blank"
                                            >
                                                <span id="tooltipw" class="tooltiptext">Descargar Tarjeta Circulación</span>
                                                @include('icons.tarjeta')
                                            </a></h6>
                                        @endif

                                        @if ($socio->fotochecks()->exists() && $socio->fotochecks[0]->status == 0)
                                            <h6><a href="{{ route('fotocheck.anverso', $socio->fotochecks[0]->id) }}"
                                                class="ml-3 text-decoration-none text-info tooltipw"
                                                target="_blank"
                                            >
                                                <span id="tooltipw" class="tooltiptext">Descargar Fotocheck</span>
                                                @include('icons.fotocheck')
                                            </a></h6>
                                        @endif
                                    @endcanPrint

                                    @if ($socio->fotochecks()->exists())
                                        <h6><a href="{{ route('fotochecks.show', $socio->url) }}"
                                            class="ml-3 text-decoration-none tooltipw text-dark"
                                            target="_blank"
                                        >
                                            <span id="tooltipw" class="tooltiptext">Ver QR Fotocheck</span>
                                            @include('icons.qr-right')
                                        </a></h6> 
                                    @endif

                                    @canDelete
                                        <h6 class="tooltipw mb-2">
                                            <form action="{{ route('socios.destroy', $socio) }}" method="POST"
                                                style="display: inline-block;"
                                                onclick="return confirm('¿Segur@ de querer eliminar?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <span id="tooltipw" class="tooltiptext">Eliminar</span>
                                                <button class="p-0 ml-2 btn btn-transparent">@include('icons.delete')</button>
                                            </form>
                                        </h6>
                                    @endcanDelete

                                </div>
                            </td>
                        </tr>
                    @empty
                        <li class="list-group-item border-0 mb-3 shadow-sm">No hay nada para mostrar</li>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <div class="overflow-auto mt-2">
        {{ $socios->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    function myFunction() {
        let check = document.getElementById("myCheck");
        let search = document.getElementById("search");

        if (check.checked == true){
            search.style.display = "block";
        } else {
            search.style.display = "none";
        }
    }

    function mySearchAdvanced() {
        let check = document.getElementById("myCheckAdvanced");
        let search = document.getElementById("searchAdvanced");

        if (check.checked == true){
            search.style.display = "block";
        } else {
            search.style.setProperty('display', 'none', 'important');
        }
    }

    // function muestra_oculta(id) {
    //     if (document.getElementById) {
    //         let el = document.getElementById(id);
    //         el.style.display = (el.style.display == 'none') ? 'inline-block' : 'none';
    //     }
    // }
    // window.onload = function() {
    //     muestra_oculta('contenido');
    // }
    function showHidden_socio() {
        var x = document.getElementById("contenidoSocio");
        if (x.style.display === "none") {
            x.style.display = "inline-block";
        } else {
            x.style.display = "none";
        }
    }

    function showHidden_tarjeta() {
        var x = document.getElementById("contenidoTarjeta");
        if (x.style.display === "none") {
            x.style.display = "inline-block";
        } else {
            x.style.display = "none";
        }
    }

    function showHidden_fotocheck() {
        var x = document.getElementById("contenidoFotocheck");
        if (x.style.display === "none") {
            x.style.display = "inline-block";
        } else {
            x.style.display = "none";
        }
    }
</script>
@endpush
