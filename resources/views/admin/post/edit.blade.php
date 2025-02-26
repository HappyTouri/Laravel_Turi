
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Post</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_post_index')}}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_post_edit_submit', $post->id) }}" method="post" enctype="multipart/form-data">                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3"> 
                                                <label class="form-label">Existing Photo</label>
                                                <div><img src="{{asset('uploads/'.$post->photo)}}" alt="" class="w_200"></div>
                                            </div>
                                            <div class="mb-3"> 
                                                <label class="form-label">Change Photo</label>
                                                <div><input type="file"  name="photo"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3"> 
                                                <label class="form-label">Existing Banner</label>
                                                <div><img src="{{asset('uploads/'.$post->banner)}}" alt="" class="w_200"></div>
                                            </div>
                                            <div class="mb-3"> 
                                                <label class="form-label">Change Banner</label>
                                                <div><input type="file"  name="banner"></div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title English</label>
                                                <input type="text" class="form-control" name="title_en" value="{{$post->title_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Russian</label>
                                                <input type="text" class="form-control" name="title_ru" value="{{$post->title_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Arabic</label>
                                                <input type="text" class="form-control" name="title_ar" value="{{$post->title_ar}}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Slug</label>
                                        <input type="text" class="form-control" name="slug" value="{{$post->slug}}">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Description English</label>
                                                <textarea name="description_en" class="form-control editor" id="" cols="30" rows="10">{{$post->description_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Description Russian</label>
                                                <textarea name="description_ru" class="form-control editor" id="" cols="30" rows="10">{{$post->description_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Description Arabic</label>
                                                <textarea name="description_ar" class="form-control editor" id="" cols="30" rows="10">{{$post->description_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Short Description English</label>
                                                <textarea name="short_description_en" class="form-control h_100" id="" cols="30" rows="10">{{$post->short_description_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Short Description Russian</label>
                                                <textarea name="short_description_ru" class="form-control h_100" id="" cols="30" rows="10">{{$post->short_description_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Short Description Arabic</label>
                                                <textarea name="short_description_ar" class="form-control h_100" id="" cols="30" rows="10">{{$post->short_description_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <select name="blog_category_id" class="form-select">
                                            @foreach ($categories as $category)
                                            <option  value="{{$category->id}}" @if ($category->id == $post->blog_category->id)selected @endif>{{$category->name_en}}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
