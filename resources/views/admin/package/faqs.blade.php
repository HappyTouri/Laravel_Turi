
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Faqs of {{$package->packageTitle->title_en}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_package_index')}}" class="btn btn-primary"> Back to Previous</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Question English</th>
                                                <th>Question Russian</th>
                                                <th>Question Arabic</th>
                                            
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($package_faqs as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->question_en}} </td>
                                                <td>{{$item->question_ru}} </td>
                                                <td>{{$item->question_ar}} </td>
                                                
                                                <td> 
                                                    <a href="{{route('admin_package_faqs_edit' ,$item->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    <a href="{{route('admin_package_faq_delete' ,$item->id)}}" class="btn btn-danger" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a>
                                                </td>
                                             </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                    <div class="mb-3">
                                        <a href="{{ route('admin_package_faqs_create', $package->id ) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
