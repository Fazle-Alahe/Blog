@extends('layouts.admin')
@section('content')

@php

// Auth trending calculation
$trend = 0;
foreach($trending as $blog){
    if($blog->blogger_id == Auth::user()->id){
        $trend++;
    }
}
// Auth trending calculation

// Auth popular calculation
// $popular = 0;
// foreach($popular as $populars){
//     if($populars->blogger_id == Auth::user()->id){
//         $popular++;
//     }
// }
// Auth popular calculation

@endphp



        

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-end">Over all</span>
                                        <h5 class="card-title mb-0">Total post</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-12">
                                            <h2 class="text-center mb-0">
                                                {{App\Models\Blog::where('status', 0)->where('blogger_id', Auth::user()->id)->count()}}
                                            </h2>
                                        </div>
                                        {{-- <div class="col-4 text-end">
                                            <span class="text-muted">12.5% <i
                                                    class="mdi mdi-arrow-up text-success"></i></span>
                                        </div> --}}
                                    </div>

                                    {{-- <div class="progress shadow-sm" style="height: 5px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 57%;">
                                        </div>
                                    </div> --}}
                                </div>
                                <!--end card body-->
                            </div><!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-end">Last week</span>
                                        <h5 class="card-title mb-0">Total post</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-12">
                                            <h2 class="text-center mb-0">
                                                {{App\Models\Blog::where('status', 0)->where('blogger_id', Auth::user()->id)->whereDate('created_at', '>=', \Carbon\Carbon::now()->subDays(7))->count()}}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <!--end card body-->
                            </div><!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-end">Last week</span>
                                        <h5 class="card-title mb-0">Trending Post</h5>
                                    </div>
                                        
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-12">
                                            <h2 class="text-center mb-0">
                                               {{$trend}}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <!--end card body-->
                            </div><!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-end">Last Month</span>
                                        <h5 class="card-title mb-0">Popular Post</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-12">
                                            <h2 class="text-center mb-0">
                                               {{-- {{$popular}} --}}
                                               {{$popular->where('blogger_id', Auth::user()->id)->count()}}
                                            </h2>
                                        </div>
                                    </div>

                                </div>
                                <!--end card body-->
                            </div><!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-md-6 col-xl-6 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-end">Overall</span>
                                        <h5 class="card-title mb-0">Total Views</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-12">
                                            <h2 class="text-center mb-0">
                                               {{-- {{$popular}} --}}
                                               {{$views}}
                                            </h2>
                                        </div>
                                    </div>

                                </div>
                                <!--end card body-->
                            </div><!-- end card-->
                        </div> <!-- end col-->

                    </div>
                    <!-- end row-->


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3>My blogs</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>SL</th>
                                            <th>Thumbnail</th>
                                            <th>Category</th>
                                            <th>Title</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($blogs as $sl=>$blog)
                                            <tr>
                                                <td>{{$sl+1}}</td>
                                                <td>
                                                    <img width="50" src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" alt="">
                                                </td>
                                                <td>{{$blog->rel_to_category->category_name}}</td>
                                                <td>{{$blog->title}}</td>
                                                <td>
                                                    <a href="{{route('single.blog',$blog->slug)}}" class="btn btn-primary">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>

                        
                            {{ $blogs->links() }}
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Pending blogs</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>SL</th>
                                            <th>Thumbnail</th>
                                            <th>Category</th>
                                            <th>Title</th>
                                        </tr>
                                        @foreach ($p_blogs as $sl=>$blog)
                                            <tr>
                                                <td>{{$sl+1}}</td>
                                                <td>
                                                    <img width="50" src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" alt="">
                                                </td>
                                                <td>{{$blog->rel_to_category->category_name}}</td>
                                                <td>{{$blog->title}}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!--end row-->

                    <div class="row">
                        {{-- <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown float-end position-relative">
                                        <a href="#" class="dropdown-toggle h4 text-muted" data-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="#" class="dropdown-item">Action</a></li>
                                            <li><a href="#" class="dropdown-item">Another action</a></li>
                                            <li><a href="#" class="dropdown-item">Something else here</a></li>
                                            <li class="dropdown-divider"></li>
                                            <li><a href="#" class="dropdown-item">Separated link</a></li>
                                        </ul>
                                    </div>
                                    <h4 class="card-title d-inline-block">Total Revenue</h4>

                                    <div id="morris-line-example" class="morris-chart" style="height: 290px;"></div>

                                    <div class="row text-center mt-4">
                                        <div class="col-6">
                                            <h4>$7841.12</h4>
                                            <p class="text-muted mb-0">Total Revenue</p>
                                        </div>
                                        <div class="col-6">
                                            <h4>17</h4>
                                            <p class="text-muted mb-0">Open Compaign</p>
                                        </div>
                                    </div>

                                </div>
                                <!--end card body-->

                            </div>
                            <!--end card-->
                        </div> --}}
                        <!--end col-->
                        {{-- <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Top 5 Bloggers</h4>
                                    <p class="card-subtitle mb-4 font-size-13">According to last month
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table table-centered table-striped table-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Bloggers</th>
                                                    <th>Photo</th>
                                                    <th>Email</th>
                                                    <th>Total post</th>
                                                </tr>
                                            </thead>
                                                <tr>
                                                    <td class="table-user">
                                                        <img src="assets/images/users/avatar-4.jpg" alt="table-user"
                                                            class="mr-2 avatar-xs rounded-circle">
                                                        <a href="javascript:void(0);"
                                                            class="text-body font-weight-semibold">Paul J. Friend</a>
                                                    </td>
                                                    <td>
                                                        937-330-1634
                                                    </td>
                                                    <td>
                                                        pauljfrnd@jourrapide.com
                                                    </td>
                                                    <td>
                                                        New York
                                                    </td>
                                                    <td>
                                                        07/07/2018
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <!--end card body-->

                            </div>
                            <!--end card-->
                        </div> --}}
                        <!--end col-->

                    </div>
                    <!--end row-->


        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


@endsection

@section('footer_script')
          
@if (session('logged'))
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
    title: '{{session('logged')}}'
    })
</script>
@endif
@endsection