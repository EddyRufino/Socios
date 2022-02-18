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

    <input type="hidden" name="suministro" class="@error('suministro') is-invalid @enderror">

    @error('suministro')
        <p style="color: red; display: block; margin-left: 20px; margin-bottom: 20px; background-color: navajowhite; padding: 5px; border-radius: 4px;">{{ $message }}</p>
    @enderror    
</div>

@if (request()->routeIs('tarjetas.create'))
    {{-- <div class="custom-control custom-checkbox mb-3">
        <div class="row ml-1">
            <div class="co-md-4">
                <input type="checkbox" class="custom-control-input" id="myCheck" onclick="myFunction()">
                <label class="custom-control-label" for="myCheck">Persona Natural</label>
            </div>
            <div class="col-md-4 ml-3 pl-3">
                <input type="checkbox" class="custom-control-input" id="myCheckJuridica" onclick="myFunctionJuridica()">
                <label class="custom-control-label" for="myCheckJuridica">Persona Jurídica</label>
            </div>
        </div>
    </div> --}}
    {{-- <div class="form-check">
        <div class="row ml-1">
            <div class="co-md-4">
                <input class="form-check-input" type="radio" name="natural" id="myCheck" onclick="myFunction()">
                <label class="form-check-label" for="exampleRadios1">
                    Persona Natural
                </label>
            </div>
            <div class="col-md-4 ml-3 pl-3">
                <input class="form-check-input" type="radio" name="juridica" id="myCheckJuridica" onclick="myFunctionJuridica()">
                <label class="form-check-label" for="exampleRadios2">
                    Persona Jurídica
                </label>
            </div>
        </div>
    </div> --}}
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

<div class="row">
    <div class="col-md-6">
        <fieldset class="boder-1 p-2">
            <legend id="legend-socio" class="text-legend-transportador legend">
                Socio
            </legend>

            <legend id="legend-persona" style="display: none" class="text-legend-transportador legend">
                Natural
            </legend>

            <legend id="legend-persona-juridica" style="display: none" class="text-legend-transportador legend">
                Jurídica
            </legend>

            <div class="form-group">
                <label for="inputEmail4 font-weight-bold">Nombres y Apellidos *</label>
                <input type="text"
                    name="nombre_socio"
                    class="form-control @error('nombre_socio') is-invalid  @enderror"
                    value="{{ old('nombre_socio', optional($tarjeta->socio)->nombre_socio) }}"
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
                <label for="inputEmail2">Tipo Documento *</label>
                <select class="form-control @error('tipo_documento_id') is-invalid  @enderror" name="tipo_documento_id">
                    @foreach ($documentos as $documento)
                      <option value="{{ $documento->id }}"
                              {{ old('tipo_documento_id', optional($tarjeta->socio)->tipo_documento_id) == $documento->id ? 'selected' : '' }}>
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
                    value="{{ old('dni_socio', optional($tarjeta->socio)->dni_socio) }}"
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
                    value="{{ old('nombre_propietario', optional($tarjeta->socio)->nombre_propietario) }}"
                    id="inputEmail4"
                    placeholder="Ejm: ALBERCA YANAYACO"
                >

                @error('nombre_propietario')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
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
                    {{ old('descripcion', $tarjeta->descripcion) }}
                </textarea>

                @error('descripcion')
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
                    <label for="inputEmail1">N. Placa *</label>
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
                    <label for="inputEmail2">Tipo Vehículo *</label>
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
                    <label for="inputEmail2">Asociación *</label>
                    <select data-size="7" class="form-control selectpicker @error('asociacione_id') is-invalid  @enderror" name="asociacione_id" data-live-search="true">
                        <option value="">Selecciona una asociación</option>
                        @foreach ($asociaciones as $asociacione)

                            <option value="{{ $asociacione->id }}"
                                  {{ old('asociacione_id', $tarjeta->asociacione_id) == $asociacione->id ? 'selected' : '' }}
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

                <div class="form-group pl-2 pr-2">
                    <label for="inputEmail1">N. Operación *</label>
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
                    <label for="inputEmail1">Vigencia Operación *</label>
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
            <fieldset class="boder-1">
                <legend class="text-legend-transportador legend p-2">
                    N. Correlativo
                </legend>

                <div class="form-group pl-2 pr-2">
                    <label for="inputEmail3">N. Correlativo</label>
                    <input type="text"
                        name="num_correlativo"
                        class="form-control @error('num_correlativo') is-invalid  @enderror"
                        value="{{ old('num_correlativo', $num_correlativo + 1) }}"
                        id="inputEmail1"
                        placeholder="Ejm: 5816-4P"
                    >

                    @error('num_correlativo')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

            </fieldset>

