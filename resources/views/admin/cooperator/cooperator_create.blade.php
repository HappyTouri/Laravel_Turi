
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Add Cooperator</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_cooperators')}}" class="btn btn-primary"><i class="fas fa-plus"></i> All Cooperators</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('admin_cooperator_create_submit')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3"> 
                                                <label class="form-label">Photo</label>
                                                <div><input type="file"  name="photo"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3"> 
                                                <label class="form-label">Logo</label>
                                                <div><input type="file"  name="logo"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3">
                                            <label class="form-label">slug</label>
                                            <input type="text" class="form-control" name="slug" value="{{old('slug')}}">
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
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Country</label>
                                                <input type="text" class="form-control" name="country" value="{{old('country')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control" name="city" value="{{old('city')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address" value="{{old('address')}}">
                                            </div>
                                        </div>
                                        
                                        
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Facebook Link</label>
                                                <input type="text" class="form-control" name="facebook" value="{{old('facebook')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Instagram Link</label>
                                                <input type="text" class="form-control" name="instagram" value="{{old('instagram')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Linkedin Link</label>
                                                <input type="text" class="form-control" name="linkedin" value="{{old('linkedin')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Twitter Link</label>
                                                <input type="text" class="form-control" name="twitter" value="{{old('twitter')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Youtube Link</label>
                                                <input type="text" class="form-control" name="youtube" value="{{old('youtube')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Destination</label>
                                                <select name="destination_id" class="form-select">
                                                    @foreach ($destinations as $item)
                                                    <option value="{{$item->id}}">{{$item->name_en}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Rule</label>
                                                <select name="rule_id" id="rule-select" class="form-select">
                                                    <option value="">No Select</option>
                                                    @foreach ($rules as $item)
                                                    <option value="{{$item->id}}">{{$item->rule}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6" id="accommodation-div" >
                                            {{-- Accommodations ID --}}
                                            <div class="row">
                                                <div class="mb-3">
                                                    <label class="form-label">Accommodation</label>
                                                    <select name="accommodation_id" class="form-select">
                                                        <option value="">No Select</option>
                                                        @foreach ($accommodations as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div> 
                                            </div> 
                                            {{-- Drivers ID --}}
                                            <div class="row">
                                                <div class="mb-3">
                                                    <label class="form-label">Driver</label>
                                                    <select name="driver_id" class="form-select">
                                                        <option value="">No Select</option>
                                                        @foreach ($drivers as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div> 
                                            </div> 
                                             {{-- Tourguide ID --}}
                                            <div class="row">
                                                <div class="mb-3">
                                                    <label class="form-label">Tourguide</label>
                                                    <select name="tourguide_id" class="form-select">
                                                        <option value="">No Select</option>
                                                        @foreach ($tourguides as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div> 
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
