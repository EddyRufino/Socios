<div class="row">
    <div class="col-md-8">
        <fieldset class="boder-1 p-2">
            <legend class="legend">
                Asociación
            </legend>

            <div class="form-group">
                <label for="inputEmail4 font-weight-bold">Nombre</label>
                <input type="text"
                    name="nombre"
                    class="form-control @error('nombre') is-invalid  @enderror"
                    value="{{ old('nombre', $asociacione->nombre) }}"
                    id="inputEmail4"
                    placeholder="Ejm: San Pablo"
                    required
                >

                @error('nombre')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </fieldset>
    </div>
</div>

<button class="btn btn-info text-white form-group mt-3 btn-lg" type="submit">{{ $btn }}</button>
