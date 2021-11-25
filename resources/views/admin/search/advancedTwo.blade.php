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
            @if ($attributes->count() > 0)

                @if (is_numeric(request()->asociacione_id_two))

                    <h6 class="text-dark ml-2 tooltipw d-flex">
                        <span class="countTarjeta mr-1">Tarjetas</span>
                        <span id="iconFotocheck">@include('icons.tarjeta')</span>
                        <strong class="mr-3">{{$tarjetasCount->count()}}</strong>

                        <span class="countTarjeta">Fotochecks</span>
                        <span id="iconFotocheck">@include('icons.fotocheck')</span>
                        <strong class="ml-1">{{$fotochecksCount->count()}}</strong>
                        {{-- <strong class="pl-1">{{ $tarjetasCount->count() ? $tarjetasCount->count().'con' : $tarjetasCountNatural->count().'sin' }}</strong> --}}
                    </h6>

                @endif

                @if (request()->asociacione_id_two == 'natural')

                    <h6 class="text-dark ml-2 tooltipw">
                    <span class="countTarjeta mr-1">Tarjetas</span>
                    <span id="iconFotocheck">@include('icons.tarjeta')</span>
                    <strong class="mr-3">{{$tarjetasCountNatural->count()}}</strong>

                    <span class="countTarjeta">Fotochecks</span>
                    <span id="iconFotocheck">@include('icons.fotocheck')</span>
                    <strong class="ml-1">{{$fotochecksCountNatural->count()}}</strong>
                        {{-- <strong>{{  $tarjetasCount->count() ? $fotochecksCount->count().'con' : $fotochecksCountNatural->count().'sin' }}</strong> --}}
                    </h6>

                @endif

            @endif

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
                            @if ($socio->vehiculo_id == 1)
                                <td class="text-info">{{ $socio->vehiculo->nombre }}</td>
                            @elseif($socio->vehiculo_id === 2)
                                <td class="text-primary">{{ $socio->vehiculo->nombre }}</td>
                            @else
                                <td class="text-secondary">{{ $socio->vehiculo->nombre }}</td>
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
                                            target="_blank"
                                        >
                                            <span id="tooltipw" class="tooltiptext">Descargar Tarjeta Circulación</span>
                                            @include('icons.tarjeta')
                                        </a></h6>
                                    @endif

                                    @if ($socio->fotochecks()->exists())
                                        <h6><a href="{{ route('fotocheck.anverso', $socio->fotochecks[0]->id) }}"
                                            class="ml-3 text-decoration-none tooltipw text-info"
                                            target="_blank"
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
