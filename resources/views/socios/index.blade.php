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

                <a href="{{ route('todo.socio.pdf') }}" class="ml-1 text-dark text-decoration-none tooltipw" target="_blank">
                    <span id="tooltipw" class="tooltiptext">Descarga Socios</span>
                    @include('icons.users')
                </a>
                <a href="{{ route('todo.tarjeta.pdf') }}" class="ml-1 text-dark text-decoration-none tooltipw" target="_blank">
                    <span id="tooltipw" class="tooltiptext">Descarga Tarjetas Circulación</span>
                    @include('icons.tarjeta')
                </a>
                <a href="{{ route('todo.fotocheck.pdf') }}" class="ml-1 text-dark text-decoration-none tooltipw" target="_blank">
                    <span id="tooltipw" class="tooltiptext">Descarga Fotochecks</span>
                    @include('icons.fotocheck')
                </a>
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

                            @if ($socio->vehiculo_id == 1)
                                <td class="text-info">{{ $socio->vehiculo->nombre }}</td>
                            @elseif($socio->vehiculo_id === 2)
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

                                    {{-- <h6><a href="{{ route('socios.edit', $socio) }}"
                                        class="ml-3 text-decoration-none text-primary tooltipw"
                                    >
                                        <span id="tooltipw" class="tooltiptext">Editar Socio</span>
                                        @include('icons.edit')
                                    </a></h6> --}}


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
</script>
@endpush
