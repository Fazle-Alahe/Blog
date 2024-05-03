@extends('layouts.master')
@section('title')
   Index
@endsection
@section('content')
@section('index')
@foreach ($cat_view as $blog)
<div class="col-lg-8">
   <!-- featured post large -->
   <div class="post featured-post-lg">
      <div class="details clearfix">
         <a href="{{route('category.blogs',$blog->category_id)}}" class="category-badge">{{$blog->rel_to_category->category_name}}</a>
         <h2 class="post-title"><a href="{{route('single.blog',$blog->slug)}}">{{$blog->title}}</a></h2>
         <ul class="meta list-inline mb-0">
            <li class="list-inline-item"><a href="{{route('single.blogger',$blog->blogger_id)}}">{{$blog->blogger}}</a></li>
            <li class="list-inline-item">{{$blog->created_at->toFormattedDateString()}}</li>
         </ul>
      </div>
      <a href="{{route('single.blog',$blog->slug)}}">
         <div class="thumb rounded">
            <div class="inner data-bg-image" data-bg-image="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}"></div>
         </div>
      </a>
   </div>
</div>
@endforeach
<div class="col-lg-4">

   <!-- post tabs -->
   <div class="post-tabs rounded bordered">
      <!-- tab navs -->
      <ul class="nav nav-tabs nav-pills nav-fill" id="postsTab" role="tablist">
         <li class="nav-item" role="presentation"><button aria-controls="popular" aria-selected="true" class="nav-link active" data-bs-target="#popular" data-bs-toggle="tab" id="popular-tab" role="tab" type="button">Popular</button></li>
         <li class="nav-item" role="presentation"><button aria-controls="recent" aria-selected="false" class="nav-link" data-bs-target="#recent" data-bs-toggle="tab" id="recent-tab" role="tab" type="button">Recent</button></li>
      </ul>
      <!-- tab contents -->
      <div class="tab-content" id="postsTabContent">
         <!-- loader -->
         <div class="lds-dual-ring"></div>
         <!-- popular posts -->
         <div aria-labelledby="popular-tab" class="tab-pane fade show active" id="popular" role="tabpanel">
            <!-- post -->
            @foreach ($blogs as $blog)
            <div class="post post-list-sm circle d-flex justify-content-between mb-4">
               <div class="blg_circle thumb circle">
                  <a href="{{route('single.blog',$blog->slug)}}">
                     <div class="blg_circle inner">
                        <img src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" alt="post-title" class="blg_circle"/>
                     </div>
                  </a>
               </div>
               <div class="details clearfix ms-4">
                  <h6 class="post-title my-0"><a href="{{route('single.blog',$blog->slug)}}">{{$blog->title}}</a></h6>
                  <ul class="meta list-inline mt-1 mb-0">
                     <li class="list-inline-item">{{$blog->created_at->toFormattedDateString()}}</li>
                  </ul>
               </div>
            </div>
            @endforeach
         </div>
         <!-- recent posts -->
         <div aria-labelledby="recent-tab" class="tab-pane fade" id="recent" role="tabpanel">
            <!-- post -->
            @foreach (App\Models\Blog::where('status', 0)->latest()->take(4)->get() as $blog)
               <div class="post post-list-sm circle d-flex justify-content-between mb-4">
                  <div class="blg_circle thumb circle">
                     <a href="{{route('single.blog',$blog->slug)}}">
                        <div class="blg_circle inner">
                           <img src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" alt="post-title" class="blg_circle"/>
                        </div>
                     </a>
                  </div>
                  <div class="details clearfix ms-4">
                     <h6 class="post-title my-0"><a href="{{route('single.blog',$blog->slug)}}">{{$blog->title}}</a></h6>
                     <ul class="meta list-inline mt-1 mb-0">
                        <li class="list-inline-item">{{$blog->created_at->toFormattedDateString()}}</li>
                     </ul>
                  </div>
               </div>
            @endforeach
         </div>
      </div>
   </div>
