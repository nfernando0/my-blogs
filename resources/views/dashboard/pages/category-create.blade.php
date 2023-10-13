@extends('dashboard.template.index')

@section('content_dashboard')
    <div class="bottom-data">
        <div class="orders">
            <form action="{{ route('category.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="input_category" id="name">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="btn_category_create"
                    style="background-color: lightblue; padding: 0.2rem 1rem; border: none; border-radius: 0.5rem; cursor: pointer;">Submit</button>
            </form>
        </div>

    </div>
@endsection
