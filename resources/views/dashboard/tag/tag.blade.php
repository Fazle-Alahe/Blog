@extends('layouts.admin')
@section('content')
@can('tag_add')
    <div class="row">
        <div class="col-lg-8">
            <form action="{{route('tag.select.soft_delete')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Tag list</h3>
                        <a href="{{route('trash.tag')}}" class="btn btn-primary"><i class="bx bx-menu"></i>Trash tag list</a>
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
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            @foreach($tags as $sl=>$tag)
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
                                    @can('tag_action')
                                        <td>
                                            <a href="{{route('tag.soft.delete',$tag->id)}}" class="btn btn-warning" title="soft-delete"><i class="bx bx-trash"></i></a>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </table>
                        @can('tag_action')
                            <div class="mb-2">
                                <button title="soft-delete" type="submit" class="btn btn-warning">Delete blogger</button>
                            </div>
                        @endcan
                    </div>
                </div>
            </form>
        </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Add new tag</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('store.tag')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Tag name</label>
                                <input type="text" name="tag_name" class="form-control">
                                @error('tag_name')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Add tag</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    {{ $tags->links() }}
    @endcan
@endsection

@section('footer_script')
    
<script>
    $("#chkSelectAll").on('click', function(){
        this.checked ? $(".chkDel").prop("checked", true) : $(".chkDel").prop("checked", false);
    })
</script>

        
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