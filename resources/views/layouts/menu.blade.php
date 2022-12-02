<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('orders.create') }}" class="nav-link {{ Route::is('orders.create') ? 'active' : '' }}">
        <i class="fas fa-cash-register nav-icon"></i>
        <p>Punto de Venta</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('products.index') }}" class="nav-link {{ Route::is('products.*') ? 'active' : '' }}">
        <i class="fas fa-boxes nav-icon"></i>
        <p>Productos</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('users.index') }}" class="nav-link {{ Route::is('users.*') ? 'active' : '' }}">
        <i class="fas fa-users nav-icon"></i>
        <p>Usuarios</p>
    </a>
</li>
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
        </li>
    </ul>
</li>