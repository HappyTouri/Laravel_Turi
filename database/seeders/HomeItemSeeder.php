<?php

namespace Database\Seeders;

use App\Models\HomeItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = new HomeItem();
        $obj->destination_heading = "Popular Destinations";
        $obj->destination_subheading = "Explore our most popular travel destinations around the world";
        $obj->destination_status = "show";

        $obj->feature_status = "show";

        $obj->package_heading = "Popular Packages";
        $obj->package_subheading = "Explore our most popular travel packages around the world";
        $obj->package_status = "show";

        $obj->testimonial_background = "130";
        $obj->testimonial_heading = "Client Testimonials";
        $obj->testimonial_subheading = "See what our clients have to say about their experience with us";
        $obj->testimonial_status = "show";

        $obj->blog_heading = "Latest News";
        $obj->blog_subheading = "Check out the latest news and updates from our blog post";
        $obj->blog_status = "show";

        $obj->save();
    }
}
