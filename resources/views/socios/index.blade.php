@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h3><a href="{{ route('socios.index') }}" class="text-dark">Socios</a></h3>
        {{-- <a href="{{ route('socios.create') }}" class="btn btn-primary">Nuevo</a> --}}
        <div>
            <a href="{{ route('socios.create') }}" class="btn btn-primary">Nueva Tarjeta</a>
            <a href="{{ route('socios.create') }}" class="btn btn-primary">Nuevo Fotocheck</a>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="mb-4">
            <form action="{{ route('search.socio') }}" class="form-inline">
                @csrf
                <div class="input-group input-group-md">

                    <input class="form-control form-control-navbar"
                        name="search" type="search"
                        placeholder="Nombre Socio"
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
                {{-- <th scope="col">Vigencia Operación</th> --}}
                <th scope="col">Actividad</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($socios as $socio)
                <tr>
                    <td>{{ $socio->nombre_socio }}</td>
                    <td>{{ $socio->dni_socio }}</td>
                    <td>{{ $socio->nombre_propietario }}</td>
                    <td>{{ $socio->num_placa }}</td>
                    <td>{{ $socio->nombre_asociacion }}</td>
                    {{-- <td>{{ $socio->expedicion }}</td> --}}
                    {{-- <td>{{ $socio->revalidacion }}</td> --}}
                    <td>{{ $socio->num_operacion }}</td>
                    {{-- <td>{{ $socio->vigencia_operacion }}</td> --}}
                    <td>
                        <a href="{{ route('socios.show', $socio->url) }}"
                            class="text-decoration-none"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Ver Socio"
                        >
                            @include('icons.qr')
                        </a>
                        <a href="{{ route('carnet.anverso', $socio->id) }}"
                            class="ml-3 text-decoration-none"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Descarga Carnet"
                        >
                            @include('icons.download')
                        </a>
                        <a href="{{ route('socios.edit', $socio) }}"
                            class="ml-3 text-decoration-none"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Editar Socio"
                        >
                            @include('icons.edit')
                        </a>
                        <form id="myform" method="POST" action="{{ route('socios.destroy', $socio) }}" style="display: inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-xs btn-transparent "
                                onclick="return confirm('¿Seguro de querer eliminar este socio?')"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Eliminar Socio"
                            >
                                @include('icons.delete')
                            </button>
                        </form>
                    </td>
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
@endsection

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function mostrar() {
        event.preventDefault();
        Swal.fire({
          title: "Estás segur@?",
          text: "Recuerda estar completamente segur@!",
          showDenyButton: true,  showCancelButton: false,
          confirmButtonText: `Sí`,
          denyButtonText: `Salir`,
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("myform").submit();
            }
        });

    }
</script>
@endpush
