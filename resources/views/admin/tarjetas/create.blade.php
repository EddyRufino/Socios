@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <h5 class="pl-2">@include('icons.back')<a href="{{ route('tarjetas.index') }}" class="text-dark font-weight-bold">Volver</a></h5>

            <h4 class="text-dark font-weight-bold mt-3 pl-2">Socios - Nueva Tarjeta Circulación</h4>

            <h2 id="dds"></h2>

            <div class="card mt-4">
                <div class="card-header bg-secondary text-white">
                    <h6 class="font-weight-bold">Nueva Tarjeta De Circulación</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tarjetas.store') }}">
                        @csrf

                        @include('admin.tarjetas.form', [
                            'tarjeta' => new App\Tarjeta,
                            'btn' => 'Guardar'
                            ])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
