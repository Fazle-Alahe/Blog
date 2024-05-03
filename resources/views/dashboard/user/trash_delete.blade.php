@extends('layouts.admin')
{{-- @extends('layouts.check_all_js') --}}
@section('content')
@can('trash_blogger')
<div class="row">
    <div class="col-lg-8 m-auto">
        <form action="{{route('user.select.restore')}}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Trash blogger list</h3>
                    <a href="{{route('user.list')}}" class="btn btn-primary"><i class="bx bx-menu"></i>Bloggers</a>
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
                            <th>Action</th>
                        </tr>
                        @forelse ($trash_user as $sl=>$user)
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
                                    <img width="70" src="{{asset('uploads/users/')}}/{{$user->photo}}" class="rounded-circle">
                                    @endif
                                </td>
                                @can('trash_blogger_action')
                                    <td>
                                        <a href="{{route('restore.user',$user->id)}}" class="btn btn-success" title="restore"><i class="bx bx-refresh"></i></a>
                                        <a href="{{route('user.permanent.delete',$user->id)}}" class="btn btn-danger" title="permanent-delete"><i class="bx bx-trash"></i></a>
                                    </td>
                                @endcan
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center"><h4>No trash user found</h4></td>
                            </tr>
                        @endforelse
                    </table>
                    @can('trash_blogger_action')
                        <div class="mb-2">
                            <button type="submit" value="1" name="btn" class="btn btn-success">Restore</button>
                            <button type="submit"  value="2" name="btn" class="btn btn-danger">Permanent Delete</button>
                        </div>
                    @endcan
                </div>
            </div>
        </form>
    </div>
</div>
@endcan
@endsection

@section('footer_script')
<script>
    $("#chkSelectAll").on('click', function(){
        this.checked ? $(".chkDel").prop("checked", true) : $(".chkDel").prop("checked", false);
    })
</script>
        
@if (session('user_restore'))
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
    title: '{{session('user_restore')}}'
    })
</script>
@endif

    
@if (session('pDelete'))
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
    title: '{{session('pDelete')}}'
    })
</script>
@endif
@endsection