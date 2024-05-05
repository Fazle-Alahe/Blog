@extends('layouts.admin')
@extends('layouts.check_all_js')
@section('content')
@can('category_access')

<div class="row">
    <div class="col-lg-8">
        <form action="{{route('cat.select.soft_delete')}}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                        <h3>Category list</h3>
                        <a href="{{route('trash.category')}}" class="btn btn-primary"><i class="bx bx-menu"></i>Trash Category</a>
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
                            <th>Category name</th>
                            <th>Icon</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($categories as $sl=>$category)
                            <tr>
                                <td>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input chkDel" name="category_id[]" type="checkbox" value="{{$category->id}}" id="invalidCheck">
                                            <label class="form-check-label" for="invalidCheck">
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$sl+1}}</td>
                                <td>{{$category->category_name}}</td>
                                <td>
                                    @if ($category->icon == null)
                                        <img width="50" src="{{asset('uploads/null_category.jpg')}}">
                                    @else
                                      <img width="70" src="{{asset('uploads/category/')}}/{{$category->icon}}" class="rounded-circle">
                                    @endif
                                </td>
                                @can('category_action')
                                <td>
                                    <a href="{{route('category.status',$category->id)}}" class="btn btn-{{$category->status == 0?'success':'secondary'}}">{{$category->status == 0?'Active':'Deactive'}}</a>
                                </td>
                                <td>
                                    <a href="{{route('edit.category',$category->id)}}" class="btn btn-primary" title="edit"><i class="bx bx-edit"></i></a>
                                    <a href="{{route('category.soft.delete',$category->id)}}" class="btn btn-warning" title="soft-delete"><i class="bx bx-trash"></i></a>
                                </td>
                                @endcan
                            </tr>
                        @endforeach
                    </table>
                    @can('category_action')
                        <div class="mb-2">
                            <button title="soft-delete" type="submit" class="btn btn-warning">Delete catagories</button>
                        </div>
                    @endcan
                </div>
            </div>
        </form>
    </div>
    <div class="mt-3">
        {{$categories->links()}}
    </div>
    
    @can('category_add')
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add new category</h3>
            </div>
            <div class="card-body">
                <form action="{{route('add.category')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Category name</label>
                        <input class="form-control" type="text" name="category_name">
                        @error('category_name')
                            <strong class="text-danger">Enter category name.</strong>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Icon</label>
                        <input class="form-control" type="file" name="icon" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <div class="my-3">
                            <img width="100" id="blah"/>
                        </div>
                        @error('icon')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>

                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary w-100" type="submit"> Add category </button>
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