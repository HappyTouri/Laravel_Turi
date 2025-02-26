
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Add New Driver in {{$destination->name}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_driver_index',$destination->id)}}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('admin_driver_create_submit',$destination->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3"> 
                                                <label class="form-label">Driver Photo</label>
                                                <div><input type="file"  name="driverPhoto"></div>
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
                                                <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
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
                                                <label class="form-label">Transportation Type</label>
                                                <select name="trabsportationType_id" class="form-select">
                                                    @foreach ($transportation_types as $item)
                                                    <option value="{{$item->type_id}}" @if(old('item_id') == $item->id) selected @endif>{{$item->transportationType->type}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Car Model</label>
                                                <input type="text" class="form-control" name="carModel" value="{{old('carModel')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Number Of Seats</label>
                                                <input type="number" class="form-control" name="numberOfSeats" value="{{old('numberOfSeats')}}">
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
                                                <label class="form-label">Driver Rate</label>
                                                <select name="rate" class="form-select">
                                                
                                                    <option value="5" @if(old('rate') == 5) selected @endif>5 Star</option>
                                                    <option value="4" @if(old('rate') == 4) selected @endif>4 Star</option>
                                                    <option value="3" @if(old('rate') == 3) selected @endif>3 Star</option>
                                                    <option value="2" @if(old('rate') == 2) selected @endif>2 Star</option>
                                                    <option value="1" @if(old('rate') == 1) selected @endif>1 Star</option>

                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Price Per Day</label>
                                                <input type="number" class="form-control" name="pricePerDay" value="{{old('pricePerDay')}}">
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
