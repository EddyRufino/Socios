@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="text-dark font-weight-bold mb-4"><a href="{{ route('tarjetas.index') }}" class="text-dark item text-decoration-none">Socios - Tarjetas Circulación</a></h4>


    {{-- Search Basico --}}
    @include('partials.searchBasico', ['link' => 'search.tarjeta'])

    {{-- Search Advanced --}}
    <div id="searchAdvanced" class="d-flex justify-content-center" style="display: none !important;">
        @include('admin.search.advanced')
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-between align-items-center">
            <h6><a href="{{ route('fotochecks.index') }}" class="text-dark ml-3 tooltipw">
                <span id="tooltipw" class="tooltiptext">Listar Fotochecks</span>
                @include('icons.fotocheck')
            </a></h6>
            <h6><a href="{{ route('tarjetas.create') }}" class="text-dark ml-3 tooltipw">
                <span id="tooltipw" class="tooltiptext">Nueva Tarjeta Circulación</span>
                @include('icons.add')
            </a></h6>
            <h6><a href="{{ route('fotochecks.create') }}" class="text-dark ml-3 tooltipw">
                <span id="tooltipw" class="tooltiptext">Nuevo Fotocheck</span>
                @include('icons.new')
            </a></h6>
        </div>

        @include('partials.checkbox')

    </div>

    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="bg-primary text-white">Nombres y Apellidos</th>
                        <th scope="col" class="bg-primary text-white">Propietario</th>
                        <th scope="col" class="bg-primary text-white">dni, ruc, carnet</th>
                        <th scope="col" class="bg-primary text-white">N. Placa</th>
                        <th scope="col" class="bg-primary text-white">Asociación</th>
                        <th scope="col" class="bg-primary text-white">Vehículo</th>
                        <th scope="col" class="bg-primary text-white">Actividad</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tarjetas as $tarjeta)
                        <tr>
                            <td>{{ $tarjeta->socio->nombre_socio }}</td>

                            @if ($tarjeta->socio->nombre_propietario)
                                <td>{{ $tarjeta->socio->nombre_propietario }}</td>
                            @else
                                <td class="text-secondary">NO TIENE</td>
                            @endif

                            <td>{{ $tarjeta->socio->dni_socio }}</td>
                            <td>{{ $tarjeta->num_placa }}</td>

                            @if (empty($tarjeta->socio->asociacione_id)  && $tarjeta->socio->tipo_documento_id == 3)
                                <td class="text-secondary">Entidad Privada</td>
                            @elseif (empty($tarjeta->socio->asociacione_id))
                                <td class="text-secondary">Persona Natural</td>
                            @else
                                <td>{{ optional($tarjeta->socio->asociacione)->nombre }}</td>
                            @endif
                            {{-- {{dd($tarjeta)}} --}}
                            @if ($tarjeta->vehiculo_id == 1)
                                <td class="text-info">{{ $tarjeta->vehiculo->nombre }}</td>
                            @elseif($tarjeta->vehiculo_id === 2)
                                <td class="text-primary">{{ $tarjeta->vehiculo->nombre }}</td>
                            @else
                                <td class="text-secondary">{{ $tarjeta->vehiculo->nombre }}</td>
                            @endif

                            <td>
                                <div class="d-flex">
                                    <h6><a href="{{ route('tarjetas.show', $tarjeta->url) }}"
                                        class="text-decoration-none tooltipw"
                                        target="_blank"
                                    >
                                        <span id="tooltipw" class="tooltiptext">Ver QR</span>
                                        @include('icons.qr')
                                    </a></h6>

                                    @canPrint
                                        <h6><a href="{{ route('tarjeta.anverso', $tarjeta->id) }}"
                                            class="ml-3 text-decoration-none tooltipw"
                                            target="_blank"
                                        >
                                            <span id="tooltipw" class="tooltiptext">Imprimir Carnet</span>
                                            @include('icons.download')
                                        </a></h6>
                                    @endcanPrint

                                    @canUpdate
                                        <h6><a href="{{ route('tarjetas.edit', $tarjeta) }}"
                                            class="ml-3 text-decoration-none tooltipw"
                                        >
                                            <span id="tooltipw" class="tooltiptext">Editar</span>
                                            @include('icons.edit')
                                        </a></h6>
                                    @endcanUpdate

                                    @canDelete
                                        <h6 class="tooltipw mb-2">
                                            <form action="{{ route('tarjetas.destroy', $tarjeta) }}" method="POST"
                                                style="display: inline-block;"
                                                onclick="return confirm('¿Segur@ de querer eliminar?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <span id="tooltipw" class="tooltiptext">Eliminar</span>
                                                <button class="p-0 ml-2 btn btn-transparent ">@include('icons.delete')</button>
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
        {{ $tarjetas->links() }}
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
