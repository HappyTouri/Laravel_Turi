
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Transportation Price of {{$transportation_price->destination->name}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_transportation_prices_index',$transportation_price->destination->id)}}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_transportation_price_edit_submit', $transportation_price->id) }}" method="post" >                                    @csrf
                                    
                                    
                                    <div class="mb-3">
                                        <label class="form-label">{{$transportation_price->transportationType->type}} Price :</label>
                                        <input type="text" class="form-control" name="price" value="{{$transportation_price->price}}">
                                    </div>
                            
                                    
                                    <div class="mb-3">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-primary">Update</button>
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
