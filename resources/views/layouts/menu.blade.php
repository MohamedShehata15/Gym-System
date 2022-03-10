@php
    if(Auth::user()->hasRole('coach')) {
        $path = "coaches";
        $route = "coaches.index";
    } else {
        $path = "/";
        $route = "home";
    }
@endphp
<li class="nav-item">
    <a href="{{ route($route) }}" class="nav-link {{ Request::is($path) ? 'active' : '' }} bg-secondary">
        <i class="nav-icon  fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
@yield('menubar')

@if(Auth::user()->hasRole('Super-Admin'))
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
                <a href="{{ route('city-managers.create') }}" class="nav-link active multi-collapse" id="multiCollapseExample2">
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
                <a href="{{ route('gym-managers.create') }}" class="nav-link active multi-collapse" id="multiCollapseExample2">
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
            </ul>
          </li>
<!--Cities Tab-->
<li class="nav-item has-treeview">
            <a href=".multi-collapse" class="nav-link bg-danger text-white" data-toggle="collapsing" aria-expanded="false" aria-controls="CollapseExample1">
              <i class="nav-icon fas fa fa-building"></i>
              <p>
               Cities
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('cities.index') }}" class="nav-link active  multi-collapse" id="CollapseExample1">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Cities</p>
                </a>
              </li>
              </ul>
          </li>
<!--Training Packages Tab-->
<li class="nav-item has-treeview">
            <a href=".multi-collapse" class="nav-link bg-white " data-toggle="collapsing" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">
              <i class="nav-icon fas fa fa-tags"></i>
              <p>
              Training Packages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('training-packages.index') }}" class="nav-link active  multi-collapse" id="multiCollapseExample1">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Packages</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('training-packages.create')}}" class="nav-link active multi-collapse" id="multiCollapseExample2">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buy a training Package</p>
                </a>
              </li>
            </ul>
          </li>
<!--Coaches tab-->
<li class="nav-item has-treeview">
            <a href=".multi-collapse" class="nav-link bg-purple " data-toggle="collapsing" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">
              <i class="nav-icon fas fa fa-users"></i>
              <p>
              Coaches
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('coaches.index') }}" class="nav-link active  multi-collapse" id="multiCollapseExample1">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Coaches</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('coaches.create')}}" class="nav-link active multi-collapse" id="multiCollapseExample2">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add a Coach</p>
                </a>
              </li>
            </ul>
          </li>
<!--Attendance tab-->
<li class="nav-item has-treeview">
            <a href=".multi-collapse" class="nav-link bg-pink " data-toggle="collapsing" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">
              <i class="nav-icon fas fa fa-check"></i>
              <p>
              Attendance
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('attendance.index') }}" class="nav-link active  multi-collapse" id="multiCollapseExample1">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Show Attendance</p>
                </a>
              </li>
            </ul>
          </li>
<!--Revenue tab-->
<li class="nav-item has-treeview">
            <a href=".multi-collapse" class="nav-link bg-yellow " data-toggle="collapsing" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">
              <i class="nav-icon fas fa fa-calculator"></i>
              <p>
              Revenue
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('attendance.index') }}" class="nav-link active  multi-collapse" id="multiCollapseExample1">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Show Revenue</p>
                </a>
              </li>
            </ul>
          </li>
@endif





@if(Auth::user()->hasRole('city_manager'))
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



@if( Auth::user()->hasRole('coach'))
<li class="nav-item">
    <a href="{{route('coaches.profile', ['id' => Auth::user()->id])}}" class="nav-link {{Request::is('coaches/profile/show') ? 'active' : ''}}">
        <i class="nav-icon fas fa-user"></i>
        <p>Profile</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('coaches.sessions', ['id' => Auth::user()->id])}}" class="nav-link {{Request::is('coaches/sessions') ? 'active' : ''}}">
        <i class="nav-icon fas fa-calendar-check"></i>
        <p>Sessions</p>
    </a>
</li>
@endif
