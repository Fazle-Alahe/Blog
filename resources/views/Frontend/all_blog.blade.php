@extends('layouts.master')
@section('title')
    All blogs
@endsection
@section('content')
@section('about')
    
    <!-- page header -->
    <section class="page-header">
        <div class="container-xl">
            <div class="text-center">
                <h1 class="mt-0 mb-2">All Blogs</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All blogs</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
@endsection

<?php
$about = App\Models\About::find(1);
?>
<div class="row gy-4">
    @forelse ($blogs as $blog)
        
    <div class="col-sm-6">
        <!-- post -->
        <div class="post post-grid rounded bordered">
            <div class="thumb top-rounded">
                <a href="{{route('category.blogs',$blog->category_id)}}" class="category-badge position-absolute">{{$blog->rel_to_category->category_name}}</a>
                <span class="post-format">
                    <i class="icon-picture"></i>
                </span>
                <a href="{{route('single.blog',$blog->slug)}}">
                    <div class="inner">
                        <img src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" alt="post-title" />
                    </div>
                </a>
            </div>
            <div class="details">
                <ul class="meta list-inline mb-0">
                    <li class="list-inline-item"><a href="#"><img src="{{asset('uploads/users/')}}/{{$blog->rel_to_user->photo}}" class="author mini_circle" alt="author"/>{{$blog->blogger}}</a></li>
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
    @empty
        <h3 class="text-warning">No search post found.</h3>
    @endforelse 
</div>
<nav>
    <ul class="pagination justify-content-center">
        <li class="page-item active" aria-current="page">
            <span class="page-link">1</span>
        </li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
    </ul>
</nav>
@endsection
