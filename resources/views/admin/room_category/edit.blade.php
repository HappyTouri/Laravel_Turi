
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Room Category</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_room_categories_index')}}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_room_category_edit_submit', $room_category->id) }}" method="post" >                                    @csrf
                                    
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Room Category</label>
                                        <input type="text" class="form-control" name="category" value="{{$room_category->category}}">
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
