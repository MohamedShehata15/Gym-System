@php
    $managerRole = Auth::user()->role;
    if($managerRole == 'coach') {
        $path = "coaches";
        $reoute = "coaches.index";
    } else {
        $path = "/";
        $route = "home";
    }
@endphp

<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route($route) }}" class="nav-link {{ Request::is($path) ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
@if( $managerRole== 'coach')
<li class="nav-item">
    <a href="{{route('coaches.profile')}}" class="nav-link {{Request::is('coaches/profile/show') ? 'active' : ''}}">
        <i class="nav-icon fas fa-user"></i>
        <p>Profile</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('coaches.sessions')}}" class="nav-link {{Request::is('coaches/sessions') ? 'active' : ''}}">
        <i class="nav-icon fas fa-calendar-check"></i>
        <p>Sessions</p>
    </a>
</li>
@endif
