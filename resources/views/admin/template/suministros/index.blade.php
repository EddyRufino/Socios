@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="d-flex mt-2 align-items-center justify-content-between">
                <h2 class="mt-4 title-left pt-3 pb-3 font-weight-bold">Suministros</h2>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">

                    <h6><a href="{{ route('suministros.create') }}" class="text-dark ml-3 tooltipw">
                        <span id="tooltipw" class="tooltiptext">Nuevo Lote</span>
                        @include('icons.add')
                    </a></h6>

                </div>
        
            </div>

            @if (auth()->user()->hasRoles(['superadmin']))
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" nowrap>Nombre Lote</th>
                                    <th scope="col" nowrap>Monto PVC</th>
                                    <th scope="col" nowrap>Monto Cinta</th>
                                    <th scope="col" nowrap>Monto Holograma</th>
                                    <th scope="col" nowrap>Adquirida</th>
                                    <th scope="col" nowrap>Inicio Utilización</th>
                                    <th scope="col" nowrap>Estado</th>
                                    <th scope="col" nowrap>Monto Pruebas</th>
                                    <th scope="col" nowrap>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($suministros as $suministro)
                                    <tr>
                                        <td nowrap>{{ $suministro->nombre }}</td>
                                        <td nowrap>{{ $suministro->monto_pvc }} <strong class="text-secondary">-</strong> {{ $suministro->conteo_monto_pvc }} <span class="text-secondary">@include('icons.top')</span></td>
                                        <td nowrap>{{ $suministro->monto_cinta }} <strong class="text-secondary">-</strong> {{ $suministro->conteo_monto_cinta }} <span class="text-secondary">@include('icons.top')</td>
                                        <td nowrap>{{ $suministro->monto_holograma }} <strong class="text-secondary">-</strong> {{ $suministro->conteo_monto_holograma }} <span class="text-secondary">@include('icons.top')</td>
                                        <td nowrap>{{ $suministro->fecha_adquisicion }}</td>
                                        <td nowrap>{{ $suministro->fecha_utilizacion }}</td>
                                        @if ($suministro->status == 1)
                                            <td nowrap>Hábil</td>
                                        @else
                                            <td nowrap>No Hábil</td>
                                        @endif
                                        <td nowrap>{{ $suministro->monto_pruebas }}</td>

                                        <td nowrap>
                                            <div class="d-flex">
                                                <a href="{{ route('suministros.edit', $suministro->id) }}" data-toggle="tooltip" data-placement="top" title="Editar" class="text-warning mr-2">

                                                    @include('icons.edit')

                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <li class="list-group-item border-0 mb-3 shadow-sm">No hay nada para mostrar</li>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="overflow-auto mt-2">
                            {{ $suministros->links() }}
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
