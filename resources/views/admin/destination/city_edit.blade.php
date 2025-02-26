
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit City</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_destination_cities',$city->destination_id)}}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_destination_city_edit_submit', $city->id) }}" method="post" >                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">City_English</label>
                                                <input type="text" class="form-control" name="city_en" value="{{$city->city_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">City_Russian</label>
                                                <input type="text" class="form-control" name="city_ru" value="{{$city->city_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">City_Arabic</label>
                                                <input type="text" class="form-control" name="city_ar" value="{{$city->city_ar}}">
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
