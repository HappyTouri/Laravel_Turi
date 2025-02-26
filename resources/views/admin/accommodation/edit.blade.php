
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Accommodation in {{$accommodation->destination->name}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_accommodation_index',$accommodation->destination->id)}}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('admin_accommodation_edit_submit',$accommodation->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3"> 
                                        <label class="form-label">Existing Featured Photo</label>
                                        <div><img src="{{asset('uploads/'.$accommodation->featured_photo)}}" alt="" class="w_200"></div>
                                    </div>
                                    <div class="mb-3"> 
                                        <label class="form-label">Change Featured Photo</label>
                                        <div><input type="file"  name="featured_photo"></div>
                                    </div>
                                    
                                    
                                   
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" name="name" value="{{$accommodation->name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Accommodation Type</label>
                                                <input type="text" class="form-control" name="accommodation_type" value="{{$accommodation->accommodation_type}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Select Destination</label>
                                                <select name="city_id" class="form-select">
                                                    @foreach ($cities as $city)
                                                    <option value="{{$city->id}}" @if($accommodation->city_id == $city->id) selected @endif>{{$city->city_en}}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" name="email" value="{{$accommodation->email}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Phone</label>
                                                <input type="text" class="form-control" name="phone" value="{{$accommodation->phone}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address" value="{{$accommodation->address}}">
                                            </div>
                                        </div>
                                       
                                    </div>
                                    
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Note</label>
                                        <textarea name="note" class="form-control editor" id="" cols="30" rows="10">{{$accommodation->note}}</textarea>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Accommodation Rate</label>
                                            <select name="rate" class="form-select">
                                               
                                                <option value="5" @if($accommodation->rate == 5) selected @endif>5 Star</option>
                                                <option value="4" @if($accommodation->rate == 4) selected @endif>4 Star</option>
                                                <option value="3" @if($accommodation->rate == 3) selected @endif>3 Star</option>
                                                <option value="2" @if($accommodation->rate == 2) selected @endif>2 Star</option>

                                               
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Hotel Website</label>
                                                <input type="text" class="form-control" name="hotel_website" value="{{$accommodation->hotel_website}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Video Link</label>
                                                <input type="text" class="form-control" name="video_link" value="{{$accommodation->video_link}}">
                                            </div>
                                            <iframe class="iframe1"
                                                    src="{{ str_contains($accommodation->video_link, 'watch?v=') ? str_replace('watch?v=', 'embed/', $accommodation->video_link) : $accommodation->video_link }}"
                                                    title="YouTube video player"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    referrerpolicy="strict-origin-when-cross-origin"
                                                    allowfullscreen>
                                            </iframe>
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
