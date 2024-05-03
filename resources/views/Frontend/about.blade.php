@extends('layouts.master')
@section('title')
    About
@endsection
@section('content')
@section('about')
    
    <!-- page header -->
    <section class="page-header">
        <div class="container-xl">
            <div class="text-center">
                <h1 class="mt-0 mb-2">About</h1>
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

@endsection
    <?php
        $logo = App\Models\Logo::find(1);
        $about = App\Models\About::find(1);
    ?>
                    <div class="page-content bordered rounded padding-30">

                        <img src="{{asset('uploads/logo/')}}/{{$logo->logo}}" alt="Katen Doe" class="rounded mb-4" />

                        <p>{!! $about->desp !!}</p>

                        <hr class="my-4" />
                        <ul class="social-icons list-unstyled list-inline mb-0">
                            <li class="list-inline-item"><a href="{{$about->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li class="list-inline-item"><a href="{{$about->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li class="list-inline-item"><a href="{{$about->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li class="list-inline-item"><a href="{{$about->pinterest}}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
							<li class="list-inline-item"><a href="{{$about->medium}}" target="_blank"><i class="fab fa-medium"></i></a></li>
							<li class="list-inline-item"><a href="{{$about->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                        
                    </div>

@endsection