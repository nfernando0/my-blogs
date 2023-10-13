<div class="sidebar">
    <a href="{{ route('home') }}" class="logo">
        <i class='bx bx-code-alt'></i>
        <div class="logo-name"><span>My</span>Blog</div>
    </a>
    <ul class="side-menu">
        <li><a href="{{ route('dashboard') }}"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
        <li><a href="{{ route('blogs.index') }}"><i class='bx bx-store-alt'></i>Blogs</a></li>
        <li><a href="{{ route('category.index') }}"><i class='bx bx-category-alt'></i>Categories</a></li>
    </ul>
    <ul class="side-menu">
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                   <span> Logout</span>
                </button>
            </form>
        </li>
    </ul>
</div>
