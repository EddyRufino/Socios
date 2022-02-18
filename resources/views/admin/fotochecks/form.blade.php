@push('styles')
    <link rel="stylesheet" href="https://www.jqueryscript.net/demo/Bootstrap-4-Dropdown-Select-Plugin-jQuery/dist/css/bootstrap-select.css" />

    <style type="text/css">
        /** Search Advanced **/
        .bootstrap-select.form-control:not([class*="col-"]) {
             width: 100% !important;
        }
    </style>
@endpush

<div class="row">
    <input type="hidden" name="disenio" class="@error('disenio') is-invalid @enderror">

    @error('disenio')
        <p style="color: red; display: block; margin-left: 20px; margin-bottom: 20px; background-color: navajowhite; padding: 5px; border-radius: 4px;">{{ $message }}</p>
    @enderror
</div>

<div class="row">
    <input type="hidden" name="suministro" class="@error('suministro') is-invalid @enderror">

    @error('suministro')
        <p style="color: red; display: block; margin-left: 20px; margin-bottom: 20px; background-color: navajowhite; padding: 5px; border-radius: 4px;">{{ $message }}</p>
    @enderror
</div>

{{-- <div class="custom-control custom-checkbox mb-3">
    <input type="checkbox" class="custom-control-input" id="myCheck" onclick="myFunction()">
    <label class="custom-control-label" for="myCheck">Persona Natural / Jurídica</label>
</div> --}}
@if (request()->routeIs('fotochecks.create'))
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tipo_persona" value="2" onchange="mostrar(this.value);">
                <label class="form-check-label" for="myCheck">
                    Persona Natural
                </label>
            </div>

        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tipo_persona" value="3" onchange="mostrar(this.value);">
                <label class="form-check-label" for="myCheckJuridica">
                    Persona Jurídica
                </label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tipo_persona" value="1" onchange="mostrar(this.value);" checked>
                <label class="form-check-label" for="myCheck">
                    Socio
                </label>
            </div>
        </div>
    </div>
@endif

@if (request()->routeIs('fotochecks.edit'))
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tipo_persona"
                    value="2" {{ $fotocheck->socio->tipo_persona == 2 ? 'checked' : '' }}
                    onchange="mostrarEdit(this.value);"
                >
                <label class="form-check-label" for="myCheck">
                    Persona Natural
                </label>
            </div>

        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tipo_persona"
                    value="3" {{ $fotocheck->socio->tipo_persona == 3 ? 'checked' : '' }}
                    onchange="mostrarEdit(this.value);"
                >
                <label class="form-check-label" for="myCheckJuridica">
                    Persona Jurídica
                </label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tipo_persona"
                    value="1" {{ $fotocheck->socio->tipo_persona == 1 ? 'checked' : '' }}
                    onchange="mostrarEdit(this.value);"
                >
                <label class="form-check-label" for="myCheck">
                    Socio
                </label>
            </div>
        </div>
    </div>
@endif

