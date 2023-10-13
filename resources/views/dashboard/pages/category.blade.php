@extends('dashboard.template.index')

@section('content_dashboard')
<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class='bx bx-receipt'></i>
            <h3>Recents Categories</h3>
            <a href="{{ route('category.create') }}">
                <i class='bx bx-plus'></i>
            </a>
            <i class='bx bx-search'></i>
        </div>
        @if (session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>

        @endif
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Handle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>
                        <p>{{ $category->name }}</p>
                    </td>
                    <td>
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color: red; border: none; padding: 0.2rem 1rem; color: #fff; cursor: pointer; border-radius: 0.5rem" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
