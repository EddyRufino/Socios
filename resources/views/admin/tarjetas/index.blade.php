@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="text-dark font-weight-bold">Socios - Tarjetas Circulación</h4>

    <h2 id="dds"></h2>
    <div class="d-flex justify-content-center">
        <div id="search" class="mb-4" style="display: none;">
            <form action="{{ route('search.tarjeta') }}" class="form-inline">
                @csrf
                <div class="input-group input-group-md">

                    <input class="form-control form-control-navbar"
                        name="search" type="search"
                        placeholder="Socio - DNI - Placa"
                        aria-label="Search"
                        required
                    >

                    <div class="input-group-append">
                        <button class="btn btn-navbar bg-primary text-white" type="submit">
                            @include('icons.icon-search')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-between align-items-center">
{{--             <h6><a href="{{ route('tarjetas.index') }}" class="text-dark ml-3 tooltipw">
                <span id="tooltipw" class="tooltiptext">Listar Tarjetas</span>
                @include('icons.tarjeta')
            </a></h6> --}}
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
        <div class="custom-control custom-checkbox ">
            <input type="checkbox" class="custom-control-input" id="myCheck" onclick="myFunction()">
            <label class="custom-control-label text-dark" for="myCheck">Mostrar Buscador</label>
        </div>

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
                                <td>El Mismo Socio</td>
                            @endif
                            <td>{{ $tarjeta->dni_socio }}</td>
                            <td>{{ $tarjeta->num_placa }}</td>
                            <td>{{ optional($tarjeta->asociacione)->nombre ? optional($tarjeta->asociacione)->nombre : 'Persona Natural' }}</td>

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
            // juridica.style.display = "none";
        } else {
            search.style.display = "none";
            // juridica.style.display = "block";
        }
    }
</script>
@endpush
