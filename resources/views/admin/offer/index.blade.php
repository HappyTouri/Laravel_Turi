
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Offers</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_offer_create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="example1">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Featured Photo</th>
                                                <th>Name</th>
                                                <th>Gallery</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($offers as $offer)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td><img src="{{asset('uploads/'.$offer->featured_photo)}}" alt="" class="w_200"></td>
                                                    <td>{{$offer->name}}</td>
                                                    <td>
                                                        <div>
                                                            <a href="{{ route('admin_offer_amenities', $offer->id ) }}" class="btn btn-success btn-sm mb-2">Amenities</a>
                                                            <a href="{{ route('admin_offer_itineraries', $offer->id ) }}" class="btn btn-success btn-sm mb-2">Itinerary</a>
                                                            <a href="{{ route('admin_offer_faqs', $offer->id ) }}" class="btn btn-success btn-sm mb-2">FAQs</a>
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('admin_offer_photos', $offer->id ) }}" class="btn btn-success btn-sm mb-2">Photo Gallery</a>
                                                            <a href="{{ route('admin_offer_videos', $offer->id ) }}" class="btn btn-success btn-sm mb-2">Video Gallery</a>
                                                        </div>
                                                        
                                                        
                                                        
                                                       
                                                    </td>
                                                    <td class="pt_10 pb_10">
                                                        <a href="{{route('admin_offer_edit' ,$offer->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                        <a href="{{route('admin_offer_delete' ,$offer->id)}}" class="btn btn-danger" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a>
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
