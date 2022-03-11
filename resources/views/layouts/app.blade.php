<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>    @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('starter_script')
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.js"></script>
    
    

    @yield('third_party_stylesheets') 
    
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('styles')
    @stack('page_css')
</head>



<body class="hold-transition sidebar-mini layout-fixed  bg-dark text-white">
<div class="wrapper">
    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto ">
            <li class="nav-item dropdown user-menu ">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/1/12/User_icon_2.svg"
                         class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/1/12/User_icon_2.svg"
                             class="img-circle elevation-2"
                             alt="User Image">
                        <p>
                            {{ Auth::user()->name }}
                            <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left side column. contains the logo and sidebar -->
@include('layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper con">
        <section class="content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')

    </div>

    <!-- Main Footer -->
    <footer class="main-footer bg-dark text-white">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.5
        </div>
        <strong>Copyright &copy; 2014-2022 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
        reserved.
    </footer>
</div>

<script src="{{ mix('js/app.js') }}" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<script>

    // Handle Selected Tags
    function handleSelectedTag(element, optionClass) {
        document.querySelector(`.${optionClass}`)?.classList.remove('d-none');
       element.parentElement.remove();
    }

    // Get Selected Gyms
    function getSelectedGyms(elementClass) {
    let selectedGyms = [];
    let tags = document.querySelectorAll(elementClass);
    for(let tag of tags) {
        selectedGyms.push(+tag.dataset.tag);
    }
    return selectedGyms;
    }

    // Generate Input Hidden for Tags Id
    function generateInputSaveTagsID(event, elementClass, inputName) {
        let selectedGyms = getSelectedGyms(`${elementClass} .tag`);
        selectedGyms.forEach(gym => {
            let inputGymId = document.createElement('input');
            inputGymId.setAttribute('type', 'hidden');
            inputGymId.setAttribute('name', `${inputName}[]`);
            inputGymId.setAttribute('value', gym);
            event.target.append(inputGymId);
        })
    }

    // Add Tags for mulitpe Select options
    function tags(e, tagsContainer) {
       
        let option = e.target.options[e.target.selectedIndex];
            let parentSpan = document.createElement('span');
            let spanTag = document.createElement('span');
            let textTag = document.createTextNode(option.text + ' ');
            let deleteTag = document.createElement('span');
            let deleteText = document.createTextNode(' X');
            deleteTag.classList.add()
            deleteTag.addEventListener('click', function() {
                this.parentElement.remove();
                option.classList.remove('d-none');
            });
            parentSpan.setAttribute('data-tag', option.value);
            parentSpan.classList.add('tag', 'bg-dark', 'text-white', 'px-3', 'py-2', 'rounded-pill', 'mt-2', 'mr-2');
            deleteTag.classList.add('text-danger');
            deleteTag.setAttribute('role', 'button');
            spanTag.append(textTag);
            deleteTag.append(deleteText);

            parentSpan.append(spanTag)
            parentSpan.append(deleteTag);
            document.querySelector(tagsContainer).append(parentSpan);

            option.classList.add('d-none');

            e.target.options[0].selected=true;
    }
</script>
@yield('javascripts')
@yield('script')

@yield('third_party_scripts')


@stack('page_scripts')

</body>
</html>
