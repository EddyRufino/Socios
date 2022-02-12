@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="d-flex mt-2 align-items-center justify-content-between">
                <h2 class="mt-4 title-left pt-3 pb-3 font-weight-bold">Fotochecks Eliminados</h2>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">

                    <h6><a href="{{ route('fotochecks.delete.pdf') }}" class="text-dark ml-3 tooltipw" target="_blank">
                        <span id="tooltipw" class="tooltiptext">Descargar</span>
                        @include('icons.pdf')
                    </a></h6>

                </div>
        
            </div>

            @if (auth()->user()->hasRoles(['superadmin']))
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">SOCIO</th>
                                    <th scope="col">N° DOC.</th>
                                    <th scope="col">N° AUTORIZ.</th>
                                    <th scope="col">VEHIVULO</th>
                                    <th scope="col">ASOCIACION</th>
                                    <th scope="col">ELIMINADO</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fotochecks as $fotocheck)
                                    <tr>
                                        <td>{{ optional($fotocheck->socio)->nombre_socio }}</td>
                    
                                        <td>{{ optional($fotocheck->socio)->dni_socio }}</td>
                                        <td>{{ $fotocheck->num_autorizacion }}</td>
                    
                                        @if ($fotocheck->vehiculo_id == 1)
                                            <td class="text-info">{{ optional($fotocheck->vehiculo)->nombre }}</td>
                                        @elseif($fotocheck->vehiculo_id === 2)
                                            <td class="text-primary">{{ optional($fotocheck->vehiculo)->nombre }}</td>
                                        @else
                                            <td class="text-secondary">{{ optional($fotocheck->vehiculo)->nombre }}</td>
                                        @endif
                    
                                        @if (empty(optional($fotocheck->socio)->asociacione_id)  && optional($fotocheck->socio)->tipo_documento_id == 3)
                                            <td>Entidad Privada</td>
                                        @elseif (empty(optional($fotocheck->socio)->asociacione_id))
                                            <td>Persona Natural</td>
                                        @else
                                            <td>{{ optional(optional($fotocheck->socio)->asociacione)->nombre }}</td>
                                        @endif

                                        <td>{{ \Carbon\Carbon::parse($fotocheck->deleted_at)->format('Y-m-d') }}</td>
                    
                                        @if ($fotocheck->status == 1)
                                            <td><img src="{{ asset('img/printer.png') }}" alt="Impreso"></td>
                                        @else
                                            <td></td>
                                        @endif
                    
                                    </tr>
                    
                                @endforeach
                    
                            </tbody>
                        </table>

                        <div class="overflow-auto mt-2">
                            {{ $fotochecks->links() }}
                        </div>
                    </div>
                </div>
            @else
                <h2 class="text-secondary p-2">No Tienes permisos para ver esta vista</h2>
            @endif
    </div>
    </div>
</div>
@endsection
