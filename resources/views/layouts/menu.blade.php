
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Gym Managers</p>
    </a>
    <a href="{{ route('gyms.index') }}" class="nav-link {{ Request::is('gyms.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Gyms</p>
    </a>

    {{-- <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('gyms.create') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Add GYM</p>
        </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('gyms.index') }}" class="nav-link {{ Request::is('gyms.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>Gyms2</p>
            </a>
        </li>
    </ul> --}}
   
</li>

