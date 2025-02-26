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
        Schema::create('cooperators', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('agent_name')->nullable();
            $table->string('slug')->nullable();
            $table->string('email')->unique();
            $table->string('photo')->nullable();
            $table->string('logo')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();

            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('token')->nullable();
            $table->string('status')->default(0)->comment('0=pending, 1=active, 2=suspended');
            $table->string('rule_id')->nullable();
            $table->string('company_name')->nullable();
            $table->string('accommodation_id')->nullable();
            $table->string('tourguide_id')->nullable();
            $table->string('driver_id')->nullable();
            $table->string('destination_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooperators');
    }
};
