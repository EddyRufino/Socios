@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="text-dark font-weight-bold mb-4"><a href="{{ route('tarjetas.index') }}" class="text-dark item text-decoration-none">Socios - "{{ $attributes[0]->nombre }}"</a></h4>

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
            <h6>
                @php
                    $count = 0;
                @endphp
                @foreach ($attributes[0]->tarjetas as $element)
                    {{-- {{dd($element)}} --}}
                        @php
                            $count = $count + 1;
                        @endphp
                    @if ($element->vehiculo_id == 2)
                        {{-- <a href="#">{{ $element }}</a> --}}
                        {{-- @foreach($attributes[0]->tarjetas[0]->vehiculo_id == 2)
                            <a href="#">{{ $count + 1 }}</a>
                            {{dd($element)}}
                        @endforeach --}}
                        {{dd($count)}}
                    @endif
                @endforeach
                {{-- {{dd($attributes[0]->tarjetas[0]->vehiculo_id)}} --}}
            </h6>
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
                        {{-- <th scope="col" class="bg-primary text-white">Asociación</th> --}}
                        <th scope="col" class="bg-primary text-white">Vehículo</th>
                        <th scope="col" class="bg-primary text-white">Tipo</th>
                        {{-- <th scope="col" class="bg-primary text-white">Actividad</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if ($attributes)
                    {{-- {{dd($attributes[0]->fotochecks)}} --}}
                        {{-- <tr> --}}
                            @foreach($attributes[0]->fotochecks as $attribute)
                                <tr>
                                    <td>{{ $attribute->nombre_socio }}</td>

                                    @if ($attribute->nombre_propietario)
                                        <td>{{ $attribute->nombre_propietario }}</td>
                                    @else
                                        <td class="text-secondary">El Mismo Socio</td>
                                    @endif

                                    <td>{{ $attribute->dni_socio }}</td>
                                    <td class="text-secondary"> - </td>

{{--                                     @if ($attribute->asociacione_id == 1)
                                        <td class="text-secondary">Es Persona Natural</td>
                                    @else
                                        <td>{{ optional($attribute->asociacione)->nombre }}</td>
                                    @endif --}}


                                    @if ($attribute->vehiculo_id === 1)
                                        <td class="text-info">Moto Taxy</td>
                                    @elseif($attribute->vehiculo_id === 2)
                                        <td class="text-primary">Moto Furgón</td>
                                    @else
                                        <td class="text-secondary">Triciclo</td>
                                    @endif


                                    <td style="color: #8B5CF6">Fotocheck</td>

                                    {{-- <td></td> --}}
                                </tr>
                            @endforeach

                            @foreach($attributes[0]->tarjetas as $attribute)
                                <tr>
                                    <td>{{ $attribute->nombre_socio }}</td>
                                    @if ($attribute->nombre_propietario)
                                        <td>{{ $attribute->nombre_propietario }}</td>
                                    @else
                                        <td class="text-secondary">El Mismo Socio</td>
                                    @endif

                                    <td>{{ $attribute->dni_socio }}</td>
                                    <td>{{ $attribute->num_placa }}</td>

{{--                                     @if ($attribute->asociacione_id == 1)
                                        <td class="text-secondary">Es Persona Natural</td>
                                    @else
                                        <td>{{ optional($attribute->asociacione)->nombre }}</td>
                                    @endif --}}


                                    @if ($attribute->vehiculo_id === 1)
                                        <td class="text-info">Moto Taxy</td>
                                    @elseif($attribute->vehiculo_id === 2)
                                        <td class="text-primary">Moto Furgón</td>
                                    @else
                                        <td class="text-secondary">Triciclo</td>
                                    @endif

                                    <td style="color: #EC4899">Tarjeta Circulación</td>
                                    {{-- <td></td> --}}
                                </tr>
                            @endforeach

                    @endif
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
