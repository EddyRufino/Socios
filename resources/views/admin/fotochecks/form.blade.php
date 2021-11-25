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
                    value="{{ old('nombre_socio', optional($fotocheck->socio)->nombre_socio) }}"
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
                <label for="exampleFormControlFile1">Foto</label>
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
            <div class="custom-control custom-checkbox mt-3">
                <input type="checkbox" class="custom-control-input" id="myCheck" onclick="myFunction()">
                <label class="custom-control-label" for="myCheck">Persona Natural</label>
            </div>
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
                        required
                    >

                    @error('expedicion')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputEmail1">Revalidación</label>
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

        <fieldset class="boder-1">
            <legend class="text-legend-transportador legend p-2">
                Vehículo
            </legend>

            <div class="form-group pl-2 pr-2">
                <label for="inputEmail2">Tipo Vehículo</label>
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
                <label for="inputEmail1">N. Placa</label>
                <input type="text"
                    name="num_placa"
                    class="form-control @error('num_placa') is-invalid  @enderror"
                    value="{{ old('num_placa', $fotocheck->num_placa) }}"
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
        function myFunction() {
            let checkBox = document.getElementById("myCheck");
            let natural = document.getElementById("natural");
            let asociacione_id = document.getElementById("asociacione_id");

            asociacione_id.value = '';

            if (checkBox.checked == true){
                natural.style.display = "none";
            } else {
                natural.style.display = "block";
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://www.jqueryscript.net/demo/Bootstrap-4-Dropdown-Select-Plugin-jQuery/dist/js/bootstrap-select.js"></script>
@endpush
