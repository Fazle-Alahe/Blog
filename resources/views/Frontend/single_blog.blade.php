@extends('layouts.master')
@section('title')
    Single blog
@endsection
@section('content')
    <!-- post single -->
    <div class="post post-single">
        <!-- post header -->
        <div class="post-header">
            <h1 class="title mt-0 mb-3">{{$blog->title}}</h1>
            <ul class="meta list-inline mb-0">
                <li class="list-inline-item"><a href="{{route('single.blogger',$blog->blogger_id)}}"><img src="{{asset('uploads/users/')}}/{{$blog->rel_to_user->photo}}" class="author mini_circle" alt="author"/>{{$blog->blogger}}</a></li>
                <li class="list-inline-item"><a href="{{route('category.blogs',$blog->category_id)}}">{{$blog->rel_to_category->category_name}}</a></li>
                <li class="list-inline-item">{{$blog->created_at->toFormattedDateString()}}</li>
            </ul>
        </div>
        <!-- featured image -->
        <div class="featured-image">
            <img src="{{asset('uploads/blog/')}}/{{$blog->thumbnail}}" alt="post-title" />
        </div>
        <!-- post content -->
        <div class="post-content clearfix">
            <p>{!! $blog->description !!}</p>
        </div>
        <!-- post bottom section -->
                
        <?php
        $logo = App\Models\Logo::find(1);
        $about = App\Models\About::find(1);
        ?>
        <div class="post-bottom">
            <div class="row d-flex align-items-center">
                <div class="col-md-6 col-12 text-center text-md-start">
                    <!-- tags -->
                    @foreach ($tag as $tags)
                        <button value="{{App\Models\Tag::find($tags)->id}}" class="tag">#{{App\Models\Tag::find($tags)->tag_name}}</button>
                    @endforeach
                </div>
                <div class="col-md-6 col-12">
                    <!-- social icons -->
                    <ul class="social-icons list-unstyled list-inline mb-0 float-md-end">
                        <li class="list-inline-item"><a href="{{$about->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a href="{{$about->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="{{$about->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="{{$about->pinterest}}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
                        <li class="list-inline-item"><a href="{{$about->medium}}" target="_blank"><i class="fab fa-medium"></i></a></li>
                        <li class="list-inline-item"><a href="{{$about->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <div class="spacer" data-height="50"></div>

    <div class="about-author padding-30 rounded d-flex justify-content-between">
        <div class="">
            <img style="width: 250px; height:120px; border-radius: 50%;" src="{{asset('uploads/users/')}}/{{$blog->rel_to_user->photo}}" />
        </div>
        <div class="details ms-4">
            <h4 class="name"><a href="{{route('single.blogger',$blog->blogger_id)}}">{{$blog->blogger}}</a></h4>
            <p>{{$blog->rel_to_user->desp}}</p>
            <!-- social icons -->
            <ul class="social-icons list-unstyled list-inline mb-0">
                <li class="list-inline-item"><a href="{{$blog->rel_to_user->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                <li class="list-inline-item"><a href="{{$blog->rel_to_user->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                <li class="list-inline-item"><a href="{{$blog->rel_to_user->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                <li class="list-inline-item"><a href="{{$blog->rel_to_user->pinterest}}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
                <li class="list-inline-item"><a href="{{$blog->rel_to_user->medium}}" target="_blank"><i class="fab fa-medium"></i></a></li>
                <li class="list-inline-item"><a href="{{$blog->rel_to_user->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
            </ul>
        </div>
    </div>

    <div class="spacer" data-height="50"></div>

    <!-- section header -->
    <div class="section-header">
        <h3 class="section-title">Comments ({{App\Models\Comment::where('post_id', $blog->id)->count()}})</h3>
        <img src="{{asset('uploads/icon/')}}/{{$logo->icon}}" class="wave" alt="wave" />
    </div>
    <!-- post comments -->
    <div class="comments bordered padding-30 rounded">
        
        @forelse (App\Models\Comment::where('post_id', $blog->id)->get() as $comment)
            <ul class="comments mb-5">
                <!-- comment item -->
                <li class="comment rounded">
                    <div class="thumb">
                        @if ($comment->rel_to_viewer->photo == null)
                            <img width="60" src="{{asset('uploads/profile_default.PNG')}}">
                        @else
                            <img src="{{asset('uploads/viewer/')}}/{{$comment->rel_to_viewer->photo}}" alt="post-title" class="comment_circle" />
                        @endif
                    </div>
                    <div class="details">
                        <h4 class="name"><a>{{$comment->rel_to_viewer->name}}</a></h4>
                        <span class="date">{{$comment->created_at->toFormattedDateString()}}&nbsp;&nbsp;&nbsp; {{$comment->created_at->diffForHumans()}}</span>
                        <p>{{$comment->comment}}</p>
                        <a href="#" class="btn btn-default btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$comment->id}}">Reply</a>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$comment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Reply to:-&nbsp;{{$comment->rel_to_viewer->name}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('store.reply',$comment->id)}}" method="POST">
                                            @csrf
                                            @auth('viewer')
                                            <div class="modal-body">
                                                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                                    <input type="hidden" name="blogger_id" value="{{$blog->blogger_id}}">
                                                    <input type="hidden" name="post_id" value="{{$blog->id}}">
                                                    <input type="hidden" name="commentor_id" value="{{Auth::guard('viewer')->user()->id}}">

                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Message:</label>
                                                        <textarea class="form-control" id="message-text" name="reply"></textarea>
                                                        @error('reply')
                                                            <strong class="text-danger">{{$message}}</strong>
                                                        @enderror
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-default">Reply</button>
                                            </div>
                                            @else
                                                <h4 class="text-center">For reply,You've to <a href="{{route('login.viewer')}}">Login</a> first.</h4>
    
                                            @endauth
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>
                </li>

                <!-- comment item -->
                @foreach (App\Models\Reply::where('comment_id', $comment->id)->whereNull('parent_reply')->get() as $reply )
                <li class="comment child rounded">
                    <div class="thumb">
                        @if ($reply->rel_to_viewer->photo == null)
                            <img width="60" src="{{asset('uploads/profile_default.PNG')}}">
                        @else
                            <img src="{{asset('uploads/viewer/')}}/{{$reply->rel_to_viewer->photo}}" alt="post-title" class="comment_circle"/>
                        @endif
                    </div>
                    <div class="details">
                        <h4 class="name"><a>{{$reply->rel_to_viewer->name}}</a></h4>
                        <span class="date">{{$reply->created_at->toFormattedDateString()}}&nbsp;&nbsp;&nbsp; {{$reply->created_at->diffForHumans()}}</span>
                        <p>{{$reply->reply}}</p>
                        <a href="#" class="btn btn-default btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$reply->id}}">Reply</a>
                        
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$reply->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Reply to:-&nbsp;{{$reply->rel_to_viewer->name}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('store.child.reply',$reply->id)}}" method="POST">
                                            @auth('viewer')
                                                <div class="modal-body">
                                                        @csrf
                                                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                                    <input type="hidden" name="blogger_id" value="{{$blog->blogger_id}}">
                                                    <input type="hidden" name="post_id" value="{{$blog->id}}">
                                                    <input type="hidden" name="commentor_id" value="{{Auth::guard('viewer')->user()->id}}">

                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Message:</label>
                                                        <textarea class="form-control" id="message-text" name="child_reply"></textarea>
                                                        @error('child_reply')
                                                            <strong class="text-danger">{{$message}}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-default">Reply</button>
                                                </div>
                                            @else
                                                <h4 class="text-center">For reply,You've to <a href="{{route('login.viewer')}}">Login</a> first.</h4>
    
                                            @endauth
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>
                    @foreach (App\Models\Reply::where('comment_id', $comment->id)->where('parent_reply', $reply->id)->get() as $child_reply )
                        <li class="comment child rounded" style="padding-left: 100px">
                            <div class="thumb">
                                @if ($child_reply->rel_to_viewer->photo == null)
                                    <img width="60" src="{{asset('uploads/profile_default.PNG')}}">
                                @else
                                    <img src="{{asset('uploads/viewer/')}}/{{$child_reply->rel_to_viewer->photo}}" alt="post-title" class="comment_circle"/>
                                @endif
                            </div>
                            <div class="details">
                                <h4 class="name"><a>{{$child_reply->rel_to_viewer->name}}</a></h4>
                                <span class="date">{{$child_reply->created_at->toFormattedDateString()}}&nbsp;&nbsp;&nbsp; {{$child_reply->created_at->diffForHumans()}}</span>
                                <p>{{$child_reply->reply}}</p>
                                <a href="#" class="btn btn-default btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$child_reply->id}}">Reply</a>
                                
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$child_reply->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Reply to:-&nbsp;{{$child_reply->rel_to_viewer->name}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{route('store.child.reply',$reply->id)}}" method="POST">
                                                    @auth('viewer')
                                                    <div class="modal-body">
                                                            @csrf
                                                            <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                                            <input type="hidden" name="blogger_id" value="{{$blog->blogger_id}}">
                                                            <input type="hidden" name="post_id" value="{{$blog->id}}">
                                                            <input type="hidden" name="commentor_id" value="{{Auth::guard('viewer')->user()->id}}">
        
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Message:</label>
                                                                <textarea class="form-control" id="message-text" name="child_reply"></textarea>
                                                                @error('child_reply')
                                                                    <strong class="text-danger">{{$message}}</strong>
                                                                @enderror
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-default">Reply</button>
                                                    </div>
                                                    @else
                                                        <h4 class="text-center">For reply,You've to <a href="{{route('login.viewer')}}">Login</a> first.</h4>
            
                                                    @endauth
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </li>
                    @endforeach
                </li>
                @endforeach
                
            </ul>
        @empty
        <h4>No one has commented on this post yet.</h4>
        @endforelse
    </div>

    <div class="spacer" data-height="50"></div>

    <!-- section header -->
    <div class="section-header">
        <h3 class="section-title">Leave Comment</h3>
        <img src="{{asset('uploads/icon/')}}/{{$logo->icon}}" class="wave" alt="wave" />
    </div>
    <!-- comment form -->
        @auth('viewer')
            <div class="comment-form rounded bordered padding-30">
                <form action="{{route('store.comment',$blog->id)}}" id="comment-form" class="comment-form" method="POST">
                    @csrf
                    <div class="messages"></div>
                    
                    <div class="row">
        
                        <div class="column col-md-12">
                            <!-- Comment textarea -->
                            <div class="form-group">
                                <textarea name="comment" id="InputComment" class="form-control" rows="4" placeholder="Your comment here..." required="required"></textarea>
                            </div>
                        </div>
        
                        <div class="column col-md-6">
                            <!-- Email input -->
                            <div class="form-group">
                                <input type="email" class="form-control" id="InputEmail" name="InputEmail" placeholder="Email address" disabled value="{{Auth::guard('viewer')->user()->email}}">
                            </div>
                        </div>
                            
                        <input type="hidden" name="commentor_id" value="{{Auth::guard('viewer')->user()->id}}">
                        <input type="hidden" name="blogger_id" value="{{$blog->blogger_id}}">
        
                        <div class="column col-md-6">
                            <!-- Email input -->
                            <div class="form-group">
                                <input type="text" class="form-control" id="InputName" name="InputName" placeholder="Your name" disabled value="{{Auth::guard('viewer')->user()->name}}">
                            </div>
                        </div>
                
                    </div>
        
                    <button type="submit" id="submit"  class="btn btn-default">Submit</button><!-- Submit Button -->
        
                </form>
            </div>
        @else
            <h4>For comments,You've to <a href="{{route('login.viewer')}}">Login</a> first.</h4>
        @endauth
@endsection

@section('footer_script')
    
@if (session('comment'))
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
    title: '{{session('comment')}}'
    })
</script>
@endif

<script>
    $('.tag').click(function(){
        var tag = $(this).val();
        var link = "{{route('all.blogs')}}"+"?tag="+tag;
        window.location.href = link;
    })
</script>
@endsection