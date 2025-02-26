
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Transportation Peices of {{$destination->name}}</h1>
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
                                                <th>Transportation Type</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transportation_Prices as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    {{$item->transportationType->type}}
                                                </td>
                                                <td>
                                                    {{$item->price}}
                                                </td>
                                               
                                                <td>
                                                    <a href="{{route('admin_transportation_price_edit' ,$item->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    <a href="{{route('admin_transportation_price_delete' ,$item->id)}}" class="btn btn-danger" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a>
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
                                <form action="{{route('admin_transportation_price_create_submit',$destination->id)}}" method="post" >
                                    @csrf

                                    <div class="mb-3"> 
                                        <label class="form-label">Transportation Type</label>
                                        <select name="type_id" class="form-select">
                                            @foreach ($transportation_types as $item)
                                            <option value="{{$item->id}}">{{$item->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3"> 
                                        <label class="form-label">Price</label>
                                        <input type="number" class="form-control" name="price" value="{{old('price')}}" min="0" required>
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
