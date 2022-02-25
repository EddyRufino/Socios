@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="d-flex mt-2 align-items-center justify-content-between">
                <h2 class="mt-4 title-left pt-3 pb-2 font-weight-bold">
                    <a href="{{ route('bitacora.indexFotocheck') }}">Bitácora</a>
                    @include('icons.arrow-right')  {{ $nombre_socio[0]->nombre_socio }}
                </h2>
            </div>

            @if (auth()->user()->hasRoles(['superadmin']))
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
                                    <td nowrap><span class="text-secondary">El</span> {{ $fotocheck->created_at }} <span class="text-secondary">Por</span> {{ $fotocheck->getUser($fotocheck->user_modifico) }}</td>
                                    <td nowrap>{{ $fotocheck->getUser($fotocheck->user_id) }}</td>
                                    <td nowrap>{{ $fotocheck->nombre_socio }}</td>
        
                                    <td>{{ $fotocheck->dni_socio }}</td>

                                    @if (empty($fotocheck->asociacione_id) && $fotocheck->tipo_persona == 2)
                                        <td nowrap class="text-secondary">Persona Natural</td>
                                    @elseif (empty($fotocheck->asociacione_id) && $fotocheck->tipo_persona == 3)
                                        <td nowrap class="text-secondary">Persona Jurídica</td>
                                    @else
                                        <td nowrap>{{ $fotocheck->getAsociacion($fotocheck->asociacione_id) }}</td>
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
            @else
                <h2 class="text-secondary p-2">No Tienes permisos para ver esta vista</h2>
            @endif
        </div>
    </div>
</div>
@endsection

