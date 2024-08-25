<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'My Blog';
        $blogs = Blog::where('user_id', auth()->user()->id)->get();


        return view('content.blogs.blog', compact('title', 'blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add a new blog';
        $categories = Category::all();
        return view('content.blogs.add', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $blogs = new Blog;
        $blogs->title = $request->input('title');
        $blogs->content = $request->input('content');
        $blogs->user_id = auth()->user()->id;
        $blogs->slug = $request->input('slug');
        $blogs->save();

        $categories = $request->input('categories');
        $blogs->categories()->sync($categories);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        $title = "test";
        return view('content.blogs.show', compact('blog', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Blog::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
