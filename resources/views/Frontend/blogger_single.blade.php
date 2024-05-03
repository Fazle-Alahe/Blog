
<!DOCTYPE html>
<html lang="en-US">

<!-- Mirrored from themeger.shop/html/katen/html/personal-alt.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Nov 2023 05:32:12 GMT -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Katen - Single blogger</title>
	<meta name="description" content="Katen - Minimal Blog & Magazine HTML Theme">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

	<!-- STYLES -->
	<link rel="stylesheet" href="{{asset('frontend/assets')}}/css/bootstrap.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="{{asset('frontend/assets')}}/css/all.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="{{asset('frontend/assets')}}/css/slick.css" type="text/css" media="all">
	<link rel="stylesheet" href="{{asset('frontend/assets')}}/css/simple-line-icons.css" type="text/css" media="all">
	<link rel="stylesheet" href="{{asset('frontend/assets')}}/css/style.css" type="text/css" media="all">

	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<?php
$logo = App\Models\Logo::find(1);
$about = App\Models\About::find(1);
?>
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

<!-- site wrapper -->
<div class="site-wrapper">

	<div class="main-overlay"></div>

	<!-- header -->
	<header class="header-personal light">
        <div class="container-xl header-top">
			<div class="row align-items-center">

				<div class="col-4 d-none d-md-block d-lg-block">
					<!-- social icons -->
					<ul class="social-icons list-unstyled list-inline mb-0">
						<li class="list-inline-item"><a href="{{$user->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<li class="list-inline-item"><a href="{{$user->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<li class="list-inline-item"><a href="{{$user->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
						<li class="list-inline-item"><a href="{{$user->pinterest}}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
						<li class="list-inline-item"><a href="{{$user->medium}}" target="_blank"><i class="fab fa-medium"></i></a></li>
						<li class="list-inline-item"><a href="{{$user->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
					</ul>
				</div>

				<div class="col-md-4 col-sm-12 col-xs-12 text-center">
				<!-- site logo -->
				<a class="navbar-brand" href="{{route('index')}}"><img width="190" src="{{asset('uploads/logo/')}}/{{$logo->logo}}" alt="logo" /></a> 
					{{-- <a href="personal-alt.html" class="d-block text-logo">Katen<span class="dot">.</span></a> --}}
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

    <!-- section hero -->
    <section class="hero data-bg-image d-flex align-items-center" data-bg-image="{{asset('uploads/users/')}}/{{$user->photo}}">
        <div class="container-xl">
            <!-- call to action -->
            <div class="cta text-center" >
                <h3 class="mt-0 mb-4" style="color: rgb(239, 227, 205) !important;">{{$user->name}}</h3>
                <h4 class="mt-0 mb-4" style="color: rgb(239, 227, 205) !important;">{{$user->title}}</h4>
                <p class="mt-0 mb-4">{{$user->desp}}</p>
                {{-- <a href="#" class="btn btn-light mt-2">About Me</a> --}}
            </div>
        </div>
        <!-- animated mouse wheel -->
        <span class="mouse">
            <span class="wheel"></span>
        </span>
        <!-- wave svg -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 260"><path fill="#FFF" fill-opacity="1" d="M0,256L60,245.3C120,235,240,213,360,218.7C480,224,600,256,720,245.3C840,235,960,181,1080,176C1200,171,1320,213,1380,234.7L1440,256L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
    </section>


    <section class="page-header">
        <div class="container-xl">
            <div class="text-center">
                <h1 class="mt-0 mb-2">Blogger blogs</h1>
            </div>
        </div>
		<div class="col-12 mt-4 d-none d-md-block d-lg-block text-center">
			<!-- social icons -->
			<ul class="social-icons list-unstyled list-inline mb-0">
				<li class="list-inline-item"><h5>Blogger social media:-</h5></li>
				<li class="list-inline-item"><a href="{{$user->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
				<li class="list-inline-item"><a href="{{$user->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
				<li class="list-inline-item"><a href="{{$user->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
				<li class="list-inline-item"><a href="{{$user->pinterest}}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
				<li class="list-inline-item"><a href="{{$user->medium}}" target="_blank"><i class="fab fa-medium"></i></a></li>
				<li class="list-inline-item"><a href="{{$user->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
			</ul>
		</div>
    </section>

    <section class="main-content">
		<div class="container-xl">
            <div class="col-lg-12">
                <div class="row gy-4">
                    @foreach ($blogs as $blog)
                        <div class="col-sm-4">
                            <!-- post -->
                            <div class="post post-grid rounded bordered">
                                <div class="thumb top-rounded">
                                    <a href="{{route('single.blog',$blog->slug)}}">
                                        <div class="inner">
                                            <img src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" alt="post-title" />
                                        </div>
                                    </a>
                                </div>
                                <div class="details">
                                    <ul class="meta list-inline mb-0">
                                        <li class="list-inline-item">{{$blog->created_at->toFormattedDateString()}}</li>
                                    </ul>
                                    <h5 class="post-title mb-3 mt-3"><a href="{{route('single.blog',$blog->slug)}}">{{$blog->title}}</a></h5>
                     				<p class="excerpt mb-0">{{Str::limit($blog->sub_title,90,'')}} <a title="see more" href="{{route('single.blog',$blog->slug)}}">....</a></p>
                                </div>
                                <div class="post-bottom clearfix d-flex align-items-center">
                                    <div class="social-share me-auto">
                                        <button class="toggle-button icon-share"></button>
                                        <ul class="icons list-unstyled list-inline mb-0">
                                            <li class="list-inline-item"><a href="{{$about->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
											<li class="list-inline-item"><a href="{{$about->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
											<li class="list-inline-item"><a href="{{$about->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
											<li class="list-inline-item"><a href="{{$about->pinterest}}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
											<li class="list-inline-item"><a href="{{$about->medium}}" target="_blank"><i class="fab fa-medium"></i></a></li>
											<li class="list-inline-item"><a href="{{$about->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="more-button float-end">
                                        <a href="{{route('single.blog',$blog->slug)}}"><span class="icon-options"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
					<li><a class="dropdown-item" href="personal-alt.html">Personal Alt</a></li>
					<li><a class="dropdown-item" href="minimal.html">Minimal</a></li>
					<li><a class="dropdown-item" href="classic.html">Classic</a></li>
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
		<li class="list-inline-item"><a href="{{$about->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
		<li class="list-inline-item"><a href="{{$about->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
		<li class="list-inline-item"><a href="{{$about->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
		<li class="list-inline-item"><a href="{{$about->pinterest}}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
		<li class="list-inline-item"><a href="{{$about->medium}}" target="_blank"><i class="fab fa-medium"></i></a></li>
		<li class="list-inline-item"><a href="{{$about->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
	</ul>
</div>

<!-- JAVA SCRIPTS -->
<script src="{{asset('frontend/assets')}}/js/jquery.min.js"></script>
<script src="{{asset('frontend/assets')}}/js/popper.min.js"></script>
<script src="{{asset('frontend/assets')}}/js/bootstrap.min.js"></script>
<script src="{{asset('frontend/assets')}}/js/slick.min.js"></script>
<script src="{{asset('frontend/assets')}}/js/jquery.sticky-sidebar.min.js"></script>
<script src="{{asset('frontend/assets')}}/js/custom.js"></script>



<script>
	$('.search_btn').click(function(){
		var search_input = $('#search_input').val();
		var link = "{{route('all.blogs')}}"+"?search_input="+search_input;
		window.location.href = link;
	})
</script>

</body>

<!-- Mirrored from themeger.shop/html/katen/html/personal-alt.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Nov 2023 05:32:28 GMT -->
</html>