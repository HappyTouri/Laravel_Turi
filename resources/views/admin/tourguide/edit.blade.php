
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Tourguide in {{$destination->name}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_tourguide_index',$destination->id)}}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('admin_tourguide_edit_submit',$tourguide->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3"> 
                                        <label class="form-label">Existing tourguide Photo</label>
                                        <div><img src="{{asset('uploads/'.$tourguide->photo)}}" alt="" class="w_200"></div>
                                    </div>
                                    <div class="mb-3"> 
                                        <label class="form-label">Change tourguide Photo</label>
                                        <div><input type="file"  name="photo"></div>
                                    </div>
                                    
                                    
                                   
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" name="name" value="{{$tourguide->name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Mobile Number</label>
                                                <input type="text" class="form-control" name="mobile" value="{{$tourguide->mobile}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Email</label>
                                                <input type="text" class="form-control" name="email" value="{{$tourguide->email}}">
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Select City</label>
                                                <select name="city_id" class="form-select">
                                                    @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}" @if($tourguide->city->id == $city->id) selected @endif>{{ $city->city_en }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Date of Birth</label>
                                                <input id="datepicker1" type="text" class="form-control" name="date_of_birth" value="{{$tourguide->date_of_birth}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Price Per Day</label>
                                                <input type="number" class="form-control" name="price_per_day" value="{{$tourguide->price_per_day}}">
                                            </div>
                                        </div>
                                       
                                    </div>
                                    
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Note</label>
                                        <textarea name="note" class="form-control editor" id="" cols="30" rows="10">{{$tourguide->note}}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-select">
                                                
                                                    <option value="active" @if($tourguide->status == 'active') selected @endif>Active</option>
                                                    <option value="inactive" @if($tourguide->status == 'inactive') selected @endif>Inactive</option>
                                                    

                                                </select>
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
