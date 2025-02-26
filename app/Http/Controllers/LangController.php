<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;

use Illuminate\Http\Request;

class LangController extends Controller
{
    public function change(Request $request)
    {
        // Get the language from the request
        $lang = $request->get('lang');

        // Check if the language is valid (you can add more validations as necessary)
        if (in_array($lang, ['en', 'ru', 'ar'])) {
            // Store the language in the session
            session()->put('locale', $lang);

            // Set the application's locale
            app()->setLocale($lang);
        }

        // Redirect back to the previous page
        return redirect()->back();
    }
}
