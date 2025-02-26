
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Destination</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_destination_index')}}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_destination_edit_submit', $destination->id) }}" method="post" enctype="multipart/form-data">  
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3"> 
                                                <label class="form-label">Existing Featured Photo</label>
                                                <div><img src="{{asset('uploads/'.$destination->featured_photo)}}" alt="" class="w_200"></div>
                                            </div>
                                            <div class="mb-3"> 
                                                <label class="form-label">Change Featured Photo</label>
                                                <div><input type="file"  name="featured_photo"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3"> 
                                                <label class="form-label">Existing Banner Photo</label>
                                                <div><img src="{{asset('uploads/'.$destination->banner)}}" alt="" class="w_200"></div>
                                            </div>
                                            <div class="mb-3"> 
                                                <label class="form-label">Change Banner Photo</label>
                                                <div><input type="file"  name="banner"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Slug</label>
                                                <input type="text" class="form-control" name="slug" value="{{$destination->slug}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Country Icon</label>
                                                <input type="text" class="form-control" name="country" value="{{$destination->country}}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Name English</label>
                                                <input type="text" class="form-control" name="name_en" value="{{$destination->name_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Name Russian</label>
                                                <input type="text" class="form-control" name="name_ru" value="{{$destination->name_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Name Arabic</label>
                                                <input type="text" class="form-control" name="name_ar" value="{{$destination->name_ar}}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Description English</label>
                                                <textarea name="description_en" class="form-control editor" id="" cols="30" rows="10">{{$destination->description_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Description Russian</label>
                                                <textarea name="description_ru" class="form-control editor" id="" cols="30" rows="10">{{$destination->description_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Description Arabic</label>
                                                <textarea name="description_ar" class="form-control editor" id="" cols="30" rows="10">{{$destination->description_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Language English</label>
                                                <input type="text" class="form-control" name="language_en" value="{{$destination->language_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Language Russian</label>
                                                <input type="text" class="form-control" name="language_ru" value="{{$destination->language_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Language Arabic</label>
                                                <input type="text" class="form-control" name="language_ar" value="{{$destination->language_ar}}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Currency English</label>
                                                <input type="text" class="form-control" name="currency_en" value="{{$destination->currency_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Currency Russian</label>
                                                <input type="text" class="form-control" name="currency_ru" value="{{$destination->currency_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Currency Arabic</label>
                                                <input type="text" class="form-control" name="currency_ar" value="{{$destination->currency_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Area English</label>
                                                <input type="text" class="form-control" name="area_en" value="{{$destination->area_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Area Russian</label>
                                                <input type="text" class="form-control" name="area_ru" value="{{$destination->area_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Area Arabic</label>
                                                <input type="text" class="form-control" name="area_ar" value="{{$destination->area_ar}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Timezone English</label>
                                                <input type="text" class="form-control" name="timezone_en" value="{{$destination->timezone_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Timezone Russian</label>
                                                <input type="text" class="form-control" name="timezone_ru" value="{{$destination->timezone_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Timezone Arabic</label>
                                                <input type="text" class="form-control" name="timezone_ar" value="{{$destination->timezone_ar}}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Activities English</label>
                                                <textarea name="activities_en" class="form-control editor" id="" cols="30" rows="10">{{$destination->activities_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Activities Russian</label>
                                                <textarea name="activities_ru" class="form-control editor" id="" cols="30" rows="10">{{$destination->activities_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Activities Arabic</label>
                                                <textarea name="activities_ar" class="form-control editor" id="" cols="30" rows="10">{{$destination->activities_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Visa Requirement English</label>
                                                <textarea name="visa_requirement_en" class="form-control editor" id="" cols="30" rows="10">{{$destination->visa_requirement_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Visa Requirement Russian</label>
                                                <textarea name="visa_requirement_ru" class="form-control editor" id="" cols="30" rows="10">{{$destination->visa_requirement_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Visa Requirement Arabic</label>
                                                <textarea name="visa_requirement_ar" class="form-control editor" id="" cols="30" rows="10">{{$destination->visa_requirement_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Best Time to Visit English</label>
                                                <textarea name="best_time_en" class="form-control editor" id="" cols="30" rows="10">{{$destination->best_time_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Best Time to Visit Russian</label>
                                                <textarea name="best_time_ru" class="form-control editor" id="" cols="30" rows="10">{{$destination->best_time_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Best Time to Visit Arabic</label>
                                                <textarea name="best_time_ar" class="form-control editor" id="" cols="30" rows="10">{{$destination->best_time_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Health & Safty English</label>
                                                <textarea name="health_safety_en" class="form-control editor" id="" cols="30" rows="10">{{$destination->health_safety_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Health & Safty Russian</label>
                                                <textarea name="health_safety_ru" class="form-control editor" id="" cols="30" rows="10">{{$destination->health_safety_ru}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Health & Safty Arabic</label>
                                                <textarea name="health_safety_ar" class="form-control editor" id="" cols="30" rows="10">{{$destination->health_safety_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mb-3">
                                        <label class="form-label">Map (iframe code)</label>
                                        <textarea name="map" class="form-control h_100" id="" cols="30" rows="10">{{$destination->map}}</textarea>
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
