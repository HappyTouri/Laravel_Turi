
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Photos of {{$accommodation->name}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_accommodation_index',$accommodation->destination->id)}}" class="btn btn-primary"><i class="fas fa-plus"></i> Back to Previous</a>
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
                                                <th>Photo</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($accommodation_photos as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td><img src="{{asset('uploads/'.$item->photo)}}" alt="" class="w_100"></td>
                                                <td> <a href="{{route('admin_accommodation_photo_delete',$item->id)}}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?');">Delete</i></a></td>
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
                                <form action="{{route('admin_accommodation_photo_submit',$accommodation->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3"> 
                                        <label class="form-label">Photo</label>
                                        <div><input type="file"  name="photo"></div>
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
