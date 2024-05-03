@extends('layouts.admin')
@section('content')
@can('message_access')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>All messages</h3>
            </div>
            <form action="{{route('select.msg.delete')}}" method="POST">
                @csrf
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
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($messages as $sl=>$message)
                            <tr>
                                <td>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input chkDel" name="message_id[]" type="checkbox" value="{{$message->id}}" id="invalidCheck">
                                            <label class="form-check-label" for="invalidCheck">
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$sl+1}}</td>
                                <td>{{$message->name}}</td>
                                <td>{{$message->email}}</td>
                                <td>{{$message->title}}</td>
                                <td>{{Str::limit($message->description,100,'....')}}</td>
                                <td>
                                    <a href="{{route('view.message',$message->id)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                    <a href="{{route('message.delete',$message->id)}}" class="btn btn-danger"><i class="bx bx-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="mb-2">
                        <button href="" type="submit" class="btn btn-danger">Delete blogger</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@else
<h3 class="text-warning">You don't have to access this page.</h3>
@endcan
@endsection

@section('footer_script')
    
<script>
    $("#chkSelectAll").on('click', function(){
        this.checked ? $(".chkDel").prop("checked", true) : $(".chkDel").prop("checked", false);
    })
</script>
   
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
@endsection