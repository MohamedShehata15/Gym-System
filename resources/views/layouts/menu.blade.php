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
<li class="nav-item">
    <a href="{{ route($route) }}" class="nav-link {{ Request::is($path) ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
@yield('menubar')

@if( $managerRole== 'admin')
<!--City Manager Tab-->
<li class="nav-item has-treeview">
            <a href=".multi-collapse" class="nav-link active text-white" data-toggle="collapsing" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">
              <i class="nav-icon fas fa fa-user"></i>
              <p>
               City Managers
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('city-managers.index') }}" class="nav-link active  multi-collapse" id="multiCollapseExample1">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List City Managers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('city-managers.create') }}" class="nav-link  multi-collapse" id="multiCollapseExample2">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add City Manager</p>
                </a>
              </li>
            </ul>
          </li>
<!--GYm Managers Tab-->
          <li class="nav-item has-treeview">
            <a href=".multi-collapse" class="nav-link bg-success" data-toggle="collapsing" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">
              <i class="nav-icon fas fa fa-user"></i>
              <p>
              Gym Managers
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('gym-managers.index') }}" class="nav-link active  multi-collapse" id="multiCollapseExample1">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Gym Managers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('gym-managers.create') }}" class="nav-link  multi-collapse" id="multiCollapseExample2">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Gym Manager</p>
                </a>
              </li>
            </ul>
          </li>
<!--Users Tab-->
<li class="nav-item has-treeview">
            <a href=".multi-collapse" class="nav-link bg-warning text-white" data-toggle="collapsing" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">
              <i class="nav-icon fas fa fa-user"></i>
              <p>
               Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link active  multi-collapse" id="multiCollapseExample1">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('users.create')}}" class="nav-link  multi-collapse" id="multiCollapseExample2">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
            </ul>
          </li>
@endif





@if( $managerRole== 'city_manager')
 <li class="w-100">
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
