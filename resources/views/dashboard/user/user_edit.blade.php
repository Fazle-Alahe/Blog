@extends('layouts.admin')
@section('content')
    
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>Update user</h3>
            </div>
            <div class="card-body">
                <form action="{{route('edit.user',$users->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Name*</label>
                        <input class="form-control" type="text" name="name" value="{{$users->name}}">
                        @error('name')
                            <strong class="text-danger">Enter your name.</strong>
                        @enderror
                    </div>
    
                    <div class="form-group mb-3">
                        <label class="form-label">Email address*</label>
                        <input class="form-control" type="email" name="email" value="{{$users->email}}">
                        @error('email')
                            <strong class="text-danger">Enter your email address.</strong>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Photo</label>
                        <input class="form-control" type="file" name="photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <div class="mt-2">
                            <img width="100" src="{{asset('uploads/users/')}}/{{$users->photo}}" id="blah">
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
            <div class="card-body">
                <form action="{{route('update.user.pass',$users->id)}}" method="POST">
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
                        <button class="btn btn-primary w-100" type="submit">  Update </button>
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

    
@if (session('pass_success'))
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
    title: '{{session('pass_success')}}'
    })
</script>
@endif
@endsection