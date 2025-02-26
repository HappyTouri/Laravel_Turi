
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Package Titles</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('admin_package_title_create_submit')}}" method="post" >
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3"> 
                                                <label class="form-label">Number of Days</label>
                                                <input type="number" class="form-control"  name="no_days">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3"> 
                                                <label class="form-label">English Title</label>
                                                <input type="text" class="form-control"  name="title_en">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3"> 
                                                <label class="form-label">Russain Title</label>
                                                <input type="text" class="form-control"  name="title_ru">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3"> 
                                                <label class="form-label">Arabic Title</label>
                                                <input type="text" class="form-control"  name="title_ar">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="mb-3 text-end">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="example1" >
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Number of Days</th>
                                                <th>English Title</th>
                                                <th>Russian Title</th>
                                                <th>Arabic Title</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($package_titles as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    {{$item->no_days}}
                                                </td>
                                                <td>
                                                    {{$item->title_en}}
                                                </td>
                                                <td>
                                                    {{$item->title_ru}}
                                                </td>
                                                <td>
                                                    {{$item->title_ar}}
                                                </td>
                                                <td> 
                                                    <a href="{{route('admin_package_title_edit' ,$item->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    <a href="{{route('admin_package_title_delete' ,$item->id)}}" class="btn btn-danger" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a>
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
