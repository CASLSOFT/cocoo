<div class="menu">
    <ul class="list">
        <li class="header">Menu de Navegación de {{ Auth()->user()->username }}</li>
        <li >
            <a href="{{ route('home') }}">
                <i class="material-icons">home</i>
                <span>Home</span>
            </a>
        </li>
        <li >
            <a href="{{ route('requisiciones') }}">
                <i class="material-icons col-red">dashboard</i>
                <span>Dashboar</span>
            </a>
        </li>
        <li>
            @can('order.create')
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons col-indigo">account_balance</i>
                <span>Realizar Pedidos</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="{{ url('/requisiciones/papeleria') }}">
                        <i class="material-icons col-pink">playlist_add_check</i>
                        <span>Papeleria</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/requisiciones/aseo') }}">
                        <i class="material-icons col-cyan">local_laundry_service</i>
                        <span>Aseo</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/requisiciones/cafeteria') }}">
                        <i class="material-icons col-light-green">local_cafe</i>
                        <span>Cafeteria</span>
                    </a>
                </li>
            </ul>
            @endcan
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons col-indigo">beenhere</i>
                <span>Articulos</span>
            </a>
            <ul class="ml-menu">
                @can('article.create')
                <li>
                    <a href="{{ route('article.create') }}">
                        <i class="material-icons col-light-blue">add_circle_outline</i>
                        <span>Adicionar</span>
                    </a>
                </li>
                @endcan
                @can('article.list')
                <li>
                    <a href="{{ route('article.index') }}">
                        <i class="material-icons col-amber">search</i>
                        <span>Consultar</span>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @can('provider.create')
        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons col-indigo">local_shipping</i>
                <span>Proveedores</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="{{ route('provider.create') }}">
                        <i class="material-icons col-light-blue">add_circle_outline</i>
                        <span>Adicionar</span>
                    </a>
                </li>
            </ul>
        </li>
        @endcan
        @can('order.approvalorder')
        <li>
            <a href="{{ route('approval.order.user') }}">
                <i class="material-icons col-indigo">assignment</i>
                <span>Aprobar Pedidos</span>
            </a>
        </li>
        @endcan
        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons col-indigo">list</i>
                <span>Informes</span>
            </a>
            <ul class="ml-menu">
                @can('order.listuser')
                <li>
                    <a href="{{ url('/requisiciones/user/list') }}">
                        <i class="material-icons col-amber">bookmark_border</i>
                        <span>Mis Ordenes de Pedido</span>
                    </a>
                </li>
                @endcan
                @can('order.draftsuser', Model::class)
                <li>
                    <a href="{{ url('requisiciones/drafts') }}">
                        <i class="material-icons col-amber">drafts</i>
                        <span>Ordenes en Borrador</span>
                    </a>
                </li>
                @endcan
                @can('order.listordershopping')
                <li>
                    <a href="{{ url('requisiciones/shopping') }}">
                        <i class="material-icons col-amber">list</i>
                        <span>Ordenes en Proceso de Compra</span>
                    </a>
                </li>
                @endcan
                @can('order.listorderdespacho')
                <li>
                    <a href="{{ url('requisiciones/despacho') }}">
                        <i class="material-icons col-amber">local_shipping</i>
                        <span>Ordenes en Despacho</span>
                    </a>
                </li>
                @endcan
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">settings</i>
                <span>Configuración</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="{{ route('permissions.assing.requisiciones') }}">
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