@extends('layouts.app')

@section('content')
<div class="container">

    @include('partials.nav')

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
        <h3><a href="{{ route('fotochecks.index') }}" class="text-dark font-weight-bold">Socios - Fotochecks</a></h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nombre Socio</th>
                <th scope="col">DNI Socio</th>
                <th scope="col">Asociación</th>
                <th scope="col">Expedición</th>
                <th scope="col">Revalidación</th>
                <th scope="col">Actividad</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($fotochecks as $fotocheck)
                <tr>
                    <td>{{ $fotocheck->nombre_socio }}</td>
                    <td>{{ $fotocheck->dni_socio }}</td>
                    <td>{{ $fotocheck->asociacione->nombre }}</td>
                    <td>{{ $fotocheck->expedicion }}</td>
                    <td>{{ $fotocheck->revalidacion }}</td>
                    <td>
                        <a href="{{ route('fotochecks.show', $fotocheck->url) }}"
                            class="text-decoration-none"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Ver Socio"
                        >
                            @include('icons.qr')
                        </a>
                        <a href="{{ route('carnet.anverso', $fotocheck->id) }}"
                            class="ml-3 text-decoration-none"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Descarga Carnet"
                        >
                            @include('icons.download')
                        </a>
                        <a href="{{ route('fotochecks.edit', $fotocheck) }}"
                            class="ml-3 text-decoration-none"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Editar Socio"
                        >
                            @include('icons.edit')
                        </a>
                        <form id="myform" method="POST" action="{{ route('fotochecks.destroy', $fotocheck) }}" style="display: inline">
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
        {{ $fotochecks->links() }}
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
