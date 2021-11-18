@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="text-dark font-weight-bold"><a href="{{ route('fotochecks.index') }}" class="text-dark font-weight-bold">Socios - Fotochecks</a></h4>

    <h2 id="dds"></h2>
    <div class="d-flex justify-content-center">
        <div id="search" class="mb-4" style="display: none;">

            <form action="{{ route('search.fotocheck') }}" class="form-inline">
                @csrf
                <div class="input-group input-group-md">

                    <input class="form-control form-control-navbar"
                        name="search" type="search"
                        placeholder="Socio - DNI"
                        aria-label="Search"
                        value="{{ request()->search }}"
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
            <h6><a href="{{ route('tarjetas.index') }}" class="text-dark ml-3 tooltipw">
                <span id="tooltipw" class="tooltiptext">Listar Tarjetas</span>
                @include('icons.tarjeta')
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
                        <th scope="col" class="bg-primary text-white">DNI Socio</th>
                        <th scope="col" class="bg-primary text-white">Asociación</th>
                        <th scope="col" class="bg-primary text-white">Vehículo</th>
                        <th scope="col" class="bg-primary text-white">QR</th>
                        <th scope="col" class="bg-primary text-white">Actividad</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($fotochecks as $fotocheck)
                        <tr>
                            <td>{{ $fotocheck->nombre_socio }}</td>
                            <td>{{ $fotocheck->dni_socio }}</td>
                            <td>{{ optional($fotocheck->asociacione)->nombre ? optional($fotocheck->asociacione)->nombre : 'Persona Natural' }}</td>

                            @if ($fotocheck->vehiculo_id === 1)
                                <td class="text-info">{{ $fotocheck->vehiculo->nombre }}</td>
                            @elseif($fotocheck->vehiculo_id === 2)
                                <td class="text-primary">{{ $fotocheck->vehiculo->nombre }}</td>
                            @else
                                <td class="text-secondary">{{ $fotocheck->vehiculo->nombre }}</td>
                            @endif

                            @if ($fotocheck->status == 1)
                                <td><span class="badge badge-info text-white">Generado</span></td>
                            @else
                                <td></td>
                            @endif

                            <td>
                                <div class="d-flex">
                                    <h6><a href="{{ route('fotochecks.show', $fotocheck->url) }}"
                                        class="text-decoration-none tooltipw"
                                    >
                                        <span id="tooltipw" class="tooltiptext">Ver QR</span>
                                        @include('icons.qr')
                                    </a></h6>
                                    {{-- {{ route('fotocheck.anverso', $fotocheck->id) }} --}}
                                    <h6><a href=""
                                        class="ml-3 text-decoration-none tooltipw"
                                    >
                                        <span id="tooltipw" class="tooltiptext">Descargar Carnet</span>
                                        @include('icons.download')
                                    </a></h6>

                                    <h6><a href="{{ route('fotochecks.edit', $fotocheck) }}"
                                        class="ml-3 text-decoration-none tooltipw"
                                    >
                                        <span id="tooltipw" class="tooltiptext">Editar</span>
                                        @include('icons.edit')
                                    </a></h6>

                                    {{-- <form id="myform" method="POST" action="{{ route('fotochecks.destroy', $fotocheck) }}" style="display: inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-xs btn-transparent "
                                            onclick="return confirm('¿Seguro de querer eliminar este socio?')"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Eliminar Socio"
                                        >
                                            @include('icons.delete')
                                        </button>
                                    </form> --}}
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
        {{ $fotochecks->links() }}
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



