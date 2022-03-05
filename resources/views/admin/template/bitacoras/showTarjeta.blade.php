@extends('admin.layout')

@section('content')
@if (auth()->user()->hasRoles(['superadmin', 'bitacora']))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="d-flex mt-2 align-items-center justify-content-between">
                    <h2 class="mt-4 title-left pt-3 pb-2 font-weight-bold">
                        <a href="{{ route('bitacora.indexTarjeta', ['id'=>1]) }}">Bitácora</a>
                        @include('icons.arrow-right')  {{ $nombre_socio[0]->nombre_socio }}
                        
                    </h2>
                </div>

                
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Actividad</th>
                                    <th>Registrado</th>
                                    <th>Socio</th>
                                    <th>Propietario</th>
                                    <th>N. Doc</th>
                                    <th nowrap>N. Placa</th>
                                    <th>Asociación</th>
                                    <th>Vehículo</th>
                                    <th>Expedición</th>
                                    <th>Revalidación</th>
                                    <th>N. Opera</th>
                                    <th>V. Opera</th>
                                    <th>N. Autori</th>
                                    <th>V. Autori</th>
                                    <th>Impreso</th>
                                    <th>Fecha Impreso</th>
                                    <th>Renovado</th>
                                    {{-- <th></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tarjetas as $tarjeta)
                                <tr>
                                    <td nowrap>
                                        <span class="{{ isset($tarjeta->created_at) ? 'text-primary' : (isset($tarjeta->updated_at) ? 'text-warning' : 'text-danger') }}">
                                            {{ isset($tarjeta->created_at) ? 'Creado ' . $tarjeta->created_at : (isset($tarjeta->updated_at) ? 'Editado ' . $tarjeta->updated_at . ' -' : 'Eliminado ' . $tarjeta->deleted_at . ' -') }}
                                        </span> 
                                        <span class="text-secondary"></span> {{ $tarjeta->getUser($tarjeta->user_modifico) }}
                                    </td>

                                    <td nowrap>{{ $tarjeta->getUser($tarjeta->user_id) }}</td>

                                    <td nowrap>{{ isset($tarjeta->nombre_socio) ? $tarjeta->nombre_socio : $tarjeta->getNombreSocioDelete($tarjeta->socio_id) }}</td>
                                    
                                     @if (isset($tarjeta->created_at))
                                        <td nowrap>{{ $tarjeta->nombre_propietario }}</td>
                                    @else
                                        <td nowrap class="text-secondary">{{ $tarjeta->getPropietarioDelete($tarjeta->socio_id) }}</td>
                                    @endif
        
                                    <td>{{ isset($tarjeta->dni_socio) ? $tarjeta->dni_socio : $tarjeta->getDniDelete($tarjeta->socio_id) }}</td>
                                    
                                    <td nowrap>{{ $tarjeta->num_placa }}</td>

                                    @if (isset($tarjeta->created_at))

                                        @if (empty($tarjeta->asociacione_id) && $tarjeta->tipo_persona == 2) 
                                            <td nowrap class="text-secondary">Persona Natural</td>
                                        @elseif (empty($tarjeta->asociacione_id) && $tarjeta->tipo_persona == 3)
                                            <td nowrap class="text-secondary">Persona Jurídica</td>
                                        @else
                                            <td nowrap>{{ $tarjeta->getAsociacion($tarjeta->asociacione_id) }}</td>
                                        @endif

                                    @else
                                        <td nowrap>{{ $tarjeta->getAsociacionDelete($tarjeta->socio_id) }}</td>
                                    @endif



                                    <td nowrap>{{ $tarjeta->getVehiculo($tarjeta->vehiculo_id) }}</td>
                                    <td>{{ $tarjeta->expedicion }}</td>
                                    <td>{{ $tarjeta->revalidacion }}</td>
                                    <td nowrap>{{ $tarjeta->num_operacion }}</td>
                                    <td nowrap>{{ $tarjeta->vigencia_operacion }}</td>
                                    <td nowrap>{{ $tarjeta->num_autorizacion }}</td>
                                    <td nowrap>{{ $tarjeta->vigencia_autorizacion }}</td>

                                    @if ($tarjeta->status)
                                        <td>Impreso</td>
                                    @else
                                        <td nowrap>No Impreso</td>
                                    @endif

                                    <th>{{ $tarjeta->fecha_print }}</th>
                                    <th>{{ $tarjeta->renovado }}</th>

                                </tr>
                                @empty
                                    <li class="list-group-item border-0 mb-3 shadow-sm">No hay nada para mostrar</li>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
@else
    <h2 class="text-secondary p-2">No Tienes permisos para ver esta vista</h2>
@endif
@endsection

