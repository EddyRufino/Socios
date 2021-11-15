<div class="row">
    <div class="col-md-6">
        <fieldset class="boder-1 p-2">
            <legend class="legend">
                Socio
            </legend>

            <div class="form-group">
                <label for="inputEmail4 font-weight-bold">Nombres y Apellidos</label>
                <input type="text"
                    name="nombre_socio"
                    class="form-control @error('nombre_socio') is-invalid  @enderror"
                    value="{{ old('nombre_socio', $tarjeta->nombre_socio) }}"
                    id="inputEmail4"
                    placeholder="Ejm: ALBERCA TERESA"
                    required
                >

                @error('nombre_socio')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputEmail4 font-weight-bold">D.N.I</label>
                <input type="text"
                    name="dni_socio"
                    class="form-control @error('dni_socio') is-invalid  @enderror"
                    value="{{ old('dni_socio', $tarjeta->dni_socio) }}"
                    id="inputEmail4"
                    placeholder="Ejm: 77577145"
                >

                @error('dni_socio')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </fieldset>
    </div>
    <div class="col-md-6">
        <fieldset class="boder-1 p-2">
            <legend class="legend">
                Propietario
            </legend>

            <div class="form-group">
                <label for="inputEmail4 font-weight-bold">Nombres y Apellidos</label>
                <input type="text"
                    name="nombre_propietario"
                    class="form-control @error('nombre_propietario') is-invalid  @enderror"
                    value="{{ old('nombre_propietario', $tarjeta->nombre_propietario) }}"
                    id="inputEmail4"
                    placeholder="Ejm: ALBERCA YANAYACO"
                >

                @error('nombre_propietario')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputEmail4 font-weight-bold">D.N.I</label>
                <input type="text"
                    name="dni_propietario"
                    class="form-control @error('dni_propietario') is-invalid  @enderror"
                    value="{{ old('dni_propietario', $tarjeta->dni_propietario) }}"
                    id="inputEmail4"
                    placeholder="Ejm: 33655414"
                >

                @error('dni_propietario')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </fieldset>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <fieldset class="boder-1 ">
            <legend class="legend p-2">
                Vehículo
            </legend>

            <div class="row col">
                <div class="form-group col-md-6">
                    <label for="inputEmail1">N. Placa</label>
                    <input type="text"
                        name="num_placa"
                        class="form-control @error('num_placa') is-invalid  @enderror"
                        value="{{ old('num_placa', $tarjeta->num_placa) }}"
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
                    <label for="inputEmail2">Tipo Vehículo</label>
                    <select class="form-control @error('vehiculo_id') is-invalid  @enderror" name="vehiculo_id">
                        <option value="">Selecciona un vehículo</option>
                        @foreach ($vehiculos as $vehiculo)
                          <option value="{{ $vehiculo->id }}"
                                  {{ old('vehiculo_id', $tarjeta->vehiculo_id) == $vehiculo->id ? 'selected' : '' }}>
                            {{ $vehiculo->nombre }}</option>
                        @endforeach
                    </select>

                    @error('vehiculo_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row col">
                <div class="form-group col-md-6">
                    <label for="inputEmail1">Expedición</label>
                    <input type="date"
                        name="expedicion"
                        min="2015-01-01" max="2030-12-31" required
                        class="form-control @error('expedicion') is-invalid  @enderror"
                        value="{{ request()->routeIs('tarjetas.edit') ? $tarjeta->expedicion : date("Y-m-d") }}"
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
                        value="{{ request()->routeIs('tarjetas.edit') ? $tarjeta->revalidacion : date("Y-m-d") }}"
                        id="inputCity"
                        required
                    >

                    @error('revalidacion')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
        </fieldset>
    </div>
</div>

<div class="row">
    @if (request()->routeIs('tarjetas.create'))
        <div class="col-md-6" id="juridica">
            <fieldset class="boder-1">
                <legend class="text-legend-transportador legend p-2">
                    Transportador Autorizado
                </legend>

                <div class="form-group pl-2 pr-2">
                    <label for="inputEmail2">Asociación</label>
                    <select class="form-control @error('asociacione_id') is-invalid  @enderror" name="asociacione_id">
                        <option value="">Selecciona una asociación</option>
                        @foreach ($asociaciones as $asociacione)
                          <option value="{{ $asociacione->id }}"
                                  {{ old('asociacione_id', $tarjeta->asociacione_id) == $asociacione->id ? 'selected' : '' }}>
                            {{ $asociacione->nombre }}</option>
                        @endforeach
                    </select>

                    @error('asociacione_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group pl-2 pr-2">
                    <label for="inputEmail1">N. Operación</label>
                    <input type="text"
                        name="num_operacion"
                        class="form-control @error('num_operacion') is-invalid  @enderror"
                        value="{{ old('num_operacion', $tarjeta->num_operacion) }}"
                        id="inputEmail1"
                        placeholder="Ejm: 036-2019"
                    >

                    @error('num_operacion')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group pl-2 pr-2">
                    <label for="inputEmail1">Vigencia Operación</label>
                    <input type="text"
                        name="vigencia_operacion"
                        class="form-control @error('vigencia_operacion') is-invalid  @enderror"
                        value="{{ old('vigencia_operacion', $tarjeta->vigencia_operacion) }}"
                        id="inputEmail1"
                        placeholder="Ejm: 19/09/2019 AL 19/09/2025"
                    >

                    @error('vigencia_operacion')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

            </fieldset>
        </div>

        <div class="col-md-6">
            <fieldset class="boder-1" id="natural" style="display:none">
                <legend class="text-legend-transportador legend p-2">
                    Persona Natural
                </legend>

                <div class="form-group pl-2 pr-2">
                    <label for="inputEmail3">N. Autorización</label>
                    <input type="text"
                        name="num_autorizacion"
                        class="form-control @error('num_autorizacion') is-invalid  @enderror"
                        value="{{ old('num_autorizacion', $tarjeta->num_autorizacion) }}"
                        id="inputEmail1"
                        placeholder="Ejm: 5816-4P"
                    >

                    @error('num_autorizacion')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group pl-2 pr-2">
                    <label for="inputEmail3">Vigencia Autorización</label>
                    <input type="text"
                        name="vigencia_autorizacion"
                        class="form-control @error('vigencia_autorizacion') is-invalid  @enderror"
                        value="{{ old('vigencia_autorizacion', $tarjeta->vigencia_autorizacion) }}"
                        id="inputEmail1"
                        placeholder="Ejm: 26/08 AL 26/09"
                    >

                    @error('vigencia_autorizacion')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

            </fieldset>

            <div class="custom-control custom-checkbox mt-3">
                <input type="checkbox" class="custom-control-input" id="myCheck" onclick="myFunction()">
                <label class="custom-control-label" for="myCheck">Persona Natural</label>
            </div>
        </div>
    @endif

    @if (request()->routeIs('tarjetas.edit') )
        <div class="col-md-6" id="juridica">
            <fieldset class="boder-1">
                <legend class="text-legend-transportador legend p-2">
                    Transportador Autorizado
                </legend>

                <div class="form-group pl-2 pr-2">
                    <label for="inputEmail2">Asociación</label>
                    <select class="form-control @error('asociacione_id') is-invalid  @enderror" name="asociacione_id">
                        <option value="">Selecciona una asociación</option>
                        @foreach ($asociaciones as $asociacione)
                          <option value="{{ $asociacione->id }}"
                                  {{ old('asociacione_id', $tarjeta->asociacione_id) == $asociacione->id ? 'selected' : '' }}>
                            {{ $asociacione->nombre }}</option>
                        @endforeach
                    </select>

                    @error('asociacione_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group pl-2 pr-2">
                    <label for="inputEmail1">N. Operación</label>
                    <input type="text"
                        name="num_operacion"
                        class="form-control @error('num_operacion') is-invalid  @enderror"
                        value="{{ old('num_operacion', $tarjeta->num_operacion) }}"
                        id="inputEmail1"
                        placeholder="Ejm: 036-2019"
                    >

                    @error('num_operacion')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group pl-2 pr-2">
                    <label for="inputEmail1">Vigencia Operación</label>
                    <input type="text"
                        name="vigencia_operacion"
                        class="form-control @error('vigencia_operacion') is-invalid  @enderror"
                        value="{{ old('vigencia_operacion', $tarjeta->vigencia_operacion) }}"
                        id="inputEmail1"
                        placeholder="Ejm: 19/09/2019 AL 19/09/2025"
                    >

                    @error('vigencia_operacion')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

            </fieldset>
        </div>

        <div class="col-md-6">
            <fieldset class="boder-1" id="natural">
                <legend class="text-legend-transportador legend p-2">
                    Persona Natural
                </legend>

                <div class="form-group pl-2 pr-2">
                    <label for="inputEmail3">N. Autorización</label>
                    <input type="text"
                        name="num_autorizacion"
                        class="form-control @error('num_autorizacion') is-invalid  @enderror"
                        value="{{ old('num_autorizacion', $tarjeta->num_autorizacion) }}"
                        id="inputEmail1"
                        placeholder="Ejm: 5816-4P"
                    >

                    @error('num_autorizacion')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group pl-2 pr-2">
                    <label for="inputEmail3">Vigencia Autorización</label>
                    <input type="text"
                        name="vigencia_autorizacion"
                        class="form-control @error('vigencia_autorizacion') is-invalid  @enderror"
                        value="{{ old('vigencia_autorizacion', $tarjeta->vigencia_autorizacion) }}"
                        id="inputEmail1"
                        placeholder="Ejm: 26/08 AL 26/09"
                    >

                    @error('vigencia_autorizacion')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

            </fieldset>
        </div>
    @endif

</div>

<button class="btn btn-info text-white form-group mt-3 btn-lg" type="submit">{{ $btn }}</button>

@push('scripts')
<script>
    function myFunction() {
        let checkBox = document.getElementById("myCheck");
        let natural = document.getElementById("natural");
        let juridica = document.getElementById("juridica");

        if (checkBox.checked == true){
            natural.style.display = "block";
            juridica.style.display = "none";
        } else {
            natural.style.display = "none";
            juridica.style.display = "block";
        }
    }
</script>
@endpush
