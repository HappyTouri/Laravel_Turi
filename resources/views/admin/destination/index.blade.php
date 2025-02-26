
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Destinations</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_destination_create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="example1">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Featured Photo</th>
                                                <th>Name</th>
                                                <th>Cities</th>
                                                <th>Gallery</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($destinations as $destination)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td><img src="{{asset('uploads/'.$destination->featured_photo)}}" alt="" class="w_200"></td>
                                                    <td>{{$destination->name_en}}</td>
                                                    <td>
                                                        <a href="{{route('admin_destination_cities',$destination->id)}}" class="btn btn-primary btn-sm mb-2"> Cities</a>
                                                        <a href="{{route('admin_destination_day_tours',$destination->id)}}" class="btn btn-primary btn-sm mb-2"> Day Tours</a>
                                                        <a href="{{route('admin_accommodation_index',$destination->id)}}" class="btn btn-primary btn-sm mb-2"> Hotels</a><br>
                                                        <a href="{{route('admin_transportation_prices_index',$destination->id)}}" class="btn btn-primary btn-sm mb-2"> Transportation Prices</a>
                                                        <a href="{{route('admin_driver_index',$destination->id)}}" class="btn btn-primary btn-sm mb-2"> Drivers</a><br>
                                                        <a href="{{route('admin_tourguide_index',$destination->id)}}" class="btn btn-primary btn-sm mb-2"> Tourguides</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('admin_destination_photos',$destination->id)}}" class="btn btn-success btn-sm mb-2">Photo Gallery</a>
                                                        <a href="{{route('admin_destination_videos',$destination->id)}}" class="btn btn-success btn-sm mb-2" >Video Gallery</a>
                                                    </td>
                                                    <td class="pt_10 pb_10">
                                                        <a href="{{route('admin_destination_edit' ,$destination->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                        <a href="{{route('admin_destination_delete' ,$destination->id)}}" class="btn btn-danger" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
