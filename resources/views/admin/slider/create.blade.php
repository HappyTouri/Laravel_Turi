
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Create Sliders</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_slider_index')}}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('admin_slider_create_submit')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3"> 
                                        <label class="form-label">Photo</label>
                                        <div><input type="file"  name="photo"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Heading English</label>
                                                <input type="text" class="form-control" name="heading_en" value="{{old('heading_en')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Heading Russian</label>
                                                <input type="text" class="form-control" name="heading_ru" value="{{old('heading_ru')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Heading Arabic</label>
                                                <input type="text" class="form-control" name="heading_ar" value="{{old('heading_ar')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Text English</label>
                                                <textarea name="text_en" class="form-control h_100" id="" cols="30" rows="10">{{old('text_en')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Text Russian</label>
                                                <textarea name="text_ru" class="form-control h_100" id="" cols="30" rows="10">{{old('text_ru')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Text Arabic</label>
                                                <textarea name="text_ar" class="form-control h_100" id="" cols="30" rows="10">{{old('text_ar')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="mb-3">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
