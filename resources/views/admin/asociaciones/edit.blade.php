@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <h5 class="pl-2">@include('icons.back')<a href="{{ route('asociaciones.index') }}" class="text-dark font-weight-bold">Volver</a></h5>

            <h4 class="text-dark font-weight-bold mt-3 pl-2">Transportador Autorizado</h4>

            <h2 id="dds"></h2>

            <div class="card mt-4">
                <div class="card-header bg-secondary text-white">
                    <h6 class="font-weight-bold">Modificar Asociación</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('asociaciones.update', $asociacione) }}">
                        @csrf
                        @method('PUT')

                        @include('admin.asociaciones.form', [
                            'btn' => 'Editar'
                            ])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
