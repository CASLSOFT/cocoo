<div class="menu">
    <ul class="list">
        <li class="header">Menu de Navegación de {{ Auth()->user()->username }}</li>
        <li class="active">
            <a href="{{ route('home') }}">
                <i class="material-icons">home</i>
                <span>Home</span>
            </a>
        </li>

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons col-indigo">account_box</i>
                <span>Empleados</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="{{ route('employee.create') }}">
                        <i class="material-icons col-light-blue">add_circle_outline</i>
                        <span>Adicionar</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('employee.index') }}">
                        <i class="material-icons col-amber">search</i>
                        <span>Consultar</span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons col-green">list_alt</i>
                <span>Novedades</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons col-light-blue">dock</i>
                        <span>Novedades</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('novelty.create') }}">
                                <i class="material-icons col-light-blue">add_circle_outline</i>
                                <span>Adicionar</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('novelty.list') }}">
                                <i class="material-icons col-amber">search</i>
                                <span>Consultar</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('he.create') }}">
                        <i class="material-icons col-light-blue">hourglass_empty</i>
                        <span>HE y Comisiones</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('retention.create') }}">
                        <i class="material-icons col-light-blue">dns</i>
                        <span>Retención en la Fuente</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tnl.create') }}">
                        <i class="material-icons col-light-blue">event_seat</i>
                        <span>Tiempos No Laborados</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('holiday.create') }}">
                        <i class="material-icons col-light-blue">flight_takeoff</i>
                        <span>Vacaciones</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons col-light-blue">account_balance</i>
                        <span>Libranzas</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('libranza.create') }}">
                                <i class="material-icons col-light-blue">add_circle_outline</i>
                                <span>Adicionar</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('libranza.index') }}">
                                <i class="material-icons col-amber">search</i>
                                <span>Consultar</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tbAmortizacion.tbAmortizacion') }}">
                                <i class="material-icons col-amber">table_chart</i>
                                <span>Tabla Amortizacion</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">settings</i>
                <span>Configuración</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="{{ route('permissions.assing.nomina') }}">
                        <i class="material-icons col-light-blue">add_circle_outline</i>
                        <span>Asignar Permiso a Roles</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="javascript:void(0);">
                        <span>Menu Item - 2</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons col-green">list_alt</i>
                        <span>Roles y Permisos</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('roles.create') }}">
                                <i class="material-icons col-light-blue">add_circle_outline</i>
                                <span>Crear Role</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('permissions.create') }}">
                                <i class="material-icons col-light-blue">add_circle_outline</i>
                                <span>Crear Permisos</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <span>Level - 3</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="javascript:void(0);">
                                        <span>Level - 4</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </li>
    </ul>
</div>