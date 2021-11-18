@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="text-dark font-weight-bold">Transportador Autorizado</h4>

    <h2 id="dds"></h2>

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
            <h6><a href="{{ route('asociaciones.create') }}" class="text-dark ml-3 tooltipw">
                <span id="tooltipw" class="tooltiptext">Nueva Asociación</span>
                @include('icons.add')
            </a></h6>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="bg-primary text-white">Nombre Asociación</th>
                        <th scope="col" class="bg-primary text-white">Actividad</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($asociaciones as $asociacione)
                        <tr>
                            <td>{{ $asociacione->nombre }}</td>
                            <td>
                                <div class="d-flex">
                                    <h6><a href="{{ route('asociaciones.edit', $asociacione->id) }}"
                                        class="ml-3 text-decoration-none tooltipw"
                                    >
                                        <span id="tooltipw" class="tooltiptext">Editar</span>
                                        @include('icons.edit')
                                    </a></h6>

                                    {{-- <form id="myform" method="POST" action="{{ route('asociaciones.destroy', $fotocheck) }}" style="display: inline">
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
                                    </form> --}}
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

    <div class="overflow-auto mt-2">
        {{ $asociaciones->links() }}
    </div>
</div>
@endsection



