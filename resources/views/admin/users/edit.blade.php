@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <h3 class="mt-4 pt-3 pb-1 font-weight-bold"><a href="{{ route('users.index') }}">Usuarios</a> @include('icons.arrow-right') {{ $user->name }}</h3>

                <div class="card mt-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                            @include('admin.forms.formUser', ['btn' => 'Editar Usuario'])

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Contraseña *</label>
                                        <input type="password"
                                            name="password"
                                            class="form-control @error('password') is-invalid  @enderror"
                                            id="password"
                                        >
                            
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password-confirm">Repite Contraseña *</label>
                                        <input type="password"
                                            name="password_confirmation"
                                            class="form-control"
                                            id="password-confirm"
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0 d-flex justify-content-end">
                                <div class="col-md-6 offset-md-4 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        Editar Usuario
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
