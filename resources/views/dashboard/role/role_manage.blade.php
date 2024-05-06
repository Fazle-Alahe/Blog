@extends('layouts.admin')
@section('content')
@can('role_manage')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Blogger list</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($users as $sl=>$user)
                        <tr>
                            <td>{{$users->firstitem()+$sl}}</td>
                            <td>{{$user->name}}</td>
                            <td class="text-wrap">
                                @forelse ($user->getRoleNames() as $roles)
                                    <span class="btn btn-secondary my-1">{{$roles}}</span>
                                @empty
                                    <span class="text-primary">Not assignd</span>
                                @endforelse
                            </td>
                            @can('role_manage_action')
                                <td>
                                    <a href="{{route('remove.role',$user->id)}}" class="btn btn-danger">Remove role</i></a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </table>
                {{ $users->links() }}
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                <h3>Role list</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Role</th>
                        <th>Permissions</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($role as $roles)
                        <tr>
                            <td>{{$roles->name}}</td>
                            <td class="text-wrap">
                                @foreach ($roles->getPermissionNames() as $permission)
                                    <span class="btn btn-secondary my-1">{{$permission}}</span>
                                @endforeach
                            </td>
                            @can('role_manage_action')
                                <td>
                                    <a href="{{route('edit.role',$roles->id)}}" class="btn btn-primary"><i class="bx bx-edit"></i></a>
                                    <a href="{{route('delete.role',$roles->id)}}" class="btn btn-danger"><i class="bx bx-trash"></i></a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @can('role_manage_action')
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Assign role</h3>
            </div>
            <div class="card-body">
                <form action="{{route('assign.role')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Select user</label>
                        <select name="user_id" class="form-control">
                            <option value="">Select user</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <select name="role" class="form-control">
                            <option value="">Select role</option>
                            @foreach ($role as $roles)
                                <option value="{{$roles->name}}">{{$roles->name}}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Assign</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                <h3>Add New Permission</h3>
            </div>
            <div class="card-body">
                <form action="{{route('permission.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Permission name</label>
                        <input type="text" name="name" class="form-control">
                        @error('name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add permission</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3>Add New Role</h3>
            </div>
            <div class="card-body">
                <form action="{{route('role.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Role name</label>
                        <input type="text" name="role_name" class="form-control">
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
                                <div class="col-lg-6">
                                    <div class="form-check">
                                        <input class="form-check-input" name="permission[]" type="checkbox" value="{{$permission->name}}" id="per{{$permission->id}}">
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
                        <button type="submit" class="btn btn-primary">Add role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
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


@if (session('delete'))
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
    title: '{{session('delete')}}'
    })
</script>
@endif

@if (session('assign'))
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
    title: '{{session('assign')}}'
    })
</script>
@endif


@if (session('remove'))
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
    title: '{{session('remove')}}'
    })
</script>
@endif
@endsection