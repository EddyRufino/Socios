    <div class="mb-4 d-flex flex-column justify-content-center align-items-center">
        <form action="{{ route('search.advanced') }}" >
            @csrf
            <span class="text-dark font-weight-bold">Encuentra socios por identificación - vehículo - asociación</span>
            <div class="input-group input-group-md">
                <select name="tipo" class="form-control" required>
                    <option value="1">Tarjeta Circulación</option>
                    <option value="2">Fotocheck</option>
                </select>



                <select name="asociacione_id" class="form-control selectpicker" data-size="7" data-live-search="true" required>
                    <option value="">Asociación</option>
                    @foreach ($asociaciones as $asociacione)
                        <option value="{{ $asociacione->id }}">{{ $asociacione->nombre }}</option>
                    @endforeach
                </select>

                <select name="vehiculo_id" class="form-control" required>
                    <option>Vehículo</option>
                    @foreach ($vehiculos as $vehiculo)
                        <option value="{{ $vehiculo->id }}">{{ $vehiculo->nombre }}</option>
                    @endforeach
                </select>

                <div class="input-group-append">
                    <button class="btn btn-navbar bg-primary text-white" type="submit">
                        @include('icons.icon-search')
                    </button>
                </div>
            </div>
        </form>

{{--         <form action="{{ route('search.advanced.tree') }}" class="mt-4">
            @csrf

            <span class="text-dark font-weight-bold">Encuentra socios por vehículo - asociación</span>
            <div class="input-group input-group-md ">
                <select name="vehiculo_id_tree" class="form-control" required>
                    <option value="">Vehículo</option>
                    @foreach ($vehiculos as $vehiculo)
                        <option value="{{ $vehiculo->id }}">{{ $vehiculo->nombre }}</option>
                    @endforeach
                </select>

                <select name="asociacione_id_tree" id="" class="form-control selectpicker" data-size="7" data-live-search="true" required>
                    <option>Filtra Asociaciones</option>
                    @foreach ($asociaciones as $asociacione)
                        <option value="{{ $asociacione->id }}">{{ $asociacione->nombre }}</option>
                    @endforeach
                </select>

                <div class="input-group-append">
                    <button class="btn btn-navbar bg-primary text-white" type="submit">
                        @include('icons.icon-search')
                    </button>
                </div>
            </div>
        </form> --}}

        <form action="{{ route('search.advanced.two') }}" class="mt-4">
            @csrf

            <span class="text-dark font-weight-bold">Encuentra socios por asociación</span>
            <div class="input-group input-group-md ">
                <select name="asociacione_id_two" id="" class="form-control selectpicker" data-size="7" data-live-search="true" required>
                    <option value="">Filtra Asociaciones</option>
                    @foreach ($asociaciones as $asociacione)
                        <option value="{{ $asociacione->id }}">{{ $asociacione->nombre }}</option>
                    @endforeach
                </select>

                <div class="input-group-append">
                    <button class="btn btn-navbar bg-primary text-white" type="submit">
                        @include('icons.icon-search')
                    </button>
                </div>
            </div>
        </form>
    </div>


    <link rel="stylesheet" href="https://www.jqueryscript.net/demo/Bootstrap-4-Dropdown-Select-Plugin-jQuery/dist/css/bootstrap-select.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://www.jqueryscript.net/demo/Bootstrap-4-Dropdown-Select-Plugin-jQuery/dist/js/bootstrap-select.js"></script>
