@extends('admin.layout')

@section('content')
@if (auth()->user()->hasRoles(['superadmin', 'reporte']))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="d-flex mt-2 align-items-center justify-content-between">
                <h2 class="mt-4 title-left pt-3 pb-3 font-weight-bold">Socios Eliminados</h2>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">

                    <h6><a href="{{ route('socios.delete.pdf') }}" class="text-dark ml-3 tooltipw" target="_blank">
                        <span id="tooltipw" class="tooltiptext">Descargar</span>
                        @include('icons.pdf')
                    </a></h6>

                </div>
        
            </div>

            
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nombre y Apellido</th>
                                <th scope="col">N. Doc.</th>
                                <th scope="col">Placa</th>
                                <th scope="col">Asociación</th>
                                <th scope="col">Vehículo</th>
                                <th scope="col">Eliminado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($socios as $socio)
                                <tr>
                                    <td>{{ $socio->nombre_socio }}</td>
                                    <td>{{ $socio->dni_socio }}</td>
                                    <td>{{ $socio->num_placa }}</td>
        
                                    @if (empty($socio->asociacione_id)  && $socio->tipo_documento_id == 3)
                                        <td class="text-secondary">Entidad Privada</td>
                                    @elseif (empty($socio->asociacione_id))
                                        <td class="text-secondary">Persona Natural</td>
                                    @else
                                        <td>{{ optional($socio->asociacione)->nombre }}</td>
                                    @endif
        
                                    @if ($socio->vehiculo_id == 1)
                                        <td class="text-info">{{ $socio->vehiculo->nombre }}</td>
                                    @elseif($socio->vehiculo_id === 2)
                                        <td class="text-primary">{{ $socio->vehiculo->nombre }}</td>
                                    @else
                                        <td class="text-secondary">{{ $socio->vehiculo->nombre }}</td>
                                    @endif

                                    <td>{{ \Carbon\Carbon::parse($socio->deleted_at)->format('Y-m-d') }}</td>
        
                                </tr>
                            @empty
                                <li class="list-group-item border-0 mb-3 shadow-sm">No hay nada para mostrar</li>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="overflow-auto mt-2">
                        {{ $socios->links() }}
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
