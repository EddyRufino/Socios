<div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputEmail4 font-weight-bold">Nombre Socio</label>
        <input type="text"
            name="nombre_socio"
            class="form-control @error('nombre_socio') is-invalid  @enderror"
            value="{{ old('nombre_socio', $socio->nombre_socio) }}"
            id="inputEmail4"
            placeholder="Ejm: ALBERCA YANAYACO TERESA"
            required
        >

        @error('nombre_socio')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="inputEmail4 font-weight-bold">Nombre Propietario</label>
        <input type="text"
            name="nombre_propietario"
            class="form-control @error('nombre_propietario') is-invalid  @enderror"
            value="{{ old('nombre_propietario', $socio->nombre_propietario) }}"
            id="inputEmail4"
            placeholder="Ejm: ALBERCA YANAYACO TERESA"
        >

        @error('nombre_propietario')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="inputEmail4 font-weight-bold">DNI Socio</label>
        <input type="text"
            name="dni_socio"
            class="form-control @error('dni_socio') is-invalid  @enderror"
            value="{{ old('dni_socio', $socio->dni_socio) }}"
            id="inputEmail4"
            placeholder="Ejm: ALBERCA YANAYACO TERESA"
        >

        @error('dni_socio')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="inputEmail4 font-weight-bold">DNI Propietario</label>
        <input type="text"
            name="dni_propietario"
            class="form-control @error('dni_propietario') is-invalid  @enderror"
            value="{{ old('dni_propietario', $socio->dni_propietario) }}"
            id="inputEmail4"
            placeholder="Ejm: ALBERCA YANAYACO TERESA"
        >

        @error('dni_propietario')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="inputEmail1">N. Placa</label>
        <input type="text"
            name="num_placa"
            class="form-control @error('num_placa') is-invalid  @enderror"
            value="{{ old('num_placa', $socio->num_placa) }}"
            id="inputEmail1"
            placeholder="Ejm: 5816-4P"
            required
        >

        @error('num_placa')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="inputEmail1">Asociación</label>
        <input type="text"
            name="nombre_asociacion"
            class="form-control @error('nombre_asociacion') is-invalid  @enderror"
            value="{{ old('nombre_asociacion', $socio->nombre_asociacion) }}"
            id="inputEmail1"
            placeholder="Ejm: San Miguel"
            required
        >

        @error('nombre_asociacion')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="inputEmail1">Expedición</label>
        <input type="date"
            name="expedicion"
            min="2015-01-01" max="2030-12-31" required
            class="form-control @error('expedicion') is-invalid  @enderror"
            value="{{ request()->routeIs('socios.edit') ? $socio->expedicion : date("Y-m-d") }}"
            id="inputCity"
            required
        >

        @error('expedicion')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="inputEmail1">Revalidación</label>
        <input type="date"
            name="revalidacion"
            min="2015-01-01" max="2030-12-31" required
            class="form-control @error('revalidacion') is-invalid  @enderror"
            value="{{ request()->routeIs('socios.edit') ? $socio->revalidacion : date("Y-m-d") }}"
            id="inputCity"
            required
        >

        @error('revalidacion')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="inputEmail1">N. Operación</label>
        <input type="text"
            name="num_operacion"
            class="form-control @error('num_operacion') is-invalid  @enderror"
            value="{{ old('num_operacion', $socio->num_operacion) }}"
            id="inputEmail1"
            placeholder="Ejm: 036-2019"
            required
        >

        @error('num_operacion')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="inputEmail1">Vigencia Operación</label>
        <input type="text"
            name="vigencia_operacion"
            class="form-control @error('vigencia_operacion') is-invalid  @enderror"
            value="{{ old('vigencia_operacion', $socio->vigencia_operacion) }}"
            id="inputEmail1"
            placeholder="Ejm: 19/09/2019 AL 19/09/2025"
            required
        >

        @error('vigencia_operacion')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="exampleFormControlFile1">Foto</label>
        <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">

        @if (request()->routeIs('socios.edit'))
            <div class="mt-3">
                <img
                    src="{{ asset($socio->image) }}"
                    alt="{{ $socio->nombre }}"
                    class="img-thumbnail"
                    style="width: 180px; height: 200px;"
                >
            </div>
        @endif
    </div>
</div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ $btn }}</button>
    </div>
