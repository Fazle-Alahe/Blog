@extends('layouts.admin')
@section('content')
   <div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>All comments</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <tr>
                        <th>SL</th>
                        <th>Comment</th>
                        <th>Action</th>
                    </tr>
                    @foreach (App\Models\Comment::where('blogger_id', Auth::user()->id)->latest()->get() as $sl=>$comment)
                        <tr style="{{$comment->status == 0?'background-color: rgb(186, 182, 179);':''}}">
                            <td class="text-black">{{$sl+1}}</td>
                            <td class="text-black text-wrap">{{$comment->comment}}</td>
                            <td>
                                <a href="{{route('comment.view',$comment->id)}}" class="btn btn-info">Comment View</a>    
                                <a href="{{route('single.blog',$comment->rel_to_blog->slug)}}" class="btn btn-success">Blog View</a>  
                                <a href="{{route('comment.delete',$comment->id)}}" class="btn btn-danger"><i class="bx bx-trash"></i></a>      
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>All replies</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <tr>
                        <th>SL</th>
                        <th>Reply</th>
                        <th>Action</th>
                    </tr>
                    @foreach (App\Models\Reply::where('blogger_id', Auth::user()->id)->latest()->get() as $sl=>$reply)
                        <tr style="{{$reply->status == 0?'background-color: rgb(186, 182, 179);':''}}">
                            <td class="text-black">{{$sl+1}}</td>
                            <td class="text-black text-wrap">{{Str::limit($reply->reply,60,'...')}}</td>
                            <td>
                                <a href="{{route('reply.view',$reply->id)}}" class="btn btn-info">Reply View</a>    
                                <a href="{{route('single.blog',$reply->rel_to_blog->slug)}}" class="btn btn-success">View</a>    
                                <a href="{{route('reply.delete',$reply->id)}}" class="btn btn-danger"><i class="bx bx-trash"></i></a>    
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>


    @can('blogs_action')
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Pending Posts</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>SL</th>
                            <th>Thumbnail</th>
                            <th>Blogger</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                        @foreach (App\Models\Blog::where('status', 1)->latest()->get() as $sl=>$blog)
                            <tr style="{{$blog->status == 1?'background-color: rgb(186, 182, 179);':''}}">
                                <td class="text-black">{{$sl+1}}</td>
                                <td>
                                    <img src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" width="100" alt="">
                                </td>
                                <td class="text-black">{{$blog->blogger}}</td>
                                <td class="text-black">{{$blog->rel_to_category->category_name}}</td>
                                <td class="text-black">{{$blog->title}}</td>
                                <td>
                                    <a href="{{route('blog.status',$blog->id)}}" class="btn btn-{{$blog->status == 0?'success':'secondary'}}">{{$blog->status == 0?'Active':'Deactive'}}</a>
                                    <a href="{{route('blog.soft.delete',$blog->id)}}" class="btn btn-warning" title="soft-delete">Delete</a>
                                    <a href="{{route('blog.view',$blog->id)}}" class="btn btn-info" title="view"><i class="fa-regular fa-eye"></i></a>
                                
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    @endcan

    @can('message_access')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Unread messages</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>

                    @foreach (App\Models\Message::latest()->get() as $sl=>$message)
                        <tr style="{{$message->status == 1?'background-color: rgb(186, 182, 179);':''}}">
                            <td class="text-black">{{$sl+1}}</td>
                            <td class="text-black">{{$message->name}}</td>
                            <td class="text-black">{{$message->email}}</td>
                            <td class="text-black">{{$message->title}}</td>
                            <td class="text-black">{{Str::limit($message->description,100,'....')}}</td>
                            <td class="text-black">
                                <a href="{{route('view.message',$message->id)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                <a href="{{route('message.delete',$message->id)}}" class="btn btn-danger"><i class="bx bx-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @endcan
   </div>
@endsection