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
        Schema::create('tourguides', function (Blueprint $table) {
            $table->id();
            $table->string('destination_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('name');
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('photo')->nullable();
            $table->text('note')->nullable();
            $table->string('price_per_day')->nullable();
            $table->string('status')->nullable();
            $table->integer('rate')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourguides');
    }
};
