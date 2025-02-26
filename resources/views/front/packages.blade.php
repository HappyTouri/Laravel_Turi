@extends('front.layout.master')

@section('main_content')

@php
    $setting=App\Models\Setting::where('id',1)->first();
@endphp
<div class="page-top" style="background-image: url({{asset('uploads/'.$setting->banner)}})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Packages</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Packages</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="package pt_70 pb_50">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="package-sidebar">
                    <form action="{{route('packages')}}" method="get">
                        
                        <div class="widget">
                            <h2>Search Package</h2>
                            <div class="box">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" name="name" class="form-control" placeholder="Package Name ..." value="{{$form_name}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget">
                            <h2>Filter by Price</h2>
                            <div class="box">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="min_price" class="form-control" placeholder="Min" value="{{$form_min_price}}">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="max_price" class="form-control" placeholder="Max" value="{{$form_max_price}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget">
                            <h2>Filter by Destination</h2>
                            <div class="box">
                                <select name="destination_id" class="form-select">
                                    <option value="">All</option>
                                    @foreach ($destinations as $item)
                                        <option value="{{$item->id}}" @if ($form_destination_id == $item->id)
                                            selected
                                        @endif>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            
                            </div>
                        </div>
                        <div class="widget">
                            <h2>Filter by Review</h2>
                            <div class="box">
                                <div class="form-check form-check-review form-check-review-1">
                                        <input name="review" class="form-check-input" type="radio" name="reviewRadios" id="reviewRadiosAll" value="" @if ($form_review == '')
                                        checked
                                        @endif>
                                    <label class="form-check-label" for="reviewRadiosAll">
                                        All
                                    </label>
                                </div>
                                <div class="form-check form-check-review">
                                    <input name="review" class="form-check-input" type="radio" name="reviewRadios" id="reviewRadios1" value="5" @if ($form_review == 5)
                                    checked
                                  @endif>
                                    <label class="form-check-label" for="reviewRadios1">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </label>
                                </div>
                                <div class="form-check form-check-review">
                                    <input name="review" class="form-check-input" type="radio" name="reviewRadios" id="reviewRadios2" value="4" @if ($form_review == 4)
                                    checked
                                    @endif>
                                    <label class="form-check-label" for="reviewRadios2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </label>
                                </div>
                                <div class="form-check form-check-review">
                                    <input name="review" class="form-check-input" type="radio" name="reviewRadios" id="reviewRadios3" value="3" @if ($form_review == 3)
                                    checked
                                     @endif>
                                    <label class="form-check-label" for="reviewRadios3">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </label>
                                </div>
                                <div class="form-check form-check-review">
                                    <input name="review" class="form-check-input" type="radio" name="reviewRadios" id="reviewRadios4" value="2" @if ($form_review == 2)
                                    checked
                                     @endif>
                                    <label class="form-check-label" for="reviewRadios4">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </label>
                                </div>
                                <div class="form-check form-check-review">
                                    <input name="review" class="form-check-input" type="radio" name="reviewRadios" id="reviewRadios5" value="1" @if ($form_review == 1)
                                    checked
                                   @endif>
                                    <label class="form-check-label" for="reviewRadios5">
                                        <i class="fas fa-star"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="filter-button">
                            <button class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8 col-md-6">
                <div class="row">
                    @foreach ($packages as $item)
                    <div class="col-lg-6 col-md-6">
                        <div class="item pb_25">
                            <div class="photo">
                                <a href="{{route('package',$item->slug)}}"><img src="{{asset('uploads/'.$item->featured_photo)}}" alt=""></a>
                                <div class="wishlist">
                                    <a href="{{route('wishlist',$item->id)}}"><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="text">
                                <div class="price">
                                    ${{$item->price}} 
                                    @if ($item->old_price != '')
                                    <del>${{$item->old_price}}</del>   
                                    @endif
                                    
                                </div>
                                <h2>
                                    @if(app()->getLocale() === 'ar')
                                        {{$item->packageTitle?->title_ar}}
                                    @elseif(app()->getLocale() === 'ru')
                                        {{$item->packageTitle?->title_ru}}
                                    @else
                                        {{$item->packageTitle?->title_en}}
                                    @endif
                                </h2>
                                <div class="review">
                                    @if ($item->total_score !=0 ||$item->total_rating !=0 )
                                        @php
                                        $package_rating =ceil($item->total_score /$item->total_rating)  ;
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i<= $package_rating)
                                            <i class="fas fa-star"></i>
                                            @else    
                                            <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                        ({{$item->reviews->count()}} Reviews)
                                    @else
                                        
                                            <div class="set">
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            
                                                ({{$item->reviews->count()}} Reviews)
                                        </div>
                                       
                                    @endif
                                </div>
                                <div class="element">
                                    <div class="element-left">
                                        <i class="fas fa-plane-departure"></i> {{$item->destination->name}}
                                    </div>
                                    <div class="element-right">
                                        <i class="fas fa-th-large"></i> {{$item->package_amenities->count()}} Amenities
                                    </div>
                                </div>
                                <div class="element">
                                    <div class="element-left">
                                        <i class="fas fa-users"></i> {{$item->tours->count()}} Tours
                                    </div>
                                    <div class="element-right">
                                        <i class="fas fa-clock"></i> {{$item->package_itirenaries->count()}} Days
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    
                </div>
                <div class="row">
                    <div class="col-md-12 ">
                        {{$packages->appends($_GET)->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection



