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
               {{-- @if (auth()->user()->hasRoles(['admin', 'cobrador', 'secretaria'])) --}}
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="nav-icon fas fa-search"></i>
                            <p>
                                Buscar Conductor
                            </p>
                        </a>
                    </li>
               {{-- @endif --}}

                {{-- @if (auth()->user()->hasRoles(['admin', 'cobrador', 'secretaria'])) --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-magic"></i>
                            <p>
                                Deuda Automatica
                            </p>
                        </a>
                    </li>
                {{-- @endif --}}

                {{-- @if (auth()->user()->hasRoles(['admin', 'cobrador', 'secretaria'])) --}}
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-tachometer-alt"></i>
                        <p>
                            Panel De Control
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Panel General
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- @endif --}}

                {{-- @if (auth()->user()->hasRoles(['admin', 'cobrador', 'secretaria'])) --}}
                    <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fa fa-users"></i>
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
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear Puesto</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                {{-- @endif --}}

                {{-- @if (auth()->user()->hasRoles(['admin', 'secretaria'])) --}}
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-random"></i>
                        <p>
                            N. Operación
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sisa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Baño</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Promoción</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- @endif --}}

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

                {{-- @if (auth()->user()->hasRoles(['admin', 'secretaria'])) --}}
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>
                            Control De Pagos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Listar Pago Sisa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Listar Deuda Sisa</p>
                            </a>
                        </li>
{{--                         <li class="nav-item">
                            <a href="{{ route('pagoanticipado.sisa.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Listar Pago Anticipado</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nuevo Pago</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- @endif --}}

                {{-- @if (auth()->user()->hasRoles(['admin', 'secretaria'])) --}}
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-map-marker-alt"></i>
                        <p>
                          Ubicaciones
                          <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Listar Ubicaciones</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear Ubicación</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- @endif --}}

                {{-- @if (auth()->user()->hasRoles(['admin', 'secretaria'])) --}}
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Actividades
                            <i class="right fas fa-angle-left"></i>
                          </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Listar Actividades</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear Actividad</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- @endif --}}

                {{-- @if (auth()->user()->hasRoles(['admin', 'secretaria', 'cobrador'])) --}}
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>
                          Talonarios
                          <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Listar Talonarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear Talonario</p>
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
                            Usuarios del Sistema
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

