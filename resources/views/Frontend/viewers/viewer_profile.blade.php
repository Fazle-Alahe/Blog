
<!DOCTYPE html>
<html lang="en-US">

<!-- Mirrored from themeger.shop/html/katen/html/personal.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Nov 2023 05:32:47 GMT -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Katen - Minimal Blog & Magazine HTML Theme</title>
	<meta name="description" content="Katen - Minimal Blog & Magazine HTML Theme">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

	<!-- STYLES -->
	<link rel="stylesheet" href="{{asset('frontend/assets')}}/css/bootstrap.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="{{asset('frontend/assets')}}/css/all.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="{{asset('frontend/assets')}}/css/slick.css" type="text/css" media="all">
	<link rel="stylesheet" href="{{asset('frontend/assets')}}/css/simple-line-icons.css" type="text/css" media="all">
	<link rel="stylesheet" href="{{asset('frontend/assets')}}/css/style.css" type="text/css" media="all">

	
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

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
		.swal2-title{
			font-weight: 500;
			font-size: 1.2rem;
			color: white}
    </style>
</head>

<body>

    <?php
    $logo = App\Models\Logo::find(1);
    $about = App\Models\About::find(1);
    ?>
<!-- preloader -->
<div id="preloader">
	<div class="book">
		<div class="inner">
			<div class="left"></div>
			<div class="middle"></div>
			<div class="right"></div>
		</div>
		<ul>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
</div>
<!-- site wrapper -->
<div class="site-wrapper">

	<div class="main-overlay"></div>

	<!-- header -->
	<header class="header-personal">
        <div class="container-xl header-top">
			<div class="row align-items-center">

				<div class="col-4 d-none d-md-block d-lg-block">
					<!-- social icons -->
					<ul class="social-icons list-unstyled list-inline mb-0">
						<li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-medium"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
					</ul>
				</div>

				<div class="col-md-4 col-sm-12 col-xs-12 text-center">
				<!-- site logo -->
				<a class="navbar-brand" href="{{route('index')}}"><img width="150" src="{{asset('uploads/logo/')}}/{{$logo->logo}}" alt="logo" /></a> 
					{{-- <a href="personal.html" class="d-block text-logo">Katen<span class="dot">.</span></a> --}}
				</div>

				<div class="col-md-4 col-sm-12 col-xs-12">
					<!-- header buttons -->
					<div class="header-buttons float-md-end mt-4 mt-md-0">
						<button class="search icon-button">
							<i class="icon-magnifier"></i>
						</button>
						<button class="burger-menu icon-button ms-2 float-end float-md-none">
							<span class="burger-icon"></span>
						</button>
					</div>
				</div>

			</div>
        </div>

		<nav class="navbar navbar-expand-lg">
			<div class="container-xl">
				
				<div class="collapse navbar-collapse justify-content-center centered-nav">
					<!-- menus -->
					<ul class="navbar-nav mr-auto">
						<li class="nav-item dropdown active">
							<a class="nav-link dropdown-toggle" href="{{route('index')}}">Home</a>
							<ul class="dropdown-menu">
								<li>
									<a class="dropdown-item" href="{{route('about.site')}}">About us</a>
								</li>
								<li>
									<a class="dropdown-item" href="{{route('contact')}}">Contact</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{route('all.blogs')}}">All blog</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#">All category</a>
							<ul class="dropdown-menu">
								@foreach (App\Models\Category::all() as $category)
									<li><a class="dropdown-item" href="{{route('category.blogs',$category->id)}}">{{$category->category_name}}</a></li>
								@endforeach
							</ul>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{route('blogger')}}">Bloggers</a>
						</li>
						<li class="nav-item">
							@auth('viewer')
								<a class="nav-link" href="{{route('viewer.profile', Auth::guard('viewer')->user()->id)}}">{{Auth::guard('viewer')->user()->name}}</a>
							@else
								<a class="nav-link" href="{{route('login.viewer')}}">Login</a>
							@endauth
						</li>
					</ul>
				</div>

			</div>
		</nav>
	</header>

	<!-- section main content -->
	<section class="main-content">
		<div class="container-xl">
            <div class="col-lg-12">
                <div class="row">
                    <div class="row gy-4">
                            <div class="col-sm-6 m-auto">
                                <!-- post -->
                                <div class="post post-grid rounded bordered">
                                    <div class="thumb top-rounded">
                                            <div class="inner">
												@if ($viewer->photo == null)
													<img width="500" src="{{asset('uploads/profile_default.PNG')}}">
												@else
                                                	<img src="{{asset('uploads/viewer/')}}/{{$viewer->photo}}" alt="post-title" />
												@endif
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <form action="{{route('viewer.update',$viewer->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="column col-md-12 m-auto">
                                                <!-- Email input -->
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="name" value="{{$viewer->name}}" required="required" data-error="Name is required.">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="column col-md-12 m-auto">
                                                <!-- Email input -->
                                                <div class="form-group">
                                                    <input class="form-control" disabled value="{{$viewer->email}}">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="column col-md-12 m-auto">
                                                <!-- Email input -->
                                                <div class="form-group">
                                                    <input type="password" class="form-control" id="InputEmail" name="password" placeholder="Current Password">
                                                    <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                                    <div class="help-block with-errors"></div>
													@if (session('wrong_pass'))
														<strong class="text-danger">{{session('wrong_pass')}}</strong>
													@endif
                                                </div>
                                            </div>
                                            <div class="column col-md-12 m-auto">
                                                <!-- Email input -->
                                                <div class="form-group">
                                                    <input type="password" class="form-control" id="InputEmail" name="new_password" placeholder="New Password">
                                                    <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                                    <div class="help-block with-errors"></div>
													@error('new_password')
														<strong class="text-danger">{{$message}}</strong>
													@enderror
                                                </div>
                                            </div>
                                            
                                            <div class="column col-md-12">
                                                <!-- Message textarea -->
                                                <div>
                                                    <input type="file" class="form-control" name="photo" placeholder="Profile photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                                    <div class="mt-3">
                                                        <img width="100" id="blah"/>
                                                    </div>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="column col-md-8 text-right mt-2">
                                                <!-- Message textarea -->
                                                <button type="submit" class="btn btn-default w-50">Submit</button><!-- Send Button -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
								<a href="{{route('viewer.logout')}}" class="btn btn-default mt-3">Log out</a>
                            </div>
                    </div>
                </div>

            </div>
		</div>
	</section>


	<!-- footer -->
	<footer>
		<div class="container-xl">
			<div class="footer-inner">
				<div class="row d-flex align-items-center gy-4">
					<!-- copyright text -->
					<div class="col-md-4">
						<span class="copyright">© 2021 Katen. Template by ThemeGer.</span>
					</div>

					<!-- social icons -->
					<div class="col-md-4 text-center">
						<ul class="social-icons list-unstyled list-inline mb-0">
							<li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fab fa-medium"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
						</ul>
					</div>

					<!-- go to top button -->
					<div class="col-md-4">
						<a href="#" id="return-to-top" class="float-md-end"><i class="icon-arrow-up"></i>Back to Top</a>
					</div>
				</div>
			</div>
		</div>
	</footer>

