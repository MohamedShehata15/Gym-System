@php
    $managerRole = Auth::user()->role;
    if($managerRole == 'coach') {
        $path = "coaches";
        $route = "coaches.index";
    } else {
        $path = "/";
        $route = "home";
    }
@endphp

@if( $managerRole== 'city_manager')
 <li class="w-100">
    <div class="accordion w-100" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
          <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
            <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>Home</p>
            </a>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
              Gyms
            </button>
          </h2>
          <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
            <div class="accordion-body">
               <strong class="text-danger">
                  
                           <a href="{{ route('gyms.create') }}" class=" {{ Request::is('gyms.create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <span>Add GYM</span>
                           </a>
                           <a href="{{ route('gyms.index') }}" class="nav-link {{ Request::is('gyms.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>ListGyms</p>
                           </a>                   
            </strong> 
            </div>
          </div>
        </div>
      </div>
 </li>
@endif

<!-- need to remove -->
@yield('menubar')
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
