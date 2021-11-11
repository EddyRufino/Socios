@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">
                    Modificar Socio
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
