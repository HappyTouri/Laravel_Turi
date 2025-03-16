<?php
use App\Http\Controllers\Admin\AdminAboutItemController;
use App\Http\Controllers\Admin\AdminAccommodationController;
use App\Http\Controllers\Admin\AdminAmenityController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminBlogCategoryController;
use App\Http\Controllers\Admin\AdminContactItemController;
use App\Http\Controllers\Admin\AdminCooperatorController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDestinationController;
use App\Http\Controllers\Admin\AdminDriverController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminFeatureController;
use App\Http\Controllers\Admin\AdminHomeItemController;
use App\Http\Controllers\Admin\AdminLeadsStatusController;
use App\Http\Controllers\Admin\AdminOfferController;
use App\Http\Controllers\Admin\AdminPackageController;
use App\Http\Controllers\Admin\AdminPackageTitleController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminRoomCategoryController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\AdminSubscriberController;
use App\Http\Controllers\Admin\AdminTeamMemberController;
use App\Http\Controllers\Admin\AdminTermPrivacyItemController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminTourController;
use App\Http\Controllers\Admin\AdminTourguideController;
use App\Http\Controllers\Admin\AdminTourguidePriceController;
use App\Http\Controllers\Admin\AdminTourTitleController;
use App\Http\Controllers\Admin\AdminTransportationPriceController;
use App\Http\Controllers\Admin\AdminTransportationTypeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminWelcomeItemController;
use App\Http\Controllers\Admin\AdminCounterItemController;

// Admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'login'])->name('admin_login');
    Route::post('/login', [AdminAuthController::class, 'login_submit'])->name('admin_login_submit');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin_logout');
    Route::get('/forget-password', [AdminAuthController::class, 'forget_password'])->name('admin_forget_password');
    Route::post('/forget_password_submit', [AdminAuthController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset-password/{token}/{email}', [AdminAuthController::class, 'reset_password'])->name('admin_reset_password');
    Route::post('/reset-password/{token}/{email}', [AdminAuthController::class, 'reset_password_submit'])->name('admin_reset_password_submit');

});

