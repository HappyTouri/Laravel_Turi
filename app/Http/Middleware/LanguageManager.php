<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class LanguageManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next)
    {
        // Supported languages
        $supportedLocales = ['en', 'ar', 'ru'];

        // Check if the language is provided in the URL
        $locale = $request->route('lang'); // 'lang' is the route parameter name

        if ($locale && in_array($locale, $supportedLocales)) {
            // Set the app locale if valid
            App::setLocale($locale);
            session()->put('locale', $locale); // Store it in the session
        } elseif (!$locale) {
            // If no language is provided, use the session or fallback to the default locale
            $locale = session()->get('locale', config('app.locale'));

            // Redirect to the homepage with the default language
            $defaultLangRoute = '/' . $locale . $request->getPathInfo();
            return redirect($defaultLangRoute);
        } else {
            // If the provided language is invalid, fallback to the default locale
            $locale = config('app.locale');
            App::setLocale($locale);
        }

        return $next($request);
    }
}
