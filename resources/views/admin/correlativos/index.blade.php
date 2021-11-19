@extends('layouts.app')

@section('content')
<div class="container">

    <h4 class="text-dark font-weight-bold mb-4"><a href="{{ route('correlativos.index') }}" class="text-dark item text-decoration-none">Número Correlativo</a></h4>

    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-between align-items-center">
            <h6><a href="{{ route('tarjetas.index') }}" class="text-dark ml-3 tooltipw">
                <span id="tooltipw" class="tooltiptext">Listar Tarjetas</span>
                @include('icons.tarjeta')
            </a></h6>
            <h6><a href="{{ route('fotochecks.index') }}" class="text-dark ml-3 tooltipw">
                <span id="tooltipw" class="tooltiptext">Listar Fotochecks</span>
                @include('icons.fotocheck')
            </a></h6>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="bg-primary text-white">Número Correlativo</th>
                        <th scope="col" class="bg-primary text-white">Actividad</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($correlativos as $correlativo)
                        <tr>
                            <td>{{ $correlativo->num_correlativo }}</td>
                            <td>
                                <div class="d-flex">
                                    <h6><a href="{{ route('correlativos.edit', $correlativo->id) }}"
                                        class="ml-3 text-decoration-none tooltipw"
                                    >
                                        <span id="tooltipw" class="tooltiptext">Editar</span>
                                        @include('icons.edit')
                                    </a></h6>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <li class="list-group-item border-0 mb-3 shadow-sm">No hay nada para mostrar</li>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection



