
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Rooms Category of {{$accommodation->name}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_accommodation_index',$accommodation->destination->id)}}" class="btn btn-primary"><i class="fas fa-plus"></i> Back to Previous</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h3>Rooms Categories</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Room Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($accommodation_rooms_categories as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    {{$item->room_category->category}}
                                                </td>
                                               
                                                <td> <a href="{{route('admin_accommodation_room_category_delete',$item->id)}}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?');">Delete</i></a></td>
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
                                <form action="{{route('admin_accommodation_room_category_submit',$accommodation->id)}}" method="post" >
                                    @csrf

                                    <div class="mb-3"> 
                                        <label class="form-label">Amenity</label>
                                        <select name="room_category_id" class="form-select">
                                            @foreach ($rooms_categories as $item)
                                            <option value="{{$item->id}}">{{$item->category}}</option>
                                            @endforeach
                                        </select>
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
