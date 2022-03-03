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