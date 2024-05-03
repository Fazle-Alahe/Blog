
@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Edit Blog</h3>
                </div>
                {{-- @if (session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif --}}
                <div class="card-body">
                    <form action="{{route('post.edit.blog',$blog->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Blogger name</label>
                                    <input class="form-control" type="text" name="name" value="{{$blog->blogger}}">
                                </div>
                            </div>

                            {{-- <input type="hidden" name="blogger_id" value="{{Auth::user()->id}}"> --}}

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Select category</label>
                                    <select class="form-control" name="category_id">
                                        <option checked value="">{{$blog->rel_to_category->category_name}}</option>
                                        @foreach (App\Models\Category::all() as $category)
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
                                <input class="form-control" type="text" name="title" value="{{$blog->title}}">
                                @error('title')
                                    <strong class="text-danger">Create a title for your blog.</strong>
                                @enderror
                            </div>
                            @php
                                $tagg = explode(',',$blog->tags);
                            @endphp
                            <div class="form-group mb-3">
                                <select id="select-gear" name="tags[]" class="demo-default" multiple>
                                        <option value="">Select tags</option>
                                    <optgroup label="Climbing">
                                        @foreach ($tags as $tag)
                                            <option
                                                @foreach ($tagg as $tags)
                                                    {{$tags == $tag->id?'selected':''}}
                                                @endforeach 
                                                value="{{$tag->id}}">{{$tag->tag_name}}</option>
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
                                    {!! $blog->sub_title !!}
                                </textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Description</label>
                                <textarea id="summernote" name="desp"  cols="30" rows="10" class="form-control">
                                    {!! $blog->description !!}
                                </textarea>
                                @error('desp')
                                    <strong class="text-danger">Write description about your blog.</strong>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Thumbnail</label>
                                <input class="form-control" type="file" name="photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                @error('photo')
                                    <strong class="text-danger">Thumbnail is required.</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <img src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" alt="" width="200" id="blah">
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