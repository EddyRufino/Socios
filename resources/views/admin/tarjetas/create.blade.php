@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('partials.nav')
            <h2 id="dds"></h2>
            <div class="card mt-4">
                <div class="card-header bg-info text-white">
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
