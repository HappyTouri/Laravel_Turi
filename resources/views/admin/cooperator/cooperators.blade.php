
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Cooperators</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_cooperator_create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add cooperator</a>
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
                                                <th>Photo</th>
                                                <th>Logo</th>
                                                <th>Name</th>
                                                <th>Information</th>
                                                <th>Address Info</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cooperators as $item)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>
                                                        @if ($item->photo != '')
                                                            <img src="{{asset('uploads/'.$item->photo)}}" alt="" class="w_100"> 
                                                        @else
                                                            <img src="{{asset('uploads/default.png')}}" alt="" class="w_100">
                                                        @endif
                                                        
                                                    </td>
                                                    <td>
                                                        @if ($item->logo != '')
                                                            <img src="{{asset('uploads/'.$item->logo)}}" alt="" class="w_100"> 
                                                        @else
                                                            <img src="{{asset('uploads/default.png')}}" alt="" class="w_100">
                                                        @endif
                                                        
                                                    </td>
                                                    <td>
                                                        {{$item->name}}<br>
                                                        @if(!is_null($item->rule))
                                                            <span class="badge badge-primary">{{ $item->rule->rule }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        email : {{$item->email}} <br>
                                                        Phone : {{$item->phone}} <br>
                                                        
                                                    </td>
                                                    
                                                    <td>
                                                        Country : {{$item->country}} <br>
                                                        Address : {{$item->address}} <br>
                                                        City : {{$item->city}} <br>
                                                    </td>
                                                    <td>
                                                        @if ($item->destination_id != ''&& $item->destination_id != '0')
                                                            Destination : {{$item->destination?->name_en}} <br>
                                                        @endif
                                                        @if ($item->accommodation_id != '' && $item->accommodation_id != 0)
                                                            Accommodation : {{$item->accommodation?->name}} <br>
                                                        @endif
                                                        @if ($item->driver_id != ''&& $item->driver_id != 0)
                                                            Driver : {{$item->driver?->name}} <br>
                                                        @endif
                                                        @if ($item->tourguide_id != ''&& $item->tourguide_id != 0)
                                                            Tourguide : {{$item->tourguide?->name}} <br>
                                                        @endif
                                                        
                                                    </td>
                                                    <td class="pt_10 pb_10">
                                                        <a href="{{route('admin_cooperator_edit' ,$item->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                        <a href="{{route('admin_cooperator_delete' ,$item->id)}}" class="btn btn-danger" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a>
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
