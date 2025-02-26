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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->nullable();
            $table->string('name_ru')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('slug')->nullable();

            $table->text('description_en')->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_ar')->nullable();

            $table->string('country')->nullable();

            $table->text('visa_requirement_en')->nullable();
            $table->text('visa_requirement_ru')->nullable();
            $table->text('visa_requirement_ar')->nullable();


            $table->string('language_en')->nullable();
            $table->string('language_ru')->nullable();
            $table->string('language_ar')->nullable();

            $table->string('currency_en')->nullable();
            $table->string('currency_ru')->nullable();
            $table->string('currency_ar')->nullable();

            $table->text('activities_en')->nullable();
            $table->text('activities_ru')->nullable();
            $table->text('activities_ar')->nullable();

            $table->string('area_en')->nullable();
            $table->string('area_ru')->nullable();
            $table->string('area_ar')->nullable();

            $table->string('timezone_en')->nullable();
            $table->string('timezone_ru')->nullable();
            $table->string('timezone_ar')->nullable();

            $table->text('best_time_en')->nullable();
            $table->text('best_time_ru')->nullable();
            $table->text('best_time_ar')->nullable();

            $table->text('health_safety_en')->nullable();
            $table->text('health_safety_ru')->nullable();
            $table->text('health_safety_ar')->nullable();

            $table->text('map')->nullable();
            $table->integer('view_count')->nullable();
            $table->string('featured_photo')->nullable();
            $table->string('banner')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
