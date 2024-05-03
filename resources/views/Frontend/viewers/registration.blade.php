
<!DOCTYPE html>
<html lang="en-US">

<!-- Mirrored from themeger.shop/html/katen/html/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Nov 2023 05:32:54 GMT -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Katen - Minimal Blog & Magazine HTML Theme</title>
	<meta name="description" content="Katen - Minimal Blog & Magazine HTML Theme">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

	<!-- STYLES -->
	<link rel="stylesheet" href="{{asset('frontend/assets')}}/css/bootstrap.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="{{asset('frontend/assets')}}/css/all.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/slick.css" type="text/css" media="all">
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

<?php
$logo = App\Models\Logo::find(1);
$contact = App\Models\About::find(1);
?>

<!-- site wrapper -->
<div class="site-wrapper">

	<div class="main-overlay"></div>

	<!-- header -->
	<header class="header-default">
		<nav class="navbar navbar-expand-lg">
			<div class="container-xl">
				<!-- site logo -->
				<a class="navbar-brand" href="{{route('index')}}"><img width="150" src="{{asset('uploads/logo/')}}/{{$logo->logo}}" alt="logo" /></a> 

				<div class="collapse navbar-collapse">
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

				<!-- header right section -->
				<div class="header-right">
					<!-- social icons -->
					<ul class="social-icons list-unstyled list-inline mb-0">
						<li class="list-inline-item"><a href="{{$contact->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<li class="list-inline-item"><a href="{{$contact->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<li class="list-inline-item"><a href="{{$contact->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
						<li class="list-inline-item"><a href="{{$contact->pinterest}}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
						<li class="list-inline-item"><a href="{{$contact->medium}}" target="_blank"><i class="fab fa-medium"></i></a></li>
						<li class="list-inline-item"><a href="{{$contact->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
					</ul>
					<!-- header buttons -->
					<div class="header-buttons">
						<button class="search icon-button">
							<i class="icon-magnifier"></i>
						</button>
						<button class="burger-menu icon-button">
							<span class="burger-icon"></span>
						</button>
					</div>
				</div>
			</div>
		</nav>
	</header>

    <!-- page header -->
    <section class="page-header">
        <div class="container-xl">
            <div class="text-center">
                <h1 class="mt-0 mb-2">Register here..</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

	<!-- section main content -->
	<section class="main-content">
		<div class="container-xl">
			<div class="row">
				<div class="col-lg-8 m-auto">
					<!-- section header -->
					<div class="section-header text-center ">
						<img src="{{asset('uploads/logo/')}}/{{$logo->logo}}" />
					</div>
		
					<!-- Contact Form -->
					<form action="{{route('viewer.store')}}" id="contact-form" class="contact-form" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="messages"></div>
						
						<div class="row">
							<div class="column col-md-6">
								<!-- Name input -->
								<div class="form-group">
									<input type="text" class="form-control" name="name" id="InputName" placeholder="Your name" required="required" data-error="Name is required.">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							
							<div class="column col-md-6">
								<!-- Email input -->
								<div class="form-group">
									<input type="email" class="form-control" id="InputEmail" name="email" placeholder="Email address" required="required" data-error="Email is required.">
									<div class="help-block with-errors"></div>
								</div>
							</div>
		
							<div class="column col-md-6">
								<!-- Password -->
								<div class="form-group">
									<input type="password" class="form-control" id="InputSubject" name="password" placeholder="Password" required="required" data-error="Password is required.">
									<i class="toggle-password fa fa-fw fa-eye-slash"></i>
									<div class="help-block with-errors"></div>
									@error('password')
										<strong class="text-danger">{{$message}}</strong>
									@enderror
								</div>
							</div>

							<div class="column col-md-6">
								<!-- Confirm password -->
								<div class="form-group">
									<input type="password" class="form-control" name="confirm_password" placeholder="Confirm password" required="required" data-error="Confirm password is required.">
									<i class="toggle-password fa fa-fw fa-eye-slash"></i>
									<div class="help-block with-errors"></div>
									@if (session('wrong'))
										<strong class="text-danger">{{session('wrong')}}</strong>
									@endif
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
							
							<div class="column col-md-12 text-right pe-5">
								<!-- Message textarea -->
								<strong>Already registered?<a href="{{route('login.viewer')}}">Login</a></strong>
							</div>
						</div>
		
						<button type="submit" class="btn btn-default">Submit</button><!-- Send Button -->
		
					</form>
					<!-- Contact Form end -->
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
							<li class="list-inline-item"><a href="{{$contact->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li class="list-inline-item"><a href="{{$contact->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li class="list-inline-item"><a href="{{$contact->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li class="list-inline-item"><a href="{{$contact->pinterest}}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
							<li class="list-inline-item"><a href="{{$contact->medium}}" target="_blank"><i class="fab fa-medium"></i></a></li>
							<li class="list-inline-item"><a href="{{$contact->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
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
		<img width="150" src="{{asset('uploads/logo/')}}/{{$logo->logo}}" alt="logo" />
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
	<ul class="social-icons list-unstyled list-inline mb-0 mt-auto w-100">
		<li class="list-inline-item"><a href="{{$contact->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
		<li class="list-inline-item"><a href="{{$contact->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
		<li class="list-inline-item"><a href="{{$contact->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
		<li class="list-inline-item"><a href="{{$contact->pinterest}}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
		<li class="list-inline-item"><a href="{{$contact->medium}}" target="_blank"><i class="fab fa-medium"></i></a></li>
		<li class="list-inline-item"><a href="{{$contact->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
	</ul>
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


</body>

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
<!-- Mirrored from themeger.shop/html/katen/html/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Nov 2023 05:32:54 GMT -->
</html>