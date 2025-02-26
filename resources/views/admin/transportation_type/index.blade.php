
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Transportation Types</h1>
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
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transportation_types as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    {{$item->type}}
                                                </td>
                                                <td> 
                                                    <a href="{{route('admin_transportation_type_edit' ,$item->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    <a href="{{route('admin_transportation_type_delete' ,$item->id)}}" class="btn btn-danger" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a>
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
                                <form action="{{route('admin_transportation_type_create_submit')}}" method="post" >
                                    @csrf

                                    <div class="mb-3"> 
                                        <label class="form-label">Transportation Type</label>
                                        <input type="text" class="form-control"  name="type">
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
