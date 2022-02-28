@extends('layouts.app')

@section('content')
<div class="container">

    <h4 class="text-dark font-weight-bold mb-4"><a href="{{ route('fotochecks.index') }}" class="text-dark item text-decoration-none">Socios - Fotochecks</a></h4>

    {{-- Search Basico --}}
    @include('partials.searchBasico', ['link' => 'search.fotocheck'])

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
                        <th scope="col" class="bg-primary text-white">dni, ruc, carnet</th>
                        <th scope="col" class="bg-primary text-white">Asociación</th>
                        <th scope="col" class="bg-primary text-white">Vehículo</th>
                        <th scope="col" class="bg-primary text-white">Actividad</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($fotochecks as $fotocheck)
                        <tr>
                            <td>{{ optional($fotocheck->socio)->nombre_socio }}</td>
                            <td>{{ optional($fotocheck->socio)->dni_socio }}</td>

                            @if ($fotocheck->socio->tipo_persona == 3)
                                <td class="text-secondary">Entidad Privada</td>
                            @elseif ($fotocheck->socio->tipo_persona == 2)
                                <td class="text-secondary">Persona Natural</td>
                            @else
                                <td>{{ optional(optional($fotocheck->socio)->asociacione)->nombre }}</td>
                            @endif

                            @if ($fotocheck->vehiculo_id == 1)
                                <td class="text-info">{{ $fotocheck->vehiculo->nombre }}</td>
                            @elseif($fotocheck->vehiculo_id === 2)
                                <td class="text-primary">{{ $fotocheck->vehiculo->nombre }}</td>
                            @else
                                <td class="text-secondary">{{ $fotocheck->vehiculo->nombre }}</td>
                            @endif

                            <td>
                                <div class="d-flex">
                                    <h6><a href="{{ route('fotochecks.show', $fotocheck->url) }}"
                                        class="text-decoration-none tooltipw"
                                        target="_blank"
                                    >
                                        <span id="tooltipw" class="tooltiptext">Ver QR</span>
                                        @include('icons.qr')
                                    </a></h6>
                                    
                                    @canPrint
                                        
                                        <h6><a href="{{ route('fotocheck.anverso', $fotocheck->id)}}"
                                            class="ml-3 text-decoration-none tooltipw"
                                            target="_blank"
                                        >
                                            <span id="tooltipw" class="tooltiptext">Imprimir Fotocheck</span>
                                            @include('icons.download')
                                        </a></h6>
                                        
                                    @endcanPrint

                                    @canUpdate
                                        <h6><a href="{{ route('fotochecks.edit', $fotocheck) }}"
                                            class="ml-3 text-decoration-none tooltipw"
                                        >
                                            <span id="tooltipw" class="tooltiptext">Editar</span>
                                            @include('icons.edit')
                                        </a></h6>
                                    @endcanUpdate

                                    {{-- @superAdmin --}}
                                    @canDelete
                                        <h6 class="tooltipw mb-2">
                                            <form action="{{ route('fotochecks.destroy', $fotocheck) }}" method="POST"
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
                                    {{-- @endsuperAdmin --}}
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



