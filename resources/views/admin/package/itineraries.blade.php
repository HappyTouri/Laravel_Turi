
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Itirenaries of {{$package->name}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_package_index')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Back to Previous</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>Excisting Itirenaries</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($package_itirenaries as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    {{$item->name}}
                                                </td>
                                                <td>
                                                    {!!$item->description!!}
                                                </td>
                                                
                                                <td> <a href="{{route('admin_package_itinerary_delete',$item->id)}}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?');">Delete</i></a></td>
                                             </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>Add Itirenary</h4>
                                <form action="{{route('admin_package_itinerary_submit',$package->id)}}" method="post" >
                                    @csrf

                                    
                                       
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control editor" id="" cols="30" rows="10">{{old('description')}}</textarea>
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
