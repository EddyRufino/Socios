@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="d-flex mt-2 align-items-center justify-content-between">
                <h2 class="mt-4 title-left pt-3 pb-3 font-weight-bold">Usuarios</h2>
            </div>

            <div class="d-flex mt-2 align-items-center justify-content-between mb-4">
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
                    <a class="btn btn-primary" href="{{ route('users.create') }}">Nuevo</a>
                </div>
            </div>

            @if (auth()->user()->hasRoles(['admin']))
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Rol</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->name }} {{ $user->apellido }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles->pluck('display_name')->implode(' - ') }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('users.edit', $user->id) }}" data-toggle="tooltip" data-placement="top" title="Editar" class="text-warning mr-2">

                                                    @include('icons.edit')

                                                </a>

                                            @auth
                                                @if (auth()->user()->hasRoles(['admin']))
                                                    <form method="POST" action="{{ route('users.destroy', $user) }}"
                                                            style="display: inline;">
                                                            {{ csrf_field() }} {{ method_field('DELETE') }}
                                                        <button class="btn btn-xs btn-link p-0 m-0"
                                                            onclick="return confirm('¿Estás seguro de eliminarlo?')" data-toggle="tooltip" data-placement="top" title="Eliminar">

                                                            @include('icons.delete')

                                                        </button>
                                                    </form>
                                                @endif
                                            @endauth
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <li class="list-group-item border-0 mb-3 shadow-sm">No hay nada para mostrar</li>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="overflow-auto mt-2">
                            {{ $users->links() }}
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
