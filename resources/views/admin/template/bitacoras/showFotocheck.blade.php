@extends('admin.layout')

@section('content')
@if (auth()->user()->hasRoles(['superadmin', 'bitacora']))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="d-flex mt-2 align-items-center justify-content-between">
                    <h2 class="mt-4 title-left pt-3 pb-2 font-weight-bold">
                        <a href="{{ route('bitacora.indexFotocheck') }}">Bitácora</a>
                        @include('icons.arrow-right')  {{ $nombre_socio[0]->nombre_socio }}
                    </h2>
                </div>

                
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Modificado</th>
                                    <th>Registrado</th>
                                    <th>Socio</th>
                                    <th>N. Doc</th>
                                    <th>Asociación</th>
                                    <th>Vehículo</th>
                                    <th>Expedición</th>
                                    <th>Revalidación</th>
                                    <th>N. Autori</th>
                                    <th>Impreso</th>
                                    <th>Fecha Impreso</th>
                                    <th>Renovado</th>
                                    {{-- <th></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($fotochecks as $fotocheck)
                                <tr>
                                    <td nowrap>
                                        <span class="{{ isset($fotocheck->created_at) ? 'text-primary' : (isset($fotocheck->updated_at) ? 'text-warning' : 'text-danger') }}">
                                            {{ isset($fotocheck->created_at) ? 'Creado ' . $fotocheck->created_at : (isset($fotocheck->updated_at) ? 'Editado ' . $fotocheck->updated_at . ' -' : 'Eliminado ' . $fotocheck->deleted_at . ' -') }}
                                        </span> 
                                        <span class="text-secondary"></span> {{ $fotocheck->getUser($fotocheck->user_modifico) }}
                                    </td>

                                    <td nowrap>{{ $fotocheck->getUser($fotocheck->user_id) }}</td>
                                    
                                    <td nowrap>{{ isset($fotocheck->nombre_socio) ? $fotocheck->nombre_socio : $fotocheck->getNombreSocioDelete($fotocheck->socio_id) }}</td>
        
                                    <td>{{ isset($fotocheck->dni_socio) ? $fotocheck->dni_socio : $fotocheck->getDniDelete($fotocheck->socio_id) }}</td>

                                    @if (isset($fotocheck->created_at))

                                        @if (empty($fotocheck->asociacione_id) && $fotocheck->tipo_persona == 2) 
                                            <td nowrap class="text-secondary">Persona Natural</td>
                                        @elseif (empty($fotocheck->asociacione_id) && $fotocheck->tipo_persona == 3)
                                            <td nowrap class="text-secondary">Persona Jurídica</td>
                                        @else
                                            <td nowrap>{{ $fotocheck->getAsociacion($fotocheck->asociacione_id) }}</td>
                                        @endif

                                    @else
                                        <td nowrap>{{ $fotocheck->getAsociacionDelete($fotocheck->socio_id) }}</td>
                                    @endif

                                    <td nowrap>{{ $fotocheck->getVehiculo($fotocheck->vehiculo_id) }}</td>
                                    <td>{{ $fotocheck->expedicion }}</td>
                                    <td>{{ $fotocheck->revalidacion }}</td>
                                    <td nowrap>{{ $fotocheck->num_autorizacion }}</td>

                                    @if ($fotocheck->status)
                                        <td>Impreso</td>
                                    @else
                                        <td nowrap>No Impreso</td>
                                    @endif

                                    <th>{{ $fotocheck->fecha_print }}</th>
                                    <th>{{ $fotocheck->renovado }}</th>

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