{{--             <div class="custom-control custom-checkbox mt-3">
                <input type="checkbox" class="custom-control-input" id="myCheck" onclick="myFunction()">
                <label class="custom-control-label" for="myCheck">Persona Natural / Jurídica</label>
            </div> --}}
        </div>

        <div class="col-md-6">
            <fieldset class="boder-1" id="natural" style="display:none">
                <legend class="text-legend-transportador legend p-2">
                    Persona Natural / Jurídica
                </legend>

                <div class="form-group pl-2 pr-2">
                    <label for="inputEmail3">N. Autorización *</label>
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
                    <label for="inputEmail3">Vigencia Autorización *</label>
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

    @if (request()->routeIs('tarjetas.edit') )

            <div class="col-md-6" id="juridica" style="{{ $tarjeta->socio->asociacione_id ? 'display: block' : 'display: none' }}">
                <fieldset class="boder-1">
                    <legend class="text-legend-transportador legend p-2">
                        Transportador Autorizado
                    </legend>

                    <div class="form-group pl-2 pr-2">
                        <label for="inputEmail2">Asociación</label>
                        <select id="asociacione_id" data-size="7" class="form-control selectpicker @error('asociacione_id') is-invalid  @enderror" data-live-search="true" name="asociacione_id">
                            <option value="">Selecciona una asociación</option>
                            @foreach ($asociaciones as $asociacione)

                                <option value="{{ $asociacione->id }}"
                                      {{ old('asociacione_id', optional($tarjeta->socio->asociacione)->id) == $asociacione->id ? 'selected' : '' }}
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

                    <div class="form-group pl-2 pr-2">
                        <label for="inputEmail1">N. Operación</label>
                        <input type="text"
                            name="num_operacion"
                            class="form-control @error('num_operacion') is-invalid  @enderror"
                            value="{{ old('num_operacion', $tarjeta->num_operacion) }}"
                            id="num_operacion"
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
                            id="vigencia_operacion"
                            placeholder="Ejm: 19/09/2019 AL 19/09/2025"
                        >

                        @error('vigencia_operacion')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                </fieldset>

                {{-- <div class="custom-control custom-checkbox mt-3">
                    <input type="checkbox" class="custom-control-input" id="myCheck" onclick="myFunctionEdit()">
                    <label class="custom-control-label" for="myCheck">Persona Natural / Jurídica</label>
                </div> --}}

                {{-- <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" value="2" onchange="mostrarEdit(this.value);">
                            <label class="form-check-label" for="myCheck">
                                Persona Natural
                            </label>
                        </div>
            
                    </div>
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" value="3" onchange="mostrarEdit(this.value);">
                            <label class="form-check-label" for="myCheckJuridica">
                                Persona Jurídica
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" value="1" onchange="mostrarEdit(this.value);" checked>
                            <label class="form-check-label" for="myCheck">
                                Socio
                            </label>
                        </div>
                    </div>
                </div> --}}
            </div>


            <div class="col-md-6" id="showBlock" style="{{ $tarjeta->socio->asociacione_id ? 'display: none' : 'display: block' }}">
                <fieldset class="boder-1" id="natural">
                    <legend class="text-legend-transportador legend p-2">
                        Persona Natural / Jurídica
                    </legend>

                    <div class="form-group pl-2 pr-2">
                        <label for="inputEmail3">N. Autorización</label>
                        <input type="text"
                            name="num_autorizacion"
                            class="form-control @error('num_autorizacion') is-invalid  @enderror"
                            value="{{ old('num_autorizacion', $tarjeta->num_autorizacion) }}"
                            id="num_autorizacion"
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
                            id="vigencia_autorizacion"
                            placeholder="Ejm: 26/08 AL 26/09"
                        >

                        @error('vigencia_autorizacion')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                </fieldset>



                {{-- <div class="custom-control custom-checkbox mt-3">
                    <input type="checkbox" class="custom-control-input" id="myCheck" onclick="myFunctionEdit()">
                    <label class="custom-control-label" for="myCheck">Tiene Asociación</label>
                </div> --}}
            </div>


            <div class="col-md-6">
                <fieldset class="boder-1">
                    <legend class="text-legend-transportador legend p-2">
                        N. Correlativo
                    </legend>

                    <div class="form-group pl-2 pr-2">
                        <label for="inputEmail3">N. Correlativo</label>
                        <input type="text"
                            name="num_correlativo"
                            class="form-control @error('num_correlativo') is-invalid  @enderror"
                            value="{{ old('num_correlativo', $tarjeta->num_correlativo) }}"
                            id="inputEmail1"
                            placeholder="Ejm: 5816-4P"
                        >
                        <i class="text-secondary">Manten ese formato año-N. Correlativo</i>

                        @error('num_correlativo')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                </fieldset>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipo_persona"
                                value="2" {{ $tarjeta->socio->tipo_persona == 2 ? 'checked' : '' }}
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
                                value="3" {{ $tarjeta->socio->tipo_persona == 3 ? 'checked' : '' }}
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
                                value="1" {{ $tarjeta->socio->tipo_persona == 1 ? 'checked' : '' }}
                                onchange="mostrarEdit(this.value);"
                            >
                            <label class="form-check-label" for="myCheck">
                                Socio
                            </label>
                        </div>
                    </div>
                </div>
            </div>


        <div class="col-md-6">

        </div>
    @endif

