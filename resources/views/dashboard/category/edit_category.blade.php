@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Update category</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('update.category',$categories->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label">Category name</label>
                            <input class="form-control" type="text" name="category_name" value="{{$categories->category_name}}">
                            @error('category_name')
                                <strong class="text-danger">Enter category name.</strong>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Icon</label>
                            <input class="form-control" type="file" name="icon" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            <div class="mt-2">
                                <img width="100" src="{{asset('uploads/category/')}}/{{$categories->icon}}" id="blah">
                            </div>
                            @error('icon')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>

                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary w-100" type="submit"> Update </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
        
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