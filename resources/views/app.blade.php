<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shafiqul Alam's Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('cdn/css/datatables.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('cdn/wnoty/wnoty.css') }}"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                <a href="{{ route('messages.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-envelope me-2"></i> Messages</a>
                <a href="{{ route('change-password.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-key me-2"></i> Change Password</a>

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
                    
            </div>

            <div class="container-fluid p-4 bg-light">
                @yield('content')
            </div>
        </div>
    </div>

    @include('modals')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('cdn/js/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('cdn/js/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('cdn/js/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('cdn/js/datatable/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('cdn/wnoty/wnoty.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    @include('yajra.js')

    @if(session()->has('success'))
    <script type="text/javascript">
      $(document).ready(function() {
        notify('{{session()->get('success')}}', 'success');
      });
    </script>
    @endif

    @if(session()->has('danger'))
    <script type="text/javascript">
      $(document).ready(function() {
        notify('{{session()->get('danger')}}', 'danger');
      });
    </script>
    @endif

    @if($errors->any())
    <script type="text/javascript">
      $(document).ready(function() {
        var errors = <?php echo json_encode($errors->all()); ?>;
        $.each(errors, function(index, val) {
          notify(val, 'danger');
        });
      });
    </script>
    @endif

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
        });
        
        function Show(title, link, style = '') {
            $('#modal').modal('show');
            $('#modal-title').html(title);
            $('#modal-body').html('<h1 class="text-center"><strong>Please wait...</strong></h1>');
            $('#modal-dialog').attr('style',style);
            $.ajax({
                url: link,
                type: 'GET',
                data: {},
            })
            .done(function(response) {
                $('#modal-body').html(response);
            });
        }

        function Delete(link) {
            $.confirm({
                title: 'Confirm!',
                content: '<hr><div class="alert alert-danger">Are you sure to delete ?</div><hr>',
                buttons: {
                  yes: {
                    text: 'Yes',
                    btnClass: 'btn-danger',
                    action: function(){
                      $.ajax({
                        url: link,
                        type: 'DELETE',
                        data: {
                            _token : "{{ csrf_token() }}"
                        },
                      })
                      .done(function(response) {
                        if(response.success){
                            reloadDatatable();
                            notify(response.message, 'success');
                        }else{
                          notify('Something went wrong!','danger');
                        }
                      })
                      .fail(function(response){
                        notify('Something went wrong!','danger');
                      });
                    }
                  },
                  no: {
                    text: 'No',
                    btnClass: 'btn-default',
                    action: function(){
                        
                    }
                  }
                }
            });
        }

        function notify(message, type) {
            $.wnoty({
              message: '<strong class="text-'+(type)+'">'+(message)+'</strong>',
              type: type,
              autohideDelay: 3000
            });
        }
    </script>
</body>
</html>
