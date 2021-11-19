@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <h5 class="pl-2">@include('icons.back')<a href="{{ route('fotochecks.index') }}" class="text-dark font-weight-bold">Volver</a></h5>

            <h4 class="font-weight-bold mt-3 pl-2 mb-4 pb-2"><a href="{{ route('fotochecks.index') }}" class="text-dark item text-decoration-none">Socios - Nuevo Fotocheck</a></h4>

            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="font-weight-bold">Nuevo Fotocheck</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('fotochecks.store') }}" enctype="multipart/form-data">
                        @csrf

                        @include('admin.fotochecks.form', [
                            'fotocheck' => new App\Fotocheck,
                            'btn' => 'Guardar'
                            ])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
