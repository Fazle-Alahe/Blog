@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Api category test</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($categories as $category)
                                <div class="col-lg-4 my-3">
                                    <div class="card">
                                        <div class="card-header">
                                            {{$category->category_name}}
                                        </div>
                                        <div class="card-header">
                                            <img src="{{env('CATEGORY_IMAGE')}}/{{$category->icon}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($products as $product)
                                <h3>{{$product->blogger}}</h3>
                                <div class="card-header">
                                    <img width="100" src="{{env('BLOG_IMAGE')}}/{{$product->thumbnail}}" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection