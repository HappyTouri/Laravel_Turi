
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit About Item</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_about_item_update', $about_item->id) }}" method="post"  enctype="multipart/form-data"> 
                                    @csrf
                                    {{-- images --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3"> 
                                                <label class="form-label">Existing Photo 1</label>
                                                <div>
                                                    <img src="{{asset('uploads/'.$about_item->image_1)}}" alt="" class="w_200">
                                                </div>
                                            </div>
        
                                            <div class="mb-3"> 
                                                <label class="form-label">Change Photo</label>
                                                <div><input type="file"  name="image_1"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3"> 
                                                <label class="form-label">Existing Photo 2</label>
                                                <div>
                                                    <img src="{{asset('uploads/'.$about_item->image_2)}}" alt="" class="w_200">
                                                </div>
                                            </div>
        
                                            <div class="mb-3"> 
                                                <label class="form-label">Change Photo</label>
                                                <div><input type="file"  name="image_2"></div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- top tittles --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Top Title EN</label>
                                                <input type="text" class="form-control" name="top_title_en" value="{{$about_item->top_title_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Top Title RU</label>
                                                <input type="text" class="form-control" name="top_title_ru" value="{{$about_item->top_title_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Top Title AR</label>
                                                <input type="text" class="form-control" name="top_title_ar" value="{{$about_item->top_title_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- top descriptions --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Top Description English</label>
                                                <textarea name="top_description_en" class="form-control editor" id="" cols="30" rows="10">{{$about_item->top_description_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Top Description Russian</label>
                                                <textarea name="top_description_ru" class="form-control editor" id="" cols="30" rows="10">{{$about_item->top_description_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Top Description Arabic</label>
                                                <textarea name="top_description_ar" class="form-control editor" id="" cols="30" rows="10">{{$about_item->top_description_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    {{-- logo 1 --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3"> 
                                                <label class="form-label">Existing Top Icon 1</label>
                                                <div>
                                                    <img src="{{asset('uploads/'.$about_item->top_logo_1)}}" alt="" class="w_50">
                                                </div>
                                            </div>
        
                                            <div class="mb-3"> 
                                                <label class="form-label">Change Icon</label>
                                                <div><input type="file"  name="top_logo_1"></div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Logo 1 tittles --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Icon 1 Title EN</label>
                                                <input type="text" class="form-control" name="logo1_title_en" value="{{$about_item->logo1_title_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Icon 1 Title RU</label>
                                                <input type="text" class="form-control" name="logo1_title_ru" value="{{$about_item->logo1_title_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Icon 1 Title AR</label>
                                                <input type="text" class="form-control" name="logo1_title_ar" value="{{$about_item->logo1_title_ar}}">
                                            </div>
                                        </div>
                                    </div>


                                     {{-- logo 2 --}}
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3"> 
                                                <label class="form-label">Existing Top Icon 2</label>
                                                <div>
                                                    <img src="{{asset('uploads/'.$about_item->top_logo_2)}}" alt="" class="w_50">
                                                </div>
                                            </div>
        
                                            <div class="mb-3"> 
                                                <label class="form-label">Change Icon</label>
                                                <div><input type="file"  name="top_logo_2"></div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Logo 2 tittles --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Icon 2 Title EN</label>
                                                <input type="text" class="form-control" name="logo2_title_en" value="{{$about_item->logo2_title_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Icon 2 Title RU</label>
                                                <input type="text" class="form-control" name="logo2_title_ru" value="{{$about_item->logo2_title_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Icon 2 Title AR</label>
                                                <input type="text" class="form-control" name="logo2_title_ar" value="{{$about_item->logo2_title_ar}}">
                                            </div>
                                        </div>
                                    </div>


                                    {{-- Porint 1  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Point 1 EN</label>
                                                <input type="text" class="form-control" name="point_1_en" value="{{$about_item->point_1_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Point 1 RU</label>
                                                <input type="text" class="form-control" name="point_1_ru" value="{{$about_item->point_1_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Point 1 AR</label>
                                                <input type="text" class="form-control" name="point_1_ar" value="{{$about_item->point_1_ar}}">
                                            </div>
                                        </div>
                                    </div>


                                    {{-- Porint 2  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Point 2 EN</label>
                                                <input type="text" class="form-control" name="point_2_en" value="{{$about_item->point_2_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Point 2 RU</label>
                                                <input type="text" class="form-control" name="point_2_ru" value="{{$about_item->point_2_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Point 2 AR</label>
                                                <input type="text" class="form-control" name="point_2_ar" value="{{$about_item->point_2_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Porint 3  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Point 3 EN</label>
                                                <input type="text" class="form-control" name="point_3_en" value="{{$about_item->point_3_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Point 3 RU</label>
                                                <input type="text" class="form-control" name="point_3_ru" value="{{$about_item->point_3_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Point 3 AR</label>
                                                <input type="text" class="form-control" name="point_3_ar" value="{{$about_item->point_3_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- mission icon --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3"> 
                                                <label class="form-label">Existing Mission Icon</label>
                                                <div>
                                                    <img src="{{asset('uploads/'.$about_item->mission_logo)}}" alt="" class="w_50">
                                                </div>
                                            </div>
        
                                            <div class="mb-3"> 
                                                <label class="form-label">Change Icon</label>
                                                <div><input type="file"  name="mission_logo"></div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Mission descriptions --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Mission Description English</label>
                                                <textarea name="mission_description_en" class="form-control editor" id="" cols="30" rows="10">{{$about_item->mission_description_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Mission Description Russian</label>
                                                <textarea name="mission_description_ru" class="form-control editor" id="" cols="30" rows="10">{{$about_item->mission_description_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Mission Description Arabic</label>
                                                <textarea name="mission_description_ar" class="form-control editor" id="" cols="30" rows="10">{{$about_item->mission_description_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- Destination icon --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3"> 
                                                <label class="form-label">Existing Destination Icon</label>
                                                <div>
                                                    <img src="{{asset('uploads/'.$about_item->destination_logo)}}" alt="" class="w_50">
                                                </div>
                                            </div>
        
                                            <div class="mb-3"> 
                                                <label class="form-label">Change Icon</label>
                                                <div><input type="file"  name="destination_logo"></div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Destination descriptions --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Destination Description English</label>
                                                <textarea name="destination_description_en" class="form-control editor" id="" cols="30" rows="10">{{$about_item->destination_description_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Destination Description Russian</label>
                                                <textarea name="destination_description_ru" class="form-control editor" id="" cols="30" rows="10">{{$about_item->destination_description_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Destination Description Arabic</label>
                                                <textarea name="destination_description_ar" class="form-control editor" id="" cols="30" rows="10">{{$about_item->destination_description_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                     {{-- Planning icon --}}
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3"> 
                                                <label class="form-label">Existing Planning Icon</label>
                                                <div>
                                                    <img src="{{asset('uploads/'.$about_item->planning_logo)}}" alt="" class="w_50">
                                                </div>
                                            </div>
        
                                            <div class="mb-3"> 
                                                <label class="form-label">Change Icon</label>
                                                <div><input type="file"  name="planning_logo"></div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Planning descriptions --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Planning Description English</label>
                                                <textarea name="planning_description_en" class="form-control editor" id="" cols="30" rows="10">{{$about_item->planning_description_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Planning Description Russian</label>
                                                <textarea name="planning_description_ru" class="form-control editor" id="" cols="30" rows="10">{{$about_item->planning_description_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Planning Description Arabic</label>
                                                <textarea name="planning_description_ar" class="form-control editor" id="" cols="30" rows="10">{{$about_item->planning_description_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- Main tittles --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Main Title EN</label>
                                                <input type="text" class="form-control" name="main_title_en" value="{{$about_item->main_title_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Main Title RU</label>
                                                <input type="text" class="form-control" name="main_title_ru" value="{{$about_item->main_title_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Main Title AR</label>
                                                <input type="text" class="form-control" name="main_title_ar" value="{{$about_item->main_title_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Main descriptions --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Main Description English</label>
                                                <textarea name="main_description_en" class="form-control editor" id="" cols="30" rows="10">{{$about_item->main_description_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Main Description Russian</label>
                                                <textarea name="main_description_ru" class="form-control editor" id="" cols="30" rows="10">{{$about_item->main_description_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Main Description Arabic</label>
                                                <textarea name="main_description_ar" class="form-control editor" id="" cols="30" rows="10">{{$about_item->main_description_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>


                                     {{--  tittles 1 --}}
                                     <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title 1 EN</label>
                                                <input type="text" class="form-control" name="title_1_en" value="{{$about_item->title_1_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title 1 RU</label>
                                                <input type="text" class="form-control" name="title_1_ru" value="{{$about_item->title_1_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title 1 AR</label>
                                                <input type="text" class="form-control" name="title_1_ar" value="{{$about_item->title_1_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- descriptions 1 --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Description 1 English</label>
                                                <textarea name="description_1_en" class="form-control editor" id="" cols="30" rows="10">{{$about_item->description_1_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Description 1 Russian</label>
                                                <textarea name="description_1_ru" class="form-control editor" id="" cols="30" rows="10">{{$about_item->description_1_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Description 1 Arabic</label>
                                                <textarea name="description_1_ar" class="form-control editor" id="" cols="30" rows="10">{{$about_item->description_1_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    {{--  tittles 2 --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title 2 EN</label>
                                                <input type="text" class="form-control" name="title_2_en" value="{{$about_item->title_2_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title 2 RU</label>
                                                <input type="text" class="form-control" name="title_2_ru" value="{{$about_item->title_2_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title 2 AR</label>
                                                <input type="text" class="form-control" name="title_2_ar" value="{{$about_item->title_2_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- descriptions 2 --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Description 2 English</label>
                                                <textarea name="description_2_en" class="form-control editor" id="" cols="30" rows="10">{{$about_item->description_2_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Description 2 Russian</label>
                                                <textarea name="description_2_ru" class="form-control editor" id="" cols="30" rows="10">{{$about_item->description_2_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Description 2 Arabic</label>
                                                <textarea name="description_2_ar" class="form-control editor" id="" cols="30" rows="10">{{$about_item->description_2_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    {{--  tittles 3 --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title 3 EN</label>
                                                <input type="text" class="form-control" name="title_3_en" value="{{$about_item->title_3_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title 3 RU</label>
                                                <input type="text" class="form-control" name="title_3_ru" value="{{$about_item->title_3_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title 3 AR</label>
                                                <input type="text" class="form-control" name="title_3_ar" value="{{$about_item->title_3_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- descriptions 3 --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Description 3 English</label>
                                                <textarea name="description_3_en" class="form-control editor" id="" cols="30" rows="10">{{$about_item->description_3_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Description 3 Russian</label>
                                                <textarea name="description_3_ru" class="form-control editor" id="" cols="30" rows="10">{{$about_item->description_3_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Description 3 Arabic</label>
                                                <textarea name="description_3_ar" class="form-control editor" id="" cols="30" rows="10">{{$about_item->description_3_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                     {{--  tittles 4 --}}
                                     <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title 4 EN</label>
                                                <input type="text" class="form-control" name="title_4_en" value="{{$about_item->title_4_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title 4 RU</label>
                                                <input type="text" class="form-control" name="title_4_ru" value="{{$about_item->title_4_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title 4 AR</label>
                                                <input type="text" class="form-control" name="title_4_ar" value="{{$about_item->title_4_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- descriptions 4 --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Description 4 English</label>
                                                <textarea name="description_4_en" class="form-control editor" id="" cols="30" rows="10">{{$about_item->description_4_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Description 4 Russian</label>
                                                <textarea name="description_4_ru" class="form-control editor" id="" cols="30" rows="10">{{$about_item->description_4_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Description 4 Arabic</label>
                                                <textarea name="description_4_ar" class="form-control editor" id="" cols="30" rows="10">{{$about_item->description_4_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>


                                    


                                   
                                    

                                   
                                    <div class="mb-3">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
