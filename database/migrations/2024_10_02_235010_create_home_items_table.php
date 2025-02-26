<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('home_items', function (Blueprint $table) {
            $table->id();

            $table->string('travel_icon_1')->nullable();
            $table->string('travel_icon_2')->nullable();
            $table->string('travel_icon_3')->nullable();

            $table->string('title_1_en')->nullable();
            $table->string('title_1_ru')->nullable();
            $table->string('title_1_ar')->nullable();
            $table->text('destination_1_en')->nullable();
            $table->text('destination_1_ru')->nullable();
            $table->text('destination_1_ar')->nullable();

            $table->string('title_2_en')->nullable();
            $table->string('title_2_ru')->nullable();
            $table->string('title_2_ar')->nullable();
            $table->text('destination_2_en')->nullable();
            $table->text('destination_2_ru')->nullable();
            $table->text('destination_2_ar')->nullable();

            $table->string('title_3_en')->nullable();
            $table->string('title_3_ru')->nullable();
            $table->string('title_3_ar')->nullable();
            $table->text('destination_3_en')->nullable();
            $table->text('destination_3_ru')->nullable();
            $table->text('destination_3_ar')->nullable();


            $table->string('explore_title_en')->nullable();
            $table->string('explore_title_ru')->nullable();
            $table->string('explore_title_ar')->nullable();
            $table->text('explore_description_en')->nullable();
            $table->text('explore_description_ru')->nullable();
            $table->text('explore_description_ar')->nullable();

            $table->string('explore_photo')->nullable();
            $table->string('explore_video')->nullable();

            $table->string('choose_title_en')->nullable();
            $table->string('choose_title_ru')->nullable();
            $table->string('choose_title_ar')->nullable();
            $table->text('choose_description_en')->nullable();
            $table->text('choose_description_ru')->nullable();
            $table->text('choose_description_ar')->nullable();

            $table->string('choose_icon_1')->nullable();
            $table->string('choose_icon_2')->nullable();
            $table->string('choose_icon_3')->nullable();


            $table->string('choose_title_1_en')->nullable();
            $table->string('choose_title_1_ru')->nullable();
            $table->string('choose_title_1_ar')->nullable();
            $table->text('choose_description_1_en')->nullable();
            $table->text('choose_description_1_ru')->nullable();
            $table->text('choose_description_1_ar')->nullable();

            $table->string('choose_title_2_en')->nullable();
            $table->string('choose_title_2_ru')->nullable();
            $table->string('choose_title_2_ar')->nullable();
            $table->text('choose_description_2_en')->nullable();
            $table->text('choose_description_2_ru')->nullable();
            $table->text('choose_description_2_ar')->nullable();

            $table->string('choose_title_3_en')->nullable();
            $table->string('choose_title_3_ru')->nullable();
            $table->string('choose_title_3_ar')->nullable();
            $table->text('choose_description_3_en')->nullable();
            $table->text('choose_description_3_ru')->nullable();
            $table->text('choose_description_3_ar')->nullable();

            $table->string('choose_photo')->nullable();

            $table->string('help_title_en')->nullable();
            $table->string('help_title_ru')->nullable();
            $table->string('help_title_ar')->nullable();
            $table->text('help_description_en')->nullable();
            $table->text('help_description_ru')->nullable();
            $table->text('help_description_ar')->nullable();

            $table->string('testimonial_photo')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_items');
    }
};
