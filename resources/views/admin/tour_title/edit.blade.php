
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Tour Title</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_room_categories_index')}}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_tour_title_edit_submit', $tour_title->id) }}" method="post" enctype="multipart/form-data" >                                    @csrf
                                    <div class="mb-3"> 
                                        <label class="form-label">Existing Photo</label>
                                        <div><img src="{{asset('uploads/'.$tour_title->photo)}}" alt="" class="w_200"></div>
                                    </div>
                                    <div class="mb-3"> 
                                        <label class="form-label">Change Photo</label>
                                        <div><input type="file"  name="photo"></div>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="mb-3"> 
                                                <label class="form-label">English Title</label>
                                                <input type="text" class="form-control"  name="title_en" value="{{$tour_title->title_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3"> 
                                                <label class="form-label">Russain Title</label>
                                                <input type="text" class="form-control"  name="title_ru" value="{{$tour_title->title_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3"> 
                                                <label class="form-label">Arabic Title</label>
                                                <input type="text" class="form-control"  name="title_ar" value="{{$tour_title->title_ar}}">
                                            </div>
                                        </div>
                                    </div>
                                   
                            
                                    
                                    <div class="mb-3 text-end">
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
