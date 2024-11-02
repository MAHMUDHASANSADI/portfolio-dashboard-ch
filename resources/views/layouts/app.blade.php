<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Portfolio Dashboard</title>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Portfolio Dashboard</div>
            <div class="list-group list-group-flush">
                <a href="{{ route('home.index') }}" class="list-group-item list-group-item-action">Home</a>
                <a href="{{ route('biography.index') }}" class="list-group-item list-group-item-action">Biography</a>
                <a href="#businessSubmenu" class="list-group-item list-group-item-action" data-bs-toggle="collapse">Business</a>
                <div class="collapse" id="businessSubmenu">
                    <a href="{{ route('business.index') }}" class="list-group-item list-group-item-action ms-4">CA Firm</a>
                    <a href="{{ route('business.index') }}" class="list-group-item list-group-item-action ms-4">Bizz Solutions Plc</a>
                </div>
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
