<ul class="nav nav-tabs mb-2">
    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin') ? 'active' : ''  ? 'active' : '' }}"
           href="{{ route('admin.home') }}">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/users*') ? 'active' : ''  ? 'active' : '' }}"
           href="{{ route('admin.users.index') }}">Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/regions*') ? 'active' : ''  ? 'active' : '' }}"
           href="{{ route('admin.regions.index') }}">Regions</a>
    </li>
</ul>