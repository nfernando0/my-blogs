@extends('template.index')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1 class="mb-5">My Profile</h1>
            <h4>Name: {{ auth()->user()->fullname }}</h4>
            <h4>Name: {{ auth()->user()->username }}</h4>
            <h4>Email: {{ auth()->user()->email }}</h4>
            <h5>My Blogs : {{ $blogs->count() }}</h5>
        </div>
    </div>
@endsection
