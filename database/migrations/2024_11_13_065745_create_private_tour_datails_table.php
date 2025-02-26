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
        Schema::create('private_tour_details', function (Blueprint $table) {
            $table->id();
            $table->integer('private_tour_id')->nullable();
            $table->date('date')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('day_tour_id')->nullable();
            $table->boolean('tourguide')->nullable();
            $table->boolean('with_accommodation')->nullable();
            $table->integer('accommodation_price')->nullable();
            $table->integer('tourguide_price')->nullable();
            $table->integer('tourguide_deal_price')->nullable();
            $table->integer('tourguide_id')->nullable();
            $table->integer('accommodation_id')->nullable();
            $table->integer('number_of_rooms')->nullable();
            $table->string('status')->nullable();
            $table->boolean('email_send')->nullable();
            $table->text('email_note')->nullable();
            $table->integer('invoice_price')->nullable();
            $table->integer('payment_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_tour_datails');
    }
};
