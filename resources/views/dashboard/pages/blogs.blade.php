@extends('dashboard.template.index')

@section('content_dashboard')
<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class='bx bx-receipt'></i>
            <h3>Recents Blogs</h3>
            <i class='bx bx-filter'></i>
            <i class='bx bx-search'></i>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                <tr>
                    <td>
                        <p>{{ $blog->user->username }}</p>
                    </td>
                    <td><p>{{ $blog->title }}</p></td>
                    <td><p>{{ $blog->excerpt }}</p></td>
                    <td><p>{{ $blog->category->name }}</p></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
