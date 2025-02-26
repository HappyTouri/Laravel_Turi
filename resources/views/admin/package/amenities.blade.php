
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Amenities of {{$package->packageTitle->title_en}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_package_index')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Back to Previous</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h3>Includes</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Amenity</th>
                                               
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($package_amenities_includes as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    {{$item->amenity->name}}
                                                </td>
                                               
                                                <td> <a href="{{route('admin_package_amenity_delete',$item->id)}}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?');">Delete</i></a></td>
                                             </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <h3>Excludes</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Amenity</th>
                                               
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($package_amenities_excludes as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    {{$item->amenity->name}}
                                                </td>
                                                
                                                <td> <a href="{{route('admin_package_amenity_delete',$item->id)}}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?');">Delete</i></a></td>
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
                                <form action="{{route('admin_package_amenity_submit',$package->id)}}" method="post" >
                                    @csrf

                                    <div class="mb-3"> 
                                        <label class="form-label">Amenity</label>
                                        <select name="amenity_id" class="form-select">
                                            @foreach ($amenities as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3"> 
                                        <label class="form-label">Type</label>
                                        <select name="type" class="form-select">
                                            <option value="Include">Include</option>
                                            <option value="Exclude">Exclude</option>
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
