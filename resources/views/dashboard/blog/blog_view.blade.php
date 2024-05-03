@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="nam">
                        <strong>Blogger name:-</strong><h3>{{$blog->blogger}}</h3>
                    </div>
                    <div class="bttn">
                        <a href="{{route('blog.soft.delete',$blog->id)}}" class="btn btn-warning" title="soft-delete">Delete</i></a>
                        <a href="{{route('blog.status',$blog->id)}}" class="btn btn-{{$blog->status == 0?'success':'secondary'}}">{{$blog->status == 0?'Active':'Deactive'}}</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Thumbnail</label>
                        <div class="my-3 text-center">
                            <img width="500" src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" alt="">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        <h4>{{$blog->title}}</h4>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Category</label>
                        <h4>{{$blog->rel_to_category->category_name}}</h4>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tags</label>
                        <h4>{{$blog->tags}}</h4>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Subtitle</label>
                        <h5>{{$blog->sub_title}}</h5>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                        <p>{!! $blog->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection