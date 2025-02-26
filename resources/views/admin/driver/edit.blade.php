
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Driver in {{$destination->name}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_driver_index',$destination->id)}}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('admin_driver_edit_submit',$driver->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3"> 
                                        <label class="form-label">Existing Driver Photo</label>
                                        <div><img src="{{asset('uploads/'.$driver->driverPhoto)}}" alt="" class="w_200"></div>
                                    </div>
                                    <div class="mb-3"> 
                                        <label class="form-label">Change Driver Photo</label>
                                        <div><input type="file"  name="driverPhoto"></div>
                                    </div>
                                    
                                    
                                   
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" name="name" value="{{$driver->name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Mobile Number</label>
                                                <input type="text" class="form-control" name="phone" value="{{$driver->phone}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Select City</label>
                                                <select name="city_id" class="form-select">
                                                    @foreach ($cities as $city)
                                                    <option value="{{$city->id}}" @if($driver->city_id == $city->id) selected @endif>{{$city->city_en}}</option>

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
                                                    <option value="{{$item->type_id}}" @if($driver->trabsportationType_id == $item->id) selected @endif>{{$item->transportationType->type}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Car Model</label>
                                                <input type="text" class="form-control" name="carModel" value="{{$driver->carModel}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Number Of Seats</label>
                                                <input type="number" class="form-control" name="numberOfSeats" value="{{$driver->numberOfSeats}}">
                                            </div>
                                        </div>
                                       
                                    </div>
                                    
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Note</label>
                                        <textarea name="note" class="form-control editor" id="" cols="30" rows="10">{{$driver->note}}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Driver Rate</label>
                                                <select name="rate" class="form-select">
                                                
                                                    <option value="5" @if($driver->rate == 5) selected @endif>5 Star</option>
                                                    <option value="4" @if($driver->rate == 4) selected @endif>4 Star</option>
                                                    <option value="3" @if($driver->rate == 3) selected @endif>3 Star</option>
                                                    <option value="2" @if($driver->rate == 2) selected @endif>2 Star</option>
                                                    <option value="1" @if($driver->rate == 1) selected @endif>1 Star</option>

                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Price Per Day</label>
                                                <input type="number" class="form-control" name="pricePerDay" value="{{$driver->pricePerDay}}">
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
