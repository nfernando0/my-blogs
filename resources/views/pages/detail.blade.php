@extends('template.index')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('home') }}" class="btn btn-primary btn-sm my-2">Back</a>
            @if (auth()->check() && auth()->user()->username == $blog->user->username)
            <a href="{{ route('blog.update', $blog->id) }}" class="btn btn-primary btn-sm my-2">Edit</a>
            <form action="{{ route('blog.delete', $blog->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm my-2" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
            @else
            @endif
           <div class="position-relative">
            <img src="https://source.unsplash.com/1600x900/?{{ $blog->category->name }}" class="img-fluid " alt="">
            <p class="position-absolute top-0 bg-white m-2 px-2 rounded">{{ $blog->category->name }}</p>
           </div>
            <h4>{{ $blog->title }}</h4>
            <p>{!! $blog->body !!}</p>
        </div>
    </div>

@endsection