</div>
@endsection


   <!-- section header -->
   <div class="section-header">
      <h3 class="section-title">Editor’s Pick</h3>
      <img src="frontend/wave.svg" class="wave" alt="wave" />
   </div>

   <div class="padding-30 rounded bordered">
      <div class="row gy-5">
         @foreach ($editors as $blog)
            <div class="col-sm-6">
               <!-- post -->
               <div class="post">
                  <div class="thumb rounded">
                     <a href="{{route('category.blogs',$blog->category_id)}}" class="category-badge position-absolute">{{$blog->rel_to_category->category_name}}</a>
                     <span class="post-format">
                        <i class="icon-picture"></i>
                     </span>
                     <a href="{{route('single.blog',$blog->slug)}}">
                        <div class="inner">
                           <img src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" alt="thumb" />
                        </div>
                     </a>
                  </div>
                  <ul class="meta list-inline mt-4 mb-0">
                     <li class="list-inline-item"><a href="{{route('single.blogger',$blog->blogger_id)}}"><img src="{{asset('uploads/users/')}}/{{$blog->rel_to_user->photo}}" class="author mini_circle" alt="author"/>{{$blog->blogger}}</a></li>
                     <li class="list-inline-item">{{$blog->created_at->toFormattedDateString()}}</li>
                  </ul>
                  <h5 class="post-title mb-3 mt-3"><a href="{{route('single.blog',$blog->slug)}}">{{$blog->title}}</a></h5>
                  <p class="excerpt mb-0">{{Str::limit($blog->sub_title,90,'')}} <a title="see more" href="{{route('single.blog',$blog->slug)}}">....</a></p>
               </div>
            </div>
         @endforeach
         <div class="col-sm-6">
            <!-- post -->
            @foreach ($editors_right as $blog)
               <div class="post post-list-sm square">
                  <div class="thumb rounded">
                     <a href="{{route('single.blog',$blog->slug)}}">
                        <div class="inner">
                           <img src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" alt="post-title" />
                        </div>
                     </a>
                  </div>
                  <div class="details clearfix">
                     <h6 class="post-title my-0"><a href="{{route('single.blog',$blog->slug)}}">{{$blog->title}}</a></h6>
                     <ul class="meta list-inline mt-1 mb-0">
                        <li class="list-inline-item">{{$blog->created_at->toFormattedDateString()}}</li>
                     </ul>
                  </div>
               </div>
            @endforeach
         </div>
      </div>
   </div>

   <div class="spacer" data-height="50"></div>
@php
   $ads =App\Models\Advertise::find(1);
   $about = App\Models\About::find(1);
