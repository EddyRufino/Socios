@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="d-flex mt-2 align-items-center justify-content-between">
                <h2 class="mt-4 title-left pt-3 pb-3 font-weight-bold">
                    <a href="{{ route('filtro.socio.create') }}" class="text-dark item text-decoration-none">Resultado</a>
                </h2>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    <h6>Exportar:</h6>
                    <h6><a href="{{ route('filtro.socio.pdf.info', [
                            'vehiculo_id' => request()->vehiculo_id,
                            'print' => request()->print,
                            'disenio_id' => request()->disenio_id,
                            'dateStart' => request()->dateStart,
                            'dateLast' => request()->dateLast,
                            'dateStartVigencia' => request()->dateStartVigencia,
                            'dateLastVigencia' => request()->dateLastVigencia,
                            'dateStartPrint' => request()->dateStartPrint,
                            'dateLastPrint' => request()->dateLastPrint,
                            'isFotocheck' => request()->fotocheck,
                            'isTarjeta' => request()->tarjeta,
                            'natural' => request()->natural,
                            'juridica' => request()->juridica,
                            'checkDatePrint' => request()->checkDatePrint,
                            'socio' => request()->socio
                        ]) }}"
                            class="text-danger ml-3 tooltipw"
                            target="_blank"
                        >
                        <span id="tooltipw" class="tooltiptext">Descargar PDF</span>
                        @include('icons.pdf')
                    </a></h6>

                    {{-- <h6><a href="{{ route('filtro.socio.pdf.grafi', [
                            'vehiculo_id' => request()->vehiculo_id,
                            'print' => request()->print,
                            'dateStart' => request()->dateStart,
                            'dateLast' => request()->dateLast,
                            'dateStartVigencia' => request()->dateStartVigencia,
                            'dateLastVigencia' => request()->dateLastVigencia,
                            'isFotocheck' => request()->fotocheck,
                            'isTarjeta' => request()->tarjeta,
                            'natural' => request()->natural,
                            'juridica' => request()->juridica,
                            'socio' => request()->socio,
                        ]) }}"
                            class="text-dark ml-3 tooltipw"
                            target="_blank"
                        >
                        <span id="tooltipw" class="tooltiptext">Descargar Gráficos</span>
                        @include('icons.graphic')
                    </a></h6> --}}

                    <h6><a href="{{ route('filtro.socio.excel.info', [
                            'vehiculo_id' => request()->vehiculo_id,
                            'print' => request()->print,
                            'disenio_id' => request()->disenio_id,
                            'dateStart' => request()->dateStart,
                            'dateLast' => request()->dateLast,
                            'dateStartVigencia' => request()->dateStartVigencia,
                            'dateLastVigencia' => request()->dateLastVigencia,
                            'dateStartPrint' => request()->dateStartPrint,
                            'dateLastPrint' => request()->dateLastPrint,
                            'isFotocheck' => request()->fotocheck,
                            'isTarjeta' => request()->tarjeta,
                            'natural' => request()->natural,
                            'juridica' => request()->juridica,
                            'checkDatePrint' => request()->checkDatePrint,
                            'socio' => request()->socio
                        ]) }}"
                            class="text-success ml-3 tooltipw"
                            target="_blank"
                        >
                        <span id="tooltipw" class="tooltiptext">Descargar EXCEL</span>
                        @include('icons.excel')
                    </a></h6>

                </div>
        
            </div>

            <div class="row">
                {{-- {{dd(request()->disenio_id)}} --}}
                <div class="col-md-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nombre y Apellido</th>
                                <th scope="col">N. Doc</th>
                                <th scope="col">N. Placa</th>
                                <th scope="col">Asociación</th>
                                <th scope="col">Vehículo</th>
                                <th scope="col">Actividad</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @forelse ($socios as $socio) --}}
                            @forelse ($datas as $data)
                                {{-- <td>{{ dd($data->socio->nombre_socio) }}</td> --}}
                                <tr>
                                    <td>{{ optional($data->socio)->nombre_socio }}</td>
                                    <td>{{ optional($data->socio)->dni_socio }}</td>
                                    <td nowrap>{{ $data->num_placa }}</td>

                                    @if (empty(optional($data->socio)->asociacione_id)  && optional($data->socio)->tipo_documento_id == 3)
                                        <td class="text-secondary">Entidad Privada</td>
                                    @elseif (empty(optional($data->socio)->asociacione_id))
                                        <td class="text-secondary">Persona Natural</td>
                                    @else
                                        <td>{{ optional(optional($data->socio)->asociacione)->nombre }}</td>
                                    @endif

                                    @if (optional($data->socio)->vehiculo_id == 1)
                                        <td class="text-info">{{ optional(optional($data->socio)->vehiculo)->nombre }}</td>
                                    @elseif(optional($data->socio)->vehiculo_id === 2)
                                        <td class="text-primary">{{ optional(optional($data->socio)->vehiculo)->nombre }}</td>
                                    @else
                                        <td class="text-secondary">{{ optional(optional($data->socio)->vehiculo)->nombre }}</td>
                                    @endif

                                    <td>
                                        <div class="d-flex">
                                            @if (request()->tarjeta)
                                                <a href="{{ route('tarjetas.show', $data->url) }}"
                                                    class="text-decoration-none tooltipw"
                                                    target="_blank"
                                                >
                                                <span id="tooltipw" class="tooltiptext">Ver QR</span>
                                                    @include('icons.qr')
                                                </a>
                                    
                                                <h6><a href="{{ route('tarjeta.anverso', $data->id) }}"
                                                    class="ml-3 text-decoration-none tooltipw"
                                                    target="_blank"
                                                >
                                                    <span id="tooltipw" class="tooltiptext">Ver Tarjeta Circulación</span>
                                                    @include('icons.tarjeta')
                                                </a></h6>
                                            @endif
                                            
                                            @if (request()->fotocheck)
                                                <h6><a href="{{ route('fotochecks.show', $data->url) }}"
                                                    class="text-decoration-none tooltipw"
                                                    target="_blank"
                                                >
                                                    <span id="tooltipw" class="tooltiptext">Ver QR</span>
                                                    @include('icons.qr')
                                                </a></h6>

                                                <h6><a href="{{ route('fotocheck.anverso', $data->id) }}"
                                                    class="ml-3 text-decoration-none tooltipw"
                                                    target="_blank"
                                                >
                                                    <span id="tooltipw" class="tooltiptext">Ver Fotocheck</span>
                                                    @include('icons.fotocheck')
                                                </a></h6>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                                {{-- <tr>
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

                                    <td>
                                        <div class="d-flex">
                                            @canPrint
                                                @if ($socio->tarjetas()->exists())
                                                    <h6><a href="{{ route('tarjeta.anverso', $socio->tarjetas[0]->id) }}"
                                                        class="ml-3 text-decoration-none tooltipw"
                                                        target="_blank"
                                                    >
                                                        <span id="tooltipw" class="tooltiptext">Descargar Tarjeta Circulación</span>
                                                        @include('icons.tarjeta')
                                                    </a></h6>
                                                @endif
                                                
                                                @if ($socio->fotochecks()->exists())
                                                    <h6><a href="{{ route('fotocheck.anverso', $socio->fotochecks[0]->id) }}"
                                                        class="ml-3 text-decoration-none tooltipw"
                                                        target="_blank"
                                                    >
                                                        <span id="tooltipw" class="tooltiptext">Descargar Fotocheck</span>
                                                        @include('icons.fotocheck')
                                                    </a></h6>
                                                @endif
                                            @endcanPrint

                                        </div>
                                    </td>
                                </tr> --}}
                            @empty
                                <li class="list-group-item border-0 mb-3 shadow-sm">No hay nada para mostrar</li>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="overflow-auto mt-2">
                {{ $datas->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection