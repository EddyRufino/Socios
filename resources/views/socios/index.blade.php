@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="text-dark font-weight-bold mb-4"><a href="{{ route('tarjetas.index') }}" class="text-dark item text-decoration-none">Socios</a></h4>

    {{-- Search Advanced --}}
    <div id="searchAdvanced" class="d-flex justify-content-center" style="display: none !important;">
        @include('admin.search.advanced')
    </div>

    {{-- Search Basico --}}
    @include('partials.searchBasico', ['link' => 'search.socio'])

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

        @include('partials.checkbox')

    </div>

    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="bg-primary text-white">Socio</th>
                        <th scope="col" class="bg-primary text-white">DNI Socio</th>
                        <th scope="col" class="bg-primary text-white">Placa</th>
                        <th scope="col" class="bg-primary text-white">Asociación</th>
                        <th scope="col" class="bg-primary text-white">Actividad</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($socios as $socio)
                        <tr>
                            <td>{{ $socio->nombre_socio }}</td>
                            <td>{{ $socio->dni_socio }}</td>
                            <td>{{ $socio->num_placa }}</td>

                            @if (is_null($socio->asociacione_id))
                                <td class="text-secondary">Es Persona Natural</td>
                            @else
                                <td>{{ optional($socio->asociacione)->nombre }}</td>
                            @endif

                            <td>
                                <div class="d-flex">

                                    @if ($socio->tarjetas()->exists())
                                        <h6><a href="{{ route('tarjeta.anverso', $socio->tarjetas[0]->id) }}"
                                            class="ml-3 text-decoration-none tooltipw"
                                        >
                                            <span id="tooltipw" class="tooltiptext">Descargar Tarjeta Circulación</span>
                                            @include('icons.tarjeta')
                                        </a></h6>
                                    @endif

                                    @if ($socio->fotochecks()->exists())
                                        <h6><a href="{{ route('fotocheck.anverso', $socio->fotochecks[0]->id) }}"
                                            class="ml-3 text-decoration-none tooltipw"
                                        >
                                            <span id="tooltipw" class="tooltiptext">Descargar Fotocheck</span>
                                            @include('icons.fotocheck')
                                        </a></h6>
                                    @endif
                                </div>
{{--                                 <a href="{{ route('socios.show', $socio->url) }}"
                                    class="text-decoration-none"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Ver Socio"
                                >
                                    @include('icons.tarjeta')
                                </a>
                                <a href="{{ route('carnet.anverso', $socio->id) }}"
                                    class="ml-3 text-decoration-none"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Descarga Carnet"
                                >
                                    @include('icons.fotocheck')
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
                                </form> --}}
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
        {{ $socios->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    function myFunction() {
        let check = document.getElementById("myCheck");
        let search = document.getElementById("search");

        if (check.checked == true){
            search.style.display = "block";
        } else {
            search.style.display = "none";
        }
    }

    function mySearchAdvanced() {
        let check = document.getElementById("myCheckAdvanced");
        let search = document.getElementById("searchAdvanced");

        if (check.checked == true){
            search.style.display = "block";
        } else {
            search.style.setProperty('display', 'none', 'important');
        }
    }
</script>
@endpush
