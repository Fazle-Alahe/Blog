@extends('layouts.admin')
{{-- @extends('layouts.check_all_js') --}}
@section('content')
@can('trash_tag')
<div class="row">
    <div class="col-lg-8 m-auto">
        <form action="{{route('tag.select.restore')}}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Trash tag list</h3>
                    <a href="{{route('tag')}}" class="btn btn-primary"><i class="bx bx-menu"></i>Tag list</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>
                                <div class="mb-3" style="width: 20px">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="chkSelectAll">
                                        <label class="form-check-label">
                                            Select all
                                        </label>
                                    </div>
                                </div>
                            </th>
                            <th>SL</th>
                            <th>Tag name</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($trash_tag as $sl=>$tag)
                            <tr>
                                <td>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input chkDel" name="tag_id[]" type="checkbox" value="{{$tag->id}}" id="invalidCheck">
                                            <label class="form-check-label" for="invalidCheck">
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$sl+1}}</td>
                                <td>{{$tag->tag_name}}</td>
                                @can('trash_tag_action')
                                    <td>
                                        <a href="{{route('restore.tag',$tag->id)}}" class="btn btn-success" title="restore"><i class="bx bx-refresh"></i></a>
                                        <a href="{{route('tag.permanent.delete',$tag->id)}}" class="btn btn-danger" title="permanent-delete"><i class="bx bx-trash"></i></a>
                                    </td>
                                @endcan
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center"><h4>No trash user found</h4></td>
                            </tr>
                        @endforelse
                    </table>
                    @can('trash_tag_action')
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
        
@if (session('tag_restore'))
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
    title: '{{session('tag_restore')}}'
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