// Admin MiddleWare
Route::middleware('admin')->prefix('admin')->group(function () {
    //Dashboard Section
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/profile', [AdminAuthController::class, 'profile'])->name('admin_profile');
    Route::post('/profile', [AdminAuthController::class, 'profile_submit'])->name('admin_profile_submit');
    //Slider Section
    Route::get('/slider/index', [AdminSliderController::class, 'index'])->name('admin_slider_index');
    Route::get('/slider/create', [AdminSliderController::class, 'create'])->name('admin_slider_create');
    Route::post('/slider/create', [AdminSliderController::class, 'create_submit'])->name('admin_slider_create_submit');
    Route::get('/slider/edit/{id}', [AdminSliderController::class, 'edit'])->name('admin_slider_edit');
    Route::post('/slider/edit/{id}', [AdminSliderController::class, 'edit_submit'])->name('admin_slider_edit_submit');
    Route::get('/slider/delete/{id}', [AdminSliderController::class, 'delete'])->name('admin_slider_delete');

    //Welcome
    Route::get('/welcome-item/index', [AdminWelcomeItemController::class, 'index'])->name('admin_welcome_item_index');
    Route::post('/welcome-item/update', action: [
        AdminWelcomeItemController::class,
        'update'
    ])->name('admin_welcome_item_update');

    //Feature Section
    Route::get('/feature/index', [AdminFeatureController::class, 'index'])->name('admin_feature_index');
    Route::get('/feature/create', [AdminFeatureController::class, 'create'])->name('admin_feature_create');
    Route::post('/feature/create', [AdminFeatureController::class, 'create_submit'])->name('admin_feature_create_submit');
    Route::get('/feature/edit/{id}', [AdminFeatureController::class, 'edit'])->name('admin_feature_edit');
    Route::post('/feature/edit/{id}', [AdminFeatureController::class, 'edit_submit'])->name('admin_feature_edit_submit');
    Route::get('/feature/delete/{id}', [AdminFeatureController::class, 'delete'])->name('admin_feature_delete');

    //Counter Section
    Route::get('/counter/index', [AdminCounterItemController::class, 'index'])->name('admin_counter_item_index');
    Route::post('/counter/update', action: [
        AdminCounterItemController::class,
        'update'
    ])->name('admin_counter_item_update');

    //Testimonial Section
    Route::get('/testimonial/index', [AdminTestimonialController::class, 'index'])->name('admin_testimonial_index');
    Route::get('/testimonial/create', [AdmintestimonialController::class, 'create'])->name('admin_testimonial_create');
    Route::post('/testimonial/create', [
        AdmintestimonialController::class,
        'create_submit'
    ])->name('admin_testimonial_create_submit');
    Route::get('/testimonial/edit/{id}', [AdmintestimonialController::class, 'edit'])->name('admin_testimonial_edit');
    Route::post('/testimonial/edit/{id}', [
        AdmintestimonialController::class,
        'edit_submit'
    ])->name('admin_testimonial_edit_submit');
    Route::get('/testimonial/delete/{id}', [AdmintestimonialController::class, 'delete'])->name('admin_testimonial_delete');

    //Team Member Section
    Route::get('/team-member/index', [AdminTeamMemberController::class, 'index'])->name('admin_team_member_index');
    Route::get('/team-member/create', [AdminTeamMemberController::class, 'create'])->name('admin_team_member_create');
    Route::post('/team-member/create', [
        AdminTeamMemberController::class,
        'create_submit'
    ])->name('admin_team_member_create_submit');
    Route::get('/team-member/edit/{id}', [AdminTeamMemberController::class, 'edit'])->name('admin_team_member_edit');
    Route::post('/team-member/edit/{id}', [
        AdminTeamMemberController::class,
        'edit_submit'
    ])->name('admin_team_member_edit_submit');
    Route::get('/team-member/delete/{id}', [AdminTeamMemberController::class, 'delete'])->name('admin_team_member_delete');

    //Faq Section
    Route::get('/faq/index', [AdminFaqController::class, 'index'])->name('admin_faq_index');
    Route::get('/faq/create', [AdminFaqController::class, 'create'])->name('admin_faq_create');
    Route::post('/faq/create', [AdminFaqController::class, 'create_submit'])->name('admin_faq_create_submit');
    Route::get('/faq/edit/{id}', [AdminFaqController::class, 'edit'])->name('admin_faq_edit');
    Route::post('/faq/edit/{id}', [AdminFaqController::class, 'edit_submit'])->name('admin_faq_edit_submit');
    Route::get('/faq/delete/{id}', [AdminFaqController::class, 'delete'])->name('admin_faq_delete');

    //Blog Category Section
    Route::get('/blog-category/index', [AdminBlogCategoryController::class, 'index'])->name('admin_blog_category_index');
    Route::get('/blog-category/create', [AdminBlogCategoryController::class, 'create'])->name('admin_blog_category_create');
    Route::post('/blog-category/create', [
        AdminBlogCategoryController::class,
        'create_submit'
    ])->name('admin_blog_category_create_submit');
    Route::get('/blog-category/edit/{id}', [AdminBlogCategoryController::class, 'edit'])->name('admin_blog_category_edit');
    Route::post('/blog-category/edit/{id}', [
        AdminBlogCategoryController::class,
        'edit_submit'
    ])->name('admin_blog_category_edit_submit');
    Route::get('/blog-category/delete/{id}', [
        AdminBlogCategoryController::class,
        'delete'
    ])->name('admin_blog_category_delete');

    //Post Section
    Route::get('/admin-post/index', [AdminPostController::class, 'index'])->name('admin_post_index');
    Route::get('/admin-post/create', [AdminPostController::class, 'create'])->name('admin_post_create');
    Route::post('/admin-post/create', [AdminPostController::class, 'create_submit'])->name('admin_post_create_submit');
    Route::get('/admin-post/edit/{id}', [AdminPostController::class, 'edit'])->name('admin_post_edit');
    Route::post('/admin-post/edit/{id}', [AdminPostController::class, 'edit_submit'])->name('admin_post_edit_submit');
    Route::get('/admin-post/delete/{id}', [AdminPostController::class, 'delete'])->name('admin_post_delete');

    //Destination Section
    Route::get('/XXdestination/index', [AdminDestinationController::class, 'index'])->name('admin_destination_index');
    Route::get('/XXdestination/create', action: [
        AdminDestinationController::class,
        'create'
    ])->name('admin_destination_create');
    Route::post('/XXdestination/create', [
        AdminDestinationController::class,
        'create_submit'
    ])->name('admin_destination_create_submit');
    Route::get('/XXdestination/edit/{id}', [AdminDestinationController::class, 'edit'])->name('admin_destination_edit');
    Route::post('/XXdestination/edit/{id}', [
        AdminDestinationController::class,
        'edit_submit'
    ])->name('admin_destination_edit_submit');
    Route::get('/XXdestination/delete/{id}', [
        AdminDestinationController::class,
        'delete'
    ])->name('admin_destination_delete');
    //Destination-Photo Section
    Route::get('/XXdestination/photos/{id}', [
        AdminDestinationController::class,
        'destination_photos'
    ])->name('admin_destination_photos');
    Route::post('/XXdestination/photo-submit/{id}', [
        AdminDestinationController::class,
        'destination_photo_submit'
    ])->name('admin_destination_photo_submit');
    Route::get('/XXdestination/photos-delete/{id}', [
        AdminDestinationController::class,
        'destination_photo_delete'
    ])->name('admin_destination_photo_delete');
    //Destination-Video Section
    Route::get('/XXdestination/videos/{id}', [
        AdminDestinationController::class,
        'destination_videos'
    ])->name('admin_destination_videos');
    Route::post('/XXdestination/video-submit/{id}', [
        AdminDestinationController::class,
        'destination_video_submit'
    ])->name('admin_destination_video_submit');
    Route::get('/XXdestination/video-delete/{id}', [
        AdminDestinationController::class,
        'destination_video_delete'
    ])->name('admin_destination_video_delete');
    //Destination-Cities Section
    Route::get('/XXdestination/cities/{id}', [
        AdminDestinationController::class,
        'destination_cities'
    ])->name('admin_destination_cities');
    Route::post('/XXdestination/city-submit/{id}', [
        AdminDestinationController::class,
        'destination_city_submit'
    ])->name('admin_destination_city_submit');
    Route::get('/destination/city-delete/{id}', [
        AdminDestinationController::class,
        'destination_city_delete'
    ])->name('admin_destination_city_delete');
    Route::get('/xxdestination/city-edit/{id}', [
        AdminDestinationController::class,
        'city_edit'
    ])->name('admin_destination_city_edit');
    Route::post('/xxdestination/city-edit/{id}', [
        AdminDestinationController::class,
        'destination_city_edit_submit'
    ])->name('admin_destination_city_edit_submit');
    //Destination-day-Tours Section
    Route::get('/XXdestination/day-tours/{id}', [
        AdminDestinationController::class,
        'destination_day_tours'
    ])->name('admin_destination_day_tours');
    Route::get('/XXdestination/day-tour-create/{id}', action: [
        AdminDestinationController::class,
        'destination_day_tour_create'
    ])->name('admin_destination_day_tour_create');
    Route::post('/destination/day-tour-create-submit/{id}', action: [
        AdminDestinationController::class,
        'destination_day_tour_create_submit'
    ])->name('admin_destination_day_tour_create_submit');
    Route::get('/destination/day-tour-edit/{id}', action: [
        AdminDestinationController::class,
        'destination_day_tour_edit'
    ])->name('admin_destination_day_tour_edit');
    Route::post('/destination/day-tour-edit-submit/{id}', action: [
        AdminDestinationController::class,
        'destination_day_tour_edit_submit'
    ])->name('admin_destination_day_tour_edit_submit');
    Route::get('/destination/day-tour-delete/{id}', action: [
        AdminDestinationController::class,
        'destination_day_tour_delete'
    ])->name('admin_destination_day_tour_delete');
    //Destination-Tour-Photos Section
    Route::get('/destination/tour/photos/{id}', [
        AdminDestinationController::class,
        'destination_tour_photos'
    ])->name('admin_destination_tour_photos');
    Route::post('/destination/tour/photo-submit/{id}', [
        AdminDestinationController::class,
        'destination_tour_photo_submit'
    ])->name('admin_destination_tour_photo_submit');
    Route::get('/destination/tour/photos-delete/{id}', [
        AdminDestinationController::class,
        'destination_tour_photo_delete'
    ])->name('admin_destination_tour_photo_delete');

    //Packages Section
    Route::get('/all-packages', [AdminPackageController::class, 'index'])->name('admin_package_index');
    Route::get('/create-package', action: [AdminPackageController::class, 'create'])->name('admin_package_create');
    Route::post('/create-package', [AdminPackageController::class, 'create_submit'])->name('admin_package_create_submit');
    Route::get('/edit-package/{id}', [AdminPackageController::class, 'edit'])->name('admin_package_edit');
    Route::post('/edit-package/{id}', [AdminPackageController::class, 'edit_submit'])->name('admin_package_edit_submit');
    Route::get('/delete-package/{id}', [AdminPackageController::class, 'delete'])->name('admin_package_delete');

    //Offers Section
    Route::get('/offer/index', [AdminOfferController::class, 'index'])->name('admin_offer_index');
    Route::get('/offer/create', action: [AdminOfferController::class, 'create'])->name('admin_offer_create');
    Route::post('/offer/create', [AdminOfferController::class, 'create_submit'])->name('admin_offer_create_submit');
    Route::get('/offer/edit/{id}', [AdminOfferController::class, 'edit'])->name('admin_offer_edit');
    Route::post('/offer/edit/{id}', [AdminOfferController::class, 'edit_submit'])->name('admin_offer_edit_submit');
    Route::get('/offer/delete/{id}', [AdminOfferController::class, 'delete'])->name('admin_offer_delete');

    //Package_Amenities Section
    Route::get('/package-amenities/{id}', [
        AdminPackageController::class,
        'package_amenities'
    ])->name('admin_package_amenities');
    Route::post('/package-amenity-submit/{id}', [
        AdminPackageController::class,
        'package_amenity_submit'
    ])->name('admin_package_amenity_submit');
    Route::get('/package-amenity-delete/{id}', [
        AdminPackageController::class,
        'package_amenity_delete'
    ])->name('admin_package_amenity_delete');

    //Package_itineraries Section
    Route::get('/package-itineraries/{id}', [
        AdminPackageController::class,
        'package_itineraries'
    ])->name('admin_package_itineraries');
    Route::post('/package-itinerary-submit/{id}', [
        AdminPackageController::class,
        'package_itinerary_submit'
    ])->name('admin_package_itinerary_submit');
    Route::get('/package-itinerary-delete/{id}', [
        AdminPackageController::class,
        'package_itinerary_delete'
    ])->name('admin_package_itinerary_delete');

    //Package_Photos Section
    Route::get('/package-photos/{id}', [AdminPackageController::class, 'package_photos'])->name('admin_package_photos');
    Route::post('/package-photo-submit/{id}', [
        AdminPackageController::class,
        'package_photo_submit'
    ])->name('admin_package_photo_submit');
    Route::get('/package-photo-delete/{id}', [
        AdminPackageController::class,
        'package_photo_delete'
    ])->name('admin_package_photo_delete');

    //Package_Videos Section
    Route::get('/package-videos/{id}', [AdminPackageController::class, 'package_videos'])->name('admin_package_videos');
    Route::post('/package-video-submit/{id}', [
        AdminPackageController::class,
        'package_video_submit'
    ])->name('admin_package_video_submit');
    Route::get('/package-video-delete/{id}', [
        AdminPackageController::class,
        'package_video_delete'
    ])->name('admin_package_video_delete');

    //Package_Faqs Section
    Route::get('/package-faqs/{id}', [AdminPackageController::class, 'package_faqs'])->name('admin_package_faqs');
    Route::get('/package-faqs/create/{id}', [
        AdminPackageController::class,
        'package_faqs_create'
    ])->name('admin_package_faqs_create');
    Route::post('/package-faq-submit/{id}', [
        AdminPackageController::class,
        'package_faq_submit'
    ])->name('admin_package_faq_submit');
    Route::get('/package-faqs/edit/{id}', [
        AdminPackageController::class,
        'package_faqs_edit'
    ])->name('admin_package_faqs_edit');
    Route::post('/package-faqs/edit-submit/{id}', [
        AdminPackageController::class,
        'package_faq_edit_submit'
    ])->name('admin_package_faq_edit_submit');
    Route::get('/package-faq-delete/{id}', [
        AdminPackageController::class,
        'package_faq_delete'
    ])->name('admin_package_faq_delete');

    //Amenity Section
    Route::get('/amenity/index', [AdminAmenityController::class, 'index'])->name('admin_amenity_index');
    Route::get('/amenity/create', [AdminAmenityController::class, 'create'])->name('admin_amenity_create');
    Route::post('/amenity/create', [AdminAmenityController::class, 'create_submit'])->name('admin_amenity_create_submit');
    Route::get('/amenity/edit/{id}', [AdminAmenityController::class, 'edit'])->name('admin_amenity_edit');
    Route::post('/amenity/edit/{id}', [AdminAmenityController::class, 'edit_submit'])->name('admin_amenity_edit_submit');
    Route::get('/amenity/delete/{id}', [AdminAmenityController::class, 'delete'])->name('admin_amenity_delete');

    //Tour Section
    Route::get('/tour/index', [AdminTourController::class, 'index'])->name('admin_tour_index');
    Route::get('/tour/create', [AdminTourController::class, 'create'])->name('admin_tour_create');
    Route::post('/tour/create', [AdminTourController::class, 'create_submit'])->name('admin_tour_create_submit');
    Route::get('/tour/edit/{id}', [AdminTourController::class, 'edit'])->name('admin_tour_edit');
    Route::post('/tour/edit/{id}', [AdminTourController::class, 'edit_submit'])->name('admin_tour_edit_submit');
    Route::get('/tour/delete/{id}', [AdminTourController::class, 'delete'])->name('admin_tour_delete');
    Route::get('/tour/booking/{tour_id}/{package_id}', [
        AdminTourController::class,
        'tour_booking'
    ])->name('admin_tour_booking');
    Route::get('/tour/booking-delete/{id}', [
        AdminTourController::class,
        'tour_booking_delete'
    ])->name('admin_tour_booking_delete');
    Route::get('/tour/invoice/{id}', [AdminTourController::class, 'tour_invoice'])->name('admin_tour_invoice');
    Route::get('/tour/booking-approve/{id}', [
        AdminTourController::class,
        'tour_booking_approve'
    ])->name('admin_tour_booking_approve');

    //Review Section
    Route::get('/review/index', [AdminReviewController::class, 'index'])->name('admin_review_index');
    Route::get('/review/delete/{id}', [AdminReviewController::class, 'delete'])->name('admin_review_delete');

    //User Section
    Route::get('/users', [AdminUserController::class, 'users'])->name('admin_users');
    Route::get('/user/create', [AdminUserController::class, 'user_create'])->name('admin_user_create');
    Route::post('/user/create', [AdminUserController::class, 'user_create_submit'])->name('admin_user_create_submit');
    Route::get('/user/edit/{id}', [AdminUserController::class, 'user_edit'])->name('admin_user_edit');
    Route::post('/user/edit/{id}', [AdminUserController::class, 'user_edit_submit'])->name('admin_user_edit_submit');
    Route::get('/user/delete/{id}', [AdminUserController::class, 'user_delete'])->name('admin_user_delete');
    Route::get('/message', [AdminUserController::class, 'message'])->name('admin_message');
    Route::get('/message-detail/{id}', [AdminUserController::class, 'message_detail'])->name('admin_message_detail');
    Route::post('/message-submit/{id}', [AdminUserController::class, 'message_submit'])->name('admin_message_submit');

    //Cooperator Section
    Route::get('/all/cooperators', [AdminCooperatorController::class, 'cooperators'])->name('admin_cooperators');
    Route::get('/cooperator/create', [
        AdminCooperatorController::class,
        'cooperator_create'
    ])->name('admin_cooperator_create');
    Route::post('/cooperator/create', [
        AdminCooperatorController::class,
        'cooperator_create_submit'
    ])->name('admin_cooperator_create_submit');
    Route::get('/cooperator/edit/{id}', [
        AdminCooperatorController::class,
        'cooperator_edit'
    ])->name('admin_cooperator_edit');
    Route::post('/cooperator/edit/{id}', [
        AdminCooperatorController::class,
        'cooperator_edit_submit'
    ])->name('admin_cooperator_edit_submit');
    Route::get('/cooperator/delete/{id}', [
        AdminCooperatorController::class,
        'cooperator_delete'
    ])->name('admin_cooperator_delete');

    //Subscriber Section
    Route::get('/subscribers', [AdminSubscriberController::class, 'subscribers'])->name('admin_subscribers');
    Route::get('/subscriber/send-email', [
        AdminSubscriberController::class,
        'send_email'
    ])->name('admin_subscriber_send_email');
    Route::post('/subscriber/send-email-submit', [
        AdminSubscriberController::class,
        'send_email_submit'
    ])->name('admin_subscriber_send_email_submit');
    Route::get('/subscriber/delete/{id}', [AdminSubscriberController::class, 'delete'])->name('admin_subscriber_delete');

    //Home Item Section
    Route::get('/home-item/index', [AdminHomeItemController::class, 'index'])->name('admin_home_item_index');
    Route::post('/home-item/update', action: [AdminHomeItemController::class, 'update'])->name('admin_home_item_update');

    //About Item Section
    Route::get('/about-item/index', [AdminAboutItemController::class, 'index'])->name('admin_about_item_index');
    Route::post('/about-item/update', action: [AdminAboutItemController::class, 'update'])->name('admin_about_item_update');

    //Contact Item Section
    Route::get('/contact-item/index', [AdminContactItemController::class, 'index'])->name('admin_contact_item_index');
    Route::post('/contact-item/update', action: [
        AdminContactItemController::class,
        'update'
    ])->name('admin_contact_item_update');

    //Term and PrivacyItem Section
    Route::get('/term-privacy-item/index', [
        AdminTermPrivacyItemController::class,
        'index'
    ])->name('admin_term_privacy_item_index');
    Route::post('/term-privacy-item/update', action: [
        AdminTermPrivacyItemController::class,
        'update'
    ])->name('admin_term_privacy_item_update');

    //Setting Item Section
    Route::get('/setting/index', [AdminSettingController::class, 'index'])->name('admin_setting_index');
    Route::post('/setting/update', action: [AdminSettingController::class, 'update'])->name('admin_setting_update');

    //Room Category Section
    Route::get('/room-category/index', [AdminRoomCategoryController::class, 'index'])->name('admin_room_categories_index');
    Route::post('/room-category/create', [
        AdminRoomCategoryController::class,
        'create_submit'
    ])->name('admin_room_category_create_submit');
    Route::get('/room-category/edit/{id}', [AdminRoomCategoryController::class, 'edit'])->name('admin_room_category_edit');
    Route::post('/room-category/edit/{id}', [
        AdminRoomCategoryController::class,
        'edit_submit'
    ])->name('admin_room_category_edit_submit');
    Route::get('/room-category/delete/{id}', [
        AdminRoomCategoryController::class,
        'delete'
    ])->name('admin_room_category_delete');


    //Leads Status
    Route::get('/lead-status/index', [AdminLeadsStatusController::class, 'index'])->name('admin_lead_status_index');
    Route::post('/lead-status/create', [
        AdminLeadsStatusController::class,
        'create_submit'
    ])->name('admin_lead_status_create_submit');
    Route::get('/lead-status/edit/{id}', [AdminLeadsStatusController::class, 'edit'])->name('admin_lead_status_edit');
    Route::post('/lead-status/edit/{id}', [
        AdminLeadsStatusController::class,
        'edit_submit'
    ])->name('admin_lead_status_edit_submit');
    Route::get('/lead-status/delete/{id}', [
        AdminLeadsStatusController::class,
        'delete'
    ])->name('admin_lead_status_delete');

    //Accommodation Section
    Route::get('/destination/accommodation/index/{id}', [
        AdminAccommodationController::class,
        'index'
    ])->name('admin_accommodation_index');
    Route::get('/destination/accommodation/create/{id}', [
        AdminAccommodationController::class,
        'create'
    ])->name('admin_accommodation_create');
    Route::post('/destination/accommodation/create/{id}', [
        AdminAccommodationController::class,
        'create_submit'
    ])->name('admin_accommodation_create_submit');
    Route::get('/destination/accommodation/edit/{id}', [
        AdminAccommodationController::class,
        'edit'
    ])->name('admin_accommodation_edit');
    Route::post('/destination/accommodation/edit/{id}', [
        AdminAccommodationController::class,
        'edit_submit'
    ])->name('admin_accommodation_edit_submit');
    Route::get('/destination/accommodation/delete/{id}', [
        AdminAccommodationController::class,
        'delete'
    ])->name('admin_accommodation_delete');
    //Accommodation-Photo Section
    Route::get('/accommodation/photos/{id}', [
        AdminAccommodationController::class,
        'accommodation_photos'
    ])->name('admin_accommodation_photos');
    Route::post('/accommodation/photo-submit/{id}', [
        AdminAccommodationController::class,
        'accommodation_photo_submit'
    ])->name('admin_accommodation_photo_submit');
    Route::get('/accommodation/photos-delete/{id}', [
        AdminAccommodationController::class,
        'accommodation_photo_delete'
    ])->name('admin_accommodation_photo_delete');
    //Accommodation_Rooms_Categories Section
    Route::get('/accommodation/rooms-categories/{id}', [
        AdminAccommodationController::class,
        'accommodation_rooms_categories'
    ])->name('admin_accommodation_rooms_categories');
    Route::post('/accommodation/rooms-categories-submit/{id}', [
        AdminAccommodationController::class,
        'accommodation_room_category_submit'
    ])->name('admin_accommodation_room_category_submit');
    Route::get('/accommodation/rooms-categories-delete/{id}', [
        AdminAccommodationController::class,
        'accommodation_room_category_delete'
    ])->name('admin_accommodation_room_category_delete');
    //Accommodation_Price_list Section
    Route::get('/accommodation/price-list/{id}', [
        AdminAccommodationController::class,
        'accommodation_price_list'
    ])->name('admin_accommodation_price_list');
    Route::post('/admin/accommodation/save-room-prices/{id}', [
        AdminAccommodationController::class,
        'saveRoomPrices'
    ])->name('admin_save_room_prices');


    //Transportation Types Section
    Route::get('/transportation-type/index', [
        AdminTransportationTypeController::class,
        'index'
    ])->name('admin_transportation_types_index');
    Route::post('/transportation-type/create', [
        AdminTransportationTypeController::class,
        'create_submit'
    ])->name('admin_transportation_type_create_submit');
    Route::get('/transportation-type/edit/{id}', [
        AdminTransportationTypeController::class,
        'edit'
    ])->name('admin_transportation_type_edit');
    Route::post('/transportation-type/edit/{id}', [
        AdminTransportationTypeController::class,
        'edit_submit'
    ])->name('admin_transportation_type_edit_submit');
    Route::get('/transportation-type/delete/{id}', [
        AdminTransportationTypeController::class,
        'delete'
    ])->name('admin_transportation_type_delete');

    //Transportation Prices Section
    Route::get('/destination/transportation-price/index/{id}', [
        AdminTransportationPriceController::class,
        'index'
    ])->name('admin_transportation_prices_index');
    Route::post('/destination/transportation-price/create/{id}', [
        AdminTransportationPriceController::class,
        'create_submit'
    ])->name('admin_transportation_price_create_submit');
    Route::get('/destination/transportation-price/edit/{id}', [
        AdminTransportationPriceController::class,
        'edit'
    ])->name('admin_transportation_price_edit');
    Route::post('/destination/transportation-price/edit/{id}', [
        AdminTransportationPriceController::class,
        'edit_submit'
    ])->name('admin_transportation_price_edit_submit');
    Route::get('/destination/transportation-price/delete/{id}', [
        AdminTransportationPriceController::class,
        'delete'
    ])->name('admin_transportation_price_delete');


    //Driver Section
    Route::get('/destination/driver/index/{id}', [AdminDriverController::class, 'index'])->name('admin_driver_index');
    Route::get('/destination/driver/create/{id}', [AdminDriverController::class, 'create'])->name('admin_driver_create');
    Route::post('/destination/driver/create/{id}', [
        AdminDriverController::class,
        'create_submit'
    ])->name('admin_driver_create_submit');
    Route::get('/destination/driver/edit/{id}', [AdminDriverController::class, 'edit'])->name('admin_driver_edit');
    Route::post('/destination/driver/edit/{id}', [
        AdminDriverController::class,
        'edit_submit'
    ])->name('admin_driver_edit_submit');
    Route::get('/destination/driver/delete/{id}', [AdminDriverController::class, 'delete'])->name('admin_driver_delete');
    //Car_Photos Section
    Route::get('/destination/car-photos/{id}', [AdminDriverController::class, 'car_photos'])->name('admin_car_photos');
    Route::post('/destination/car-photo-submit/{id}', [
        AdminDriverController::class,
        'car_photo_submit'
    ])->name('admin_car_photo_submit');
    Route::get('/destination/car-photo-delete/{id}', [
        AdminDriverController::class,
        'car_photo_delete'
    ])->name('admin_car_photo_delete');

    //Tourguide Section
    Route::get('/destination/tourguide/index/{id}', [
        AdminTourguideController::class,
        'index'
    ])->name('admin_tourguide_index');
    Route::get('/destination/tourguide/create/{id}', [
        AdminTourguideController::class,
        'create'
    ])->name('admin_tourguide_create');
    Route::post('/destination/tourguide/create/{id}', [
        AdminTourguideController::class,
        'create_submit'
    ])->name('admin_tourguide_create_submit');
    Route::get('/destination/tourguide/edit/{id}', [AdminTourguideController::class, 'edit'])->name('admin_tourguide_edit');
    Route::post('/destination/tourguide/edit/{id}', [
        AdminTourguideController::class,
        'edit_submit'
    ])->name('admin_tourguide_edit_submit');
    Route::get('/destination/tourguide/delete/{id}', [
        AdminTourguideController::class,
        'delete'
    ])->name('admin_tourguide_delete');

    //Package Title Section
    Route::get('/package-title/index', [AdminPackageTitleController::class, 'index'])->name('admin_package_titles_index');
    Route::post('/package-title/create', [
        AdminPackageTitleController::class,
        'create_submit'
    ])->name('admin_package_title_create_submit');
    Route::get('/package-title/edit/{id}', [AdminPackageTitleController::class, 'edit'])->name('admin_package_title_edit');
    Route::post('/package-title/edit/{id}', [
        AdminPackageTitleController::class,
        'edit_submit'
    ])->name('admin_package_title_edit_submit');
    Route::get('/package-title/delete/{id}', [
        AdminPackageTitleController::class,
        'delete'
    ])->name('admin_package_title_delete');


    //Tour Title Section
    Route::get('/tour-title/index', [AdminTourTitleController::class, 'index'])->name('admin_tour_titles_index');
    Route::post('/tour-title/create', [
        AdminTourTitleController::class,
        'create_submit'
    ])->name('admin_tour_title_create_submit');
    Route::get('/tour-title/edit/{id}', [AdminTourTitleController::class, 'edit'])->name('admin_tour_title_edit');
    Route::post('/tour-title/edit/{id}', [
        AdminTourTitleController::class,
        'edit_submit'
    ])->name('admin_tour_title_edit_submit');
    Route::get('/tour-title/delete/{id}', [AdminTourTitleController::class, 'delete'])->name('admin_tour_title_delete');


    //Tourguide Prices Section
    Route::get('/tourguide-price/index', [
        AdminTourguidePriceController::class,
        'index'
    ])->name('admin_tourguide_prices_index');
    Route::post('/tourguide-price/create', [
        AdminTourguidePriceController::class,
        'create_submit'
    ])->name('admin_tourguide_price_create_submit');
    Route::get('/tourguide-price/edit/{id}', [
        AdminTourguidePriceController::class,
        'edit'
    ])->name('admin_tourguide_price_edit');
    Route::post('/tourguide-price/edit/{id}', [
        AdminTourguidePriceController::class,
        'edit_submit'
    ])->name('admin_tourguide_price_edit_submit');
    Route::get('/tourguide-price/delete/{id}', [
        AdminTourguidePriceController::class,
        'delete'
    ])->name('admin_tourguide_price_delete');
});