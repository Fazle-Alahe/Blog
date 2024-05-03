@extends('layouts.admin')
@section('content')
@can('advertise')
<div class="row justify-content-between">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header text-center">
                <h2>Update advertises</h2>
            </div>
            <div class="card-body">
                <form action="{{route('update.ads')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Content advertise</h3>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <label class="form-label">Content advertise</label>
                                        <input type="file" name="content_ads" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                    <div  class="mt-2">
                                        <img width="150" src="{{asset('uploads/ads/')}}/{{$advertise->content_ads}}" id="blah">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Side advertise</h3>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <label class="form-label">Side advertise</label>
                                        <input type="file" name="side_ads" class="form-control" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                    <div class="mt-2">
                                        <img width="150" src="{{asset('uploads/ads/')}}/{{$advertise->side_ads}}" id="blah2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button type="submit" class="btn btn-primary w-50">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
@endsection