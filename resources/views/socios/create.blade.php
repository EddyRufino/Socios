@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">
                    Nuevo Socio
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('socios.store') }}" enctype="multipart/form-data">
                        @csrf

                        @include('socios.form', [
                            'socio' => new App\Socio,
                            'btn' => 'Guardar'
                            ])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
