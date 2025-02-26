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
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->integer('destination_id');
            $table->integer('city_id');
            $table->string('name')->nullable();
            $table->string('featured_photo')->nullable();
            $table->string('accommodation_type')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('video_link')->nullable();
            $table->text('hotel_website')->nullable();
            $table->integer('rate')->nullable();
            $table->text('note')->nullable();
            $table->boolean('share')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};
