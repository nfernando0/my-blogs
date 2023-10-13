@extends('template.index')

@section('content')
    @auth
        <a href="{{ route('blog.create') }}" class="btn btn-primary btn-sm my-3">Add Blog</a>
    @endauth
    <div class="my-2">
        @include('partials.notif')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="d-flex" action="{{ route('home') }}">
                    <input class="form-control me-2" type="text" placeholder="Search" value="{{ request('search') }}" name="search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
    @if ($blogs->count())
        <div class="card my-3 ">
            <div class="position-relative">
                <img src="https://source.unsplash.com/1600x900/?{{ $blogs[0]->category->name }}" class="img-fluid "
                    alt="">
                <p class="position-absolute top-0 bg-white m-2 px-2 rounded">{{ $blogs[0]->category->name }}</p>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $blogs[0]->title }}</h5>
                <span class="fw-bold">Author : {{ $blogs[0]->user->username }}</span>
                <p class="card-text">{{ $blogs[0]->excerpt }}</p>
                <p class="card-text"><small class="text-body-secondary">{{ $blogs[0]->created_at->diffForHumans() }}</small>
                </p>
                @auth
                    <a href="{{ route('blog.show', $blogs[0]->id) }}" class="btn btn-primary">See Post ...</a>
                @endauth
            </div>
        </div>
    @endif

    <div class="row">
        @if ($blogs->count())
            @foreach ($blogs->skip(1) as $blog)
                <div class="col-md-4">
                    <div class="card mt-2 ">
                        <div class="position-relative">
                            <img src="https://source.unsplash.com/1600x900/?{{ $blog->category->name }}" class="img-fluid "
                                alt="">
                            <p class="position-absolute top-0 bg-white m-2 px-2 rounded">{{ $blog->category->name }}</p>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <span class="fw-bold">Author : {{ $blog->user->username }}</span>
                            <p class="card-text">{{ $blog->excerpt }}</p>
                            <hr>
                            @auth
                                <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-primary">See Post ...</a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h2 class="text-center">Not Found</h2>
        @endif
    </div>

    <div class="d-flex justify-content-center my-2">
        {{ $blogs->links() }}
    </div>
@endsection
