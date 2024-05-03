@extends('layouts.admin')
@section('content')
@can('about_us')
<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header text-center">
                <h3>About us</h3>
            </div>
            <div class="card-body">
                <form action="{{route('update.about')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Phone</label>
                                <input class="form-control" type="text" name="phone" value="{{$about->phone}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" name="email" value="{{$about->email}}">
                                @error('email')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Location</label>
                                <input class="form-control" type="text" name="location" value="{{$about->location}}">
                                @error('location')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Faceook</label>
                                <input class="form-control" type="text" name="facebook" value="{{$about->facebook}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Twitter</label>
                                <input class="form-control" type="text" name="twitter" value="{{$about->twitter}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Instagram</label>
                                <input class="form-control" type="text" name="instagram" value="{{$about->instagram}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Medium</label>
                                <input class="form-control" type="text" name="medium" value="{{$about->medium}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Pinterest</label>
                                <input class="form-control" type="text" name="pinterest" value="{{$about->pinterest}}">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Youtube</label>
                            <input class="form-control" type="text" name="youtube" value="{{$about->youtube}}">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Title</label>
                            <input class="form-control" type="text" name="title" value="{{$about->title}}">
                            @error('title')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Description</label>
                            <textarea id="summernote" name="desp"  cols="30" rows="10" class="form-control">
                                {{$about->desp}}
                            </textarea>
                            @error('desp')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="col-lg-6 m-auto">
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary w-100">Update</button>
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