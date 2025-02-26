
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Day Tours of {{$destination->name}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_destination_day_tour_create',$destination->id)}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                                                <th>
                                                    Tout Title 
                                                </th>
                                                <th>
                                                    City
                                                </th>
                                                <th>
                                                    Gallery
                                                </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($destination_day_tours as $tour)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$tour->title_en}}</td>
                                                    <td>{{$tour->city->city_en}}</td>
                                                    <td>
                                                        <a href="{{ route('admin_destination_tour_photos', $tour->id) }}" class="btn btn-success btn-sm">Photo Gallery</a>

                                                       
                                                    </td>
                                                    
                                                    <td class="pt_10 pb_10">
                                                        <a href="{{route('admin_destination_day_tour_edit' ,$tour->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                        <a href="{{route('admin_destination_day_tour_delete' ,$tour->id)}}" class="btn btn-danger" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a>
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
