@extends('template.index')

@section('content')
    <div class="row">
        <div class="col">
            <h2>Edit Blogs</h2>
            <form action="{{ route('update.blog', $blog->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title')
                        is-invalid
                    @enderror" value="{{ old('title', $blog->title) }}" name="title" id="title">
                </div>
               <div class="mb-3">
                <select class="form-select @error('category_id')
                is-invalid
            @enderror" aria-label="Default select example" name="category_id" value="{{ old('category_id', $blog->category_id) }}">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
               </div>
                <input id="x" type="hidden" name="body" value="{{ old('body', $blog->body) }}">
                <trix-editor input="x"></trix-editor>
                <button type="submit" class="btn btn-primary my-3">Submit</button>
            </form>
        </div>
    </div>
@endsection
