@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="d-flex mt-2 align-items-center justify-content-between">
                <h2 class="mt-4 title-left pt-3 pb-3 font-weight-bold">Area</h2>
            </div>

            {{-- <div class="d-flex mt-2 align-items-center justify-content-between mb-4">
                <div class="input-group input-group-md">

                    <input class="form-control col-md-4 form-control-navbar"
                        name="search" type="search"
                        placeholder="Socio - DNI - Placa"
                        aria-label="Search"
                        value="{{ request()->search }}"
                        required
                    >

                    <div class="input-group-append">
                        <button class="btn btn-navbar bg-primary text-white" type="submit">
                            @include('icons.icon-search')
                        </button>
                    </div>
                </div>

                <div class="">
                    <a class="btn btn-primary" href="{{ route('disenios.create') }}">Nuevo</a>
                </div>
            </div> --}}

            @if (auth()->user()->hasRoles(['superadmin', 'area']))
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Título</th>
                                    <th scope="col">Sub Título</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($areas as $area)
                                    <tr>
                                        <th scope="row">{{ $area->id }}</th>
                                        <td>{{ $area->title }}</td>
                                        <td>{{ $area->sub_title }}</td>

                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('areas.edit', $area->id) }}" data-toggle="tooltip" data-placement="top" title="Editar" class="text-warning mr-2">

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
                            {{-- {{ $disenios->links() }} --}}
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
