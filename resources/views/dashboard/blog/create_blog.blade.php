
@extends('layouts.admin')
@section('content')
@can('create_blog')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="mr-auto p-2">Create Blog</h3>
                <div class="p-2">
                    <a href="{{route('all.blog')}}" class="btn btn-primary p-2"><i class="bx bx-menu"></i>Blog list</a>
                </div>
            </div>
            {{-- @if (session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif --}}
            <div class="card-body">
                <form action="{{route('post.blog')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Blogger name</label>
                                <input class="form-control" type="text" name="name" value="{{Auth::user()->name}}">
                                @error('name')
                                    <strong class="text-danger">Blogger name is required.</strong>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="blogger_id" value="{{Auth::user()->id}}">

                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Select category</label>
                                <select class="form-control" name="category_id">
                                    <option  value="">Select Category</option>
                                    @foreach (App\Models\Category::where('status', 0)->get() as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <strong class="text-danger">Select a category.</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Blog title</label>
                            <input class="form-control" type="text" name="title" value="">
                            @error('title')
                                <strong class="text-danger">Create a title for your blog.</strong>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <select id="select-gear" name="tags[]" class="demo-default" multiple>
                                <option value="">Select tags</option>
                                <optgroup label="Climbing">
                                    @foreach ($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->tag_name}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('tags')
                                <strong class="text-danger">Input some tags which is related to your blog.</strong>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Subtitle</label>
                            <textarea name="sub_title" class="form-control">
                                
                            </textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Description</label>
                            <textarea id="summernote" name="desp"  cols="30" rows="10" class="form-control">
                                
                            </textarea>
                            @error('desp')
                                <strong class="text-danger">Write description about your blog.</strong>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Thumbnail</label>
                            <input class="form-control" type="file" name="photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            <div class="mt-2">
                                <img width="150"  id="blah">
                            </div>
                            @error('photo')
                                <strong class="text-danger">Thumbnail is required.</strong>
                            @enderror
                        </div>
                        <div class="col-lg-6 m-auto">
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@else
<h3 class="text-warning">You don't have to access this page.</h3>
@endcan
@endsection
@section('footer_script')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>

<script>
   $('#select-gear').selectize({ sortField: 'text' })
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

@endsection