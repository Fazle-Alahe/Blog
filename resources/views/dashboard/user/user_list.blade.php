@extends('layouts.admin')
@section('content')
@can('blogger_access')
<div class="row">
    <div class="col-lg-8">
        <form action="{{route('user.select.soft_delete')}}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                        <h3>Blogger list</h3>
                        <a href="{{route('trash.user')}}" class="btn btn-primary"><i class="bx bx-menu"></i>Trash Blogger</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="chkSelectAll">
                                        <label class="form-check-label">
                                            Select all
                                        </label>
                                    </div>
                                </div>
                            </th>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Photo</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach($users as $sl=>$user)
                            <tr>
                                <td>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input chkDel" name="user_id[]" type="checkbox" value="{{$user->id}}" id="invalidCheck">
                                            <label class="form-check-label" for="invalidCheck">
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$sl+1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if ($user->photo == null)
                                        <img width="60" src="{{asset('uploads/profile_default.PNG')}}">
                                    @else
                                      <img width="70" src="{{asset('uploads/users/')}}/{{$user->photo}}" class="blg_circle">
                                    @endif
                                </td>
                                @can('blogger_action')
                                    <td>
                                        <a href="{{route('user.status',$user->id)}}" class="btn btn-{{$user->status == 0?'success':'secondary'}}" data-plugin="switchery" data-color="#039cfd">{{$user->status == 0?'Active':'Deactive'}}</a>
                                    </td>
                                    <td>
                                        <a href="{{route('user.edit',$user->id)}}" class="btn btn-primary" title="edit"><i class="bx bx-edit"></i></a>
                                        <a href="{{route('user.soft.delete',$user->id)}}" class="btn btn-warning" title="soft-delete"><i class="bx bx-trash"></i></a>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </table>
                    @can('blogger_action')
                        <div class="mb-2">
                            <button title="soft-delete" type="submit" class="btn btn-warning">Delete blogger</button>
                        </div>
                    @endcan
                </div>
            </div>
        </form>
    </div>
    @can('blogger_add')
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add new blogger</h3>
            </div>
            <div class="card-body">
                <form action="{{route('user.add')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Name*</label>
                        <input class="form-control" type="text" name="name">
                        @error('name')
                            <strong class="text-danger">Enter your name.</strong>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Email address*</label>
                        <input class="form-control" type="email" name="email">
                        @error('email')
                            <strong class="text-danger">Enter your email address.</strong>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Password*</label>
                        <input class="form-control" type="password" name="password">
                        <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                        @error('password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Confirm Password*</label>
                        <input class="form-control" type="password" name="confirm_password">
                        <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                        @if (session('wrong'))
                            <strong class="text-danger">{{session('wrong')}}</strong>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Photo</label>
                        <input class="form-control" type="file" name="photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <div class="my-3">
                            <img width="100" id="blah"/>
                        </div>
                        @error('photo')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>

                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary w-100" type="submit"> Add blogger </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    @endcan
</div>
@endcan
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
    
    <script>
        $("#chkSelectAll").on('click', function(){
            this.checked ? $(".chkDel").prop("checked", true) : $(".chkDel").prop("checked", false);
        })
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

    
@if (session('soft_delete'))
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
    title: '{{session('soft_delete')}}'
    })
</script>
@endif
@endsection