@endphp
   <!-- horizontal ads -->
   <div class="ads-horizontal text-md-center">
      <span class="ads-title">- Sponsored Ad -</span>
      <a href="#">
         <img src="{{asset('uploads/ads/')}}/{{$ads->content_ads}}" alt="Advertisement" />
      </a>
   </div>

   <div class="spacer" data-height="50"></div>

   <!-- section header -->
   <div class="section-header">
      <h3 class="section-title">Trending</h3>
      <img src="frontend/wave.svg" class="wave" alt="wave" />
   </div>

   <div class="padding-30 rounded bordered">
      <div class="row gy-5">
         <div class="col-sm-6">
            @foreach ($trending_left as $blog)
               <div class="col-sm-12">
                  <!-- post large -->
                  <div class="post">
                     <div class="thumb rounded">
                        <a href="{{route('category.blogs',$blog->category_id)}}" class="category-badge position-absolute">{{$blog->rel_to_category->category_name}}</a>
                        <span class="post-format">
                           <i class="icon-picture"></i>
                        </span>
                        <a href="{{route('single.blog',$blog->slug)}}">
                           <div class="inner">
                              <img src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" alt="thumb" />
                           </div>
                        </a>
                     </div>
                     <ul class="meta list-inline mt-4 mb-0">
                        <li class="list-inline-item"><a href="{{route('single.blogger',$blog->blogger_id)}}"><img src="{{asset('uploads/users/')}}/{{$blog->rel_to_user->photo}}" class="author mini_circle" alt="author"/>{{$blog->blogger}}</a></li>
                        <li class="list-inline-item">{{$blog->created_at->toFormattedDateString()}}</li>
                     </ul>
                     <h5 class="post-title mb-3 mt-3"><a href="{{route('single.blog',$blog->slug)}}">{{$blog->title}}</a></h5>
                     <p class="excerpt mb-0">{{Str::limit($blog->sub_title,90,'')}} <a title="see more" href="{{route('single.blog',$blog->slug)}}">....</a></p>
                  </div>
                  @foreach ($trending_l as $blogs)
                  <!-- post -->
                  <div class="post post-list-sm square before-seperator">
                     <div class="thumb rounded">
                        <a href="{{route('single.blog',$blogs->slug)}}">
                           <div class="inner">
                              <img src="{{asset('uploads/blog/')}}/{{$blogs->thumbnail}}" alt="post-title" />
                           </div>
                        </a>
                     </div>
                     <div class="details clearfix">
                        <h6 class="post-title my-0"><a href="{{route('single.blog',$blogs->slug)}}">{{$blogs->title}}</a></h6>
                        <ul class="meta list-inline mt-1 mb-0">
                           <li class="list-inline-item">{{$blogs->created_at->toFormattedDateString()}}</li>
                        </ul>
                     </div>
                  </div>
                  @endforeach
               </div>
            @endforeach
         </div>
         <div class="col-sm-6">
            @foreach ($trending_right as $blog)
               <div class="col-sm-12">
                  <!-- post large -->
                  <div class="post">
                     <div class="thumb rounded">
                        <a href="{{route('category.blogs',$blog->category_id)}}" class="category-badge position-absolute">{{$blog->rel_to_category->category_name}}</a>
                        <span class="post-format">
                           <i class="icon-picture"></i>
                        </span>
                        <a href="{{route('single.blog',$blog->slug)}}">
                           <div class="inner">
                              <img src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" alt="thumb" />
                           </div>
                        </a>
                     </div>
                     <ul class="meta list-inline mt-4 mb-0">
                        <li class="list-inline-item"><a href="{{route('single.blogger',$blog->blogger_id)}}"><img src="{{asset('uploads/users/')}}/{{$blog->rel_to_user->photo}}" class="author mini_circle" alt="author"/>{{$blog->blogger}}</a></li>
                        <li class="list-inline-item">{{$blog->created_at->toFormattedDateString()}}</li>
                     </ul>
                     <h5 class="post-title mb-3 mt-3"><a href="{{route('single.blog',$blog->slug)}}">{{$blog->title}}</a></h5>
                     <p class="excerpt mb-0">{{Str::limit($blog->sub_title,90,'')}} <a title="see more" href="{{route('single.blog',$blog->slug)}}">....</a></p>
                  </div>
                  @foreach ($trending_r as $blogs)
                  <!-- post -->
                  <div class="post post-list-sm square before-seperator">
                     <div class="thumb rounded">
                        <a href="{{route('single.blog',$blogs->slug)}}">
                           <div class="inner">
                              <img src="{{asset('uploads/blog/')}}/{{$blogs->thumbnail}}" alt="post-title" />
                           </div>
                        </a>
                     </div>
                     <div class="details clearfix">
                        <h6 class="post-title my-0"><a href="{{route('single.blog',$blogs->slug)}}">{{$blogs->title}}</a></h6>
                        <ul class="meta list-inline mt-1 mb-0">
                           <li class="list-inline-item">{{$blogs->created_at->toFormattedDateString()}}</li>
                        </ul>
                     </div>
                  </div>
                  @endforeach
               </div>
            @endforeach
         </div>
      </div>
   </div>

   <div class="spacer" data-height="50"></div>

   <!-- section header -->
   <div class="section-header">
      <h3 class="section-title">Sports</h3>
      <img src="frontend/wave.svg" class="wave" alt="wave" />
      <div class="slick-arrows-top">
         <button type="button" data-role="none" class="carousel-topNav-prev slick-custom-buttons" aria-label="Previous"><i class="icon-arrow-left"></i></button>
         <button type="button" data-role="none" class="carousel-topNav-next slick-custom-buttons" aria-label="Next"><i class="icon-arrow-right"></i></button>
      </div>
   </div>

   <div class="row post-carousel-twoCol post-carousel">
      <!-- post -->
      @foreach (App\Models\Blog::where('status', 0)->where('category_id', 9)->latest()->take(3)->get() as $blog)
         
         <div class="post post-over-content col-md-6">
            <div class="details clearfix">
               <a href="{{route('category.blogs',$blog->category_id)}}" class="category-badge">{{$blog->rel_to_category->category_name}}</a>
               <h4 class="post-title"><a href="{{route('single.blog',$blog->slug)}}">{{$blog->title}}</a></h4>
               <ul class="meta list-inline mb-0">
                  <li class="list-inline-item"><a href="{{route('single.blogger',$blog->blogger_id)}}">{{$blog->blogger}}</a></li>
                  <li class="list-inline-item">{{$blog->created_at->toFormattedDateString()}}</li>
               </ul>
            </div>
            <a href="{{route('single.blog',$blog->slug)}}">
               <div class="thumb rounded">
                  <div class="inner">
                     <img src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" alt="thumb" />
                  </div>
               </div>
            </a>
         </div>
      @endforeach
   </div>

   <div class="spacer" data-height="50"></div>

   <!-- section header -->
   <div class="section-header">
      <h3 class="section-title">Latest Posts</h3>
      <img src="frontend/wave.svg" class="wave" alt="wave" />
   </div>

   <div class="padding-30 rounded bordered">
      <div class="row">
         @foreach (App\Models\Blog::where('status', 0)->latest()->take(4)->get() as $blog)
            <div class="col-md-12 col-sm-6">
               <!-- post -->
               <div class="post post-list clearfix">
                  <div class="thumb rounded">
                     <span class="post-format-sm">
                        <i class="icon-picture"></i>
                     </span>
                     <a href="{{route('single.blog',$blog->slug)}}">
                        <div class="inner">
                           <img src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" alt="post-title" />
                        </div>
                     </a>
                  </div>
                  <div class="details">
                     <ul class="meta list-inline mb-3">
                        <li class="list-inline-item"><a href="{{route('single.blogger',$blog->blogger_id)}}"><img src="{{asset('uploads/users/')}}/{{$blog->rel_to_user->photo}}" class="author mini_circle" alt="author"/>{{$blog->blogger}}</a></li>
                        <li class="list-inline-item"><a href="{{route('category.blogs',$blog->category_id)}}">{{$blog->rel_to_category->category_name}}</a></li>
                        <li class="list-inline-item">{{$blog->created_at->toFormattedDateString()}}</li>
                     </ul>
                     <h5 class="post-title"><a href="{{route('single.blog',$blog->slug)}}">{{$blog->title}}</a></h5>
                     <p class="excerpt mb-0">{{Str::limit($blog->sub_title,90,'')}} <a title="see more" href="{{route('single.blog',$blog->slug)}}">....</a></p>
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
            </div>
         @endforeach
      </div
      >
      <!-- load more button -->
      <div class="text-center">
         <a class="btn btn-simple" href="{{route('all.blogs')}}">Load More</a>
      </div>

   </div>

@endsection

@section('footer_script')
        
@if (session('logged'))
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
    title: '{{session('logged')}}'
    })
</script>
@endif
@endsection