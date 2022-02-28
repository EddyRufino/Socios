<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label for="inputEmail4 font-weight-bold">Nombre *</label>
            <input type="text"
                name="name"
                class="form-control @error('name') is-invalid  @enderror"
                value="{{ old('name', $user->name) }}"
                id="inputEmail4"
                placeholder="Ejm: ALBERCA TERESA"
                required
            >

            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>


    </div>

    <div class="col-md-6">

        <div class="form-group">
            <label for="email">Correo *</label>
            <input type="email"
                name="email"
                class="form-control @error('email') is-invalid  @enderror"
                value="{{ old('email', $user->email) }}"
                id="email"
                placeholder="Ejm: example@gmail.com"
                required
            >

            @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="font-weight-bold">Roles *</label>
            @auth
                {{-- <div class=""> --}}
                    @if (auth()->user()->hasRoles(['superadmin']))
                        <div class="checkbox">
                            @foreach ($roles as $id => $name)
                                <label class="font-weight-normal text-dark mr-2">
                                    <input type="checkbox"
                                        value="{{ $id }}"
                                        {{ $user->roles->pluck('id')->contains($id) ? 'checked' : '' }}
                                        name="roles[]">
                                    {{ $name }}
                                </label>
                            @endforeach
                        </div>
                    @elseif (auth()->user()->hasRoles(['recep']))
                        <div class="checkbox d-none">
                            @foreach ($roles as $id => $name)
                                <label >
                                    <input type="checkbox"
                                        value="{{ $id }}"
                                        {{ $user->roles->pluck('id')->contains($id) ? 'checked' : 'disabled' }}
                                        name="roles[]">
                                    {{ $name }}
                                </label>
                            @endforeach
                        </div>
                    @endif
                {{-- </div> --}}

            @endauth
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="font-weight-bold">Puede Ver:</label>
                @if (auth()->user()->hasRoles(['superadmin']))
                    <div class="checkbox">
                        @foreach ($permissions as $id => $name)
                            <label class="font-weight-normal text-dark mr-2">
                                <input type="checkbox"
                                    value="{{ $id }}"
                                    {{ $user->roles->pluck('id')->contains($id) ? 'checked' : '' }}
                                    name="roles[]">
                                {{ $name }}
                            </label>
                        @endforeach
                    </div>
                @endif
        </div>
    </div>
</div>

