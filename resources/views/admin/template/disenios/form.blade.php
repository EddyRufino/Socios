<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nombre">Nombre Del Diseño *</label>
            <input type="text"
                name="nombre"
                class="form-control @error('nombre') is-invalid  @enderror"
                value="{{ old('nombre', $disenio->nombre) }}"
                id="inputEmail4"
                placeholder="Ejm: Diseño Uno"
                required
            >

            @error('nombre')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="status">Estado *</label>
            <select class="form-control @error('status') is-invalid  @enderror" name="status">
                <option value="1"
                    {{ old('status', 1) == $disenio->status ? 'selected' : '' }}
                >
                    Hábil
                </option>
                <option value="0"
                    {{ old('status', 0) == $disenio->status ? 'selected' : '' }}
                >
                    No Hábil
                </option>
            </select>

            @error('status')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nombre_jefe">Nombre Del Jefe *</label>
            <input type="text"
                name="nombre_jefe"
                class="form-control @error('nombre') is-invalid  @enderror"
                value="{{ old('nombre_jefe', $disenio->nombre_jefe) }}"
                id="inputEmail4"
                placeholder="Ejm: Diseño Uno"
                required
            >

            @error('nombre_jefe')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="modelo">Modelo *</label>
            <select class="form-control @error('modelo') is-invalid  @enderror" name="modelo">
                <option value="1"
                    {{ old('modelo', 1) == $disenio->modelo ? 'selected' : '' }}
                >
                    Tarjeta Circulación
                </option>
                <option value="0"
                    {{ old('modelo', 0) == $disenio->modelo ? 'selected' : '' }}
                >
                    Fotocheck
                </option>
            </select>

            @error('status')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <label for="anverso">Diseño Anverso *</label>
        <input type="file"
            name="anverso"
            class="form-control @error('anverso') is-invalid  @enderror"
        >

        @error('anverso')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror


    </div>

    <div class="col-md-6">
        <label for="reverso">Diseño Reverso *</label>
        <input type="file"
            name="reverso"
            class="form-control @error('reverso') is-invalid  @enderror"
        >

        @error('reverso')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror


    </div>
</div>

<div class="row mt-2">
    <div class="col-md-6">
        <label for="firma">Firma Del Jefe *</label>
        <input type="file"
            name="firma"
            class="form-control @error('firma') is-invalid  @enderror"
        >

        @error('firma')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror


    </div>
</div>

<div class="row">
    <div class="col-md-4">
        
        @if (request()->routeIs('disenios.edit'))
            <div class="mt-3">
                <img
                    src="{{ asset('disenios/' . $disenio->anverso) }}"
                    alt="{{ $disenio->nombre }}"
                    class="img-thumbnail"
                    style="width: 120px; height: 80px;"
                >
            </div>
            <label>Diseño Anverso</label>
        @endif
    </div>
    <div class="col-md-4">
        
        @if (request()->routeIs('disenios.edit'))
            <div class="mt-3">
                <img
                    src="{{ asset('disenios/' . $disenio->reverso) }}"
                    alt="{{ $disenio->nombre }}"
                    class="img-thumbnail"
                    style="width: 120px; height: 80px;"
                >
            </div>
            <label>Diseño Reverso</label>
        @endif
    </div>
    <div class="col-md-4">
        
        @if (request()->routeIs('disenios.edit'))
            <div class="mt-3">
                <img
                    src="{{ asset('disenios/' . $disenio->firma) }}"
                    alt="{{ $disenio->nombre_jefe }}"
                    class="img-thumbnail"
                    style="width: 120px; height: 80px;"
                >
            </div>
            <label>Firma del Jefe</label>
        @endif
    </div>
</div>

