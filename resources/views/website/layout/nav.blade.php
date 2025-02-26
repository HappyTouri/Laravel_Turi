<nav class="main-menu">
  
    <ul class="navigation clearfix">
        <li class="{{ (Route::is('home.lang') || Route::is('home')) ? 'current' : '' }}">
            <a href="{{ route('home.lang', ['lang' => request()->segment(1), 'cooperator' => $cooperator->slug]) }}">@lang('common.home')</a>
        </li>
        <li class="{{ (Route::is('destinations') || Route::is('destination')) ? 'current' : '' }}">
            <a href="{{ route('destinations', ['lang' => request()->segment(1), 'cooperator' => $cooperator->slug]) }}">@lang('common.destinations')</a>
        </li>
        <li class="{{ (Route::is('packages') || Route::is('package') || Route::is('tour')) ? 'current' : '' }}">
            <a href="{{ route('packages', ['lang' => request()->segment(1), 'cooperator' => $cooperator->slug]) }}">@lang('common.packages')</a>
        </li>
        <li class="{{ Route::is('about') ? 'current' : '' }}">
            <a href="{{ route('about', ['lang' => request()->segment(1), 'cooperator' => $cooperator->slug]) }}">@lang('common.about')</a>
        </li>
        <li class="{{ (Route::is('blog') || Route::is('post')) ? 'current' : '' }}">
            <a href="{{ route('blog', ['lang' => request()->segment(1), 'cooperator' => $cooperator->slug]) }}">@lang('common.blog')</a>
        </li>
        <li class="{{ Route::is('contact') ? 'current' : '' }}">
            <a href="{{ route('contact', ['lang' => request()->segment(1), 'cooperator' => $cooperator->slug]) }}">@lang('common.contact')</a>
        </li>
    </ul>
   
</nav>
