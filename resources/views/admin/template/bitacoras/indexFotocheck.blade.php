@extends('admin.layout')

@section('content')
@if (auth()->user()->hasRoles(['superadmin', 'bitacora']))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="d-flex mt-2 align-items-center justify-content-between">
                    <h2 class="mt-4 title-left pt-3 pb-2 font-weight-bold">Bitácora Fotochecks</h2>
                </div>

                <div class="d-flex justify-content-between align-items-center">

            
                </div>

                
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nombres y Apellidos</th>
                                    <th scope="col">N. Doc</th>
                                    <th scope="col">Asociación</th>
                                    <th scope="col">Vehículo</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bitacoras as $fotocheck)
                                <tr>
                                    <td>{{ $fotocheck->socio->nombre_socio }}</td>
        
                                    <td>{{ $fotocheck->socio->dni_socio }}</td>
        
                                    @if ($fotocheck->socio->tipo_persona == 3)
                                        <td class="text-secondary">Entidad Privada</td>
                                    @elseif ($fotocheck->socio->tipo_persona == 2)
                                        <td class="text-secondary">Persona Natural</td>
                                    @else
                                        <td>{{ optional($fotocheck->socio->asociacione)->nombre }}</td>
                                    @endif

                                    @if ($fotocheck->vehiculo_id == 1)
                                        <td class="text-info">{{ $fotocheck->vehiculo->nombre }}</td>
                                    @elseif($fotocheck->vehiculo_id === 2)
                                        <td class="text-primary">{{ $fotocheck->vehiculo->nombre }}</td>
                                    @else
                                        <td class="text-secondary">{{ $fotocheck->vehiculo->nombre }}</td>
                                    @endif

                                    <td>
                                        <a class="tooltipw" href="{{ route('bitacora.showFotocheck', $fotocheck->id) }}">
                                            <span id="tooltipw" class="tooltiptext">Ver más</span>
                                            @include('icons.arrow-right')
                                        </a>
                                    </td>
        
                                </tr>
                                @empty
                                    <li class="list-group-item border-0 mb-3 shadow-sm">No hay nada para mostrar</li>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="overflow-auto mt-2">
                            {{ $bitacoras->links() }}
                        </div>
                    </div>
                </div>

        </div>
        </div>
    </div>
@else
    <h2 class="text-secondary p-2">No Tienes permisos para ver esta vista</h2>
@endif
@endsection
