<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    return view('pages.index', [
        'blogs' => Blog::latest()->filter(request(['search', 'category']))->paginate(7)
    ]);
})->name('home');

Route::get('/profile', function () {
    return view('pages.Auth.profile', [
        'blogs' => DB::table('blogs')->get()
    ]);
})->name('profile');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');
Route::post('blog/store', [BlogController::class, 'store'])->name('blog.store')->middleware('auth');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->name('blog.update');
Route::put('/blog/{id}', [BlogController::class, 'update'])->name('update.blog')->middleware('auth');
Route::delete('/blog/{id}', [BlogController::class, 'delete'])->name('blog.delete');
Route::get('/myblogs', [BlogController::class, 'myblogs'])->name('myblogs');



Route::get('/dashboard', function () {
    $blogs = Blog::all();
    return view('dashboard.pages.index', [
        'blogs' => $blogs
    ]);
})->middleware(['admin'])->name('dashboard');

Route::post('/category', [CategoryController::class, 'store'])->name('category.store')->middleware(['admin']);
Route::get('/dashboard/category', [CategoryController::class, 'index'])->name('category.index')->middleware(['admin']);

Route::get('/dashboard/category/create', [CategoryController::class, 'create'])->name('category.create')->middleware(['admin']);
Route::delete('/dashboard/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy')->middleware(['admin']);

Route::get('/dashboard/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::delete('/dashboard/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');


