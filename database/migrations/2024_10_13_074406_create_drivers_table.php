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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('city_id')->constrained('cities');
            $table->foreignId('trabsportationType_id')->constrained('transportation_types');
            $table->foreignId('destination_id')->constrained('destinations');
            $table->string('carModel')->nullable();
            $table->string('numberOfSeats')->nullable();
            $table->text('note')->nullable();
            $table->string('pricePerDay')->nullable();
            $table->integer('rate')->nullable();
            $table->string('driverPhoto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
