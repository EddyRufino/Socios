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
        <label for="inputEmail1">N. Placa</label>
        <input type="text"
            name="num_placa"
            class="form-control @error('num_placa') is-invalid  @enderror"
            value="{{ old('num_placa', $socio->num_placa) }}"
            id="inputEmail1"
            placeholder="Ejm: 5816-4P"
        >

        @error('num_placa')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

</div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ $btn }}</button>
    </div>
