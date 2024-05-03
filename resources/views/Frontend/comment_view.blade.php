@extends('layouts.admin')
@section('content')
<div class="col-lg-8 m-auto">
    <div class="card text-center">
        <div class="card-header">
            <h3>Comment</h3>
        </div>
        <div class="card-body">
            <strong>{{$comment->comment}}</strong>
        </div>
    </div>
</div>
@endsection