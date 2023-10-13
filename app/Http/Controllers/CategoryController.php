<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $blogs = Blog::all();

        return view('dashboard.pages.category', [
            'categories' => $categories,
            'blogs' => $blogs
        ]);
    }

    public function create()
    {
        return view('dashboard.pages.category-create', [
            'blogs' => DB::table('blogs')->get()
        ]);
    }

   public function store(Request $request)
    {
         $validated = $request->validate([
             'name' => 'required'
         ]);

         $category = Category::create($validated);

         return redirect()->route('category.index')->with('success', 'Category created successfully');
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();

        return redirect()->route('category.index');
    }
}
