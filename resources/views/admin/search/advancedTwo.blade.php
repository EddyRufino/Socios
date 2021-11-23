@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="text-dark font-weight-bold mb-4"><a href="{{ route('socios.index') }}" class="text-dark item text-decoration-none">Socios - "{{ $attributes[0] ? optional($attributes[0]->asociacione)->nombre : 'Sin Socios' }}"</a></h4>

    {{-- Search Advanced --}}
    <div id="searchAdvanced" class="d-flex justify-content-center" style="display: none !important;">
        @include('admin.search.advanced')
    </div>

    {{-- Search Basico --}}
    @include('partials.searchBasico', ['link' => 'search.tarjeta'])

    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-between align-items-center">
            {{-- {{dd(!request()->asociacione_id_two == "natural")}} --}}
{{--             @if ($attributes)
                <h6 class="text-dark ml-3 tooltipw">Fotochecks <strong>{{ $fotochecksCount }}</strong></h6>
                <h6 class="text-dark ml-3 tooltipw">Tarjetas <strong>{{ $tarjetasCount }}</strong></h6>
            @endif --}}
            {{-- {{dd($attributes[0]->tarjetas())}} --}}
            @if ($attributes->count() > 0)
                {{-- @if (optional($attributes[0]->tarjetas())->exists()) --}}
                    <h6 class="text-dark ml-3 tooltipw d-flex">
                        <span class="countTarjeta">Tarjetas</span>
                        <span id="iconFotocheck">@include('icons.tarjeta')</span>
                        <strong class="pl-1">{{ $tarjetasCount ? $tarjetasCount : $tarjetasCountNatural }}</strong>
                    </h6>
                {{-- @endif --}}

                {{-- {{dd($attributes[0]->fotochecks())}} --}}
                {{-- @if (optional($attributes[0]->fotochecks())->exists()) --}}
                    <h6 class="text-dark ml-3 tooltipw">
                        <span class="countFotocheck">Fotochecks</span>
                        <span id="iconTarjeta">@include('icons.fotocheck')</span>
                        <strong>{{  $fotochecksCount ? $fotochecksCount : $fotochecksCountNatural}}</strong>
                    </h6>
                {{-- @endif --}}
            @endif

{{--             @if ($attributes && !request()->asociacione_id_two == "natural") optional($attributes[0]->fotochecks())->count()
                <h6 class="text-dark ml-3 tooltipw">Fotochecks <strong>{{ $fotochecksCount }}</strong></h6>
                <h6 class="text-dark ml-3 tooltipw">Tarjetas <strong>{{ $tarjetasCount }}</strong></h6>
            @endif

            @if($attributes || (request()->asociacione_id_two === 'natural' && $attributes))
                <h6 class="text-dark ml-3 tooltipw">Fotochecks <strong>{{ $fotochecksCountNatural }}</strong></h6>
                <h6 class="text-dark ml-3 tooltipw">Tarjetas <strong>{{ $tarjetasCountNatural }}</strong></h6>
            @endif --}}
{{--             <h6><a href="{{ route('tarjetas.create') }}" class="text-dark ml-3 tooltipw">
                <span id="tooltipw" class="tooltiptext">Nueva Tarjeta Circulación</span>
                @include('icons.add')
            </a></h6>
            <h6><a href="{{ route('fotochecks.create') }}" class="text-dark ml-3 tooltipw">
                <span id="tooltipw" class="tooltiptext">Nuevo Fotocheck</span>
                @include('icons.new')
            </a></h6>
            <h6> --}}
            </h6>
        </div>

        @include('partials.checkbox')

    </div>

    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="bg-primary text-white">Socio</th>
                        <th scope="col" class="bg-primary text-white">Propietario</th>
                        <th scope="col" class="bg-primary text-white">DNI Socio</th>
                        <th scope="col" class="bg-primary text-white">Placa</th>
                        <th scope="col" class="bg-primary text-white">Vehículo</th>
                        <th scope="col" class="bg-primary text-white">Asociación</th>
                        <th scope="col" class="bg-primary text-white">Actividad</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attributes as $socio)
                        <tr>
                            <td>{{ $socio->nombre_socio }}</td>

                            @if ($socio->nombre_propietario)
                                <td>{{ $socio->nombre_propietario }}</td>
                            @else
                                <td class="text-secondary">El mismo socio</td>
                            @endif

                            <td>{{ $socio->dni_socio }}</td>
                            <td>{{ $socio->num_placa ? $socio->num_placa : '-' }}</td>

                            {{-- {{dd(optional($socio->tarjetas[0])->vehiculo_id)}} --}}
                            @if (isset($socio->tarjetas[0]->vehiculo_id))
                                <td>{{ optional($socio->tarjetas[0]->vehiculo)->nombre }}
                            @else
                                <td>-</td>
                            @endif
                            {{-- {{dd($socio->tarjetas[0]->vehiculo_id)}} --}}
                            {{-- @if (optional($socio->tarjetas[0])->vehiculo_id == 1) --}}
                                {{-- <td class="text-info">{{ optional($socio->tarjetas[0]->vehiculo)->nombre }}</td> --}}
                            {{-- @elseif(optional($socio->tarjetas[0])->vehiculo_id == 2) --}}
                                {{-- <td class="text-primary">{{ optional($socio->tarjetas[0]->vehiculo)->nombre }}</td> --}}
                            {{-- @else --}}
                                {{-- <td class="text-secondary">{{ optional($socio->tarjetas->vehiculo)->nombre }}</td> --}}
                            {{-- @endif --}}

                            @if (is_null($socio->asociacione_id))
                                <td class="text-secondary">Es Persona Natural</td>
                            @else
                                <td>{{ optional($socio->asociacione)->nombre }}</td>
                            @endif

                            <td>
                                <div class="d-flex">

                                    @if ($socio->tarjetas()->exists())
                                        <h6><a href="{{ route('tarjeta.anverso', $socio->tarjetas[0]->id) }}"
                                            class="ml-3 text-decoration-none tooltipw text-dark"
                                        >
                                            <span id="tooltipw" class="tooltiptext">Descargar Tarjeta Circulación</span>
                                            @include('icons.tarjeta')
                                        </a></h6>
                                    @endif

                                    @if ($socio->fotochecks()->exists())
                                        <h6><a href="{{ route('fotocheck.anverso', $socio->fotochecks[0]->id) }}"
                                            class="ml-3 text-decoration-none tooltipw text-info"
                                        >
                                            <span id="tooltipw" class="tooltiptext">Descargar Fotocheck</span>
                                            @include('icons.fotocheck')
                                        </a></h6>
                                    @endif
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
        {{-- {{ $attributes->links() }} --}}
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
