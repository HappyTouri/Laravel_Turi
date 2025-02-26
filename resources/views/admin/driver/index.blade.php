
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Drivers of {{$destination->name}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_driver_create',$destination->id)}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                                                <th> Photo</th>
                                                <th>Name</th>
                                                <th>Information</th>
                                                <th>Gallery</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($drivers as $driver)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>
                                                        
                                                        <div style="display: flex; align-items: center;">
                                                            <!-- Main image -->
                                                            <img src="{{asset('uploads/'.$driver->driverPhoto)}}" alt="" class="w_200">
                                                            @if ($driver->driverCarPhotos->count() > 0)
                                                                <div style="display: flex; flex-direction: column; margin-left: 10px;">
                                                                    <img src="{{asset('uploads/'.$driver->driverCarPhotos[0]->car_photo)}}" alt="" style="height: 100px; ">
                                                                    @if ($driver->driverCarPhotos->count() >= 2)
                                                                     <img src="{{asset('uploads/'.$driver->driverCarPhotos[1]->car_photo)}}" alt="" style="height: 100px;">
                                                                    @endif
                                                                    
                                                                </div>
                                                            @endif
                                                            
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{$driver->name}}
                                                    </td>
                                                    <td>
                                                       <b> Phone : </b>{{$driver->phone}}<br>
                                                       <b> Type : </b>{{$driver->transportationType->type}}<br>
                                                       <b> Car Model : </b>{{$driver->carModel}}<br>
                                                       <b> Price / day : </b>{{$driver->pricePerDay}}<br>
                                                       <b> Rate : </b>{{$driver->rate}} Star
                                                    </td>
                                                    
                                                    <td>
                                                        <div>
                                                            <a href="{{route('admin_car_photos',$driver->id)}}" class="btn btn-success btn-sm mb-2">Transportation Photos</a><br>
                                                      
                                                        </div>
                            
                                                    </td>
                                                    <td class="pt_10 pb_10">
                                                        <a href="{{route('admin_driver_edit' ,$driver->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                        <a href="{{route('admin_driver_delete' ,$driver->id)}}" class="btn btn-danger" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a>
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
