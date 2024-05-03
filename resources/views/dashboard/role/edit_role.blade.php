@extends('layouts.admin')
@section('content')
    
<div class="card">
    <div class="card-header">
        <h3>Edit Role</h3>
    </div>
    <div class="card-body">
        <form action="{{route('update.role',$role->id)}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Role name</label>
                <input type="text" name="role_name" class="form-control" value="{{$role->name}}">
                @error('role_name')
                    <strong class="text-danger">{{$message}}</strong>
                @enderror
                @if (session('exists'))
                    <strong class="text-danger">{{session('exists')}}</strong>
                @endif
            </div>
            <div class="mb-3">
                <div class="row">
                    @foreach ($permissions as $permission)
                        <div class="col-lg-2">
                            <div class="form-check">
                                <input {{$role->hasPermissionTo($permission->name)?'checked':''}} class="form-check-input" name="permission[]" type="checkbox" value="{{$permission->name}}" id="per{{$permission->id}}">
                                <label class="form-check-label" for="per{{$permission->id}}">
                                    {{$permission->name}}
                                </label>
                            </div>
                        </div>
                    @endforeach
                    @error('permission')
                        <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update role</button>
            </div>
        </form>
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