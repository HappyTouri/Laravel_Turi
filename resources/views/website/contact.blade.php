@extends('website.layout.master')

@section('main_content')
@php
    $setting=App\Models\Setting::where('id',1)->first();
@endphp

<!-- Banner Section -->
<section class="inner-banner">
    <div class="image-layer" style="background-image: url({{asset('uploads/'.$contact_item->banner)}});">
    </div>
    <div class="auto-container">
        <div class="content-box">
            <h1>@lang('common.contact')</h1>
            <div class="bread-crumb">
                <ul class="clearfix">
                    <li><a href="{{ route('home.lang', ['lang' => request()->segment(1), 'cooperator' => $cooperator->slug]) }}">@lang('common.home')</a></li>
                    <li class="current">@lang('common.contact')</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--End Banner Section -->

<!--Contact Section-->
<section class="contact-section">
    <div class="auto-container">
        <div class="row clearfix">
            <!--Info Col-->
            <div class="info-col col-lg-4 col-md-12 col-sm-12">
                <div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="info">
                        <ul>
                            <li class="location">
                                <i class="icon fa fa-map-marker-alt"></i>
                                <h5>@lang('common.Location')</h5>
                                <div class="travilo-text">{{$cooperator->address}}</div>
                            </li>
                            <li class="phone">
                                <i class="icon fa-solid fa-phone"></i>
                                <h5>@lang('common.Phone')</h5>
                                <div class="travilo-text">{{$cooperator->phone}}</div>
                            </li>
                            <li class="email">
                                <i class="icon fa fa-envelope"></i>
                                <h5>@lang('common.Email')</h5>
                                <div class="travilo-text"><a href="mailto:hello@travilo.com">{{$cooperator->email}}</a></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Form Col-->
            <div class="form-col col-lg-8 col-md-12 col-sm-12" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                <div class="inner wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <h3>@lang('common.Send Us A Message')</h3>
                    <div class="form-box site-form">
                        <form action="{{ route('contact_submit') }}" method="post">
                            @csrf
                            <div class="row clearfix">
                                <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <div class="field-inner">
                                        <input type="text" name="name" value="" placeholder="@lang('common.Your name')" required class="custom-input">
                                    </div>
                                </div>
                                <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <div class="field-inner">
                                        <input type="email" name="email" value="" placeholder="@lang('common.Your email')" required class="custom-input">
                                    </div>
                                </div>
                                <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <div class="field-inner">
                                        <input type="text" name="phone" value="" placeholder="@lang('common.Your Phone')" required class="custom-input">
                                    </div>
                                </div>
                                <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <div class="field-inner">
                                        <input type="text" name="subject" value="" placeholder="@lang('common.Subject')" required class="custom-input">
                                    </div>
                                </div>
                                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="field-inner">
                                        <textarea name="message" placeholder="@lang('common.Start writing your message here')" required class="custom-textarea"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <button type="submit" class="theme-btn btn-style-one"><span>
                                        @lang('common.Submit Query')</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            
        </div>

        <div class="map-box">
            <iframe
                src="{{$contact_item->map}}"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            <div class="map-icon"><img src="assets/images/icons/map-marker.png" alt=""></div>
        </div>

    </div>
</section>

@endsection