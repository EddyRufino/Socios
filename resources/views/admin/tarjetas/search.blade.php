@extends('layouts.app')

@section('content')
<div class="container">

    @include('partials.nav')

    <div class="d-flex justify-content-center">
        <div class="mb-4">
            <form action="{{ route('search.tarjeta') }}" class="form-inline">
                @csrf
                <div class="input-group input-group-md">

                    <input class="form-control form-control-navbar"
                        name="search" type="search"
                        placeholder="Nombre - DNI - Placa"
                        aria-label="Search"
                        required
                    >

                    <div class="input-group-append">
                        <button class="btn btn-navbar bg-primary text-white" type="submit">
                            @include('icons.icon-search')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
        <h3><a href="{{ route('tarjetas.index') }}" class="text-dark font-weight-bold">Socios - Tarjetas Circulación</a></h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nombre Socio</th>
                <th scope="col">DNI Socio</th>
                <th scope="col">Nombre Propietario</th>
                <th scope="col">N. Placa</th>
                <th scope="col">Asociación</th>
                <!--<th scope="col">Expedición</th>-->
                <!--<th scope="col">Revalicación</th>-->
                <th scope="col">N. Operación</th>
                <th scope="col">QR</th>
                <th scope="col">Actividad</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tarjetas as $tarjeta)
                <tr>
                    <td>{{ $tarjeta->nombre_socio }}</td>
                    <td>{{ $tarjeta->dni_socio }}</td>
                    <td>{{ $tarjeta->nombre_propietario }}</td>
                    <td>{{ $tarjeta->num_placa }}</td>
                    <td>{{ optional($tarjeta->asociacione)->nombre }}</td>
                    {{-- <td>{{ $tarjeta->expedicion }}</td> --}}
                    {{-- <td>{{ $tarjeta->revalidacion }}</td> --}}
                    <td>{{ $tarjeta->num_operacion }}</td>
                    @if ($tarjeta->status == 1)
                        <td><span class="badge badge-info text-white">Generado</span></td>
                    @else
                        <td></td>
                    @endif
                    <td>
                        <a href="{{ route('tarjetas.show', $tarjeta->url) }}"
                            class="text-decoration-none"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Ver Socio"
                        >
                            @include('icons.qr')
                        </a>
                        <a href="{{ route('carnet.anverso', $tarjeta->id) }}"
                            class="ml-3 text-decoration-none"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Descarga Carnet"
                        >
                            @include('icons.download')
                        </a>
                        <a href="{{ route('tarjetas.edit', $tarjeta) }}"
                            class="ml-3 text-decoration-none"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Editar Socio"
                        >
                            @include('icons.edit')
                        </a>

                    </td>
                </tr>
            @empty
                <li class="list-group-item border-0 mb-3 shadow-sm">No hay nada para mostrar</li>
            @endforelse
        </tbody>
    </table>

    <div class="overflow-auto mt-2">
        {{ $tarjetas->links() }}
    </div>
</div>
@endsection

