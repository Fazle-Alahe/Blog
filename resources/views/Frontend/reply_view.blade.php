@extends('layouts.admin')
@section('content')
<div class="col-lg-8 m-auto">
    <div class="card text-center">
        <div class="card-header">
            <h3>Reply</h3>
        </div>
        <div class="card-body">
            <strong>{{$reply->reply}}</strong>
        </div>
    </div>
</div>
@endsection