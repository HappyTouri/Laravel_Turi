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
        Schema::create('private_tours', function (Blueprint $table) {
            $table->id();
            $table->integer('cooperator_id')->nullable();
            $table->string('tour_name')->nullable();
            $table->integer('package_id')->nullable();
            $table->integer('tour_title_id')->nullable();
            $table->integer('transportation_id')->nullable();
            $table->date('from')->nullable();
            $table->date('till')->nullable();
            $table->integer('number_of_days')->nullable();
            $table->boolean('website')->nullable();
            $table->integer('transportation_price')->nullable();
            $table->integer('tourguide_price')->nullable();
            $table->integer('hotels_price')->nullable();
            $table->integer('profit_price')->nullable();
            $table->integer('total_price')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('reserved')->nullable();
            $table->integer('number_of_people')->nullable();
            $table->integer('driver_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('status')->nullable();
            $table->boolean('my_offer')->nullable();
            $table->text('note')->nullable();
            $table->integer('driver_price')->nullable();
            $table->timestamp('admin_seen_at')->nullable();
            $table->timestamp('cooperator_seen_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_tours');
    }
};
