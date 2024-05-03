@extends('layouts.admin')
@section('content')
<div class="col-lg-8 m-auto">
    <div class="card text-center">
        <div class="card-header">
            <h3>Messages</h3>
        </div>
        <div class="card-body">
            <strong>{{$messages->description}}</strong>
        </div>
    </div>
</div>
@endsection