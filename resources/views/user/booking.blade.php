@extends('front.layout.master')

@section('main_content')

@php
    $setting=App\Models\Setting::where('id',1)->first();
@endphp
<div class="page-top" style="background-image: url({{asset('uploads/'.$setting->banner)}})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Bookings</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Bookings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content user-panel pt_70 pb_70">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <div class="card">
                    @include('user.sidebar')
                </div>
            </div>
            <div class="col-lg-9 col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>SL</th>
                                <th>Invoice No</th>
                                <th>Total Person</th>
                                <th>Paid Amount</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                                <th class="w-100">
                                    Action
                                </th>
                            </tr>
                            @foreach ($all_data as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->invoice_no}}</td>
                                <td>{{$item->total_person}}</td>
                                <td>$ {{$item->paid_amount}}</td>
                                <td>{{$item->payment_method}}</td>
                                <td>
                                    @if ($item->payment_status == 'Completed')
                                    <span class="badge bg-success">{{$item->payment_status}}</span>
                                    @else
                                    <span class="badge bg-danger">{{$item->payment_status}}</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Trigger for Modal -->
                                    <a href="" class="btn btn-secondary btn-sm mb-1 w-100-p" data-bs-toggle="modal" data-bs-target="#exampleModal{{$loop->iteration}}">Detail</a>
                                    <a href="{{route('user_invoice',$item->invoice_no)}}" class="btn btn-secondary btn-sm w-100-p">Invoice</a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$loop->iteration}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel{{$loop->iteration}}">Detail</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Modal Content -->
                                            <div class="mb-3 row modal-seperator">
                                                <div class="col-md-5">
                                                    <b>Invoice Number:</b>
                                                </div>
                                                <div class="col-md-7">
                                                    {{$item->invoice_no}}
                                                </div>
                                            </div>
                                            <div class="mb-3 row modal-seperator">
                                                <div class="col-md-5">
                                                    <b>Package Details:</b>
                                                </div>
                                                <div class="col-md-7">
                                                    {{$item->package->name}}<br>
                                                    <a href="{{route('package',$item->package->slug)}}" target="_blank">Show Details</a>
                                                </div>
                                            </div>
                                            <div class="mb-3 row modal-seperator">
                                                <div class="col-md-5">
                                                    <b>Tour Details:</b>
                                                </div>
                                                <div class="col-md-7">
                                                  <strong>name :</strong>  {{$item->tour->tour_name}}<br>
                                                  <strong>Start Date :</strong>  {{$item->tour->tour_start_date}}<br>
                                                  <strong>End Date :</strong>  {{$item->tour->tour_end_date}}<br>
                                                </div>
                                            </div>
                                            <!-- Repeat similar divs for package details, tour details, etc. -->
                                            <div class="mb-3 row modal-seperator">
                                                <div class="col-md-5">
                                                    <b>Total Persons:</b>
                                                </div>
                                                <div class="col-md-7">
                                                    {{$item->total_person}}
                                                </div>
                                            </div>
                                            <div class="mb-3 row modal-seperator">
                                                <div class="col-md-5">
                                                    <b>Paid Amount:</b>
                                                </div>
                                                <div class="col-md-7">
                                                    ${{$item->paid_amount}}
                                                </div>
                                            </div>
                                            <!-- Payment Method and Status -->
                                            <div class="mb-3 row modal-seperator">
                                                <div class="col-md-5">
                                                    <b>Payment Method:</b>
                                                </div>
                                                <div class="col-md-7">
                                                    {{$item->payment_method}}
                                                </div>
                                            </div>
                                            <div class="mb-3 row modal-seperator">
                                                <div class="col-md-5">
                                                    <b>Payment Status</b>
                                                </div>
                                                <div class="col-md-7">
                                                    @if ($item->payment_status == 'Completed')
                                                    <span class="badge bg-success">{{$item->payment_status}}</span>
                                                    @else
                                                    <span class="badge bg-danger">{{$item->payment_status}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Modal -->
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection