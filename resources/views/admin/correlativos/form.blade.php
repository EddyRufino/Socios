<div class="row">
    <div class="col-md-8">
        <fieldset class="boder-1 p-2">
            <legend class="legend">
                Correlativo
            </legend>

            <div class="form-group">
                <label for="inputEmail4 font-weight-bold">Número</label>
                <input type="text"
                    name="num_correlativo"
                    class="form-control @error('num_correlativo') is-invalid  @enderror"
                    value="{{ old('num_correlativo', $correlativo->num_correlativo) }}"
                    id="inputEmail4"
                    placeholder="Ejm: San Pablo"
                    required
                >
                <i class="text-secondary">La siguiente tarjeta será número + 1</i>

                @error('num_correlativo')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </fieldset>
    </div>
</div>

<button class="btn float-right text-white form-group mt-3"
    type="submit"
    style="background-color: rgba(42,67,101,1) !important"
>
    {{ $btn }}
</button>
