
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Cooperator</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_cooperators')}}" class="btn btn-primary"><i class="fas fa-plus"></i> All Cooperators</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('admin_cooperator_edit_submit',$cooperator->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3"> 
                                                <label class="form-label">Existing Photo</label>
                                                <div>
                                                    @if ($cooperator->photo != '')
                                                       <img src="{{asset('uploads/'.$cooperator->photo)}}" alt="" class="w_200">
                                                    @else
                                                    <img src="{{asset('uploads/default.png')}}" alt="" class="w_200">  
                                                    @endif
                                                    
                                                </div>
                                            </div>
        
                                            <div class="mb-3"> 
                                                <label class="form-label">Photo</label>
                                                <div><input type="file"  name="photo"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3"> 
                                                <label class="form-label">Existing logo</label>
                                                <div>
                                                    @if ($cooperator->logo != '')
                                                       <img src="{{asset('uploads/'.$cooperator->logo)}}" alt="" class="w_200">
                                                    @else
                                                    <img src="{{asset('uploads/default.png')}}" alt="" class="w_200">  
                                                    @endif
                                                    
                                                </div>
                                            </div>
        
                                            <div class="mb-3"> 
                                                <label class="form-label">Logo</label>
                                                <div><input type="file"  name="logo"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3">
                                            <label class="form-label">slug</label>
                                            <input type="text" class="form-control" name="slug" value="{{$cooperator->slug}}">
                                        </div>
                                    </div>
                                   

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" name="name" value="{{$cooperator->name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" name="email" value="{{$cooperator->email}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Phone</label>
                                                <input type="text" class="form-control" name="phone" value="{{$cooperator->phone}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Country</label>
                                                <input type="text" class="form-control" name="country" value="{{$cooperator->country}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control" name="city" value="{{$cooperator->city}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address" value="{{$cooperator->address}}">
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Facebook Link</label>
                                                <input type="text" class="form-control" name="facebook" value="{{$cooperator->facebook}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Instagram Link</label>
                                                <input type="text" class="form-control" name="instagram" value="{{$cooperator->instagram}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Linkedin Link</label>
                                                <input type="text" class="form-control" name="linkedin" value="{{$cooperator->linkedin}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Twitter Link</label>
                                                <input type="text" class="form-control" name="twitter" value="{{$cooperator->twitter}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Youtube Link</label>
                                                <input type="text" class="form-control" name="youtube" value="{{$cooperator->youtube}}">
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
                                                    <option value="{{$item->id}}" @if($cooperator->destination_id == $item->id) selected @endif>
                                                        {{$item->name_en}}
                                                    </option>
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
                                                
                                                    @foreach ($rules as $item)
                                                    <option value="{{$item->id}}" @if($cooperator->rule_id == $item->id) selected @endif>
                                                        {{$item->rule}}
                                                    </option>
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
                                                        <option value="{{$item->id}}" @if($cooperator->accommodation_id == $item->id) selected @endif>
                                                            {{$item->name}}
                                                        </option>
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
                                                        <option value="{{$item->id}}" @if($cooperator->driver_id == $item->id) selected @endif>
                                                            {{$item->name}}
                                                        </option>
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
                                                        <option value="{{$item->id}}" @if($cooperator->tourguide_id == $item->id) selected @endif>
                                                            {{$item->name}}
                                                        </option>
                                                        @endforeach
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
