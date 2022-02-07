<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nombre">Título *</label>
            <input type="text"
                name="title"
                class="form-control @error('title') is-invalid  @enderror"
                value="{{ old('title', $area->title) }}"
                id="inputEmail4"
                placeholder="Ejm: Diseño Uno"
                required
            >

            @error('title')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="nombre">Sub Título *</label>
            <input type="text"
                name="sub_title"
                class="form-control @error('sub_title') is-invalid  @enderror"
                value="{{ old('sub_title', $area->sub_title) }}"
                id="inputEmail4"
                placeholder="Ejm: Diseño Uno"
                required
            >

            @error('sub_title')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>
</div>