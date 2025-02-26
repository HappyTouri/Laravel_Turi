<div class="navbar-area" id="stickymenu">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="index.html" class="logo">
            <img src="{{asset('uploads/'.$setting->logo)}}" alt="">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{route('home')}}">
                    <img src="{{asset('uploads/'.$setting->logo)}}" alt="">
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item {{Route::is('home') ? 'active' : '' }}">
                            <a href="{{route('home')}}" class="nav-link">@lang('common.home')</a>
                        </li>
                        <li class="nav-item {{Route::is('about') ? 'active' : '' }}">
                            <a href="{{route('about')}}" class="nav-link">@lang('common.about')</a>
                        </li>
                        <li class="nav-item {{Route::is('destinations') ? 'active' : '' }} ">
                            <a href="{{route('destinations')}}" class="nav-link">@lang('common.destinations')</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('packages')}}" class="nav-link">@lang('common.packages')</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('team_members')}}" class="nav-link">@lang('common.team')</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('faq')}}" class="nav-link">@lang('common.faq')</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('blog')}}" class="nav-link">@lang('common.blog')</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('contact')}}" class="nav-link" {{Route::is('contact') ? 'active' : '' }}>@lang('common.contact')</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>