<div class="row">
    <div class="col-md-6">
        <fieldset class="boder-1 p-2">
            <legend class="legend">
                Conductor
            </legend>

            <div class="form-group">
                <label for="inputEmail4 font-weight-bold">Nombres y Apellidos *</label>
                <input type="text"
                    name="nombre_socio"
                    class="form-control @error('nombre_socio') is-invalid  @enderror"
                    value="{{ old('nombre_socio', optional($fotocheck->socio)->nombre_socio) }}"
                    id="inputEmail4"
                    placeholder="Ejm: ALBERCA TERESA"
                >

                @error('nombre_socio')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputEmail2">Tipo Documento *</label>
                <select class="form-control @error('tipo_documento_id') is-invalid  @enderror" name="tipo_documento_id">
                    @foreach ($documentos as $documento)
                      <option value="{{ $documento->id }}"
                              {{ old('tipo_documento_id', optional($fotocheck->socio)->tipo_documento_id) == $documento->id ? 'selected' : '' }}>
                        {{ $documento->nombre }}</option>
                    @endforeach
                </select>

                @error('tipo_documento_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                {{-- <label for="inputEmail4 font-weight-bold">D.N.I *</label> --}}
                <input type="number"
                    name="dni_socio"
                    class="form-control @error('dni_socio') is-invalid  @enderror"
                    value="{{ old('dni_socio', optional($fotocheck->socio)->dni_socio) }}"
                    id="inputEmail4"
                    placeholder="Ejm: 77577145"
                >

                @error('dni_socio')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-">
                <label for="exampleFormControlFile1">Foto *</label>
                <input type="file" name="image" class="form-control-file @error('image') is-invalid  @enderror" id="exampleFormControlFile1">

                @error('image')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror

                @if (request()->routeIs('fotochecks.edit'))
                    <div class="mt-3">
                        <img
                            src="{{ asset($fotocheck->image) }}"
                            alt="{{ $fotocheck->nombre }}"
                            class="img-thumbnail"
                            style="width: 120px; height: 120px;"
                        >
                    </div>
                @endif
            </div>

        </fieldset>

        <fieldset class="boder-1 p-2">
            <legend class="legend">
                Observación
            </legend>

            <div class="form-group">
                <textarea
                    name="descripcion"
                    class="form-control @error('descripcion') is-invalid  @enderror"
                    rows="2"
                >
                    {{ old('descripcion', $fotocheck->descripcion) }}
                </textarea>

                @error('descripcion')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

        </fieldset>

{{--         <fieldset class="boder-1 p-2">
            <legend class="legend">
                Propietario
            </legend>

            <div class="form-group pl-2 pr-2">
                <label for="inputEmail1">Nombres</label>
                <input type="text"
                    name="nombre_propietario"
                    class="form-control @error('nombre_propietario') is-invalid  @enderror"
                    value="{{ old('nombre_propietario', optional($fotocheck->socio)->nombre_propietario) }}"
                    id="inputEmail1"
                    placeholder="Ejm: JUAN Y SANDRA"
                >

                @error('nombre_propietario')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

        </fieldset> --}}

{{--             <div class="custom-control custom-checkbox mt-3">
                <input type="checkbox" class="custom-control-input" id="myCheck" onclick="myFunction()">
                <label class="custom-control-label" for="myCheck">Persona Natural / Jurídica</label>
            </div> --}}
    </div>
    <div class="col-md-6">
        <fieldset class="boder-1 p-2" >
            <legend class="legend">
                Autorización
            </legend>

                <div class="form-group">
                    <label for="inputEmail1">Expedición</label>
                    <input type="date"
                        name="expedicion"
                        min="2015-01-01" max="2030-12-31" required
                        class="form-control @error('expedicion') is-invalid  @enderror"
                        value="{{ request()->routeIs('fotochecks.edit') ? $fotocheck->expedicion : date("Y-m-d") }}"
                        id="inputCity"
                    >

                    @error('expedicion')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputEmail1">Revalidación *</label>
                    <input type="date"
                        name="revalidacion"
                        min="2015-01-01" max="2030-12-31" required
                        class="form-control @error('revalidacion') is-invalid  @enderror"
                        value="{{ request()->routeIs('fotochecks.edit') ? $fotocheck->revalidacion : date("Y-m-d") }}"
                        id="inputCity"
                        required
                    >

                    @error('revalidacion')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
        </fieldset>

        @if (request()->routeIs('fotochecks.create'))
            <fieldset class="boder-1 " id="natural">
                <legend class="text-legend-transportador legend p-2">
                    Transportador Autorizado
                </legend>

                <div class="form-group pl-2 pr-2">
                    <label for="inputEmail2">Asociación</label>
                    <select id="asociacione_id" data-size="7" class="form-control selectpicker @error('asociacione_id') is-invalid  @enderror" name="asociacione_id" data-live-search="true">
                        <option value="">Selecciona una asociación</option>
                        @foreach ($asociaciones as $asociacione)

                            <option value="{{ $asociacione->id }}"
                                {{ old('asociacione_id', optional($fotocheck->socio)->asociacione_id) == $asociacione->id ? 'selected' : '' }}
                            >
                                {{ $asociacione->nombre }}
                            </option>

                        @endforeach
                    </select>

                    @error('asociacione_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

            </fieldset>
        @endif


        @if (request()->routeIs('fotochecks.edit'))
            <fieldset class="boder-1 " id="natural" style="{{ $fotocheck->socio->tipo_persona == 1 || !isset($fotocheck->socio->tipo_persona) ? 'display: block' : 'display: none' }}">
                <legend class="text-legend-transportador legend p-2">
                    Transportador Autorizado
                </legend>

                <div class="form-group pl-2 pr-2">
                    <label for="inputEmail2">Asociación</label>
                    <select id="asociacione_id" data-size="7" class="form-control selectpicker @error('asociacione_id') is-invalid  @enderror" name="asociacione_id" data-live-search="true">
                        <option value="">Selecciona una asociación</option>
                        @foreach ($asociaciones as $asociacione)

                            <option value="{{ $asociacione->id }}"
                                {{ old('asociacione_id', optional($fotocheck->socio)->asociacione_id) == $asociacione->id ? 'selected' : '' }}
                            >
                                {{ $asociacione->nombre }}
                            </option>

                        @endforeach
                    </select>

                    @error('asociacione_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

            </fieldset>
        @endif

        <fieldset class="boder-1">
            <legend class="text-legend-transportador legend p-2">
                Vehículo
            </legend>

            <div class="form-group pl-2 pr-2">
                <label for="inputEmail2">Tipo Vehículo *</label>
                <select class="form-control @error('vehiculo_id') is-invalid  @enderror" name="vehiculo_id">
                    <option value="">Selecciona un vehículo</option>
                    @foreach ($vehiculos as $vehiculo)
                      <option value="{{ $vehiculo->id }}"
                              {{ old('vehiculo_id', $fotocheck->vehiculo_id) == $vehiculo->id ? 'selected' : '' }}>
                        {{ $vehiculo->nombre }}</option>
                    @endforeach
                </select>

                @error('vehiculo_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group pl-2 pr-2">
                <label for="inputEmail1">N° Autorización</label>
                <input type="text"
                    name="num_autorizacion"
                    class="form-control @error('num_autorizacion') is-invalid  @enderror"
                    value="{{ old('num_autorizacion', $fotocheck->num_autorizacion) }}"
                    id="inputEmail1"
                    placeholder="Ejm: 5816-4P"
                >

                @error('num_autorizacion')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

{{--             <div class="form-group pl-2 pr-2">
                <label for="inputEmail1">N. Placa</label>
                <input type="text"
                    name="num_placa"
                    class="form-control @error('num_placa') is-invalid  @enderror"
                    value="{{ old('num_placa', $fotocheck->num_placa) }}"
                    id="inputEmail1"
                    placeholder="Ejm: 5816-4P"
                >

                @error('num_placa')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div> --}}
        </fieldset>
    </div>
</div>

<div class="row col">
    <div class="col-md-6">

    </div>

</div>

<div>

    <button class="btn float-right text-white form-group mt-3 mr-3" type="submit"
        style="background-color: rgba(42,67,101,1) !important"
    >
        {{ $btn }}
    </button>
</div>

@push('scripts')
    <script>
    function mostrar(dato) {
        if (dato == "1") {
            document.getElementById("natural").style.display = "block";
            document.getElementById("juridica").style.display = "none";            
        }
        if (dato == "2") {
            document.getElementById("natural").style.display = "none";
            document.getElementById("juridica").style.display = "block";
        }
        if (dato == "3") {
            document.getElementById("natural").style.display = "none";
            document.getElementById("juridica").style.display = "block";
        }
    }

    function mostrarEdit(dato) {

        let asociacione_id = document.getElementById("asociacione_id");

        // Quitar el valor
        asociacione_id.value = '';

        if (dato == "1") {
            document.getElementById("natural").style.display = "block";
            document.getElementById("juridica").style.display = "none";
        }
        if (dato == "2") {
            document.getElementById("natural").style.display = "none";
            document.getElementById("juridica").style.display = "block";

        }
        if (dato == "3") {
            document.getElementById("natural").style.display = "none";
            document.getElementById("juridica").style.display = "block";
        }
    }
        // function myFunction() {
        //     let checkBox = document.getElementById("myCheck");
        //     let natural = document.getElementById("natural");
        //     let asociacione_id = document.getElementById("asociacione_id");

        //     asociacione_id.value = '';

        //     if (checkBox.checked == true){
        //         natural.style.display = "none";
        //     } else {
        //         natural.style.display = "block";
        //     }
        // }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://www.jqueryscript.net/demo/Bootstrap-4-Dropdown-Select-Plugin-jQuery/dist/js/bootstrap-select.js"></script>
@endpush