</div>

<button class="btn float-right text-white form-group mt-3" type="submit"
    style="background-color: rgba(42,67,101,1) !important"
>
    {{ $btn }}
</button>

@push('scripts')

<script>
    function mostrar(dato) {
        if (dato == "1") {
            document.getElementById("legend-socio").style.display = "block";
            document.getElementById("legend-persona").style.display = "none";
            document.getElementById("legend-persona-juridica").style.display = "none";
            document.getElementById("natural").style.display = "none";
            document.getElementById("juridica").style.display = "block";            
        }
        if (dato == "2") {
            document.getElementById("legend-socio").style.display = "none";
            document.getElementById("legend-persona").style.display = "block";
            document.getElementById("legend-persona-juridica").style.display = "none";
            document.getElementById("natural").style.display = "block";
            document.getElementById("juridica").style.display = "none";
        }
        if (dato == "3") {
            document.getElementById("legend-socio").style.display = "none";
            document.getElementById("legend-persona").style.display = "none";
            document.getElementById("legend-persona-juridica").style.display = "block";
            document.getElementById("natural").style.display = "block";
            document.getElementById("juridica").style.display = "none";
        }
    }

    function mostrarEdit(dato) {

        if (dato == "1") {
            document.getElementById("legend-socio").style.display = "block";
            document.getElementById("legend-persona").style.display = "none";
            document.getElementById("legend-persona-juridica").style.display = "none";
            document.getElementById("natural").style.display = "none";
            document.getElementById("juridica").style.display = "block";
            
            let asociacione_id = document.getElementById("asociacione_id");
            let num_operacion = document.getElementById("num_operacion");
            let vigencia_operacion = document.getElementById("vigencia_operacion");
            let num_autorizacion = document.getElementById("num_autorizacion");
            let vigencia_autorizacion = document.getElementById("vigencia_autorizacion");
            
            // Quitar el valor
            asociacione_id.value = '';
            num_operacion.value = '';
            vigencia_operacion.value = '';
            num_autorizacion.value = '';
            vigencia_autorizacion.value = '';
        }
        if (dato == "2") {
            document.getElementById("legend-socio").style.display = "none";
            document.getElementById("legend-persona").style.display = "block";
            document.getElementById("legend-persona-juridica").style.display = "none";

            document.getElementById('showBlock').removeAttribute("style");

            document.getElementById("natural").style.display = "block";
            document.getElementById("juridica").style.display = "none";

        }
        if (dato == "3") {
            document.getElementById("legend-socio").style.display = "none";
            document.getElementById("legend-persona").style.display = "none";
            document.getElementById("legend-persona-juridica").style.display = "block";

            document.getElementById('showBlock').removeAttribute("style");

            document.getElementById("natural").style.display = "block";
            document.getElementById("juridica").style.display = "none";
        }
    }
    // function myFunction() {
    //     let checkBox = document.getElementById("myCheck");
    //     let checkBoxJuridica = document.getElementById("myCheckJuridica");

    //     let natural = document.getElementById("natural");
    //     let juridica = document.getElementById("juridica");

    //     let persona = document.getElementById("legend-persona");
    //     let socio = document.getElementById("legend-socio");
    //     let personaJuridica = document.getElementById("legend-persona-juridica");

    //     if (checkBox.checked == true) {

    //         natural.style.display = "block";
    //         juridica.style.display = "none";

    //         persona.style.display = "block";
    //         socio.style.display = "none";
    //         personaJuridica.display = "none";

    //     } else {
    //         natural.style.display = "none";
    //         juridica.style.display = "block";

    //         persona.style.display = "none";
    //         socio.style.display = "block";

    //         // Pon el valor

    //     }
    // }
</script>

{{-- <script>
    function myFunctionEdit() {
        let checkBox = document.getElementById("myCheck");
        let natural = document.getElementById("natural");
        let juridica = document.getElementById("juridica");

        let asociacione_id = document.getElementById("asociacione_id");
        let num_operacion = document.getElementById("num_operacion");
        let vigencia_operacion = document.getElementById("vigencia_operacion");
        let num_autorizacion = document.getElementById("num_autorizacion");
        let vigencia_autorizacion = document.getElementById("vigencia_autorizacion");

            // Quitar el valor
            asociacione_id.value = '';
            num_operacion.value = '';
            vigencia_operacion.value = '';
            num_autorizacion.value = '';
            vigencia_autorizacion.value = '';

        if (checkBox.checked == true){

            natural.style.display = "block";
            juridica.style.display = "none";



        } else {
            natural.style.display = "none";
            juridica.style.display = "block";

            // Pon el valor

        }
    }
</script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://www.jqueryscript.net/demo/Bootstrap-4-Dropdown-Select-Plugin-jQuery/dist/js/bootstrap-select.js"></script>
@endpush
