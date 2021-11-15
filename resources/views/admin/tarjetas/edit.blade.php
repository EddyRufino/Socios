@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('partials.nav')

            <div class="card mt-3">
                <div class="card-header bg-info text-white">
                    <h6 class="font-weight-bold">Modificar - Tarjeta De Circulación</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tarjetas.update', $tarjeta) }}">
                        @csrf
                        @method('PUT')

                        @include('admin.tarjetas.form', ['btn' => 'Editar'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
