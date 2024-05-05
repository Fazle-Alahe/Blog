@extends('layouts.admin')
@section('content')
@can('all_blogs')
<div class="row">
    <div class="col-lg-12">
        <form action="{{route('select.blog.soft_delete')}}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="mr-auto p-2">Blog list</h3>
                    <div class="p-2">
                        <a href="{{route('trash.blog')}}" class="btn btn-primary p-2"><i class="bx bx-menu"></i>Trash Blog list</a>
                        <a href="{{route('blog')}}" class="btn btn-info p-2"><i class="bx bx-menu"></i>Create Blog</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>
                                <div class="mb-3" style="width: 50px">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="chkSelectAll">
                                        <label class="form-check-label">
                                            Select all
                                        </label>
                                    </div>
                                </div>
                            </th>
                            <th>SL</th>
                            <th>Thumbnail</th>
                            <th>Blogger</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($blogs as $sl=>$blog)
                            <tr>
                                <td>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input chkDel" name="blog_id[]" type="checkbox" value="{{$blog->id}}" id="invalidCheck">
                                            <label class="form-check-label" for="invalidCheck">
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$sl+1}}</td>
                                <td>
                                    <img src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" width="150" alt="">
                                </td>
                                <td>{{$blog->blogger}}</td>
                                <td>{{$blog->rel_to_category->category_name}}</td>
                                <td>{{$blog->title}}</td>
                                <td>
                                    <a href="{{route('blog.status',$blog->id)}}" class="btn btn-{{$blog->status == 0?'success':'secondary'}}">{{$blog->status == 0?'Active':'Deactive'}}</a>
                                </td>
                                <td>
                                    @can('blogs_edit')
                                        <a href="{{route('edit.blog',$blog->id)}}" class="btn btn-primary" title="edit"><i class="bx bx-edit"></i></a>
                                    @endcan

                                    @can('blogs_action')
                                        <a href="{{route('blog.soft.delete',$blog->id)}}" class="btn btn-warning" title="soft-delete"><i class="bx bx-trash"></i></a>
                                        <a href="{{route('blog.view',$blog->id)}}" class="btn btn-info" title="view"><i class="fa-regular fa-eye"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="mb-2">
                        <button title="soft-delete" type="submit" class="btn btn-warning">Delete blog</button>
                    </div>
                </div>
            </div>
        </form>
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