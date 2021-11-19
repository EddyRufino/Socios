    <div  class="mb-4">
        <form action="{{ route('search.advanced') }}" class="form-inline">
            @csrf
            <div class="input-group input-group-md">
                <select name="tipo" id="" class="form-control" required>
                    <option value="1">Tarjeta Circulación</option>
                    <option value="2">Fotocheck</option>
                </select>

                <select name="vehiculo_id" id="" class="form-control" required>
                    <option>Vehículo</option>
                    @foreach ($vehiculos as $vehiculo)
                        <option value="{{ $vehiculo->id }}">{{ $vehiculo->nombre }}</option>
                    @endforeach
                </select>

                <select name="asociacione_id" id="" class="form-control selectpicker" data-size="7" data-live-search="true" required>
                    <option>Asociación</option>
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
