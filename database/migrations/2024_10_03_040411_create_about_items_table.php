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
        Schema::create('about_items', function (Blueprint $table) {
            $table->id();
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('top_title_en')->nullable();
            $table->string('top_title_ru')->nullable();
            $table->string('top_title_ar')->nullable();
            $table->text('top_description_en')->nullable();
            $table->text('top_description_ru')->nullable();
            $table->text('top_description_ar')->nullable();
            $table->string('top_logo_1')->nullable();
            $table->string('top_logo_2')->nullable();

            $table->string('logo1_title_en')->nullable();
            $table->string('logo1_title_ru')->nullable();
            $table->string('logo1_title_ar')->nullable();
            $table->string('logo2_title_en')->nullable();
            $table->string('logo2_title_ru')->nullable();
            $table->string('logo2_title_ar')->nullable();

            $table->string('point_1_en')->nullable();
            $table->string('point_1_ru')->nullable();
            $table->string('point_1_ar')->nullable();
            $table->string('point_2_en')->nullable();
            $table->string('point_2_ru')->nullable();
            $table->string('point_2_ar')->nullable();
            $table->string('point_3_en')->nullable();
            $table->string('point_3_ru')->nullable();
            $table->string('point_3_ar')->nullable();

            $table->string('mission_logo')->nullable();
            $table->text('mission_description_en')->nullable();
            $table->text('mission_description_ru')->nullable();
            $table->text('mission_description_ar')->nullable();


            $table->string('destination_logo')->nullable();
            $table->text('destination_description_en')->nullable();
            $table->text('destination_description_ru')->nullable();
            $table->text('destination_description_ar')->nullable();

            $table->string('planning_logo')->nullable();
            $table->text('planning_description_en')->nullable();
            $table->text('planning_description_ru')->nullable();
            $table->text('planning_description_ar')->nullable();


            $table->string('main_title_en')->nullable();
            $table->string('main_title_ru')->nullable();
            $table->string('main_title_ar')->nullable();
            $table->text('main_description_en')->nullable();
            $table->text('main_description_ru')->nullable();
            $table->text('main_description_ar')->nullable();


            $table->string('title_1_en')->nullable();
            $table->string('title_1_ru')->nullable();
            $table->string('title_1_ar')->nullable();
            $table->text('description_1_en')->nullable();
            $table->text('description_1_ru')->nullable();
            $table->text('description_1_ar')->nullable();


            $table->string('title_2_en')->nullable();
            $table->string('title_2_ru')->nullable();
            $table->string('title_2_ar')->nullable();
            $table->text('description_2_en')->nullable();
            $table->text('description_2_ru')->nullable();
            $table->text('description_2_ar')->nullable();

            $table->string('title_3_en')->nullable();
            $table->string('title_3_ru')->nullable();
            $table->string('title_3_ar')->nullable();
            $table->text('description_3_en')->nullable();
            $table->text('description_3_ru')->nullable();
            $table->text('description_3_ar')->nullable();

            $table->string('title_4_en')->nullable();
            $table->string('title_4_ru')->nullable();
            $table->string('title_4_ar')->nullable();
            $table->text('description_4_en')->nullable();
            $table->text('description_4_ru')->nullable();
            $table->text('description_4_ar')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_items');
    }
};