</div><!-- end site wrapper -->

<!-- search popup area -->
<div class="search-popup">
	<!-- close button -->
	<button type="button" class="btn-close" aria-label="Close"></button>
	<!-- content -->
	<div class="search-content">
		<div class="text-center">
			<h3 class="mb-4 mt-0">Press ESC to close</h3>
		</div>
		<!-- form -->
		<form class="d-flex search-form">
			<input class="form-control me-2" type="search" placeholder="Search and press enter ..." aria-label="Search">
			<button class="btn btn-default btn-lg" type="submit"><i class="icon-magnifier"></i></button>
		</form>
	</div>
</div>

<!-- canvas menu -->
<div class="canvas-menu d-flex align-items-end flex-column">
	<!-- close button -->
	<button type="button" class="btn-close" aria-label="Close"></button>

	<!-- logo -->
	<div class="logo">
		<img src="{{asset('uploads/logo/')}}/{{$logo->logo}}" alt="Katen" />
	</div>

	<!-- menu -->
	<nav>
		<ul class="vertical-menu">
			<li class="active">
				<a href="{{route('index')}}">Home</a>
				<ul class="submenu">
					<li>
						<a class="dropdown-item" href="{{route('about.site')}}">About us</a>
					</li>
					<li>
						<a class="dropdown-item" href="{{route('contact')}}">Contact</a>
					</li>
				</ul>
			</li>
			<li><a href="{{route('all.blogs')}}">All blog</a></a></li>
			<li>
				<a href="#">All category</a>
				<ul class="submenu">
					@foreach (App\Models\Category::all() as $category)
						<li><a href="{{route('category.blogs',$category->id)}}">{{$category->category_name}}</a></li>
					@endforeach
				</ul>
			</li>
			<li><a href="{{route('blogger')}}">Bloggers</a></li>
			<li>
				@auth('viewer')
					<a href="{{route('viewer.profile', Auth::guard('viewer')->user()->id)}}">{{Auth::guard('viewer')->user()->name}}</a>
				@else
					<a href="{{route('login.viewer')}}">Login</a>
				@endauth
			</li>
		</ul>
	</nav>

	<!-- social icons -->
	{{-- <ul class="social-icons list-unstyled list-inline mb-0 mt-auto w-100">
		<li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
		<li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
		<li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
		<li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
		<li class="list-inline-item"><a href="#"><i class="fab fa-medium"></i></a></li>
		<li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
	</ul> --}}
</div>

<!-- JAVA SCRIPTS -->
<script src="{{asset('frontend/assets')}}/js/jquery.min.js"></script>
<script src="{{asset('frontend/assets')}}/js/popper.min.js"></script>
<script src="{{asset('frontend/assets')}}/js/bootstrap.min.js"></script>
<script src="{{asset('frontend/assets')}}/js/slick.min.js"></script>
<script src="{{asset('frontend/assets')}}/js/jquery.sticky-sidebar.min.js"></script>
<script src="{{asset('frontend/assets')}}/js/custom.js"></script>

    {{-- select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
	$(".toggle-password").click(function() {
		$(this).toggleClass("fa-eye fa-eye-slash");
		input = $(this).parent().find("input");
		if (input.attr("type") == "password") {
			input.attr("type", "text");
		} else {
			input.attr("type", "password");
		}
	});
</script>

@if (session('success'))
<script>
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    })

    Toast.fire({
    icon: 'success',
    title: '{{session('success')}}'
    })
</script>
@endif
</body>

<!-- Mirrored from themeger.shop/html/katen/html/personal.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Nov 2023 05:32:48 GMT -->
</html>