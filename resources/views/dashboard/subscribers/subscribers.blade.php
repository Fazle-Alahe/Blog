@extends('layouts.admin')
@extends('layouts.check_all_js')
@section('content')
@can('subscriber')

<div class="row">
    <div class="col-lg-8 m-auto">
        <form action="{{route('selected.subscriber.delete')}}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3>Subscriber list</h3>
                </div>
                
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>
                                <div class="mb-3" style="width: 30px">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="chkSelectAll">
                                        <label class="form-check-label">
                                            Select all
                                        </label>
                                    </div>
                                </div>
                            </th>
                            <th>SL</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($subscribers as $sl=>$subscriber)
                            <tr>
                                <td>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input chkDel" name="subscriber[]" type="checkbox" value="{{$subscriber->id}}" id="invalidCheck">
                                            <label class="form-check-label" for="invalidCheck">
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$subscribers->firstitem()+$sl}}</td>
                                <td>{{$subscriber->email}}</td>
                                @can('subscriber_action')
                                    <td>
                                        <a href="{{route('subscriber.delete',$subscriber->id)}}" class="btn btn-danger" title="delete"><i class="bx bx-trash"></i></a>
                                    </td>
                                @endcan
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center"><h4>No subscribers found</h4></td>
                            </tr>
                        @endforelse
                    </table>
                    @can('subscriber_action')
                        <div class="mb-2">
                            <button type="submit"class="btn btn-danger">Delete</button>
                        </div>     
                    @endcan
                </div>
            </div>
        </form>
        {{ $subscribers->links() }}
    </div>
</div>
@else
<h3 class="text-warning">You don't have to access this page.</h3>
@endcan
@endsection

@section('footer_script')
        
@if (session('Delete'))
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
    title: '{{session('Delete')}}'
    })
</script>
@endif
@endsection