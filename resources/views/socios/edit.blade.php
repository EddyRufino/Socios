@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <h5 class="pl-2">@include('icons.back')<a href="{{ route('socios.index') }}" class="text-dark font-weight-bold">Volver</a></h5>

            <h4 class="font-weight-bold mt-3 pl-2 mb-4 pb-1"><a href="{{ route('socios.index') }}" class="text-dark item text-decoration-none">Socios - Modificar Socio Oficial</a></h4>

            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="font-weight-bold">Modificar Socio</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('socios.update', $socio) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @include('socios.form', ['btn' => 'Editar'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
