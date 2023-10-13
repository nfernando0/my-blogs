@extends('template.index')

@section('content')
<div class="row">
    @if ($blogs->count())
        @foreach ($blogs as $blog)
            <div class="col-md-4">
                <div class="card mt-2">
                    <img src="https://source.unsplash.com/1600x900/?{{ $blog->category->name }}" class="card-img-top"
                        alt="{{ $blog->category->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <span>Author : {{ $blog->user->username }}</span>
                        <p class="card-text">{{ $blog->excerpt }}</p>
                        <hr>
                        @auth
                            <a href="{{ route('blog.show', $blog->id) }}') }}" class="btn btn-primary">See Post ...</a>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <h2 class="text-center">Not Found</h2>
    @endif
</div>
@endsection
