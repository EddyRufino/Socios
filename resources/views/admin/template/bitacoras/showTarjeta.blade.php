@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="d-flex mt-2 align-items-center justify-content-between">
                <h2 class="mt-4 title-left pt-3 pb-2 font-weight-bold">
                    <a href="{{ route('bitacora.indexTarjeta', ['id'=>1]) }}">Bitácora</a>
                    @include('icons.arrow-right')  XD
                    {{-- {{ $tarjetas->first()->pluck('nombre_socio')->implode('') }} --}}
                </h2>
            </div>

            @if (auth()->user()->hasRoles(['superadmin']))
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nombres y Apellidos</th>
                                    <th scope="col">Propietario</th>
                                    <th scope="col">N. Doc</th>
                                    <th scope="col" nowrap>N. Placa</th>
                                    <th scope="col">Asociación</th>
                                    <th scope="col">Vehículo</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tarjetas as $tarjeta)
                                {{-- <tr>
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

                                    @if ($tarjeta->vehiculo_id == 1)
                                        <td class="text-info">{{ $tarjeta->vehiculo->nombre }}</td>
                                    @elseif($tarjeta->vehiculo_id === 2)
                                        <td class="text-primary">{{ $tarjeta->vehiculo->nombre }}</td>
                                    @else
                                        <td class="text-secondary">{{ $tarjeta->vehiculo->nombre }}</td>
                                    @endif

                                </tr> --}}
                                @empty
                                    <li class="list-group-item border-0 mb-3 shadow-sm">No hay nada para mostrar</li>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            @else
                <h2 class="text-secondary p-2">No Tienes permisos para ver esta vista</h2>
            @endif
        </div>
    </div>
</div>
@endsection
