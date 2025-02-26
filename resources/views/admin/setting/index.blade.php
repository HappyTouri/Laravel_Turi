
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Settings</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_setting_update', $setting->id) }}" method="post"  enctype="multipart/form-data" > 
                                    @csrf
                                   <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3"> 
                                                <label class="form-label">Existing Logo</label>
                                                <div><img src="{{asset('uploads/'.$setting->logo)}}" alt="" class="w_200"></div>
                                            </div>
                                            <div class="mb-3"> 
                                                <label class="form-label">Change logo</label>
                                                <div><input type="file"  name="logo"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3"> 
                                                <label class="form-label">Existing Favicon</label>
                                                <div><img src="{{asset('uploads/'.$setting->favicon)}}" alt="" class="w_50"></div>
                                            </div>
                                            <div class="mb-3"> 
                                                <label class="form-label">Change favicon</label>
                                                <div><input type="file"  name="favicon"></div>
                                            </div>
                                        </div>
                                   </div>
                            
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address" value="{{$setting->address}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" name="email" value="{{$setting->email}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" name="phone" value="{{$setting->phone}}">
                                        </div>
                                    </div>
                               </div>

                               <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Facebook Link</label>
                                            <input type="text" class="form-control" name="facebook" value="{{$setting->facebook}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Instagram Link</label>
                                            <input type="text" class="form-control" name="instagram" value="{{$setting->instagram}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Linkedin Link</label>
                                            <input type="text" class="form-control" name="linkedin" value="{{$setting->linkedin}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Twitter Link</label>
                                            <input type="text" class="form-control" name="twitter" value="{{$setting->twitter}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Youtube Link</label>
                                            <input type="text" class="form-control" name="youtube" value="{{$setting->youtube}}">
                                        </div>
                                </div>
                            </div>

                           
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3"> 
                                    <label class="form-label">Destinations Banner</label>
                                    <div><img src="{{asset('uploads/'.$setting->destinations_banner)}}" alt="" class="w_200"></div>
                                </div>
                                <div class="mb-3"> 
                                    <label class="form-label">Change Banner</label>
                                    <div><input type="file"  name="destinations_banner"></div>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="mb-3"> 
                                    <label class="form-label">Packages Banner</label>
                                    <div><img src="{{asset('uploads/'.$setting->packages_banner)}}" alt="" class="w_200"></div>
                                </div>
                                <div class="mb-3"> 
                                    <label class="form-label">Change Banner</label>
                                    <div><input type="file"  name="packages_banner"></div>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="mb-3"> 
                                    <label class="form-label">About Banner</label>
                                    <div><img src="{{asset('uploads/'.$setting->about_banner)}}" alt="" class="w_200"></div>
                                </div>
                                <div class="mb-3"> 
                                    <label class="form-label">Change Banner</label>
                                    <div><input type="file"  name="about_banner"></div>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="mb-3"> 
                                    <label class="form-label">Blog Banner</label>
                                    <div><img src="{{asset('uploads/'.$setting->blog_banner)}}" alt="" class="w_200"></div>
                                </div>
                                <div class="mb-3"> 
                                    <label class="form-label">Change Banner</label>
                                    <div><input type="file"  name="blog_banner"></div>
                                </div>
                            </div> 
                        </div>           
                              

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label"> Copywright</label>
                                <input type="text" class="form-control" name="copyright" value="{{$setting->copyright}}">
                            </div>
                        </div>

                                   
                            <div class="mb-3">
                                <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
