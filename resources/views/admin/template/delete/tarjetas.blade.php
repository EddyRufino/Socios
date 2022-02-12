@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="d-flex mt-2 align-items-center justify-content-between">
                <h2 class="mt-4 title-left pt-3 pb-3 font-weight-bold">Tarjetas Eliminadas</h2>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">

                    <h6><a href="{{ route('tarjetas.delete.pdf') }}" class="text-dark ml-3 tooltipw" target="_blank">
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
                                <tr >
                                        <th scope="col">SOCIO</th>
                                        <th scope="col">N° DOC.</th>
                                        <th scope="col">PLACA</th>
                                        <th scope="col">VEHIVULO</th>
                                        <th scope="col">ASOCIACION</th>
                                        <th scope="col">N° OPERAC.</th>
                                        <th scope="col">N° AUTORIZAC.</th>
                                        <th scope="col">ELIMINADO</th>
                                        <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tarjetas as $tarjeta)
                                    <tr>
                                        <td>{{ optional($tarjeta->socio)->nombre_socio }}</td>
                    
                                        <td>{{ optional($tarjeta->socio)->dni_socio }}</td>
                                        <td>{{ $tarjeta->num_placa ? $tarjeta->num_placa : '-' }}</td>
                    
                                        @if ($tarjeta->vehiculo_id == 1)
                                            <td class="text-info">{{ optional($tarjeta->vehiculo)->nombre }}</td>
                                        @elseif($tarjeta->vehiculo_id === 2)
                                            <td class="text-primary">{{ optional($tarjeta->vehiculo)->nombre }}</td>
                                        @else
                                            <td class="text-secondary">{{ optional($tarjeta->vehiculo)->nombre }}</td>
                                        @endif
                    
                                        @if (empty(optional($tarjeta->socio)->asociacione_id)  && optional($tarjeta->socio)->tipo_documento_id == 3)
                                            <td class="text-secondary">Entidad Privada</td>
                                        @elseif (empty(optional($tarjeta->socio)->asociacione_id))
                                            <td class="text-secondary">Persona Natural</td>
                                        @else
                                            <td>{{ optional(optional($tarjeta->socio)->asociacione)->nombre }}</td>
                                        @endif
                    
                                        <td>{{ $tarjeta->num_operacion }}</td>
                    
                                        <td>{{ $tarjeta->num_autorizacion }}</td>
                    
                    
                                        <td>{{ \Carbon\Carbon::parse($tarjeta->deleted_at)->format('Y-m-d') }}</td>

                                        @if ($tarjeta->status == 1)
                                            <td><img src="{{ asset('img/printer.png') }}" alt="Impreso"></td>
                                        @else
                                            <td></td>
                                        @endif

                                        
                    
                                    </tr>
                    
                                @endforeach
                    
                            </tbody>
                        </table>

                        <div class="overflow-auto mt-2">
                            {{ $tarjetas->links() }}
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