@extends('layouts.admin')
@section('content')
    
<div class="row">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Update profile</h3>
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <div class="card-body">
                <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Name*</label>
                        <input class="form-control" type="text" name="name" value="{{Auth::user()->name}}">
                        @error('name')
                            <strong class="text-danger">Enter your name.</strong>
                        @enderror
                    </div>
    
                    <div class="form-group mb-3">
                        <label class="form-label">Email address*</label>
                        <input class="form-control" type="email" name="email" value="{{Auth::user()->email}}">
                        @error('email')
                            <strong class="text-danger">Enter your email address.</strong>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Photo</label>
                        <input class="form-control" type="file" name="photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <div class="mt-2">
                            <img width="100" src="{{asset('uploads/users/')}}/{{Auth::user()->photo}}" alt="">
                        </div>
                        @error('photo')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
    
                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary w-100" type="submit">  Update </button>
                    </div>
    
                </form>
            </div>
        </div>
    </div>  
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>Update password</h3>
            </div>
            @if (session('pass_success'))
                <div class="alert alert-success">{{session('pass_success')}}</div>
            @endif
            <div class="card-body">
                <form action="{{route('profile.pass.update')}}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label class="form-label">Current Password*</label>
                        <input class="form-control" type="password" name="current_password">
                        <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                        @if (session('wrong_pass'))
                            <strong class="text-danger">{{session('wrong_pass')}}</strong>
                        @endif
                    </div>
    
                    <div class="form-group mb-3">
                        <label class="form-label">New Password*</label>
                        <input class="form-control" type="password" name="new_password">
                        <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                        @error('new_password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>

                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary w-100" type="submit">  Update profile</button>
                    </div>
    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8 m-auto mt-3">
        <div class="card">
            <div class="card-header">
                <h3>About me</h3>
            </div>
            {{-- @if (session('about_update'))
                <div class="alert alert-success">{{session('about_update')}}</div>
            @endif --}}
            <div class="card-body">
                <form action="{{route('blogger.about')}}" method="POST">
                    @csrf
                    <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Faceook</label>
                            <input class="form-control" type="text" name="facebook" value="{{Auth::user()->facebook}}" placeholder="https://facebook.com">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Twitter</label>
                            <input class="form-control" type="text" name="twitter" value="" placeholder="https://twitter.com">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Instagram</label>
                            <input class="form-control" type="text" name="instagram" value="" placeholder="https://instagram.com">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Medium</label>
                            <input class="form-control" type="text" name="medium" value="" placeholder="https://medium.com">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Pinterest</label>
                            <input class="form-control" type="text" name="pinterest" value="" placeholder="https://pinterest.com">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Youtube</label>
                        <input class="form-control" type="text" name="youtube" value="" placeholder="https://youtube.com">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Title</label>
                        <input class="form-control" type="text" name="title" value="{{Auth::user()->title}}">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Desp</label>
                        <textarea name="desp" id="" cols="20" rows="10" class="form-control">
                            {{Auth::user()->desp}}
                        </textarea>
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary w-100" type="submit">  Update </button>
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
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>

    
@if (session('about_update'))
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
    title: '{{session('about_update')}}'
    })
</script>
@endif
@endsection