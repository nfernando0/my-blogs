<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();

        return view('dashboard.pages.blogs', [
            'blogs' => $blogs
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'body' => 'required',
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);

        Blog::create($validatedData);

        return redirect()->route('home')->with('success', 'Blog created successfully!');
    }

    public function show($id)
    {

        $blog = Blog::find($id);
        return view('pages.detail', [
            'blog' => $blog
        ]);
    }

    public function myblogs()
    {
        $blogs = Blog::where('user_id', auth()->user()->id)->get();

        return view('pages.myblogs', [
            'blogs' => $blogs
        ]);
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);

        $blog->delete();

        return redirect()->route('blogs.index');
    }

    public function delete($id)
    {
        $blog = Blog::find($id);

        $blog->delete();

        return redirect()->route('home')->with('success', 'Blog deleted successfully!');
    }

    public function edit($id)
    {
        $blog = Blog::find($id);

        $categories = Category::all();

        return view('pages.update', [
            'blog' => $blog,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'body' => 'required',
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Blog::where('id', $id)->update($validatedData);

        return redirect()->route('home')->with('success', 'Blog updated successfully!');
    }
}
