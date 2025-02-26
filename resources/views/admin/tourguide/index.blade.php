
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Tourguides of {{$destination->name}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_tourguide_create',$destination->id)}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                                                <th>Note</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tourguides as $tourguide)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>
                                                        
                                                        <div style="display: flex; align-items: center;">
                                                            <!-- Main image -->
                                                            <img src="{{asset('uploads/'.$tourguide->photo)}}" alt="" class="w_200">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{$tourguide->name}}<br><br>
                                                        @if ($tourguide->status == "active")
                                                            <span class="badge badge-success">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                       <b> Phone : </b>{{$tourguide->mobile}}<br>
                                                       <b> Email : </b>{{$tourguide->email}}<br>
                                                       <b> Date of Birth : </b>{{$tourguide->date_of_birth}}<br>
                                                       <b> Price / day : </b>{{$tourguide->price_per_day}} $<br>
                                                       <b> City : </b>{{$tourguide->city->city_en}} 
                                                    </td>
                                                    
                                                    <td>
                                                        {!!$tourguide->note!!}
                                                    </td>
                                                    <td class="pt_10 pb_10">
                                                        <a href="{{route('admin_tourguide_edit' ,$tourguide->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                        <a href="{{route('admin_tourguide_delete' ,$tourguide->id)}}" class="btn btn-danger" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a>
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
