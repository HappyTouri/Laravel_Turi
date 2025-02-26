
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Add New Tourguide in {{$destination->name}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_tourguide_index',$destination->id)}}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('admin_tourguide_create_submit',$destination->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3"> 
                                                <label class="form-label">Tourguide Photo</label>
                                                <div><input type="file"  name="photo"></div>
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
                                                <label class="form-label">Mobile Number</label>
                                                <input type="text" class="form-control" name="mobile" value="{{old('mobile')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Email</label>
                                                <input type="text" class="form-control" name="email" value="{{old('email')}}">
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
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
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Date of Birth</label>
                                                <input id="datepicker1" type="text" class="form-control" name="date_of_birth" value="{{old('date_of_birth')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Price Per Day</label>
                                                <input type="number" class="form-control" name="price_per_day" value="{{old('price_per_day')}}">
                                            </div>
                                        </div>
                                       
                                    </div>
                                    
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Note</label>
                                        <textarea name="note" class="form-control editor" id="" cols="30" rows="10">{{old('note')}}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-select">
                                                
                                                    <option value="active" @if(old('status') == 'active') selected @endif>Active</option>
                                                    <option value="inactive" @if(old('status') == 'inactive') selected @endif>Inactive</option>
                                                    

                                                </select>
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
