<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <a href="{{ route('tarjetas.index') }}"
            class="btn btn-outline-info {{ request()->routeIs('tarjetas.index') ? 'font-weight-bold text-white btn btn-info ' : '' }}"
        >
            Listar Tarjetas
        </a>
        <a href="{{ route('fotochecks.index') }}"
            class="btn btn-outline-success {{ request()->routeIs('fotochecks.index') ? 'font-weight-bold text-white btn btn-primary ' : '' }}"
        >
            Listar Fotochecks
        </a>
    </div>
    <div>
        <a href="{{ route('tarjetas.create') }}"
            class="btn btn-outline-info {{ request()->routeIs('tarjetas.create') ? 'font-weight-bold text-white btn btn-info ' : '' }}"
        >
            Nueva Tarjeta
        </a>
        <a href="{{ route('fotochecks.create') }}"
            class="btn btn-outline-success {{ request()->routeIs('fotochecks.create') ? 'font-weight-bold text-white btn btn-primary ' : '' }}"
        >
            Nuevo Fotocheck
        </a>
    </div>
</div>
