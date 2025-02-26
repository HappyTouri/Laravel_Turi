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
        Schema::create('r_room_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('private_tour_detail_id')->nullable();
            $table->integer('room_category_id')->nullable();
            $table->integer('extrabed_price')->nullable();
            $table->integer('room_price')->nullable();
            $table->boolean('extra_bed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_room_categories');
    }
};
