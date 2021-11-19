@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="text-dark font-weight-bold mb-4"><a href="{{ route('tarjetas.index') }}" class="text-dark item text-decoration-none">Socios - Tarjetas Circulación</a></h4>

    {{-- Search Advanced --}}
    <div id="searchAdvanced" class="d-flex justify-content-center" style="display: none !important;">
        @include('admin.search.advanced')
    </div>

    {{-- Search Basico --}}
    @include('partials.searchBasico', ['link' => 'search.tarjeta'])

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
                        <th scope="col" class="bg-primary text-white">Nombre Socio</th>
                        <th scope="col" class="bg-primary text-white">Propietario</th>
                        <th scope="col" class="bg-primary text-white">DNI Socio</th>
                        <th scope="col" class="bg-primary text-white">N. Placa</th>
                        <th scope="col" class="bg-primary text-white">Asociación</th>
                        <th scope="col" class="bg-primary text-white">Vehículo</th>
                        <th scope="col" class="bg-primary text-white">Actividad</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tarjetas as $tarjeta)
                        <tr>
                            <td>{{ $tarjeta->nombre_socio }}</td>
                            @if ($tarjeta->nombre_propietario)
                                <td>{{ $tarjeta->nombre_propietario }}</td>
                            @else
                                <td class="text-secondary">El Mismo Socio</td>
                            @endif
                            <td>{{ $tarjeta->dni_socio }}</td>
                            <td>{{ $tarjeta->num_placa }}</td>

                            @if ($tarjeta->asociacione->id == 1)
                                <td class="text-secondary">Es Persona Natural</td>
                            @else
                                <td>{{ optional($tarjeta->asociacione)->nombre }}</td>
                            @endif

                            @if ($tarjeta->vehiculo_id === 1)
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
                                    >
                                        <span id="tooltipw" class="tooltiptext">Ver QR</span>
                                        @include('icons.qr')
                                    </a></h6>
                                    <h6><a href="{{ route('tarjeta.anverso', $tarjeta->id) }}"
                                        class="ml-3 text-decoration-none tooltipw"
                                    >
                                        <span id="tooltipw" class="tooltiptext">Descargar Carnet</span>
                                        @include('icons.download')
                                    </a></h6>

                                    <h6><a href="{{ route('tarjetas.edit', $tarjeta) }}"
                                        class="ml-3 text-decoration-none tooltipw"
                                    >
                                        <span id="tooltipw" class="tooltiptext">Editar</span>
                                        @include('icons.edit')
                                    </a></h6>

                                    @superAdmin
                                        <h6 class="tooltipw mb-2">
                                            <form action="{{ route('tarjetas.destroy', $tarjeta) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')

                                                <span id="tooltipw" class="tooltiptext">Eliminar</span>
                                                <button class="p-0 ml-2 btn btn-transparent ">@include('icons.delete')</button>
                                            </form>
                                        </h6>
                                    @endsuperAdmin
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
