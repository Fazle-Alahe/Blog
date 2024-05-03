@auth()
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">


<!-- Mirrored from myrathemes.com/dashtrap/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Mar 2024 03:40:24 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8" />
    <title>Dashboard | Dashtrap - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('backend/assets')}}/images/favicon.ico">

    <link href="{{asset('backend/assets')}}/libs/morris.js/morris.css" rel="stylesheet" type="text/css" />

    
    <!-- include summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <!-- App css -->
    <link href="{{asset('backend/assets')}}/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('backend/assets')}}/css/icons.min.css" rel="stylesheet" type="text/css">
    {{-- select2 --}}
    
    {{-- tags --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
    integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('backend/assets')}}/js/config.js"></script>
    <style>
        .toggle-password {
            float: right;
            cursor: pointer;
            margin-right: 10px;
            margin-top: -25px;
        }
        
        .swal2-container.swal2-backdrop-show{
            background-color: none !important;
        }

        .swal2-popup.swal2-toast{
            background: rgb(8, 157, 26) !important;
			padding: 8px !important;
        }

        .blg_circle{
			height: 60px;
			width: 60px;
			border-radius: 50%;
		}
    </style>
</head>

<body>

    <!-- Begin page -->
    <div class="layout-wrapper">

        <!-- ========== Left Sidebar ========== -->
        <div class="main-menu">
            <!-- Brand Logo -->
            <div class="logo-box">
                <!-- Brand Logo Light -->
                <a class='logo-light' href='{{route('dashboard')}}'>
                    <img src="{{asset('backend/assets')}}/images/logo-light.png" alt="logo" class="logo-lg" height="28">
                    <img src="{{asset('backend/assets')}}/images/logo-sm.png" alt="small logo" class="logo-sm" height="28">
                </a>

                <!-- Brand Logo Dark -->
                <a class='logo-dark' href='{{route('dashboard')}}'>
                    <img src="{{asset('backend/assets')}}/images/logo-dark.png" alt="dark logo" class="logo-lg" height="28">
                    <img src="{{asset('backend/assets')}}/images/logo-sm.png" alt="small logo" class="logo-sm" height="28">
                </a>
            </div>

            <!--- Menu -->
            <div data-simplebar>
                <ul class="app-menu">
                    <li class="menu-item">
                        <a class='menu-link' href='{{route('logo')}}'>
                            <span class="menu-icon"><i class="bx bx-award"></i></span>
                            <span class="menu-text">Logo</span>
                        </a>
                    </li>

                    <li class="menu-title">Blogger</li>

                    <li class="menu-item">
                        <a href="#menuExpages" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-user"></i></span>
                            <span class="menu-text"> Bloggers </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="menuExpages">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a class='menu-link' href='{{route('user.list')}}'>
                                        <span class="menu-text">Blogger list</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class='menu-link' href='{{route('trash.user')}}'>
                                        <span class="menu-text">Trash blogger list</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <li class="menu-title">Category</li>

                    <li class="menu-item">
                        <a href="#category" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-globe"></i></span>
                            <span class="menu-text"> Category </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="category">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a class='menu-link' href='{{route('category')}}'>
                                        <span class="menu-text">Category add & list</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class='menu-link' href='{{route('trash.category')}}'>
                                        <span class="menu-text">Trash category list</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="menu-title">Subscribers</li>

                    <li class="menu-item">
                        <a href="#Subscribers" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-user-plus"></i></span>
                            <span class="menu-text"> Subscribers </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="Subscribers">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a class='menu-link' href='{{route('subscriber.list')}}'>
                                        <span class="menu-text">Subscribers list</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    
                    <li class="menu-title">Tag</li>

                    <li class="menu-item">
                        <a href="#tag" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-droplet"></i></span>
                            <span class="menu-text"> Tag </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="tag">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a class='menu-link' href='{{route('tag')}}'>
                                        <span class="menu-icon"><i class="bx bx-plus"></i></span>
                                        <span class="menu-text">Tag</span>
                                    </a>
                                </li>
            
                                <li class="menu-item">
                                    <a class='menu-link' href='{{route('trash.tag')}}'>
                                        <span class="menu-icon"><i class="bx bx-plus"></i></span>
                                        <span class="menu-text">Trash tag</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-title">Blog</li>

                    <li class="menu-item">
                        <a href="#blog" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-droplet"></i></span>
                            <span class="menu-text"> Blog </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="blog">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a class='menu-link' href='{{route('blog')}}'>
                                        <span class="menu-text">Create blog</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class='menu-link' href='{{route('all.blog')}}'>
                                        <span class="menu-text">All blogs</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class='menu-link' href='{{route('trash.blog')}}'>
                                        <span class="menu-text">Trash blog</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="menu-title">About</li>

                    <li class="menu-item">
                        <a class='menu-link' href='{{route('about')}}'>
                            <span class="menu-icon"><i class="bx bx-menu"></i></span>
                            <span class="menu-text">About us</span>
                        </a>
                    </li>
                    {{-- <li class="menu-title">About</li> --}}

                    <li class="menu-item">
                        <a class='menu-link' href='{{route('advertise')}}'>
                            <span class="menu-icon"><i class="bx bx-menu"></i></span>
                            <span class="menu-text">Ads</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class='menu-link' href='{{route('role.manage')}}'>
                            <span class="menu-icon"><i class="bx bx-menu"></i></span>
                            <span class="menu-text">Role manage</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a class='menu-link' href='{{route('show.message')}}'>
                            <span class="menu-icon"><i class="bx bx-message"></i></span>
                            <span class="menu-text">Messages</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>

        

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">

            <!-- ========== Topbar Start ========== -->
            <div class="navbar-custom">
                <div class="topbar">
                    <div class="topbar-menu d-flex align-items-center gap-lg-2 gap-1">

                        <!-- Brand Logo -->
                        <div class="logo-box">
                            <!-- Brand Logo Light -->
                            <a class='logo-light' href='{{route('dashboard')}}'>
                                <img src="{{asset('backend/assets')}}/images/logo-light.png" alt="logo" class="logo-lg" height="22">
                                <img src="{{asset('backend/assets')}}/images/logo-sm.png" alt="small logo" class="logo-sm" height="22">
                            </a>

                            <!-- Brand Logo Dark -->
                            <a class='logo-dark' href='{{route('dashboard')}}'>
                                <img src="{{asset('backend/assets')}}/images/logo-dark.png" alt="dark logo" class="logo-lg" height="22">
                                <img src="{{asset('backend/assets')}}/images/logo-sm.png" alt="small logo" class="logo-sm" height="22">
                            </a>
                        </div>

                        <!-- Sidebar Menu Toggle Button -->
                        <button class="button-toggle-menu">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </div>

                    <ul class="topbar-menu d-flex align-items-center gap-4">

                        <li class="d-none d-md-inline-block">
                            <a class="nav-link" href="#" data-bs-toggle="fullscreen">
                                <i class="mdi mdi-fullscreen font-size-24"></i>
                            </a>
                        </li>

                        {{-- <li class="dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="mdi mdi-magnify font-size-24"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end dropdown-lg p-0">
                                <form class="p-3">
                                    <input type="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                </form>
                            </div>
                        </li> --}}



                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="mdi mdi-bell font-size-24"></i>

                                <span class="badge bg-danger rounded-circle noti-icon-badge">
                                    {{App\Models\Comment::where('status', 0)->where('blogger_id', Auth::user()->id)->count()+App\Models\Reply::where('status', 0)->where('blogger_id', Auth::user()->id)->count()}}
                                </span>

                                @can('blogs_action')
                                    <span class="badge bg-danger rounded-circle noti-icon-badge">
                                        {{App\Models\Comment::where('status', 0)->where('blogger_id', Auth::user()->id)->count()+App\Models\Reply::where('status', 0)->where('blogger_id', Auth::user()->id)->count()+
                                        App\Models\Blog::where('status', 1)->count()}}
                                    </span>
                                @endcan

                                @can('message_access')
                                    <span class="badge bg-danger rounded-circle noti-icon-badge">
                                        {{App\Models\Comment::where('status', 0)->where('blogger_id', Auth::user()->id)->count()+App\Models\Reply::where('status', 0)->where('blogger_id', Auth::user()->id)->count()+
                                        App\Models\Blog::where('status', 1)->count()+App\Models\Message::where('status', 1)->count()}}
                                    </span>
                                @endcan
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                                <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 font-size-16 fw-semibold"> Notification</h6>
                                        </div>
                                    </div>
                                </div>


                                <div class="px-1" style="max-height: 300px;" data-simplebar>
                                   
                                    {{-- <h5 class="text-muted font-size-13 fw-normal mt-2">Today</h5> --}}
                                    <!-- item-->
                                    @foreach (App\Models\Comment::where('status', 0)->where('blogger_id', Auth::user()->id)->latest()->take(2)->get() as $comment)
                                        
                                        <a href="{{route('comment.view',$comment->id)}}" class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-1">
                                            <div class="card-body">
                                                {{-- <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span> --}}
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon bg-primary">
                                                            <i class="mdi mdi-comment-account-outline"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <h5 class="noti-item-title fw-semibold font-size-14">Commented by {{$comment->rel_to_viewer->name}}<small class="fw-normal text-muted ms-1">{{$comment->created_at->diffForHumans()}}</small></h5>
                                                        <small class="noti-item-subtitle text-muted">{{Str::limit($comment->comment,30,'....')}}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach

                                    @foreach (App\Models\Reply::where('status', 0)->where('blogger_id', Auth::user()->id)->latest()->take(2)->get() as $reply)
                                        <a href="{{route('reply.view',$reply->id)}}" class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-1">
                                            <div class="card-body">
                                                {{-- <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span> --}}
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon bg-primary">
                                                            <i class="mdi mdi-comment-account-outline"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <h5 class="noti-item-title fw-semibold font-size-14">Replied by {{$reply->rel_to_viewer->name}} <small class="fw-normal text-muted ms-1">{{$reply->created_at->diffForHumans()}}</small></h5>
                                                        <small class="noti-item-subtitle text-muted">{{Str::limit($reply->reply,30,'....')}}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                    
                                    @can('blogs_action')
                                        @foreach (App\Models\Blog::where('status', 1)->latest()->take(2)->get() as $blogs)
                                            <a href="{{route('blog.view',$blogs->id)}}" class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-1">
                                                <div class="card-body">
                                                    {{-- <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span> --}}
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <div class="notify-icon bg-primary">
                                                                <i class="mdi mdi-comment-account-outline"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 text-truncate ms-2">
                                                            <h5 class="noti-item-title fw-semibold font-size-14">Posted by {{$blogs->blogger}} <small class="fw-normal text-muted ms-1">{{$blogs->created_at->diffForHumans()}}</small></h5>
                                                            <small class="noti-item-subtitle text-muted">Post needs to be approve.</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endcan

                                    @can('message_access')
                                        @foreach (App\Models\Message::where('status', 1)->latest()->take(2)->get() as $message)
                                            <a href="{{route('view.message',$message->id)}}" class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-1">
                                                <div class="card-body">
                                                    {{-- <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span> --}}
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <div class="notify-icon bg-primary">
                                                                <i class="mdi mdi-comment-account-outline"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 text-truncate ms-2">
                                                            <h5 class="noti-item-title fw-semibold font-size-14">Message from {{$message->name}} <small class="fw-normal text-muted ms-1">{{$message->created_at->diffForHumans()}}</small></h5>
                                                            <small class="noti-item-subtitle text-muted">You've a new messsage!</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endcan
                                    

                                    <h5 class="text-muted font-size-13 fw-normal mt-0">{{\Carbon\Carbon::now()->toFormattedDateString()}}</h5>

                                    <div class="text-center">
                                        <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                                    </div>
                                </div>

                                <!-- All-->
                                <a href="{{route('notification')}}" class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                                    View All
                                </a>

                            </div>
                        </li>

                        <li class="nav-link" id="theme-mode">
                            <i class="bx bx-moon font-size-24"></i>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                @if (Auth::user()->photo == null)
                                    <img width="60" src="{{asset('uploads/profile_default.PNG')}}">
                                @else
                                    <img src="{{asset('uploads/users/')}}/{{Auth::user()->photo}}" class="rounded-circle">
                                @endif
                                <span class="ms-1 d-none d-md-inline-block">
                                {{Auth::user()->name}} <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">

                                <!-- item-->
                                <a href="{{route('user.profile')}}" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>My profile</span>
                                </a>

                                <div class="dropdown-divider"></div>
                                <!-- item-->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class='dropdown-item notify-item' href='{{ route('logout') }}' 
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                            <i class="fe-log-out"></i>
                                            <span>Logout</span>
                                        </a>
                                    </form>
                            </div>
                        </li>
          
                    </ul>
                </div>
            </div>
            <!-- ========== Topbar End ========== -->
            <div class="px-3">

                @php
                    $breads = Request::segments();
                    array_pop($breads);
                @endphp
                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="py-3 py-lg-4">
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                {{-- <h4 class="page-title mb-4">Chartjs Charts</h4> --}}
                            </div>
                            <div class="col-lg-6">
                                <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                        @foreach (Request::segments() as $segment)
                                            <li class="breadcrumb-item active" aria-current="page">
                                                {{ucwords($segment)}}
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>
                        @yield('content')
                    </div>
                    <!-- end page title -->

                </div> <!-- container -->

            </div> <!-- content -->



            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div><script>document.write(new Date().getFullYear())</script> © Dashtrap</div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-none d-md-flex gap-4 align-item-center justify-content-md-end">
                                <p class="mb-0">Design & Develop by <a href="https://myrathemes.com/" target="_blank">MyraStudio</a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- App js -->
    <script src="{{asset('backend/assets')}}/js/vendor.min.js"></script>
    <script src="{{asset('backend/assets')}}/js/app.js"></script>

    <!-- Knob charts js -->
    <script src="{{asset('backend/assets')}}/libs/jquery-knob/jquery.knob.min.js"></script>

    <!-- Sparkline Js-->
    <script src="{{asset('backend/assets')}}/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

    <script src="{{asset('backend/assets')}}/libs/morris.js/morris.min.js"></script>

    <script src="{{asset('backend/assets')}}/libs/raphael/raphael.min.js"></script>

    <!-- Dashboard init-->
    <script src="{{asset('backend/assets')}}/js/pages/dashboard.js"></script>

    <!-- include summernote js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    {{-- select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- tags --}}
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
    integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer">
    </script>
@yield('footer_script')
</body>


<!-- Mirrored from myrathemes.com/dashtrap/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Mar 2024 03:40:30 GMT -->
</html>   
@endauth
