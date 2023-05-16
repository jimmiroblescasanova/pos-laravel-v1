<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-store"></i>
        <p>Inicio</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('orders.create') }}" class="nav-link {{ Route::is('orders.create') ? 'active' : '' }}">
        <i class="fas fa-cash-register nav-icon"></i>
        <p>Punto de Venta</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('sales.index') }}" class="nav-link {{ Route::is('sales.*') ? 'active' : '' }}">
        <i class="fas fa-money-bill-alt nav-icon"></i>
        <p>Ventas</p>
    </a>
</li>
@can('products_access')
<li class="nav-item">
    <a href="{{ route('products.index') }}" class="nav-link {{ Route::is('products.*') ? 'active' : '' }}">
        <i class="fas fa-boxes nav-icon"></i>
        <p>Productos</p>
    </a>
</li>
@endcan
@can('inventory_access')
<li class="nav-item">
    <a href="{{ route('inventory.index') }}" class="nav-link {{ Route::is('inventory.*') ? 'active' : '' }}">
        <i class="fas fa-warehouse nav-icon"></i>
        <p>Inventario</p>
    </a>
</li>
@endcan
<li class="nav-item {{ Route::is('reports.*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Route::is('reports.*') ? 'active' : '' }}">
        <i class="fas fa-folder-open nav-icon"></i>
        <p>
            Reportes
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item {{ Route::is('reports.sales.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon"></i>
                <p>Ventas</p>
                <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('reports.sales.daily-sales.index') }}" class="nav-link {{ Route::is('reports.sales.daily-sales.index') ? 'active' : '' }}">
                        <i class="fas fa-angle-double-right nav-icon"></i>
                        <p>Ventas del día</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reports.sales.product-sales.index') }}" class="nav-link {{ Route::is('reports.sales.product-sales.index') ? 'active' : '' }}">
                        <i class="fas fa-angle-double-right nav-icon"></i>
                        <p>Ventas por producto</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link {{ Route::is('reports.inventory.*') ? 'menu-open' : '' }}">
                <i class="nav-icon"></i>
                <p>Inventarios</p>
                <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('reports.inventory.count.index') }}" class="nav-link {{ Route::is('reports.inventory.count.index') ? 'active' : '' }}">
                        <i class="fas fa-angle-double-right nav-icon"></i>
                        <p>Toma de inventario</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>
@can('users_access')
<li class="nav-item">
    <a href="{{ route('access.index') }}" class="nav-link {{ Route::is('access.*') ? 'active' : '' }}">
        <i class="fas fa-users-cog nav-icon"></i>
        <p>Control de Acceso</p>
    </a>
</li>
@endcan
@can('configurations_access')
<li class="nav-item {{ Route::is('settings.*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Route::is('settings.*') ? 'active' : '' }}">
        <i class="fas fa-cogs nav-icon"></i>
        <p>
            Configuraciones
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('settings.business') }}" class="nav-link {{ Route::is('settings.business') ? 'active' : '' }}">
                <i class="fas fa-cog nav-icon"></i>
                Mi empresa
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('settings.ticket') }}" class="nav-link {{ Route::is('settings.ticket') ? 'active' : '' }}">
                <i class="fas fa-users nav-icon"></i>
                <p>Ticket</p>
            </a>
        </li><li class="nav-item">
            <a href="{{ route('settings.groups.index') }}" class="nav-link {{ Route::is('settings.groups.index') ? 'active' : '' }}">
                <i class="fas fa-cog nav-icon"></i>
                Grupos de productos
            </a>
        </li>
    </ul>
</li>
@endcan