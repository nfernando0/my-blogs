<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    $title = 'Home Page';

    $blogs = Blog::paginate(9)->withQueryString();

    return view('content.index', compact('title', 'blogs'));
})->name('home.index');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index')->middleware('auth');
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/blog-create', [BlogController::class, 'create'])->name('blog-create.index')->middleware('auth');
    Route::post('/blog-create', [BlogController::class, 'store'])->name('blog-create.store')->middleware('auth');
    Route::get('/show-blog/{slug}', [BlogController::class, 'show'])->name('show-blog.index');
    Route::get('/blogs/checkSlug', [BlogController::class, 'checkSlug'])->name('blogs.checkSlug')->middleware('auth');
});

Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store');

Route::get('/category', [CategoryController::class, 'index'])->name('category.index');

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');

Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

// Login with github
Route::get('/auth/github/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.github.redirect');

Route::get('/auth/github/callback', function () {
    $githubUser = Socialite::driver('github')->user();


    $user = User::updateOrCreate([
        'github_id' => $githubUser->id
    ], [
        'username' => $githubUser->name,
        'address' => $githubUser->address,
        'phone' => $githubUser->phone,
        'password' => Hash::make('password'),
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);

    Auth::login($user, true);

    return redirect('/');
});
// Login With Google

Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('auth.redirect');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();


    $userGoogle = User::updateOrCreate([
        'google_id' => $googleUser->id
    ], [
        'username' => $googleUser->name,
        'address' => $googleUser->address,
        'phone' => $googleUser->phone,
        'password' => Hash::make('password'),
        'email' => $googleUser->email,
        'google_token' => $googleUser->token,
        'google_refresh_token' => $googleUser->refreshToken,
    ]);

    Auth::login($userGoogle, true);

    return redirect('/');
});

Route::get('/profil', [ProfileController::class, 'index'])->name('profil.index');
Route::post('/profil', [ProfileController::class, 'update'])->name('profil.update');
