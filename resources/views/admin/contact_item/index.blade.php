
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Contact Item</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_contact_item_update', $contact_item->id) }}" method="post" enctype="multipart/form-data" > 
                                    @csrf

                                    
                                    <div class="mb-3">
                                        <label class="form-label">Existing Banner</label>
                                        <div>
                                            <img src="{{asset('uploads/'.$contact_item->banner)}}" alt="" class="w_200">
                                        </div>
                                    </div>
    
                                    <div class="mb-3"> 
                                        <label class="form-label">Banner</label>
                                        <div><input type="file"  name="banner"></div>
                                    </div>
                                   
                                    
                                   
                                    <div class="mb-3">
                                        <label class="form-label">Map Code</label>
                                        <textarea name="map" class="form-control h_100" id="" cols="30" rows="10">{{$contact_item->map}}</textarea>
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
