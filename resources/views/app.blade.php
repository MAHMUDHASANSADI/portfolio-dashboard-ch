<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shafiqul Alam's Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('cdn/css/datatables.min.css') }}"/>

    <style>
        /* Custom sidebar styling */
        #sidebar-wrapper {  
            min-height: 100vh;
            width: 250px;
            background-color: #343a40;
            color: #ffffff;
            position: fixed;
        }
        #sidebar-wrapper .sidebar-heading {
            padding: 1rem;
            font-size: 1.25rem;
            background-color: #212529;
            text-align: center;
        }
        #sidebar-wrapper .list-group-item {
            background-color: #343a40;
            color: #ffffff;
            border: none;
        }
        #sidebar-wrapper .list-group-item:hover {
            background-color: #495057;
            color: #ffffff;
        }
        #sidebar-wrapper .list-group-item-action[data-bs-toggle="collapse"]:after {
            content: '▾';
            float: right;
        }
        .collapse.show .list-group-item-action[data-bs-toggle="collapse"]:after {
            content: '▴';
        }
        /* Main content styling */
        #page-content-wrapper {
            margin-left: 250px;
            padding: 2rem;
            width: calc(100% - 250px);
        }
        .content-header {
            font-size: 1.5rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 1.5rem;
        }
    </style>

    @include('yajra.css')
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">
                <img src="{{ asset('/storage/blog_images/chairman.png') }}" alt="" style="width: 220px; height: 50px;">
            </div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="collapse" data-bs-target="#homeSubmenu" aria-expanded="false">
                    <i class="fas fa-home me-2"></i> Home
                </a> 
                <!-- Dropdown Submenu -->
                <div class="collapse" id="homeSubmenu">
                    <div class="list-group " style="width: 220px;">
                        <a href="{{route('slider.index')}}" class="list-group-item list-group-item-action ms-3"><i class="fas fa-images me-2"></i> Slider</a>
                        <a href="{{route('hero.index')}}" class="list-group-item list-group-item-action ms-3"><i class="fas fa-flag me-2"></i> Hero</a>
                        <a href="{{route('program.index')}}" class="list-group-item list-group-item-action ms-3"><i class="fas fa-graduation-cap me-2"></i> Programs</a>
                        <a href="{{route('gallery.index')}}" class="list-group-item list-group-item-action ms-3"><i class="fas fa-photo-video me-2"></i> Gallery</a>
                        <a href="{{route('news.index')}}" class="list-group-item list-group-item-action ms-3"><i class="fas fa-newspaper me-2"></i> News</a>
                    </div>
                </div>
                <a href="{{ route('biography.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-user me-2"></i> Biography</a>
                <a href="{{ route('business_category.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-th-large me-2"></i> Business Category</a>
                <a href="{{ route('business.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-briefcase me-2"></i> Business</a>
                <a href="{{ route('award_category.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-trophy me-2"></i> Award Category</a>
                <a href="{{ route('award.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-award me-2"></i> Award & Honor</a>
                <a href="{{ route('blog.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-blog me-2"></i> Blog</a>
                <a href="{{ route('video.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-video me-2"></i> Video</a>
                <!-- <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a> -->

                <form method="POST" action="{{ route('logout') }}">
                @csrf
                    <a href="route('logout')" class="list-group-item list-group-item-action" 
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"> <i class="fas fa-sign-out me-2"></i>{{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="navbar-container">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-3 px-4">
                         <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                        
                        <!-- Search Button -->
                        <form class="form-inline my-2 my-lg-0 mx-auto w-50">
                            <input class="form-control mr-sm-2 w-75" type="search" placeholder="Search" aria-label="Search">
                                <i class="fas fa-search"></i> <!-- Optional icon for search button -->
                            </button>
                        </form>

                        <!-- Notification Icon -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell text-primary"></i> <!-- Notification icon styled -->
                                    <span class="badge badge-danger badge-pill">3</span> <!-- Rounded notification count badge -->
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationsDropdown">
                                    <h6 class="dropdown-header">Notifications</h6>
                                    <a class="dropdown-item" href="#">Notification 1</a>
                                    <a class="dropdown-item" href="#">Notification 2</a>
                                    <a class="dropdown-item" href="#">Notification 3</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-center text-primary" href="#">View All</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
            </div>

            <div class="container-fluid p-4 bg-light">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('cdn/js/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('cdn/js/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('cdn/js/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('cdn/js/datatable/buttons.colVis.min.js') }}"></script>
    
    @include('yajra.js')
</body>
</html>
