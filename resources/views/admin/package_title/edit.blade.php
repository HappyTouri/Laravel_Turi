
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
                                <form action="{{ route('admin_package_title_edit_submit', $package_title->id) }}" method="post" >                                    @csrf
                                    

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3"> 
                                                <label class="form-label">Number of Days</label>
                                                <input type="text" class="form-control"  name="no_days" value="{{$package_title->no_days}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3"> 
                                                <label class="form-label">English Title</label>
                                                <input type="text" class="form-control"  name="title_en" value="{{$package_title->title_en}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3"> 
                                                <label class="form-label">Russain Title</label>
                                                <input type="text" class="form-control"  name="title_ru" value="{{$package_title->title_ru}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3"> 
                                                <label class="form-label">Arabic Title</label>
                                                <input type="text" class="form-control"  name="title_ar" value="{{$package_title->title_ar}}">
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
