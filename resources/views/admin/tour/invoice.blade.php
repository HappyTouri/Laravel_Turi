
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            {{-- <div class="section-header justify-content-between">
                <h1>Invoice No: {{$booking->invoice_no}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_tour_create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
                </div>
            </div> --}}
            <div class="section-body">
                <div class="invoice">
                    <h3>&nbsp;Invoice No: {{$booking->invoice_no}}</h3>
                    <div class="invoice-print">
                        <table class="responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Invoice Number :</td>
                                        <td>{{$booking->invoice_no}}</td>
                                    </tr>
                                    <tr>
                                        <td>Invoice To :</td>
                                        <td>
                                           name: {{$booking->user->name}}<br>
                                           email: {{$booking->user->email}}<br>
                                           phone: {{$booking->user->phone}}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Invoice By :</td>
                                        <td>
                                            name: {{Auth::guard('admin')->user()->name}}<br>
                                            email: {{Auth::guard('admin')->user()->email}}<br>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tour Information :</td>
                                        <td> 
                                            <strong>name :</strong>{{$booking->tour->tour_name}}<br>
                                            <strong>Start Date :</strong>{{$booking->tour->tour_start_date}}<br>
                                            <strong>End Date :</strong>{{$booking->tour->tour_end_date}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Package Name :</td>
                                        <td> 
                                            {{$booking->package->name}}
                                           
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Booking Date :</td>
                                        <td>{{$booking->created_at->format('d M Y')}} </td>
                                    </tr>
                                    <tr>
                                        <td>Payment Method :</td>
                                        <td>{{$booking->payment_method}} </td>
                                    </tr>
                                    <tr>
                                        <td>Payment Statud :</td>
                                        <td>
                                            @if ($booking->payment_status == 'Confirmed')
                                                Compleated
                                            @else
                                                Pending
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Person :</td>
                                        <td>{{$booking->total_person}} </td>
                                    </tr>
                                    <tr>
                                        <td>Total Amount :</td>
                                        <td>${{$booking->paid_amount}} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </table>
                        

                        
                    </div>
                    
                    <div class="text-md-right">
                        <a href="javascript:window.print();" class="btn btn-warning btn-icon icon-left text-white print-invoice-button"><i class="fas fa-print"></i> Print</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
