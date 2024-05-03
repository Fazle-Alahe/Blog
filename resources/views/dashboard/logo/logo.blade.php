@extends('layouts.admin')
@section('content')
@can('logo_access')

<div class="row justify-content-between">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>Update Logo</h3>
            </div>
            <div class="card-body">
                <form action="{{route('update.logo')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Logo</label>
                        <input type="file" name="logo" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        @error('logo')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <img width="150" src="{{asset('uploads/logo/')}}/{{$logo->logo}}" id="blah">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <h3>Update icon</h3>
            </div>
            <div class="card-body">
                <form action="{{route('icon.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Icon</label>
                        <input type="file" name="icon" class="form-control" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">
                        @error('icon')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <img width="150" src="{{asset('uploads/icon/')}}/{{$logo->icon}}" id="blah2">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4 m-auto">
        <img width="300" src="{{asset('uploads/logo/')}}/{{$logo->logo}}" alt="">
    </div>
</div>
@else
<h3 class="text-warning">You don't have to access this page.</h3>
@endcan
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