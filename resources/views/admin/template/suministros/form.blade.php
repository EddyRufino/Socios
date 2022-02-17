<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nombre">Nombre Del Lote *</label>
            <input type="text"
                name="nombre"
                class="form-control @error('nombre') is-invalid  @enderror"
                value="{{ old('nombre', $suministro->nombre) }}"
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
                    {{ old('status', 1) == $suministro->status ? 'selected' : '' }}
                >
                    Hábil
                </option>
                <option value="0"
                    {{ old('status', 0) == $suministro->status ? 'selected' : '' }}
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
            <label for="monto_pvc">Monto PVC *</label>
            <input type="number"
                name="monto_pvc"
                class="form-control @error('monto_pvc') is-invalid  @enderror"
                value="{{ old('monto_pvc', $suministro->monto_pvc) }}"
                placeholder="Ejm: 2 500"
                required
            >

            @error('monto_pvc')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="monto_cinta">Monto Cinta *</label>
            <input type="number"
                name="monto_cinta"
                class="form-control @error('monto_cinta') is-invalid  @enderror"
                value="{{ old('monto_cinta', $suministro->monto_cinta) }}"
                id="inputEmail4"
                placeholder="Ejm: 2 500"
                required
            >

            @error('monto_cinta')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="monto_holograma">Monto Holograma *</label>
            <input type="number"
                name="monto_holograma"
                class="form-control @error('monto_holograma') is-invalid  @enderror"
                value="{{ old('monto_holograma', $suministro->monto_holograma) }}"
                id="inputEmail4"
                placeholder="Ejm: 2 500"
                required
            >

            @error('monto_holograma')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="inputEmail1">Fecha Aquisición *</label>
        <input type="date"
            name="fecha_adquisicion"
            min="2015-01-01" max="2030-12-31" required
            class="form-control @error('fecha_adquisicion') is-invalid  @enderror"
            value="{{ request()->routeIs('sumunistros.edit') ? $sumunistro->fecha_adquisicion : date("Y-m-d") }}"
            id="inputCity"
        >

        @error('fecha_adquisicion')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="monto_pruebas">Observaciones</label>
            <textarea
                name="description"
                class="form-control @error('description') is-invalid  @enderror"
                rows="2"
            >
                {{ old('description', $suministro->description) }}
            </textarea>

            @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>
    @if (request()->routeIs('suministros.edit'))
        <div class="col-md-6">
            <div class="form-group">
                <label for="monto_pruebas">Monto Pruebas</label>
                <input type="number"
                    name="monto_pruebas"
                    class="form-control @error('monto_pruebas') is-invalid  @enderror"
                    value="{{ old('monto_pruebas', $suministro->monto_pruebas) }}"
                    id="inputEmail4"
                    placeholder="Ejm: 1 500"
                >

                @error('monto_pruebas')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
    @endif
</div>

