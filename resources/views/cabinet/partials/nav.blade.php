<ul class="nav nav-tabs mb-2">
    <li class="nav-item">
        <a class="nav-link {{ request()->is('cabinet') ? 'active' : ''  ? 'active' : '' }}"
           href="{{ route('cabinet.home') }}">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('cabinet/profile*') ? 'active' : ''  ? 'active' : '' }}"
           href="{{ route('cabinet.profile.home') }}">Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('cabinet/adverts*') ? 'active' : ''  ? 'active' : '' }}"
           href="{{ route('cabinet.adverts.index') }}">Adverts</a>
    </li>
</ul>