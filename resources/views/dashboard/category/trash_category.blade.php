@extends('layouts.admin')
@extends('layouts.check_all_js')
@section('content')
@can('trash_category')
    
<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                    <h3>Trash category list</h3>
                    <a href="{{route('category')}}" class="btn btn-primary"><i class="bx bx-menu"></i>Category list</a>
            </div>
            <form action="{{route('cat.select.restore')}}" method="POST">
                @csrf
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
                            <th>Category name</th>
                            <th>Icon</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($trash_category as $sl=>$category)
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
                                <td>{{$trash_category->firstitem()+$sl}}</td>
                                <td>{{$category->category_name}}</td>
                                <td>
                                    @if ($category->icon == null)
                                        <img width="50" src="{{asset('uploads/null_category.jpg')}}">
                                    @else
                                      <img width="70" src="{{asset('uploads/category/')}}/{{$category->icon}}" class="rounded-circle">
                                    @endif
                                </td>
                                @can('trash_category_action')
                                    <td>
                                        <a href="{{route('restore.category',$category->id)}}" class="btn btn-success" title="restore"><i class="bx bx-refresh"></i></a>
                                        <a href="{{route('category.permanent.delete',$category->id)}}" class="btn btn-danger" title="permanent-delete"><i class="bx bx-trash"></i></a>
                                    </td>
                                @endcan
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center"><h4>No trash category found</h4></td>
                            </tr>
                        @endforelse
                    </table>
                    @can('trash_category_action')
                        <div class="mb-2">
                            <button type="submit" value="1" name="btn" class="btn btn-success">Restore</button>
                            <button type="submit"  value="2" name="btn" class="btn btn-danger">Permanent Delete</button>
                        </div>
                    @endcan
                </div>
            </form>
            {{$trash_category->links()}}
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

@if (session('category_restore'))
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
    title: '{{session('category_restore')}}'
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
