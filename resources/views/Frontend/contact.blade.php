
<!DOCTYPE html>
<html lang="en-US">

<!-- Mirrored from themeger.shop/html/katen/html/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Nov 2023 05:32:54 GMT -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Katen - Contact</title>
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
		.blg_circle{
			height: 70px;
			width: 70px;
			border-radius: 50%;
		}
		.mini_circle{
			height: 35px;
			width: 35px;
			border-radius: 50%;
		}

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

		 .breadcrumb-item+.breadcrumb-item::before {
            content: '' !important;
        }
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

$breads = Request::segments();
	array_pop($breads);
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
								<a class="nav-link" href="{{route('viewer.profile', Auth::guard('viewer')->user()->id)}}">{{Str::limit(Auth::guard('viewer')->user()->name,9,'..')}}</a>
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
                <h1 class="mt-0 mb-2">Contact</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
						@foreach (Request::segments() as $segment)
							<li class="breadcrumb-item active" aria-current="page">
								{{ucwords($segment)}}
							</li>
						@endforeach
                    </ol>
                </nav>
            </div>
        </div>
    </section>

	<!-- section main content -->
	<section class="main-content">
		<div class="container-xl">

			<div class="row">
						
                <div class="col-md-4">
                    <!-- contact info item -->
                    <div class="contact-item bordered rounded d-flex align-items-center">
                        <span class="icon icon-phone"></span>
                        <div class="details">
                            <h3 class="mb-0 mt-0">Phone</h3>
                            <p class="mb-0">{{$contact->phone}}</p>
                        </div>
                    </div>
                    <div class="spacer d-md-none d-lg-none" data-height="30"></div>
                </div>

                <div class="col-md-4">
                    <!-- contact info item -->
                    <div class="contact-item bordered rounded d-flex align-items-center">
                        <span class="icon icon-envelope-open"></span>
                        <div class="details">
                            <h3 class="mb-0 mt-0">E-Mail</h3>
                            <p class="mb-0">{{$contact->email}}</p>
                        </div>
                    </div>
                    <div class="spacer d-md-none d-lg-none" data-height="30"></div>
                </div>

                <div class="col-md-4">
                    <!-- contact info item -->
                    <div class="contact-item bordered rounded d-flex align-items-center">
                        <span class="icon icon-map"></span>
                        <div class="details">
                            <h3 class="mb-0 mt-0">Location</h3>
                            <p class="mb-0">{{$contact->location}}</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="spacer" data-height="50"></div>

            <!-- section header -->
            <div class="section-header">
                <h3 class="section-title">Send Message</h3>
                <img src="{{asset('uploads/icon/')}}/{{$logo->icon}}" class="wave" alt="wave" />
            </div>

            <!-- Contact Form -->
            <form action="{{route('message')}}" id="contact-form" class="contact-form" method="POST">
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

                    <div class="column col-md-12">
                        <!-- Email input -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="InputSubject" name="title" placeholder="Subject" required="required" data-error="Subject is required.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
            
                    <div class="column col-md-12">
                        <!-- Message textarea -->
                        <div class="form-group">
                            <textarea name="description" id="InputMessage" class="form-control" rows="4" placeholder="Your message here..." required="required" data-error="Message is required."></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-default">Submit Message</button><!-- Send Button -->

            </form>
            <!-- Contact Form end -->
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
							<li class="list-inline-item"><a href="{{$contact->facebook}}"><i class="fab fa-facebook-f"></i></a></li>
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
		<div class="d-flex search-form">
			<input class="form-control me-2" id="search_input" type="search" placeholder="Search and press enter ..." aria-label="Search">
			<button class="btn btn-default btn-lg search_btn" type="submit"><i class="icon-magnifier"></i></button>
		</div>
	</div>
</div>

<!-- canvas menu -->
<div class="canvas-menu d-flex align-items-end flex-column">
	<!-- close button -->
	<button type="button" class="btn-close" aria-label="Close"></button>

	<!-- logo -->
	<div class="logo">
		<a class="navbar-brand" href="{{route('index')}}"><img width="150" src="{{asset('uploads/logo/')}}/{{$logo->logo}}" alt="logo" /></a> 
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


	<script>
		$('.search_btn').click(function(){
			var search_input = $('#search_input').val();
			var link = "{{route('all.blogs')}}"+"?search_input="+search_input;
			window.location.href = link;
		})
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

<!-- Mirrored from themeger.shop/html/katen/html/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Nov 2023 05:32:54 GMT -->
</html>