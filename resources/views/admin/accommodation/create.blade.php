
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Create Accommodation in {{$destination->name}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_accommodation_index',$destination->id)}}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('admin_accommodation_create_submit',$destination->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3"> 
                                                <label class="form-label">Featured Photo</label>
                                                <div><input type="file"  name="featured_photo"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                   
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Accommodation Type</label>
                                                <input type="text" class="form-control" name="accommodation_type" value="{{old('accommodation_type')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Select City</label>
                                                <select name="city_id" class="form-select">
                                                    @foreach ($cities as $city)
                                                    <option value="{{$city->id}}" @if(old('city_id') == $city->id) selected @endif>{{$city->city_en}}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" name="email" value="{{old('email')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Phone</label>
                                                <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address" value="{{old('address')}}">
                                            </div>
                                        </div>
                                       
                                    </div>
                                    
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Note</label>
                                        <textarea name="note" class="form-control editor" id="" cols="30" rows="10">{{old('note')}}</textarea>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Accommodation Rate</label>
                                            <select name="rate" class="form-select">
                                               
                                                <option value="5" @if(old('rate') == 5) selected @endif>5 Star</option>
                                                <option value="4" @if(old('rate') == 4) selected @endif>4 Star</option>
                                                <option value="3" @if(old('rate') == 3) selected @endif>3 Star</option>
                                                <option value="2" @if(old('rate') == 2) selected @endif>2 Star</option>

                                               
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Hotel Website</label>
                                                <input type="text" class="form-control" name="hotel_website" value="{{old('hotel_website')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Video Link</label>
                                                <input type="text" class="form-control" name="video_link" value="{{old('video_link')}}">
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
