
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Sliders</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_slider_index')}}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_slider_edit_submit', $slider->id) }}" method="post" enctype="multipart/form-data">                                    @csrf
                                    <div class="mb-3"> 
                                        <label class="form-label">Existing Photo</label>
                                        <div><img src="{{asset('uploads/'.$slider->photo)}}" alt="" class="w_200"></div>
                                    </div>
                                    <div class="mb-3"> 
                                        <label class="form-label">Change Photo</label>
                                        <div><input type="file"  name="photo"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Heading English</label>
                                                <input type="text" class="form-control" name="heading_en" value="{{$slider->heading_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Heading Russian</label>
                                                <input type="text" class="form-control" name="heading_ru" value="{{$slider->heading_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Heading Arabic</label>
                                                <input type="text" class="form-control" name="heading_ar" value="{{$slider->heading_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Text English</label>
                                                <textarea name="text_en" class="form-control h_100" id="" cols="30" rows="10">{{$slider->text_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Text Russian</label>
                                                <textarea name="text_ru" class="form-control h_100" id="" cols="30" rows="10">{{$slider->text_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Text Arabic</label>
                                                <textarea name="text_ar" class="form-control h_100" id="" cols="30" rows="10">{{$slider->text_ar}}</textarea>
                                            </div>
                                        </div>
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
