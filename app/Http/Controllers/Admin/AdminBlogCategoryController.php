<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Validation\Rule;

class AdminBlogCategoryController extends Controller
{
    public function index()
    {

        $blog_categories = BlogCategory::get();
        return view('admin.blog_category.index', compact('blog_categories'));
    }

    public function create()
    {
        return view('admin.blog_category.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name_en' => ['required'],
            'name_ru' => ['required'],
            'name_ar' => ['required'],
            'slug' => ['required', 'alpha_dash', 'unique:team_members,slug'],
        ]);

        $blog_category = new BlogCategory();
        $blog_category->name_en = $request->name_en;
        $blog_category->name_ru = $request->name_ru;
        $blog_category->name_ar = $request->name_ar;
        $blog_category->slug = $request->slug;
        $blog_category->save();

        return redirect()->route('admin_blog_category_index')->with('success', 'Blog Category is Created successfuly');

    }

    public function edit($id)
    {
        $blog_category = BlogCategory::find($id);
        return view('admin.blog_category.edit', compact('blog_category'));
    }

    public function edit_submit(Request $request, $id)
    {

        $blog_category = BlogCategory::where('id', $id)->first();
        $request->validate([
            'name_en' => ['required'],
            'name_ru' => ['required'],
            'name_ar' => ['required'],
            'slug' => [
                'required',
                'alpha_dash',
                Rule::unique('team_members', 'slug')->ignore($id)
            ],
        ]);

        $blog_category->name_en = $request->name_en;
        $blog_category->name_ru = $request->name_ru;
        $blog_category->name_ar = $request->name_ar;
        $blog_category->slug = $request->slug;
        $blog_category->save();
        ;

        return redirect()->route('admin_blog_category_index')->with('success', 'Blog Category is Updated successfuly');
    }

    public function delete($id)
    {
        $total = Post::where('blog_category_id', $id)->count();
        if ($total > 0) {
            return redirect()->route('admin_blog_category_index')->with('error', 'This blog Category is in use , so you can not Deleted');
        }
        $blog_category = BlogCategory::find($id);
        $blog_category->delete();
        return redirect()->route('admin_blog_category_index')->with('success', 'Blog Category is Deleted successfuly');
    }
}
