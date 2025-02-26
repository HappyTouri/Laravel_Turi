
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Cities of {{$destination->name}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_destination_index')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Back to Previous</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>City_EN</th>
                                                <th>City_RU</th>
                                                <th>City_AR</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($destination_cities as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->city_en}}</td>
                                                <td>{{$item->city_ru}}</td>
                                                <td>{{$item->city_ar}}</td>
                                                <td>
                                                    <a href="{{route('admin_destination_city_edit' ,$item->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    <a href="{{route('admin_destination_city_delete',$item->id)}}" class="btn btn-danger" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a>
                                                </td>
                                             </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('admin_destination_city_submit',$destination->id)}}" method="post">
                                    @csrf

                                    <div class="mb-3"> 
                                        <label class="form-label">City_English</label>
                                        <input type="text" class="form-control"  name="city_en">
                                    </div>

                                    <div class="mb-3"> 
                                        <label class="form-label">City_Russian</label>
                                        <input type="text" class="form-control"  name="city_ru">
                                    </div>

                                    <div class="mb-3"> 
                                        <label class="form-label">City_Arabic</label>
                                        <input type="text" class="form-control"  name="city_ar">
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
