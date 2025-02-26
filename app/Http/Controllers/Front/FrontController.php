<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AboutItem;
use App\Models\Booking;
use App\Models\ContactItem;
use App\Models\Cooperator;
use App\Models\DestinationVideo;
use App\Models\Admin;
use App\Models\HomeItem;
use App\Models\Faq;
use App\Models\PackageFaq;
use App\Models\PackagePhoto;
use App\Models\PackageTitle;
use App\Models\PackageTour;
use App\Models\PackageVideo;
use App\Models\PrivateTour;
use App\Models\PrivateTourDetail;
use App\Models\Review;
use App\Models\Setting;
use App\Models\Subscriber;
use App\Models\TermPrivacyItem;
use App\Models\WelcomeItem;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use App\Models\Slider;
use App\Models\Feature;
use App\Models\TeamMember;
use App\Models\BlogCategory;
use App\Models\Post;
use App\Models\Destination;
use App\Models\DestinationPhoto;
use App\Models\Package;
use App\Models\PackageAmenity;


use App\Mail\Websitemail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class FrontController extends Controller
{
    public function home(Request $request)
    {
        $cooperatorSlug = $request->route('cooperator');
        $cooperator = Cooperator::where('slug', $cooperatorSlug)->first();
        $home_items = HomeItem::where('id', 1)->first();
        $sliders = Slider::get();
        $destinations = Destination::with('cities', 'accommodations', 'packages')
            ->orderBy('id', 'asc')
            ->get();
        $partners = Cooperator::where('rule_id', 5)->get();
        $posts = Post::with('blog_category')->orderBy('id', 'desc')->take(3)->get();

        $total_destinations = Destination::count();
        $total_Packages = Package::count();
        $total_reviews = Review::count();
        $total_users = User::count();

        $reviews = Review::with('package.packageTitle', 'user')->orderBy('id', 'desc')->take(9)->get();


        $query = Package::with(
            'packageTitle',
            'destination',
            'privateTours.privateTourDetails',
            'privateTours.tourTitle'
        )
            ->whereHas('privateTours', function ($query) use ($cooperator) {
                $query->where('website', true)->where('cooperator_id', $cooperator->id);
            })
            ->orderBy(
                PackageTitle::select('no_days')
                    ->whereColumn('package_titles.id', 'packages.package_title_id') // Ensure the column names match your schema
                    ->orderBy('no_days', 'asc')
                    ->limit(1),
                'asc'
            );

        $packages = $query->orderBy('id', 'desc')->get();


        return view('website.index', compact(
            'sliders',
            'home_items',
            'posts',
            'destinations',
            'packages',
            'cooperator',
            'partners',
            'posts',
            'total_destinations',
            'total_Packages',
            'total_reviews',
            'total_users',
            'reviews'
        ));
    }

    public function destinations(Request $request)
    {
        $destinations = Destination::with('cities', 'accommodations', 'packages')->orderBy('id', 'asc')->paginate(8);
        $cooperatorSlug = $request->route('cooperator');
        $cooperator = Cooperator::where('slug', $cooperatorSlug)->first();

        $setting = Setting::where('id', 1)->first();
        $destinations_banner = $setting->destinations_banner;

        return view('website.destinations', compact(
            'destinations',
            'cooperator',
            'destinations_banner'
        ));
    }

    public function destination(Request $request, $lang, $cooperator, $slug)
    {
        $destination = Destination::where('slug', $slug)->first();
        $destination->view_count = ($destination->view_count ?? 0) + 1;
        $destination->update();

        $cooperatorSlug = $request->route('cooperator');
        $cooperator = Cooperator::where('slug', $cooperatorSlug)->first();
        $destination_photos = DestinationPhoto::where('destination_id', $destination->id)->get();
        $destination_videos = DestinationVideo::where('destination_id', $destination->id)->get();

        $query = Package::with(
            'packageTitle',
            'destination',
            'privateTours.privateTourDetails',
            'privateTours.tourTitle'
        )
            ->whereHas('privateTours', function ($query) use ($cooperator) {
                $query->where('website', true)->where('cooperator_id', $cooperator->id);
            });
        $packages = $query->where('destination_id', $destination->id)->orderBy('id', 'desc')->get();

        return view('website.destination', compact(
            'destination',
            'destination_photos',
            'destination_videos',
            'packages',
            'cooperator'
        ));
    }

    public function packages(Request $request)
    {
        // dd($request->all());
        // Getting form inputs
        $cooperatorSlug = $request->route('cooperator');
        $cooperator = Cooperator::where('slug', $cooperatorSlug)->first();
        $form_name = $request->name;
        $form_min_price = $request->min_price;
        $form_max_price = $request->max_price;
        $form_destination_id = $request->destination_id;
        $form_review = $request->review;

        $setting = Setting::where('id', 1)->first();
        $packages_banner = $setting->packages_banner;

        // Retrieve all destinations ordered by name
        $destinations = Destination::orderBy('name_en', 'asc')->get();

        // Initialize the packages query with relationships and ordering
        $query = Package::with(
            'packageTitle',
            'destination',
            'privateTours.privateTourDetails',
            'privateTours.tourTitle'
        )
            ->whereHas('privateTours', function ($query) use ($cooperator) {
                $query->where('website', true)->where('cooperator_id', $cooperator->id);
            })
            ->orderBy(
                PackageTitle::select('no_days')
                    ->whereColumn('package_titles.id', 'packages.package_title_id') // Ensure the column names match your schema
                    ->orderBy('no_days', 'asc')
                    ->limit(1),
                'asc'
            );


        $days = $query->get();


        // Filter by destination if provided
        if ($request->destination) {
            $query->where('destination_id', $request->destination);
        }

        // Filter by number of days if provided
        if ($request->no_of_days) {
            $query->whereHas('packageTitle', function ($query) use ($request) {
                $query->where('no_days', $request->no_of_days);
            });
        }

        // Filter by review rating if provided
        if ($request->review) {
            $query->whereRaw('CEIL(total_score / total_rating) = ?', [$request->review]);
        }

        // Pagination for the packages
        $packages = $query->orderBy('id', 'desc')->paginate(6);



        // Return the view with compacted data
        return view('website.packages', compact(
            'destinations',
            'packages',
            'form_name',
            'form_min_price',
            'form_max_price',
            'form_destination_id',
            'form_review',
            'cooperator',
            'packages_banner',
            'days'
        ));
    }

    public function package(Request $request, $lang, $cooperator, $id)
    {
        $package = Package::with(
            'destination',
            'package_photos',
            'packageTitle'
        )->where('id', $id)->first();

        $cooperatorSlug = $request->route('cooperator');
        $cooperator = Cooperator::where('slug', $cooperatorSlug)->first();


        $private_tours = PrivateTour::with('tourTitle')
            ->where('package_id', $package->id)
            ->where('website', true)
            ->where('cooperator_id', $cooperator->id)
            ->orderBy('total_price', 'asc')
            ->paginate(9);


        return view('website.package', compact(
            'package',
            'cooperator',
            'private_tours'
        ));

    }

    public function single_tour(Request $request, $lang, $cooperator, $id)
    {

        $private_tour = PrivateTour::with(
            'package.destination',
            'package.packageTitle',
            'tourTitle',
            'cooperator'
        )->findOrFail($id);

        $cooperatorSlug = $request->route('cooperator');
        $cooperator = Cooperator::where('slug', $cooperatorSlug)->first();
        $package = Package::where('id', $private_tour->package_id)->first();



        $package_photos = PackagePhoto::where('package_id', $package->id)->get();
        $package_videos = PackageVideo::where('package_id', $package->id)->get();
        $package_faqs = PackageFaq::where('package_id', $package->id)->get();
        $package_reviews = Review::with('user')
            ->where('package_id', $package->id)
            ->paginate(2);
        $total_reviews = Review::where('package_id', $package->id)->count();
        $package_rating = ($package->total_rating && $package->total_rating > 0)
            ? number_format($package->total_score / $package->total_rating, 1)
            : null; // Return 'N/A' if total_rating is null or 0



        $package_amenities_includes = PackageAmenity::with('amenity')
            ->where('package_id', $package->id)
            ->where('type', 'Include')
            ->get();

        $package_amenities_excludes = PackageAmenity::with('amenity')
            ->where('package_id', $package->id)
            ->where('type', 'Exclude')
            ->get();


        $private_tour_details = PrivateTourDetail::with(
            'accommodation.city',
            'dayTour.tour_photos'
        )
            ->where('private_tour_id', $id)->get();

        return view('website.singleTour', compact(
            'private_tour',
            'package_amenities_includes',
            'package_amenities_excludes',
            'private_tour_details',
            'package_photos',
            'package_videos',
            'package_faqs',
            'cooperator',
            'package_reviews',
            'total_reviews',
            'package_rating',
            'package'
        ));
    }

    public function contact(Request $request)
    {
        $cooperatorSlug = $request->route('cooperator');
        $cooperator = Cooperator::where('slug', $cooperatorSlug)->first();
        $contact_item = ContactItem::where('id', 1)->first();
        return view('website.contact', compact('contact_item', 'cooperator'));
    }

    public function contact_submit(Request $request)
    {
        $cooperatorSlug = $request->route('cooperator');
        $cooperator = Cooperator::where('slug', $cooperatorSlug)->first();
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'subject' => ['required'],
            'message' => ['required'],
        ]);

        $admin = Admin::where('id', 1)->first();
        $subject = $request->subject;
        $message = "<b>Name : </b>" . $request->name . "<br>";
        $message .= "<b>Email : </b>" . $request->email . "<br>";
        $message .= "<b>Phone : </b>" . $request->phone . "<br>";
        $message .= "<b>Message : </b> <br>" . $request->message;

        // Send the email
        \Mail::to($$cooperator->email)->send(new Websitemail($subject, $message));
        return redirect()->back()->with('success', 'Your massage send Successfully, We will contact you Soon');
    }

    public function blog(Request $request)
    {
        $cooperatorSlug = $request->route('cooperator');
        $cooperator = Cooperator::where('slug', $cooperatorSlug)->first();
        $posts = Post::with('blog_category')->orderBy('id', 'desc')->paginate(6);

        $setting = Setting::where('id', 1)->first();
        $blog_banner = $setting->blog_banner;

        return view('website.blog', compact('posts', 'cooperator', 'blog_banner'));
    }

    public function post(Request $request, $lang, $slug)
    {
        $cooperatorSlug = $request->route('cooperator');
        $cooperator = Cooperator::where('slug', $cooperatorSlug)->first();
        $categories = BlogCategory::orderBy('name_en', 'asc')->get();
        $post = Post::with('blog_category')->where('slug', $slug)->first();
        $latest_posts = Post::orderBy('id', 'desc')
            ->where('id', '!=', $post->id) // Exclude the current post
            ->get()
            ->take(3);
        return view('website.post', compact('post', 'categories', 'latest_posts', 'cooperator'));
    }



    public function about(Request $request)
    {
        $cooperatorSlug = $request->route('cooperator');
        $cooperator = Cooperator::where('slug', $cooperatorSlug)->first();
        $welcome_item = WelcomeItem::where('id', 1)->first();
        $features = Feature::get();

        $about_item = AboutItem::where('id', 1)->first();

        $total_destinations = Destination::count();
        $total_Packages = Package::count();
        $total_reviews = Review::count();
        $total_users = User::count();

        $setting = Setting::where('id', 1)->first();
        $about_banner = $setting->about_banner;

        $partners = Cooperator::where('rule_id', 5)->get();
        $team_members = Cooperator::with('rule')
            ->whereIn('rule_id', [1, 2, 3, 5, 7])
            ->get();

        $reviews = Review::with('package.packageTitle', 'user')->orderBy('id', 'desc')->take(9)->get();


        return view('website.about', compact(
            'welcome_item',
            'features',

            'about_item',
            'cooperator',
            'about_banner',
            'partners',
            'reviews',
            'team_members',
            'total_destinations',
            'total_Packages',
            'total_reviews',
            'total_users'
        ));
    }





    public function subscriber_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:subscribers,email'],
        ]);

        $token = hash('sha256', time());

        $obj = new Subscriber();
        $obj->email = $request->email;
        $obj->token = $token;
        $obj->status = 'Pending';
        $obj->save();

        $verification_link = route('subscriber_verify', [
            'email' => $request->email,
            'token' => $token
        ]);

        $subject = "Subscriber verification";
        $message = "Please Click on the Following Link to verify your email address as subscriber:<br>";
        $message .= "<a href='" . $verification_link . "'>Click Here</a>";

        $admin_data = Admin::where('id', 1)->first();
        // Send the email
        \Mail::to($request->email)->send(new Websitemail($subject, $message));
        return redirect()->back()->with('success', 'Your are subscribed successfully. Please Check your email to confirm the verification Link ');

    }

    public function subscriber_verify($email, $token)
    {
        $subscriber = Subscriber::where('email', $email)
            ->where('token', $token)
            ->first();
        if (!$subscriber) {
            return redirect()->route('home');
        }

        $subscriber->token = '';
        $subscriber->status = 'Active';
        $subscriber->save();

        return redirect()->route('home')->with('success', 'Your Email is Verified, Your Email is Subscribed Now.');

    }

    public function team_members()
    {
        $team_members = TeamMember::paginate(20);
        return view('front.team_members', compact(
            'team_members',

        ));
    }

    public function team_member($slug)
    {
        $team_member = TeamMember::where('slug', $slug)->first();

        return view('front.team_member', compact(
            'team_member'
        ));
    }

    public function faq()
    {
        $faqs = Faq::get();

        return view('front.faq', compact(
            'faqs'
        ));
    }

    public function terms()
    {
        $term_item = TermPrivacyItem::where('id', 1)->first();

        return view('front.term', compact(
            'term_item'
        ));
    }

    public function privacy()
    {
        $privacy_item = TermPrivacyItem::where('id', 1)->first();

        return view('front.privacy', compact(
            'privacy_item'
        ));
    }



    public function category($slug)
    {
        $category = BlogCategory::where('slug', $slug)->first();
        $posts = Post::with('blog_category')->where('blog_category_id', $category->id)->orderBy('id', 'desc')->paginate(9);

        return view('front.category', compact('posts', 'category', ));
    }


    public function wishlist($package_id)
    {
        // Check if the user is not authenticated
        if (!Auth::guard('web')->check()) {
            return redirect()->route('login')->with('error', "Please login first to add this item to your wishlist!");
        }

        $user_id = Auth::guard('web')->user()->id;

        // Check if the item is already in the wishlist
        $check = Wishlist::where('user_id', $user_id)->where('package_id', $package_id)->count();
        if ($check > 0) {
            return redirect()->back()->with('error', "This item is already in your wishlist.");
        }

        // Add the item to the wishlist
        $wishlist = new Wishlist();
        $wishlist->user_id = $user_id;
        $wishlist->package_id = $package_id;
        $wishlist->save();

        return redirect()->back()->with('success', "Item is added to your wishlist.");
    }



    public function payment(Request $request)
    {
        // dd($request->all());
        if (!$request->tour_id) {
            return redirect()->back()->with('error', "Please Select a tour First");
        }


        $tour_data = PackageTour::where('id', $request->tour_id)->first();

        if ($tour_data->total_seat != 0) {
            $total_allowed_seats = $tour_data->total_seat;

            $total_booked_seats = 0;
            $all_data = Booking::where('tour_id', $request->tour_id)
                ->where('package_id', $request->package_id)
                ->get();
            foreach ($all_data as $data) {
                $total_booked_seats += $data->total_person;
            }

            $remaining_seats = $total_allowed_seats - $total_booked_seats;
            if ($total_booked_seats + $request->total_person > $total_allowed_seats) {
                return redirect()->back()->with('error', 'Sorry! only ' . $remaining_seats . ' seats are available for this tour.');
            }
        }




        $user_id = Auth::guard('web')->user()->id;
        $package = Package::where('id', $request->package_id)->first();
        if ($request->payment_method == 'PayPal') {
            $total_price = $request->ticket_price * $request->total_person;
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('paypal_success'),
                    "cancel_url" => route('paypal_cancel')
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $total_price
                        ]
                    ]
                ]
            ]);
            //dd($response);
            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] == 'approve') {
                        // session()->put('product_name', $package->name);
                        session()->put('total_person', $request->total_person);
                        session()->put('tour_id', $request->tour_id);
                        session()->put('package_id', $request->package_id);
                        session()->put('user_id', $user_id);
                        return redirect()->away($link['href']);
                    }
                }
            } else {
                return redirect()->route('paypal_cancel');
            }
        } elseif ($request->payment_method == 'Cash') {
            $obj = new Booking();
            $obj->tour_id = $request->tour_id;
            $obj->user_id = Auth::guard('web')->user()->id;
            $obj->package_id = $request->package_id;
            $obj->total_person = $request->total_person;
            $obj->paid_amount = $request->ticket_price;
            $obj->payment_method = "Cash";
            $obj->payment_status = "Pending";
            $obj->invoice_no = time();
            $obj->save();

            return redirect()->back()->with('success', "Payment is Pending");


        } else {

        }
    }


    public function paypal_success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        //dd($response);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            // Insert data into database
            $obj = new Booking();
            $obj->tour_id = session()->get('tour_id');
            $obj->user_id = session()->get('user_id');
            $obj->package_id = session()->get('package_id');
            $obj->total_person = session()->get('total_person');
            // $obj->payment_id = $response['id'];
            // $obj->product_name = session()->get('product_name');
            $obj->paid_amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            // $obj->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            $obj->payer_name = $response['payer']['name']['given_name'];
            $obj->payer_email = $response['payer']['email_address'];
            $obj->payment_method = "PayPal";
            $obj->payment_status = $response['status'];
            $obj->invoice_no = time();
            $obj->save();

            unset($_SESSION['tour_id']);
            unset($_SESSION['package_id']);
            unset($_SESSION['user_id']);
            unset($_SESSION['total_person']);

            return redirect()->back()->with('success', "Payment is successful");

        } else {
            return redirect()->route('cancel');
        }

    }

    public function paypal_cancel()
    {
        return redirect()->back()->with('error', "Payment is canceled");

    }

    public function enquary_form_submit(Request $request, $id)
    {
        // Fetch the package and admin data
        $package = Package::where('id', $id)->first();
        $admin = Admin::where('id', 1)->first();

        // Validate the form data
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'message' => ['required'],
        ]);

        // Create the subject for the email
        $subject = "Enquiry about: " . $package->name;

        // Create the message content by concatenating the strings
        $message = "<b>Name: </b>" . $request->name . "<br>";
        $message .= "<b>Email: </b>" . $request->email . "<br>";
        $message .= "<b>Phone: </b>" . $request->phone . "<br>";
        $message .= "<b>Message: </b>" . nl2br($request->message) . "<br>";

        // Send the email
        \Mail::to($admin->email)->send(new Websitemail($subject, $message));

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your enquiry has been submitted successfully, we will contact you soon.');
    }

    public function registration()
    {
        return view('front.registration');
    }

    public function registration_submit(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
            'retype_password' => ['required', 'same:password'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $token = hash('sha256', time());
        $user->token = $token;
        $user->save();


        $verification_link = route('registration_verify', ['email' => $request->email, 'token' => $token]);

        $subject = "Registration Verification";
        $message = 'To complete registration, please click on the link below:<br> <a href="' . $verification_link . '">Click Here</a>';


        \Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->back()->with('success', 'Your registration is completed. Please check your email for verification. If you do not find the email in your inbox, please check your spam folder.');
    }

    public function registration_verify($email, $token)
    {
        $user = User::where('token', $token)->where('email', $email)->first();
        if (!$user) {
            return redirect()->route('login');
        }
        $user->token = '';
        $user->status = 1;
        $user->update();
        return redirect()->route('login')->with('success', 'Your email is verified. You can login now.');
    }

    public function login()
    {
        return view('front.login');
    }

    public function login_submit(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
        ];



        if (Auth::guard('web')->attempt($data)) {
            return redirect()->back()->with('success', 'Login is Successful!');
        } else {
            return redirect()->back()->with('error', 'The information you entered is incorrect! Please try again!')->withInput();
        }
    }

    public function forget_password()
    {
        return view('front.forget-password');
    }

    public function logout()
    {
        // dd("hello");
        Auth::guard('web')->logout();
        return redirect()->back()->with('success', 'Logout is successful!');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Email is not found');
        }

        $token = hash('sha256', time());
        $user->token = $token;
        $user->update();

        $reset_link = route('reset_password', ['email' => $request->email, 'token' => $token]);
        $subject = "Password Reset";
        $message = "To reset password, please click on the link below:<br>";
        $message .= "<a href='" . $reset_link . "'>Click Here</a>";

        \Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->back()->with('success', 'We have sent a password reset link to your email. Please check your email. If you do not find the email in your inbox, please check your spam folder.');
    }

    public function reset_password($email, $token)
    {
        $user = User::where('email', $email)->where('token', $token)->first();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Token or email is not correct');
        }
        return view('front.reset-password', compact('email', 'token'));
    }

    public function reset_password_submit(Request $request, $token, $email)
    {
        $request->validate([
            'password' => ['required'],
            'retype_password' => ['required', 'same:password'],
        ]);

        $user = User::where('email', $request->email)->where('token', $request->token)->first();
        $user->password = Hash::make($request->password);
        $user->token = "";
        $user->update();

        return redirect()->route('login')->with('success', 'Password reset is successful. You can login now.');
    }

    public function review_submit(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'rating' => ['required'],
            'comment' => ['required'],
        ]);
        $obj = new Review();
        $obj->user_id = Auth::guard('web')->user()->id;
        $obj->package_id = $request->package_id;
        $obj->rating = $request->rating;
        $obj->comment = $request->comment;
        $obj->save();

        $package_data = Package::where('id', $request->package_id)->first();
        $package_data->total_rating = $package_data->total_rating + 1;
        $package_data->total_score = $package_data->total_score + $request->rating;
        $package_data->update();

        return redirect()->back()->with('success', 'Your review has been submited successfuly');

    }

}
