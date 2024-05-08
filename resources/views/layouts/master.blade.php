
<!DOCTYPE html>
<html lang="en-US">

<!-- Mirrored from themeger.shop/html/katen/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Nov 2023 05:32:38 GMT -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Katen - @yield('title')</title>
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
		.blg_circle{
			height: 65px;
			width: 70px;
			border-radius: 50%;
		}
		
		.comment_circle{
			height: 60px;
			width: 60px;
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
$about = App\Models\About::find(1);
$ads =App\Models\Advertise::find(1);

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
						<li class="list-inline-item"><a href="{{$about->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<li class="list-inline-item"><a href="{{$about->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<li class="list-inline-item"><a href="{{$about->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
						<li class="list-inline-item"><a href="{{$about->pinterest}}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
						<li class="list-inline-item"><a href="{{$about->medium}}" target="_blank"><i class="fab fa-medium"></i></a></li>
						<li class="list-inline-item"><a href="{{$about->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
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
	<!-- hero section -->
	<section id="hero">

		<div class="container-xl">

			<div class="row gy-4">

				@yield('index')
				{{-- <div class="col-lg-4">

				</div> --}}

			</div>

		</div>

	</section>
	@yield('about')
	<!-- section main content -->
	<section class="main-content">
		<div class="container-xl">

			<div class="row gy-4">

				<div class="col-lg-8">

					@yield('content')
				</div>
				<div class="col-lg-4">

					<!-- sidebar -->
					<div class="sidebar">
						<!-- widget about -->
						<div class="widget rounded">
							<div class="widget-about data-bg-image text-center" data-bg-image="map_bg.png">
								<img src="{{asset('uploads/logo/')}}/{{$logo->logo}}" alt="logo" class="mb-4" />
								<p class="mb-4">{!!Str::limit($about->desp,160,'')!!} <a title="see more" href="{{route('about.site')}}">....</a></p>
								<ul class="social-icons list-unstyled list-inline mb-0">
									<li class="list-inline-item"><a href="{{$about->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
									<li class="list-inline-item"><a href="{{$about->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
									<li class="list-inline-item"><a href="{{$about->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
									<li class="list-inline-item"><a href="{{$about->pinterest}}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
									<li class="list-inline-item"><a href="{{$about->medium}}" target="_blank"><i class="fab fa-medium"></i></a></li>
									<li class="list-inline-item"><a href="{{$about->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
								</ul>
							</div>
						</div>

						<!-- widget popular posts -->
						<div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Popular Posts</h3>
								<img src="{{asset('uploads/icon/')}}/{{$logo->icon}}" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<!-- post -->
								@foreach (App\Models\Blog::where('status', 0)->orderBy('view', 'DESC')->take(3)->get() as $blog)
								<div class="post post-list-sm circle  d-flex justify-content-between mb-4 w-100">
									<div class="blg_circle thumb circle">
									   <a href="{{route('single.blog',$blog->slug)}}">
										  <div class="blg_circle inner">
											 <img src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" alt="post-title" class="blg_circle"/>
										  </div>
									   </a>
									</div>
									<div class="details ms-4 w-100">
									   <h6 class="post-title my-0"><a href="{{route('single.blog',$blog->slug)}}">{{$blog->title}}</a></h6>
									   <ul class="meta list-inline mt-1 mb-0">
										  <li class="list-inline-item">{{$blog->created_at->toFormattedDateString()}}</li>
									   </ul>
									</div>
								 </div>
								@endforeach
							</div>		
						</div>

						<!-- widget categories -->
						<div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Explore Topics</h3>
								<img src="{{asset('uploads/icon/')}}/{{$logo->icon}}" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<ul class="list">
									@foreach (App\Models\Category::all() as $category)
										<li><a href="{{route('category.blogs',$category->id)}}">{{$category->category_name}}</a><span>({{App\Models\Blog::where('category_id', $category->id)->get()->count()}})</span></li>
									@endforeach
								</ul>
							</div>
							
						</div>

						<!-- widget newsletter -->
						<div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Newsletter</h3>
								<img src="{{asset('uploads/icon/')}}/{{$logo->icon}}" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<span class="newsletter-headline text-center mb-3">Join {{App\Models\Subscriber::all()->count()}} subscribers!</span>
								<form action="{{route('subscribe')}}" method="POST">
									@csrf                  
									@if (session('subscribe'))
										<div class="alert alert-success">{{session('subscribe')}}</div>
									@endif
									<div class="mb-2">
										<input class="form-control w-100 text-center" placeholder="Email address…" type="email" name="email">
										@error('email')
											<strong class="text-danger">{{$message}}</strong>
										@enderror
									</div>
									<button class="btn btn-default btn-full" type="submit">Sign Up</button>
								</form>
								<span class="newsletter-privacy text-center mt-3">By signing up, you agree to our <a href="#">Privacy Policy</a></span>
							</div>		
						</div>

						<!-- widget post carousel -->
						<div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Fashion</h3>
								<img src="{{asset('uploads/icon/')}}/{{$logo->icon}}" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<div class="post-carousel-widget">
									<!-- post -->
									@foreach (App\Models\Blog::where('status', 0)->where('category_id', 10)->latest()->take(3)->get() as $blog)
										<div class="post post-carousel">
											<div class="thumb rounded">
												<a href="{{route('category.blogs',$category->id)}}" class="category-badge position-absolute">{{$blog->rel_to_category->category_name}}</a>
												<a href="{{route('single.blog',$blog->slug)}}">
													<div class="inner">
														<img src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" alt="post-title" />
													</div>
												</a>
											</div>
											<h5 class="post-title mb-0 mt-4"><a href="{{route('single.blog',$blog->slug)}}">{{$blog->title}}</a></h5>
											<ul class="meta list-inline mt-2 mb-0">
												<li class="list-inline-item"><a href="{{route('single.blogger',$blog->blogger_id)}}">{{$blog->blogger}}</a></li>
												<li class="list-inline-item">{{$blog->created_at->toFormattedDateString()}}</li>
											</ul>
										</div>
									@endforeach
								</div>
								<!-- carousel arrows -->
								<div class="slick-arrows-bot">
									<button type="button" data-role="none" class="carousel-botNav-prev slick-custom-buttons" aria-label="Previous"><i class="icon-arrow-left"></i></button>
									<button type="button" data-role="none" class="carousel-botNav-next slick-custom-buttons" aria-label="Next"><i class="icon-arrow-right"></i></button>
								</div>
							</div>		
						</div>

						<!-- widget advertisement -->
						<div class="widget no-container rounded text-md-center">
							<span class="ads-title">- Sponsored Ad -</span>
							<a href="#" class="widget-ads">
								<img src="{{asset('uploads/ads/')}}/{{$ads->side_ads}}" alt="Advertisement" />	
							</a>
						</div>

						<!-- widget tags -->
						<div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Tag Clouds</h3>
								<img src="{{asset('uploads/icon/')}}/{{$logo->icon}}" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								@foreach (App\Models\Tag::orderBy('uses', 'DESC')->take(6)->get() as $tags)
									<button value="{{$tags->id}}" class="tag">#{{$tags->tag_name}}</button>
								@endforeach
							</div>		
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
							<li class="list-inline-item"><a href="{{$about->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li class="list-inline-item"><a href="{{$about->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li class="list-inline-item"><a href="{{$about->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li class="list-inline-item"><a href="{{$about->pinterest}}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
							<li class="list-inline-item"><a href="{{$about->medium}}" target="_blank"><i class="fab fa-medium"></i></a></li>
							<li class="list-inline-item"><a href="{{$about->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
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




    {{-- select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script>
		$('.tag').click(function(){
			var tag = $(this).val();
			var link = "{{route('all.blogs')}}"+"?tag="+tag;
			window.location.href = link;
		})
	</script>
	
	<script>
		$('.search_btn').click(function(){
			var search_input = $('#search_input').val();
			var link = "{{route('all.blogs')}}"+"?search_input="+search_input;
			window.location.href = link;
		})
	</script>
@yield('footer_script')

</body>

<!-- Mirrored from themeger.shop/html/katen/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Nov 2023 05:32:47 GMT -->
</html>