@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <h3 class="mt-4 pt-3 pb-1 font-weight-bold"><a href="{{ route('suministros.index') }}">Suministros</a> @include('icons.arrow-right') Nuevo</h3>

            <div class="card mt-4">
                
                <div class="card-body">
                    <form method="POST" action="{{ route('suministros.store') }}">
                    @csrf

                        @include('admin.template.suministros.form')

                        <div class="form-group row mb-0 d-flex justify-content-end mt-3">
                            <div class="col-md-6 offset-md-4 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    Nuevo Lote
                                </button>
                            </div>
                        </div>
                    </form>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection