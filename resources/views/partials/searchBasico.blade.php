    <div class="d-flex justify-content-center">
        <div id="search" class="mb-4" style="display: none;">
            <form action="{{ route($link) }}">
                @csrf

                <span class="text-dark font-weight-bold">Encuentra socios</span>
                <div class="input-group input-group-md">

                    <input class="form-control form-control-navbar"
                        name="search" type="search"
                        placeholder="Socio - DNI"
                        aria-label="Search"
                        value="{{ request()->search }}"
                        required
                    >

                    <div class="input-group-append">
                        <button class="btn btn-navbar bg-primary text-white" type="submit">
                            @include('icons.icon-search')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
