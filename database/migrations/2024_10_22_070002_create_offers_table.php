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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'slug');
            $table->string('destination_id');
            $table->string('packageTitle_id');
            $table->text('description_en')->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_ar')->nullable();
            $table->string('featured_photo')->nullable();
            $table->string('banner_photo')->nullable();
            $table->string('price')->nullable();
            $table->string('old_price')->nullable();
            $table->text('map')->nullable();
            $table->boolean('website')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
