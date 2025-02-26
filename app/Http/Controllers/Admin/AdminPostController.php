<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\BlogCategory;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        // dd("hello");
        $posts = Post::with('blog_category')->get();
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::get();
        return view('admin.post.create', compact('categories'));
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'title_en' => ['required'],
            'title_ru' => ['required'],
            'title_ar' => ['required'],
            'slug' => ['required', 'alpha_dash', 'unique:team_members,slug'],
            'description_en' => ['required'],
            'description_ru' => ['required'],
            'description_ar' => ['required'],
            'short_description_en' => ['required'],
            'short_description_ru' => ['required'],
            'short_description_ar' => ['required'],
            'photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            'banner' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
        ]);

        $final_name = 'post_' . time() . '.' . $request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('uploads'), $final_name);

        $final_name_1 = 'post_banner_' . time() . '.' . $request->banner->getClientOriginalExtension();
        $request->banner->move(public_path('uploads'), $final_name_1);


        $post = new Post();
        $post->photo = $final_name;
        $post->banner = $final_name_1;
        $post->blog_category_id = $request->blog_category_id;
        $post->title_en = $request->title_en;
        $post->title_ru = $request->title_ru;
        $post->title_ar = $request->title_ar;
        $post->slug = $request->slug;
        $post->description_en = $request->description_en;
        $post->description_ru = $request->description_ru;
        $post->description_ar = $request->description_ar;
        $post->short_description_en = $request->short_description_en;
        $post->short_description_ru = $request->short_description_ru;
        $post->short_description_ar = $request->short_description_ar;
        $post->save();

        return redirect()->route('admin_post_index')->with('success', 'Post Created successfuly');

    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = BlogCategory::get();
        return view('admin.post.edit', compact('post', 'categories'));
    }

    public function edit_submit(Request $request, $id)
    {

        $post = Post::where('id', $id)->first();
        $request->validate([
            'title_en' => ['required'],
            'title_ru' => ['required'],
            'title_ar' => ['required'],
            'slug' => [
                'required',
                'alpha_dash',
                Rule::unique('team_members', 'slug')->ignore($id)
            ],
            'description_en' => ['required'],
            'description_ru' => ['required'],
            'description_ar' => ['required'],
            'short_description_en' => ['required'],
            'short_description_ru' => ['required'],
            'short_description_ar' => ['required'],
        ]);

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            ]);

            unlink(public_path('uploads/' . $post->photo));

            $final_name = 'post_' . time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('uploads'), $final_name);
            $post->photo = $final_name;
        }


        if ($request->hasFile('banner')) {
            $request->validate([
                'banner' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            ]);
            if ($post->banner != '') {
                unlink(public_path('uploads/' . $post->banner));
            }

            $final_name = 'banner_' . time() . '.' . $request->banner->getClientOriginalExtension();
            $request->banner->move(public_path('uploads'), $final_name);
            $post->banner = $final_name;
        }


        $post->blog_category_id = $request->blog_category_id;
        $post->title_en = $request->title_en;
        $post->title_ru = $request->title_ru;
        $post->title_ar = $request->title_ar;
        $post->slug = $request->slug;
        $post->description_en = $request->description_en;
        $post->description_ru = $request->description_ru;
        $post->description_ar = $request->description_ar;
        $post->short_description_en = $request->short_description_en;
        $post->short_description_ru = $request->short_description_ru;
        $post->short_description_ar = $request->short_description_ar;
        $post->save();

        return redirect()->route('admin_post_index')->with('success', 'Post Updated successfuly');
    }

    public function delete($id)
    {
        $post = Post::find($id);
        unlink(public_path('uploads/' . $post->photo));
        $post->delete();
        return redirect()->route('admin_post_index')->with('success', 'Post Deleted successfuly');
    }
}
