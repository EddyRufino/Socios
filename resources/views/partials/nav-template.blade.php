<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('adminlte/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
        <span class="brand-text font-weight-light">Socios</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                    <a href="{{ route('admin.template') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                {{-- @if (auth()->user()->hasRoles(['admin', 'cobrador', 'secretaria'])) --}}
                    <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fa fa-list-alt"></i>
                            <p>
                                Diseños
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('disenios.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listar Diseños</p>
                                </a>
                            </li>
                            {{-- @if (auth()->user()->hasRoles(['admin', 'secretaria'])) --}}
                            <li class="nav-item">
                                <a href="{{ route('disenios.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Subir Diseño</p>
                                </a>
                            </li>
                            {{-- @endif --}}
                        </ul>
                    </li>
                {{-- @endif --}}

                {{-- @if (auth()->user()->hasRoles(['admin', 'secretaria'])) --}}
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-university"></i>
                        <p>
                            Nombre Area
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('areas.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Listar Area</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- @endif --}}

                {{-- <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-print"></i>
                        <p>
                            Impresiones
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('areas.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ver Más</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- @if (auth()->user()->hasRoles(['admin', 'secretaria'])) --}}
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Reportes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('filtro.socio.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Filtros</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('socios.delete') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Socios Eliminados</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tarjetas.delete') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tarjetas Eliminadas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('fotochecks.delete') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fotochecks Eliminados</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- @endif --}}

                {{-- @if (auth()->user()->hasRoles(['admin'])) --}}
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Usuarios - Sistema
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lista usuarios sistema</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.create') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear usuario sistema</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- @endif --}}

            </ul>
        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
