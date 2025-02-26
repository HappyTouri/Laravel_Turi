
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Home Item</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_home_item_update', $home_item->id) }}" method="post" enctype="multipart/form-data" > 
                                    @csrf
                                    <h4>Let’s Travel Now</h4>
                                    {{-- First --}}
                                    <div class="row">
                                        <div class="mb-3"> 
                                            <label class="form-label">Existing Icon 1</label>
                                            <div><img src="{{asset('uploads/'.$home_item->travel_icon_1)}}" alt="" class="w_50"></div>
                                        </div>
                                        <div class="mb-3"> 
                                            <label class="form-label">Change Icon 1</label>
                                            <div><input type="file"  name="travel_icon_1"></div>
                                        </div>
                                    </div>
                                    {{-- Title  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title English </label>
                                                <input type="text" class="form-control" name="title_1_en" value="{{$home_item->title_1_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Russian </label>
                                                <input type="text" class="form-control" name="title_1_ru" value="{{$home_item->title_1_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Arabic </label>
                                                <input type="text" class="form-control" name="title_1_ar" value="{{$home_item->title_1_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Description  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description English</label>
                                                <textarea name="description_1_en" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->description_1_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description Russian</label>
                                                <textarea name="description_1_ru" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->description_1_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description Arabic</label>
                                                <textarea name="description_1_ar" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->description_1_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Second --}}
                                    <div class="row">
                                        <div class="mb-3"> 
                                            <label class="form-label">Existing Icon 2</label>
                                            <div><img src="{{asset('uploads/'.$home_item->travel_icon_2)}}" alt="" class="w_50"></div>
                                        </div>
                                        <div class="mb-3"> 
                                            <label class="form-label">Change Icon 2</label>
                                            <div><input type="file"  name="travel_icon_2"></div>
                                        </div>
                                    </div>

                                    {{-- Title  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title English </label>
                                                <input type="text" class="form-control" name="title_2_en" value="{{$home_item->title_2_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Russian </label>
                                                <input type="text" class="form-control" name="title_2_ru" value="{{$home_item->title_2_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Arabic </label>
                                                <input type="text" class="form-control" name="title_2_ar" value="{{$home_item->title_2_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Description  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description English</label>
                                                <textarea name="description_2_en" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->description_2_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description Russian</label>
                                                <textarea name="description_2_ru" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->description_2_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description Arabic</label>
                                                <textarea name="description_2_ar" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->description_2_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Third --}}
                                    <div class="row">
                                        <div class="mb-3"> 
                                            <label class="form-label">Existing Icon 3</label>
                                            <div><img src="{{asset('uploads/'.$home_item->travel_icon_3)}}" alt="" class="w_50"></div>
                                        </div>
                                        <div class="mb-3"> 
                                            <label class="form-label">Change Icon 3</label>
                                            <div><input type="file"  name="travel_icon_3"></div>
                                        </div>
                                    </div>

                                    {{-- Title  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title English </label>
                                                <input type="text" class="form-control" name="title_3_en" value="{{$home_item->title_3_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Russian </label>
                                                <input type="text" class="form-control" name="title_3_ru" value="{{$home_item->title_3_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Arabic </label>
                                                <input type="text" class="form-control" name="title_3_ar" value="{{$home_item->title_3_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Description  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description English</label>
                                                <textarea name="description_3_en" class="form-control h_100" id="" cols="30" rows="100">{{$home_item->description_3_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description Russian</label>
                                                <textarea name="description_3_ru" class="form-control h_100" id="" cols="30" rows="100">{{$home_item->description_3_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description Arabic</label>
                                                <textarea name="description_3_ar" class="form-control h_100" id="" cols="30" rows="100">{{$home_item->description_3_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <h4 class="mt-5">Let’s Explore the World</h4>
                                    {{-- image & video --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3"> 
                                                <label class="form-label">Existing Photo</label>
                                                <div><img src="{{asset('uploads/'.$home_item->explore_photo)}}" alt="" class="w_200"></div>
                                            </div>
                                            <div class="mb-3"> 
                                                <label class="form-label">Change Photo</label>
                                                <div><input type="file"  name="explore_photo"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Existing Video</label>
                                                <iframe class="iframe1" 
                                                src="{{ str_replace('watch?v=', 'embed/', strtok($home_item->explore_video, '&')) }}" 
                                                title="YouTube video player" 
                                                frameborder="0" 
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                                referrerpolicy="strict-origin-when-cross-origin" 
                                                allowfullscreen>
                                                </iframe> 
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Video Link</label>
                                                <input type="text" class="form-control" name="explore_video" value="{{$home_item->explore_video}}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Title  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title English </label>
                                                <input type="text" class="form-control" name="explore_title_en" value="{{$home_item->explore_title_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Russian </label>
                                                <input type="text" class="form-control" name="explore_title_ru" value="{{$home_item->explore_title_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Arabic </label>
                                                <input type="text" class="form-control" name="explore_title_ar" value="{{$home_item->explore_title_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Description  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description English</label>
                                                <textarea name="explore_description_en" class="form-control editor" id="" cols="30" rows="10">{{$home_item->explore_description_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description Russian</label>
                                                <textarea name="explore_description_ru" class="form-control editor" id="" cols="30" rows="10">{{$home_item->explore_description_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description Arabic</label>
                                                <textarea name="explore_description_ar" class="form-control editor" id="" cols="30" rows="10">{{$home_item->explore_description_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="mt-5">Why Choose Us</h4>

                                    {{-- Image --}}
                                    <div class="row">
                                        <div class="mb-3"> 
                                            <label class="form-label">Existing Image</label>
                                            <div><img src="{{asset('uploads/'.$home_item->choose_photo)}}" alt="" class="w_200"></div>
                                        </div>
                                        <div class="mb-3"> 
                                            <label class="form-label">Change Image</label>
                                            <div><input type="file"  name="choose_photo"></div>
                                        </div>
                                    </div>
                                    {{-- Title  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title English </label>
                                                <input type="text" class="form-control" name="choose_title_en" value="{{$home_item->choose_title_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Russian </label>
                                                <input type="text" class="form-control" name="choose_title_ru" value="{{$home_item->choose_title_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Arabic </label>
                                                <input type="text" class="form-control" name="choose_title_ar" value="{{$home_item->choose_title_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Description  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description English</label>
                                                <textarea name="choose_description_en" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->choose_description_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description Russian</label>
                                                <textarea name="choose_description_ru" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->choose_description_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description Arabic</label>
                                                <textarea name="choose_description_ar" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->choose_description_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- icon --}}
                                    <div class="row">
                                        <div class="mb-3"> 
                                            <label class="form-label">Existing Icon 1</label>
                                            <div><img src="{{asset('uploads/'.$home_item->choose_icon_1)}}" alt="" class="w_50"></div>
                                        </div>
                                        <div class="mb-3"> 
                                            <label class="form-label">Change Icon 1</label>
                                            <div><input type="file"  name="choose_icon_1"></div>
                                        </div>
                                    </div>
                                    {{-- Title  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title English </label>
                                                <input type="text" class="form-control" name="choose_title_1_en" value="{{$home_item->choose_title_1_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Russian </label>
                                                <input type="text" class="form-control" name="choose_title_1_ru" value="{{$home_item->choose_title_1_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Arabic </label>
                                                <input type="text" class="form-control" name="choose_title_1_ar" value="{{$home_item->choose_title_1_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Description  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description English</label>
                                                <textarea name="choose_description_1_en" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->choose_description_1_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description Russian</label>
                                                <textarea name="choose_description_1_ru" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->choose_description_1_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description Arabic</label>
                                                <textarea name="choose_description_1_ar" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->choose_description_1_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- icon --}}
                                    <div class="row">
                                        <div class="mb-3"> 
                                            <label class="form-label">Existing Icon 2</label>
                                            <div><img src="{{asset('uploads/'.$home_item->choose_icon_2)}}" alt="" class="w_50"></div>
                                        </div>
                                        <div class="mb-3"> 
                                            <label class="form-label">Change Icon 2</label>
                                            <div><input type="file"  name="choose_icon_2"></div>
                                        </div>
                                    </div>
                                    {{-- Title  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title English </label>
                                                <input type="text" class="form-control" name="choose_title_2_en" value="{{$home_item->choose_title_2_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Russian </label>
                                                <input type="text" class="form-control" name="choose_title_2_ru" value="{{$home_item->choose_title_2_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Arabic </label>
                                                <input type="text" class="form-control" name="choose_title_2_ar" value="{{$home_item->choose_title_2_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Description  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description English</label>
                                                <textarea name="choose_description_2_en" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->choose_description_2_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description Russian</label>
                                                <textarea name="choose_description_2_ru" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->choose_description_2_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description Arabic</label>
                                                <textarea name="choose_description_2_ar" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->choose_description_2_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- icon --}}
                                    <div class="row">
                                        <div class="mb-3"> 
                                            <label class="form-label">Existing Icon 3</label>
                                            <div><img src="{{asset('uploads/'.$home_item->choose_icon_3)}}" alt="" class="w_50"></div>
                                        </div>
                                        <div class="mb-3"> 
                                            <label class="form-label">Change Icon 3</label>
                                            <div><input type="file"  name="choose_icon_3"></div>
                                        </div>
                                    </div>
                                    {{-- Title  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title English </label>
                                                <input type="text" class="form-control" name="choose_title_3_en" value="{{$home_item->choose_title_3_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Russian </label>
                                                <input type="text" class="form-control" name="choose_title_3_ru" value="{{$home_item->choose_title_3_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Arabic </label>
                                                <input type="text" class="form-control" name="choose_title_3_ar" value="{{$home_item->choose_title_3_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Description  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description English</label>
                                                <textarea name="choose_description_3_en" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->choose_description_3_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description Russian</label>
                                                <textarea name="choose_description_3_ru" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->choose_description_3_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description Arabic</label>
                                                <textarea name="choose_description_3_ar" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->choose_description_3_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <h4 class="mt-5">Confused? Get Help</h4>
                                    {{-- Title  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title English </label>
                                                <input type="text" class="form-control" name="help_title_en" value="{{$home_item->help_title_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Russian </label>
                                                <input type="text" class="form-control" name="help_title_ru" value="{{$home_item->help_title_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Title Arabic </label>
                                                <input type="text" class="form-control" name="help_title_ar" value="{{$home_item->help_title_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Description  --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description English</label>
                                                <textarea name="help_description_en" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->help_description_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description Russian</label>
                                                <textarea name="help_description_ru" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->help_description_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Description Arabic</label>
                                                <textarea name="help_description_ar" class="form-control h_100" id="" cols="30" rows="10">{{$home_item->help_description_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="mt-5">Testimonials</h4>
                                    {{-- Image --}}
                                    <div class="row">
                                        <div class="mb-3"> 
                                            <label class="form-label">Existing Image</label>
                                            <div><img src="{{asset('uploads/'.$home_item->testimonial_photo)}}" alt="" class="w_200"></div>
                                        </div>
                                        <div class="mb-3"> 
                                            <label class="form-label">Change Image</label>
                                            <div><input type="file"  name="testimonial_photo"></div>
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
