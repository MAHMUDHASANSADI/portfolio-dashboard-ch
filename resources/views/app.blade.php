<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Portfolio Dashboard</title>

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

</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Portfolio Dashboard</div>
            <div class="list-group list-group-flush">
                <a href="{{ route('home.index') }}" class="list-group-item list-group-item-action">Home</a>
                <a href="{{ route('biography.index') }}" class="list-group-item list-group-item-action">Biography</a>
                <a href="#" class="list-group-item list-group-item-action">Business Category</a>
                <a href="{{ route('business.index') }}" class="list-group-item list-group-item-action" >Business</a>
                
                <a href="#awardSubmenu" class="list-group-item list-group-item-action" data-bs-toggle="collapse">Award & Honor</a>
                <div class="collapse" id="awardSubmenu">
                    <a href="{{ route('award-category.index') }}" class="list-group-item list-group-item-action ms-4">Award</a>
                    <a href="{{ route('award-category.index') }}" class="list-group-item list-group-item-action ms-4">Achievement</a>
                    <a href="{{ route('award-category.index') }}" class="list-group-item list-group-item-action ms-4">Honorary Degree</a>
                    <a href="{{ route('award-category.index') }}" class="list-group-item list-group-item-action ms-4">Experiences</a>
                </div>
                <a href="{{ route('blog.index') }}" class="list-group-item list-group-item-action">Blog</a>
                <a href="{{ route('video.index') }}" class="list-group-item list-group-item-action">Video</a>
            </div>
        </div>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid p-4">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
